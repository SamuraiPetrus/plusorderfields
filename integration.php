<?php
/*

  integration.php - Integração com a REST API do PagSeguro.

*/

include_once "transaction.php";

$closure = [
  "transaction_query" => $transaction_query,
  "url" => $_url,
  "email" => $_email,
  "token" => $_token
];

add_action( 'woocommerce_thankyou',  function ( $order_id ) use ( $closure ) {

  $order = get_post( $order_id );

  $_query = $closure["transaction_query"](
    $closure["url"],
    $closure["email"],
    $closure["token"],
    $order
  );

  $order_meta_data = [
    "nsu" => $_query->transactions->transaction->reference,
    "auth_date" => $_query->transactions->transaction->date,
    "transaction_id" => $_query->transactions->transaction->code,
    "gross_amount" => $_query->transactions->transaction->grossAmount,
  ];

  foreach ( $order_meta_data as $meta_key => $meta_value ) {
    if ( get_post_meta($order->ID, $meta_key, true) === "" ) {
      add_post_meta( $order->ID, $meta_key, $meta_value );
    }
  }
  
});
