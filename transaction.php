<?php
/*

  transaction.php

  Objetivo: Obter os dados da API do PagSeguro relacionados a um pedido recém finalizado.

  De acordo com a API do PagSeguro, uma requisição ao endpoint "transactions" deve utilizar
  o método "GET", e receber obrigatoriamente os argumentos: "email", "token" e "initialDate".

  Para mais informações: https://dev.pagseguro.uol.com.br/reference/checkout-transparente#api-checkout-transparente-consulta-transacoes-por-data-ou-codigo-de-referencia

  A fim de alcançar o objetivo mencionado, foi definido um lambda "$transaction_query()"
  com os seguintes parâmetros:

  $_url (string) -> Url base gerada pelo arquivo "plusorderfields.php"
  $_email (string) -> E-mail gerado pelo usuário no painel de controle do plugin.
  $_token (string) -> Token gerado pelo usuário no painel de controle do plugin.
  $order (object) -> Instância da classe "WC_Order" gerado pelo arquivo "metadata.php"

  "$transaction_query()" faz uma requisição ao endpoint "transactions" da API do PagSeguro
  através da biblioteca cURL do PHP, os parâmetros do lambda são passados como as variáveis
  de uma requisição GET, e a resposta da mesma, naturalmente um objeto XML, é convertida em
  um array legível ao PHP e atribuída a variável $array_transaction, valor retornado pela função.

*/

$transaction_query = function ( $_url, $_email, $_token, $order ) {

  //Coletando data de criação do pedido
  $initial_date_object = date_create( $order->post_date );
  $initialDate = $initial_date_object->format( 'Y-m-d' ) . "T" . $initial_date_object->format( 'H:i' );

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
