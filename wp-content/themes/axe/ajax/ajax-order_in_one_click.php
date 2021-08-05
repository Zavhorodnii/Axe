<?php

add_action('wp_ajax_ajax_order_in_one_click', 'ajax_order_in_one_click');
add_action('wp_ajax_nopriv_ajax_order_in_one_click', 'ajax_order_in_one_click');

function ajax_order_in_one_click(){

    if(!isset($_POST['product_id']) ||
        !isset($_POST['phone']) ||
        !isset($_POST['address']) ||
        !isset($_POST['email']) ||
        !isset($_POST['name'])){
        $result = array(
            'result'    => 'error',
        );
        echo json_encode($result);
        die();
    }


    $order = wc_create_order();



    $product_id = intval($_POST['product_id']);

    $variation_colour = $_POST['variation'];
    $variation_id = intval($_POST['variation']);
    $variation_id_2 = array();


    if(isset($_POST['variation'])){
                $variation_id_2[] = $variation_id;
                $order->add_product(wc_get_product($variation_id ? $variation_id : $product_id), 1, [
                    'variation_id'         => intval($variation_id),
                ] );
    } else{
        $order->add_product(wc_get_product($product_id), 1);
    }

    $order->set_billing_phone( $_POST['phone'] );
    $order->set_billing_email( $_POST['email'] );
    $order->set_address($_POST['address']);
    $order->add_order_note('Заказ в один клик');
    $order->set_billing_first_name($_POST['name']);


    $order->save();

    $result = array(
        'result'    => 'add',
    );
    echo json_encode($result);
    die();
}