<?php

//Programando interface para inserção dos dados de integração do WooCommerce

function plus_settings_init () {
  //Registrando nova 'setting' na tabela WP_options
  register_setting('reading','plus_consumer_key');
  register_setting('reading','plus_consumer_secret');

  //Adicionando nova seção 'plus_settings_section' na tela 'reading' de Configuração
  add_settings_section(
    'plus_settings_section',
    'Chaves de acesso a REST API do WooCommerce', 'plus_settings_section_html',
    'reading'
  );

  //Adicionando campo 'plus_settings_field' na seção 'plus_settings_section'
  add_settings_field(
    'consumer_key_field',
    'Consumer Key', 'consumer_key_field_html',
    'reading',
    'plus_settings_section'
  );

  //Adicionando campo 'plus_settings_field' na seção 'plus_settings_section'
  add_settings_field(
    'consumer_secret_field',
    'Consumer Secret', 'consumer_secret_field_html',
    'reading',
    'plus_settings_section'
  );
}

add_action( 'admin_init', 'plus_settings_init' );

//Programando os Callbacks da Interface
function plus_settings_section_html () {
  echo "";
}

function consumer_key_field_html () {
  $_consumer_key = null !== get_option('plus_consumer_key') ? get_option('plus_consumer_key') : '';
  echo '<input type="text" placeholder="Começa com ck_" autocomplete="off" name="plus_consumer_key" style="width: 400px;" value="' . $_consumer_key . '" />';
}

function consumer_secret_field_html () {
  $_consumer_secret = null !== get_option('plus_consumer_secret') ? get_option('plus_consumer_secret') : '';
  echo '<input type="password" placeholder="Começa com cs_" autocomplete="off" name="plus_consumer_secret" style="width: 400px;" value="' . $_consumer_secret . '" />';
}
