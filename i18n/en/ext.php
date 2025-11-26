<?php

return array(
  'karakeepButton' => array(
    'configure' => array(
      'api_token' => 'API token',
      'api_token_description' => '<ul class="listedNumbers">
        <li>Go to your Karakeep instance and navigate to \'<c>User Settings -> API Keys</c>\'</li>
        <li>Create a new API key</li>
        <li>Enter your Karakeep instance url and API token and hit \'Connect to Karakeep\'</li>
      </ul>
      <span>Details can be found on <a href="https://docs.karakeep.app/api/karakeep-api" target="_blank">Karakeep API Documentation</a>!',
      'connect_to_karakeep' => 'Connect to Karakeep',
      'username' => 'Username',
      'instance_url' => 'Karakeep instance url',
      'keyboard_shortcut' => 'Keyboard shortcut',
      'extension_disabled' => 'You need to enable the extension before you can connect to Karakeep!',
      'connected_to_karakeep' => 'You are connected to Karakeep with the account <b>%s</b> using the access token <b>%s</b> at <b>%s</b>.',
      'revoke_access' => 'Disconnect from Karakeep!'
    ),
    'notifications' => array(
      'added_article_to_karakeep' => 'Successfully added <i>\'%s\'</i> to Karakeep!',
      'failed_to_add_article_to_karakeep' => 'Adding article to Karakeep failed! Karakeep API error code: %s',
      'ajax_request_failed' => 'Ajax request failed!',
      'authorized_success' => 'Authorization successful!',
      'authorized_aborted' => 'Authorization aborted!',
      'authorized_failed' => 'Authorization failed! Karakeep API error code: %s',
      'relog_required' => 'Relog to Karakeep is required! Please log out and log back in in the extension settings.',
      'request_access_failed' => 'Access request failed! Karakeep API error code: %s',
      'article_not_found' => 'Can\'t find article!',
    )
  ),
);
