<?php
/*

  integration.php - Cadastro dos metadados ao pedido do WooCommerce

  Através de um "include_once", é puxado o lambda "$transaction_query()" que processa
  uma requisição com a biblioteca cURL tendo como argumentos "url", "email" e "token".

  Esse lambda, juntamente com seus parâmetros foram estruturados em um array "$closure",
  importado ao escopo de uma função anônima, argumento de um "add_action"
  para a ação "woocommerce_thankyou", que na prática é o processo de finalização de
  compra pelo usuário.

  Dentro dessa ação, é criada uma nova instância da classe "WC_Order" com o id do
  pedido que acaba de ser finalizado, representado pela variável "$order_id", que é
  passada como argumento natural da função anônima.

  O lambda passado pela variável "$closure" é executado e seu resultado associa-se a
  variável "$_query", utilizada posteriormente para definir as chaves do array
  "$order_meta_data", responsável pela referência de um laço "foreach" que cadastra
  os metadados ao pedido.

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
