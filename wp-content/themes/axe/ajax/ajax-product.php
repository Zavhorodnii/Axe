<?php

function la_product_add_cart()
{
    if(!isset($_POST['product_id']))
        la_ajax_result('error', 'Not set product ID');

    $product_id = intval($_POST['product_id']);

    $product_cart_id = WC()->cart->generate_cart_id($product_id);

    if(!WC()->cart->find_product_in_cart($product_cart_id))
        WC()->cart->add_to_cart($product_id);
    
    // ищи функцию в template-functions.php
    la_ajax_result('ok');
}

add_action('wp_ajax_la_product_add_cart', 'la_product_add_cart');
add_action('wp_ajax_nopriv_la_product_add_cart', 'la_product_add_cart');

?>