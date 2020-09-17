<?php
/**
 * Plugin Name: Plus Order Fields
 * Description: Simples integração ao Pagseguro que gera campos adicionais ao pedido de acordo com seu transactionID no PagSeguro.
 * Version: 1.0.0
 * Author: Petrus Nogueira
 */

/*

  plusorderfields.php - Documentação para desenvolvedores.

  Plus Order Fields é o primeiro plugin desenvolvido por mim,
  Petrus Nogueira, para a plataforma WordPress. Sua função é
  simplesmente adicionar campos adicionais ao pedido através
  de uma requisição a sua respectiva referência no PagSeguro.

  Cada arquivo contém um breve resumo de sua funcionalidade,
  além de links com as referências que fundamentam a
  lógica implementada.

  Requisitos:

  WooCommerce -> https://br.wordpress.org/plugins/woocommerce/
  PagSeguro for WooCommerce -> https://br.wordpress.org/plugins/woocommerce-pagseguro/

  Desenvolvido com <3 ~ SamuraiPetrus

*/

//Variáveis Globais
$_is_sandbox  = null !== get_option('plusorderfields_is_sandbox') ? get_option('plusorderfields_is_sandbox') : 0;
$_orders      = get_posts('post_type=shop_order&post_status=any');
if ( $_is_sandbox ) {
  $_email = null !== get_option('plusorderfields_sandbox_email') ? get_option('plusorderfields_sandbox_email') : 0;
  $_token = null !== get_option('plusorderfields_sandbox_token') ? get_option('plusorderfields_sandbox_token') : 0;
  $_url   = "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/";
} else {
  $_email = null !== get_option('plusorderfields_pagseguro_email') ? get_option('plusorderfields_pagseguro_email') : 0;
  $_token = null !== get_option('plusorderfields_pagseguro_token') ? get_option('plusorderfields_pagseguro_token') : 0;
  $_url   = "https://ws.pagseguro.uol.com.br/v2/transactions";
}


require 'notices.php'; // Alertas (Caso não hajam os requisitos)
require 'integration.php'; // Integração com o PagSeguro
require 'settings.php'; // Painel de controle.
