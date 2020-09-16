<?php
/*

  integration.php - Integração com a REST API do PagSeguro.

  curl_init(); - Inicia a sessão.
  curl_setopt(); - Configura a sessão.
  curl_exec(); - Executa a sessão.
  curl_close(); - Fecha a sessão.

  Esse algoritmo lista os pedidos do e-commerce independente de seu status,
  e a partir de sua respectiva data de criação, é feita uma requisição
  para algum dos endpoints abaixo:

  (No caso de Sandbox) -> https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/
  (No caso de Produção) -> https://ws.pagseguro.uol.com.br/v2/transactions

  Argumentos:

  [email] -> Obtido pelo registro do usuário ($_email) - @see settings.php
  [token] -> Obtido pelo registro do usuário ($_token) - @see settings.php
  [initialDate] -> Obtida pelo loop dos pedidos ($initialDate)
  [finalDate] -> Obtida pelo loop dos pedidos + tratamento PHP ($finalDate)

  DETALHES SOBRE O FORMATO DA DATA
  Para se adequar ao padrão do PagSeguro, precisei fazer o seguinte tratamento via PHP:

  2020-09-10 11:22:49 (Antes)
  2020-09-10T11:22:49 (Depois)

*/

include_once "transaction.php";
include_once "notices.php";

foreach ( $_orders as $order ) {

  display_notice("001");

  $transaction_query = get_pagseguro_transaction( $_url, $_email, $_token, $order );

  $order_meta_data = [
    "nsu" => $transaction_query->transactions->transaction->reference,
    "auth_date" => $transaction_query->transactions->transaction->date,
    "transaction_id" => $transaction_query->transactions->transaction->code,
    "gross_amount" => $transaction_query->transactions->transaction->grossAmount,
  ];

  print_r($order_meta_data);

}

wp_die();
