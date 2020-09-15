<?php
/**
 * Plugin Name: Plus Order Fields
 * Description: Simples integração WooCommerce/Pagseguro para adição de campos adicionais ao pedido.
 * Version: 1.0.0
 * Author: Petrus Nogueira
 */

//Depende do seguinte plugin para funcionar:
// https://br.wordpress.org/plugins/woocommerce-pagseguro/ - WooCommerce For Pagseguro

// $_pagseguro = get_option('woocommerce_pagseguro_settings', false);
// $_pagseguro_email = null !== get_option('plus_consumer_key') ? get_option('plus_consumer_key') : '';
// $_pagseguro_token = null !== get_option('plus_consumer_secret') ? get_option('plus_consumer_secret') : '';
require 'model.php'; //Model - WooCommerce REST API
require 'view.php'; //View - Painel de Configurações.
require 'controller.php'; //Controller - Regra de negócio.
