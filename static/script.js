if (document.readyState && document.readyState !== 'loading')
{
  documentReady();
} else
{
  document.addEventListener('DOMContentLoaded', async () => await documentReady(), false);
}

async function documentReady()
{
  var karakeepButtons = document.querySelectorAll('#stream .flux a.karakeepButton');
  for (var i = 0; i < karakeepButtons.length; i++)
  {
    let karakeepButton = karakeepButtons[i];
    karakeepButton.addEventListener('click', async function (e)
    {
      if (!karakeepButton)
      {
        return;
      }

      var active = karakeepButton.closest(".flux");
      if (!active)
      {
        return;
      }

      e.preventDefault();
      e.stopPropagation();

      await add_to_karakeep(karakeepButton, active);
    }, false);
  }

  if (karakeep_button_vars.keyboard_shortcut)
  {
    document.addEventListener('keydown', function (e)
    {
      if (e.ctrlKey || e.metaKey || e.altKey || e.shiftKey || e.target.closest('input, textarea'))
      {
        return;
      }

      if (e.key === karakeep_button_vars.keyboard_shortcut)
      {
        var active = document.querySelector("#stream .flux.active");
        if (!active)
        {
          return;
        }

        var karakeepButton = active.querySelector("a.karakeepButton");
        if (!karakeepButton)
        {
          return;
        }

        add_to_karakeep(karakeepButton, active);
      }
    });
  }
}

function requestFailed(activeId, karakeepButtonImg, loadingAnimation)
{
  delete pending_entries[activeId];

  karakeepButtonImg.classList.remove("disabled");
  loadingAnimation.classList.add("disabled");

  badAjax(this.status == 403);
}

async function add_to_karakeep(karakeepButton, active)
{
  const url = karakeepButton.getAttribute("href");
  if (!url)
  {
    return;
  }

  let karakeepButtonImg = karakeepButton.querySelector("img");
  karakeepButtonImg.classList.add("disabled");

  let loadingAnimation = karakeepButton.querySelector(".lds-dual-ring");
  loadingAnimation.classList.remove("disabled");

  let activeId = active.getAttribute('id');
  if (pending_entries[activeId])
  {
    return;
  }

  pending_entries[activeId] = true;
  await fetch(url,
    {
      method: "POST",
      headers:
      {
        "Content-Type": "application/json",
        "Accept": "application/json",
      },
      body: JSON.stringify({
        _csrf: context.csrf,
      })
    })
    .then(async response =>
    {
      delete pending_entries[activeId];

      karakeepButtonImg.classList.remove("disabled");
      loadingAnimation.classList.add("disabled");

      if (!response.ok)
      {
        requestFailed(activeId, karakeepButtonImg, loadingAnimation);
        openNotification(karakeep_button_vars.i18n.failed_to_add_article_to_karakeep.replace('%s', json.errorCode), 'karakeep_button_bad');
        return;
      }

      let json = await response.json();
      if (!json)
      {
        requestFailed(activeId, karakeepButtonImg, loadingAnimation);
        openNotification(karakeep_button_vars.i18n.failed_to_add_article_to_karakeep.replace('%s', json.errorCode), 'karakeep_button_bad');
        return;
      }

      console.log(karakeep_button_vars);
      console.log(json.errorCode);

      switch (json.errorCode)
      {
        case 200:
        case 201:
        case 202:
        case 301:
          karakeepButtonImg.setAttribute("src", karakeep_button_vars.icons.added_to_karakeep);
          openNotification(karakeep_button_vars.i18n.added_article_to_karakeep.replace('%s', json.response.title), 'karakeep_button_good');
          break;

        case 401:
          openNotification(karakeep_button_vars.i18n.relog_required, 'karakeep_button_bad');
          break;

        case 404:
          openNotification(karakeep_button_vars.i18n.article_not_found, 'karakeep_button_bad');
          break;

        case 500:
          openNotification(karakeep_button_vars.i18n.failed_to_add_article_to_karakeep, 'karakeep_button_bad');
          break;

        default:
          requestFailed(activeId, karakeepButtonImg, loadingAnimation);
          break;
      }
    });
}
