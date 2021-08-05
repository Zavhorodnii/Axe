<?php

/*
	Plugin Name: Yandex.Money (card)
	Description: Оплата с помощью любых банковских карт через Яндекс.Деньги (без привязки кошельку). <br> Плагин работает только с установленым плагином Yandex.Money Gateway. 
	Version: 1.0
*/

add_action( 'plugins_loaded', 'yandex_money_gateway_card', 0 );
function yandex_money_gateway_card() {
	if ( ! class_exists( 'WC_Payment_Gateway' ) ) return;
	
	include_once( 'woocommerce-yandex-money.php' );

	add_filter( 'woocommerce_payment_gateways', 'add_yandex_money_gateway_card' );
	function add_yandex_money_gateway_card( $methods ) {
		$methods[] = 'WC_Yandex_Money_Gateway_card';
		return $methods;
	}
}