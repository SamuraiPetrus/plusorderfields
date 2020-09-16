<?php
/*

  transaction.php - Algoritmo de integração com o PagSeguro

  Esse algoritmo lista os pedidos do e-commerce independente de seu status,
  e a partir de sua respectiva data de criação, é feita uma requisição
  para algum dos endpoints abaixo:

  (No caso de Sandbox) -> https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/
  (No caso de Produção) -> https://ws.pagseguro.uol.com.br/v2/transactions

  Argumentos:

  [_url]   -> Obtido no arquivo raíz (plusorderfields.php) ($_url) - @see settings.php
  [_email] -> Obtido pelo registro do usuário ($_email) - @see settings.php
  [_token] -> Obtido pelo registro do usuário ($_token) - @see settings.php
  [order]  -> Obtido pelo loop dos pedidos ($initialDate)

  DETALHES SOBRE O FORMATO DA DATA
  Para se adequar ao padrão do PagSeguro, precisei fazer o seguinte tratamento via PHP:

  2020-09-10 11:22:49 (Antes)
  2020-09-10T11:22:49 (Depois)

*/

$transaction_query = function ( $_url, $_email, $_token, $order ) {

  //Coletando data de criação do pedido
  $initial_date_object = date_create( $order->post_date );
  $initialDate = $initial_date_object->format( 'Y-m-d' ) . "T" . $initial_date_object->format( 'H:i' );

  //Intervalo de 1 minuto, utilizada na filtragem de data da API do PagSeguro
  // date_add( $initial_date_object, date_interval_create_from_date_string( "5 minutes" ) );
  // $finalDate = $initial_date_object->format( 'Y-m-d' ) . "T" . $initial_date_object->format( 'H:i' );

  //Requisição da API
  $transaction = curl_init();

  $transaction_url = $_url .
  "?email=" . $_email .
  "&token=" . $_token .
  "&initialDate=" . $initialDate;

  $options = [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_URL => $transaction_url,
  ];

  curl_setopt_array( $transaction, $options );

  $content = curl_exec( $transaction );

  //Tratando a resposta XML e convertendo em um objeto sdtClass para uso do PHP
  $xml_transaction = simplexml_load_string( $content );
  $json_transaction = json_encode( $xml_transaction );
  $array_transaction = json_decode( $json_transaction );

  curl_close( $transaction );

  return $array_transaction;
};
