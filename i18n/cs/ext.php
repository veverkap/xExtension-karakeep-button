<?php

return array(
  'karakeepButton' => array(
    'configure' => array(
      'api_token' => 'Token API',
      'api_token_description' => '<ul class="listedNumbers">
        <li>Navigujte do své Karakeep instance na \'<c>Nastavení -> API klíče</c>\'</li>
        <li>Vytvořte nový API klíč</li>
        <li>Zadejte URL své Karakeep instance a API token a klikněte na \'Připojit se ke Karakeep\'</li>
      </ul>
      <span>Podrobnosti naleznete na <a href="https://docs.karakeep.app/api/karakeep-api" target="_blank">Karakeep API dokumentaci</a>!',
      'connect_to_karakeep' => 'Připojit se ke Karakeep',
      'username' => 'Uživatelské jméno',
      'instance_url' => 'URL adresa instance Karakeep',
      'keyboard_shortcut' => ' Klávesová zkratka',
      'extension_disabled' => 'Před připojením ke službě Karakeep je nutné rozšíření povolit!',
      'connected_to_karakeep' => 'Jste připojeni ke Karakeep skrze účet <b>%s</b> zapomocí API tokenu <b>%s</b> na adrese <b>%s</b>.',
      'revoke_access' => 'Odpojit se od Karakeep!'
    ),
    'notifications' => array(
      'added_article_to_karakeep' => 'Úspěšně přidán <i>\'%s\'</i> do Karakeep!',
      'failed_to_add_article_to_karakeep' => 'Přidání článku na Karakeep se nezdařilo! Kód chyby Karakeep API: %s',
      'ajax_request_failed' => 'Požadavek Ajax selhal!',
      'authorized_success' => 'Autorizace proběhla úspěšně!',
      'authorized_aborted' => 'Autorizace přerušena!',
      'authorized_failed' => 'Autorizace selhala! Chyba Karakeep API: %s',
      'relog_required' => 'Je nutné provést opětovné přihlášení na Karakeep! Odhlaste se a znovu přihlaste v nastavení rozšíření.',
      'request_access_failed' => 'Žádost o přístup se nezdařila! Kód chyby Karakeep API: %s',
      'article_not_found' => 'Nelze najít článek!',
    )
  ),
);
