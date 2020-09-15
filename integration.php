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
  [initialDate] -> Obtida pelo loop dos pedidos ($initial_date)(LINE:33)
  [finalDate] -> Obtida pelo loop dos pedidos + tratamento PHP ($search_interval)(LINE:35)

  DETALHES SOBRE O FORMATO DA DATA
  Para se adequar ao padrão do PagSeguro, precisei fazer o seguinte tratamento via PHP:

  2020-09-10 11:22:49 (Antes)
  2020-09-10T11:22:49 (Depois)

*/

$test = [];

foreach ( $_orders as $order ) {

  //Coletando data de criação do pedido
  $initial_date_object = date_create( $order->post_date );
  $date = $initial_date_object->format('Y-m-d') . "T" . $initial_date_object->format('H:i');

  //Intervalo de 1 minuto, utilizada na filtragem de data da API do PagSeguro
  date_add($initial_date_object, date_interval_create_from_date_string("1 minute"));
  $interval = $initial_date_object->format('Y-m-d') . "T" . $initial_date_object->format('H:i');

  //Requisição da API
  curl_init($_url);

}

wp_die(print_r($test));
