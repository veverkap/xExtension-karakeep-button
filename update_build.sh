#!/bin/bash

SCRIPT_NAME="update_build.sh"
REMOTE_REPO_URL="git@gitlab.com:joedmin-group/coding-standards.git"

# Validate variables
source .env
[ -z "$BRANCH" ] && echo "Variable 'BRANCH' not declared in .env file."
[ -z "$REMOTE_FOLDER" ] && echo "Variable 'REMOTE_FOLDER' not declared in .env file."
[ -z "$FILES_TO_UPDATE" ] && echo "Variable 'FILES_TO_UPDATE' not declared in .env file."
[[ -z "$BRANCH" || -z "$REMOTE_FOLDER" || -z "$FILES_TO_UPDATE" ]] && exit 1

function check_self_update() {
  # Compare checksums of the local and remote scripts
  local remote_hash=$(git archive --remote=$REMOTE_REPO_URL $BRANCH $SCRIPT_NAME | tar xO | sha256sum | awk '{print $1}')
  local local_hash=$(sha256sum "$SCRIPT_NAME" | awk '{print $1}')

  UPDATE_CHECKED="true"

  if [[ "$remote_hash" != "$local_hash" ]]; then
    echo "Script update available. Updating..."
    git archive --remote=$REMOTE_REPO_URL $BRANCH $SCRIPT_NAME | tar x
    chmod +x "$SCRIPT_NAME"
    echo "Script updated. Re-executing..."
    exec "./$SCRIPT_NAME" "$@"
    exit 0
  fi
}

if [[ -z "$UPDATE_CHECKED" ]]; then
  check_self_update
fi

function update_files() {
  for file in "${FILES_TO_UPDATE[@]}"; do
    echo Updating $file
    git archive --remote="$REMOTE_REPO_URL" "$BRANCH" "$REMOTE_FOLDER/$file" | tar x
    mv "$REMOTE_FOLDER/$file" ./
  done

  rm -rf $REMOTE_FOLDER
}

echo "Updating files..."
update_files

echo "Update complete!"