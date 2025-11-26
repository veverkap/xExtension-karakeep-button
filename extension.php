<?php

class KarakeepButtonExtension extends Minz_Extension
{
  #[\Override]
  public function init()
  {
    $this->registerTranslates();

    Minz_View::appendScript($this->getFileUrl('script.js', 'js'), false, false, false);
    Minz_View::appendStyle($this->getFileUrl('style.css', 'css'));
    Minz_View::appendScript(strval(_url('karakeepButton', 'jsVars')), false, true, false);

    $this->registerController('karakeepButton');
    $this->registerViews();
  }

  #[\Override]
  public function handleConfigureAction()
  {
    $this->registerTranslates();
    if (Minz_Request::isPost()) {
      $keyboard_shortcut = Minz_Request::paramString('keyboard_shortcut');
      FreshRSS_Context::userConf()->_attribute('karakeep_shortcut', $keyboard_shortcut);
      FreshRSS_Context::userConf()->save();
    }
  }
}
