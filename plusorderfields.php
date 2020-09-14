<?php
/**
 * Plugin Name: Plus Order Fields
 * Description: Simples integração WooCommerce/Pagseguro para adição de campos adicionais ao pedido.
 * Version: 1.0.0
 * Author: Petrus Nogueira
 */

//Depende do seguinte plugin para funcionar:
// https://br.wordpress.org/plugins/woocommerce-pagseguro/ - WooCommerce For Pagseguro

//Interface de inserção das Chaves REST API do WooCommerce
require 'woocommerce_keys.php';

$_pagseguro = get_option('woocommerce_pagseguro_settings', false);
$_consumer_key = null !== get_option('plus_consumer_key') ? get_option('plus_consumer_key') : '';
$_consumer_secret = null !== get_option('plus_consumer_secret') ? get_option('plus_consumer_secret') : '';

if ( is_array( $_pagseguro ) ) {
  if ( sizeof( $_pagseguro ) ) {
    //Sandbox ou Real?
    if ( $_pagseguro['sandbox'] === 'yes' ) {
      // Integração Sandbox
      $_email = $_pagseguro['sandbox_email'];
      $_token = $_pagseguro['sandbox_token'];

    } else {
      // Integração Real
    }
  }
} else {
  wp_die('WooCommerce Pagseguro não instalado');
}
