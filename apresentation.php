<?php

//Camada de apresentação


//Interface de registro das credenciais do Pagseguro / WooCommerce

add_action( 'admin_menu', 'add_plusorder_fields_menu' );

function add_plusorder_fields_menu () {
  add_menu_page (
    "Dados de integração",
    "Dados de integração",
    'manage_options',
    'plus_order_fields_integration',
    'plus_order_fields_html'
  );
}

function plus_order_fields_html () {

  //Controlando a permissão de exibição
  if ( !current_user_can('manage_options') ) {
    return;
  }
  

  submit_button( 'Salvar dados de integração' );

}
