<?php


add_action('wp_ajax_add_product_coupons', 'add_product_coupons');
add_action('wp_ajax_nopriv_add_product_coupons', 'add_product_coupons');

function add_product_coupons(){
    if(!isset($_POST['coupons'])){
        $result = array(
            'result'    => 'error',
        );
        echo json_encode($result);
        die();
    }

    $status = WC()->cart->apply_coupon( $_POST['coupons'] );
    $amount = 0;
    foreach ( WC()->cart->get_applied_coupons() as $cart_item_key => $coupon ) {
        $coupon = new WC_Coupon($coupon);
        $amount = $coupon->get_amount() . '₽';
    }


    $result = array(
        'result'        => 'add',
        'info'          => $status,
        'amount'          => $amount,
        'cart_total'    => v_get_total_cart(),
    );
    echo json_encode($result);
    die();
}