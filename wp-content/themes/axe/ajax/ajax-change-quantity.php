<?php


add_action('wp_ajax_add_product_quantity', 'add_product_quantity');
add_action('wp_ajax_nopriv_add_product_quantity', 'add_product_quantity');

function add_product_quantity(){
    if(!isset($_POST['cart_item_key'])){
        $result = array(
            'result'    => 'error',
        );
        echo json_encode($result);
        die();
    }
    $change = 'none';
    $subtotal = 0;
//    $cart_total = 0;
    $cart_subtotal = 0;
    $post_cart_item_key = $_POST['cart_item_key'];

    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        if($post_cart_item_key == $cart_item_key){
            WC()->cart->set_quantity( $cart_item_key, intval($_POST['new_quantity']) );

            $subtotal = WC()->cart->get_product_subtotal( $cart_item['data'], intval($_POST['new_quantity']) );
//            $cart_total = WC()->cart->get_cart_total();
            $cart_subtotal = WC()->cart->get_cart_subtotal();
            $change = 'change';
            break;
        }
    }


    $result = array(
        'result'    => $change,
        'subtotal'    => $subtotal,
        'cart_total'    => v_get_total_cart(),
        'cart_subtotal'    => $cart_subtotal,
    );
    echo json_encode($result);
    die();
}