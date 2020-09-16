<?php

function get_pagseguro_transaction ( $_url, $_email, $_token, $order ) {

  //Coletando data de criação do pedido
  $initial_date_object = date_create( $order->post_date );
  $initialDate = $initial_date_object->format('Y-m-d') . "T" . $initial_date_object->format('H:i');

  //Intervalo de 1 minuto, utilizada na filtragem de data da API do PagSeguro
  date_add($initial_date_object, date_interval_create_from_date_string("2 minutes"));
  $finalDate = $initial_date_object->format('Y-m-d') . "T" . $initial_date_object->format('H:i');

  //Requisição da API
  $transaction = curl_init();

  $transaction_url = $_url .
  "?email=" . $_email .
  "&token=" . $_token .
  "&initialDate=" . $initialDate .
  "&finalDate=" . $finalDate;

  $options = [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_URL => $transaction_url,
  ];

  curl_setopt_array($transaction, $options);

  $content = curl_exec($transaction);

  //Tratando a resposta XML e convertendo em um objeto sdtClass para uso do PHP
  $xml_transaction = simplexml_load_string($content);
  $json_transaction = json_encode($xml_transaction);
  $array_transaction = json_decode($json_transaction);

  curl_close($transaction);

  return $array_transaction;
}
