<?php

/*

  settings.php - Painel de controle do plugin.

  Esse é o painel de configurações da integração, nela o usuário
  irá fornecer os dados de autenticação para a integração com a API
  do PagSeguro acontecer.

  É possível escolher entre integrar com a API de Produção e com o Sandbox.

  Settings API -> https://developer.wordpress.org/plugins/settings/settings-api/

*/

function plus_settings_init () {

  register_setting('plusorderfields','plusorderfields_pagseguro_email');
  register_setting('plusorderfields','plusorderfields_pagseguro_token');

  register_setting('plusorderfields','plusorderfields_sandbox_email');
  register_setting('plusorderfields','plusorderfields_sandbox_token');

  register_setting('plusorderfields','plusorderfields_is_sandbox');

  add_settings_section(
    'plus_settings_section',
    'Dados do PagSeguro', 'plus_settings_section_html',
    'plusorderfields'
  );

  add_settings_field(
    'pagseguro_email_field',
    'E-mail', 'pagseguro_email_field_html',
    'plusorderfields',
    'plus_settings_section'
  );

  add_settings_field(
    'pagseguro_token_field',
    'Token', 'pagseguro_token_field_html',
    'plusorderfields',
    'plus_settings_section'
  );

  add_settings_field(
    'sandbox_email_field',
    'E-mail (Sandbox)', 'sandbox_email_field_html',
    'plusorderfields',
    'plus_settings_section'
  );

  add_settings_field(
    'sandbox_token_field',
    'Token (Sandbox)', 'sandbox_token_field_html',
    'plusorderfields',
    'plus_settings_section'
  );

  add_settings_field(
    'is_sandbox_field',
    'Habilitar Pagseguro Sandbox', 'is_sandbox_field_html',
    'plusorderfields',
    'plus_settings_section'
  );

}

add_action( 'admin_init', 'plus_settings_init' );

//Callbacks (Front-end dos campos)

function plus_settings_section_html () {
  echo "";
}

function pagseguro_email_field_html () {
  $_consumer_key = null !== get_option('plusorderfields_pagseguro_email') ? get_option('plusorderfields_pagseguro_email') : '';
  echo '<input id="true_email" type="text" autocomplete="off" name="plusorderfields_pagseguro_email" style="width: 400px;" value="' . $_consumer_key . '" />';
}

function pagseguro_token_field_html () {
  $_consumer_secret = null !== get_option('plusorderfields_pagseguro_token') ? get_option('plusorderfields_pagseguro_token') : '';
  echo '<input id="true_token" type="text" autocomplete="off" name="plusorderfields_pagseguro_token" style="width: 400px;" value="' . $_consumer_secret . '" />';
}

//Sandbox
function sandbox_email_field_html () {
  $_consumer_key = null !== get_option('plusorderfields_sandbox_email') ? get_option('plusorderfields_sandbox_email') : '';
  echo '<input id="sandbox_email" type="text" autocomplete="off" name="plusorderfields_sandbox_email" style="width: 400px;" value="' . $_consumer_key . '" />';
}
function sandbox_token_field_html () {
  $_consumer_secret = null !== get_option('plusorderfields_sandbox_token') ? get_option('plusorderfields_sandbox_token') : '';
  echo '<input id="sandbox_token" type="text" autocomplete="off" name="plusorderfields_sandbox_token" style="width: 400px;" value="' . $_consumer_secret . '" />';
}

//Checkbox - Habilitar Sandbox
function is_sandbox_field_html () {
  $_sandbox_check = get_option('plusorderfields_is_sandbox');
  echo '<input id="is_sandbox" type="checkbox" name="plusorderfields_is_sandbox" '. checked(1, (Bool) $_sandbox_check, false ) .' />';
}

function plusorderfields_page () {
  add_menu_page (
    'Plus Order Fields - Integração adicional ao pedido',
    'Plus Order Fields',
    'manage_options',
    'plusorderfields',
    'plusorderfields_page_html'
  );
}

add_action('admin_menu', 'plusorderfields_page');

//Interface HTML de Plus Order Fields

function plusorderfields_page_html () {
  if ( ! current_user_can ('manage_options') ) {
    return;
  }
  if ( isset( $_GET['settings-updated'] ) ) {
    add_settings_error(
      'plusorderfields_messages',
      'plusorderfields_sucess',
      'Alterações salvas',
      'updated'
    );
  }

  settings_errors('plusorderfields_messages');

  ?>
  <h1 style="margin-top: 50px;"><?= esc_html( get_admin_page_title() ); ?></h1>
  <p style="margin-bottom: 30px;">Escrito com &hearts; ~ por SamuraiPetrus.</p>
  <form method="POST" action="options.php">
    <?php
    settings_fields('plusorderfields');
    do_settings_sections('plusorderfields');
    submit_button('Salvar alterações');
    ?>
  </form>
  <script type="text/javascript" src="<?=plugins_url("assets/js/plusorderfields.min.js", __FILE__)?>" />
  <?php
}
