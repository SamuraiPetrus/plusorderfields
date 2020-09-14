<?php

//Controller - Regra de negócio.

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
