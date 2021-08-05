<?php

function v_get_total_cart(){
    return strval(bcdiv((floatval( preg_replace( '#[^\d.]#', '', WC()->cart->get_cart_total() ) ) + intval(WC()->cart->get_shipping_total())),  1, 2)) . '₽';
}