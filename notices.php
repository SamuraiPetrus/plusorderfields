<?php

/*

  notices.php - Alertas emitidos pelo plugin.

  Alertas serão disparados caso não sejam encontrados
  os plugins "WooCommerce" e "PagSeguro for WooCommerce"

*/

function display_notice ( $case ) {

  switch ( $case ) {
    case "missing_woocommerce" :
      add_action( 'admin_notices', function ($message) {
        $class = 'notice notice-error';
        $message = "WooCommerce não está instalado."
      ?>
        <div class="<?=esc_attr( $class )?>"><p><strong>Plus Order Fields:</strong> <?=esc_html( $message )?></p></div>
      <?php
      });
    break;
  }

}

// display_notice("missing_woocommerce");
