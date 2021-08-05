<?php


add_action('wp_ajax_delete_product_from_cart', 'delete_product_from_cart');
add_action('wp_ajax_nopriv_delete_product_from_cart', 'delete_product_from_cart');

function delete_product_from_cart(){

    if(!isset($_POST['product_id'])){
        $result = array(
            'result'    => 'error',
        );
        echo json_encode($result);
        die();
    }
    $product_id = $_POST['product_id'];
    $remove = 'none';
    if(WC()->cart->find_product_in_cart($product_id)) {
        WC()->cart->remove_cart_item($product_id);
        $remove = 'remove';
    }

    $result = array(
        'result'    => $remove,
        'cart_subtotal' => WC()->cart->get_subtotal(),
        'cart_total'    => v_get_total_cart(),
        'count_products'     => WC()->cart->get_cart_contents_count(),
        'total_order'     => WC()->cart->get_subtotal(),
    );
    echo json_encode($result);
    die();
}