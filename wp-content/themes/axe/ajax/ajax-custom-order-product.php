<?php

add_action('wp_ajax_ajax_order_products', 'ajax_order_products');
add_action('wp_ajax_nopriv_ajax_order_products', 'ajax_order_products');


function ajax_order_products(){
    if(!isset($_POST['name']) ||
        !isset($_POST['phone']) ||
        !isset($_POST['address']) ||
        !isset($_POST['pay_method']) ||
        !isset($_POST['mail'])){
        $result = array(
            'result'    => 'error',
        );
        echo json_encode($result);
        die();
    }

    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $pay_method = $_POST['pay_method'];


    $address = array(
        'first_name' => $name,
        'last_name'  => '',
        'company'    => '',
        'email'      => $mail,
        'phone'      => $phone,
        'address_1'  => $address,
        'address_2'  => '',
        'city'       => '',
        'state'      => '',
        'postcode'   => '',
        'country'    => 'RU'
    );
    // Get cart


    // Now we create the order
    $order = wc_create_order();

//     The add_product() function below is located in /plugins/woocommerce/includes/abstracts/abstract_wc_order.php
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $product = $cart_item['data'];
        $product_id = $cart_item['product_id'];
        $quantity = $cart_item['quantity'];
        $price = WC()->cart->get_product_price( $product );
        $subtotal = WC()->cart->get_product_subtotal( $product, $cart_item['quantity'] );
        $link = $product->get_permalink( $cart_item );
        // Anything related to $product, check $product tutorial
        $attributes = $product->get_attributes();
        $whatever_attribute = $product->get_attribute( 'whatever' );
        $whatever_attribute_tax = $product->get_attribute( 'pa_whatever' );
        $any_attribute = $cart_item['variation']['attribute_whatever'];
        $meta = wc_get_formatted_cart_item_data( $cart_item );
        $order->add_product($product, $quantity, $any_attribute);
    }
    foreach ( WC()->cart->get_applied_coupons() as $cart_item_key => $coupon ) {
        $order->apply_coupon($coupon);
    }


    $add_shipp = array();
    $shossing_shipping = wc_get_chosen_shipping_method_ids();
    $stop = false;
    foreach ( WC()->cart->get_shipping_packages() as $package_id => $package ) {
        // Check if a shipping for the current package exist
        if ( WC()->session->__isset( 'shipping_for_package_'.$package_id ) ) {
            // Loop through shipping rates for the current package
            foreach ( WC()->session->get( 'shipping_for_package_'.$package_id )['rates'] as $shipping_rate_id => $shipping_rate ) {
//                $rate_id     = $shipping_rate->get_id(); // same thing that $shipping_rate_id variable (combination of the shipping method and instance ID)
                $method_id   = $shipping_rate->get_method_id(); // The shipping method slug
//                $instance_id = $shipping_rate->get_instance_id(); // The instance ID
//                $label_name  = $shipping_rate->get_label(); // The label name of the method
//                $cost        = $shipping_rate->get_cost(); // The cost without tax
//                $tax_cost    = $shipping_rate->get_shipping_tax(); // The tax cost
//                $taxes       = $shipping_rate->get_taxes(); // The taxes details (array)
                if($shossing_shipping[0] == $method_id){
                    $add_shipp [] = $method_id;
                    $order->add_shipping((object)$shipping_rate);
                    $stop = true;
                    break;
                }
            }
        }
        if($stop){
            break;
        }
    }


    $set_stat = '';
    $order->set_billing_phone( $phone );
    $order->set_billing_email( $mail );
    $order->set_address($address);
    $order->set_billing_first_name($name);


    $WC_Payment_Gateways = new WC_Payment_Gateways();
//    $available_gateways = $WC_Payment_Gateways->get_available_payment_gateways();
    $available_gateways = $WC_Payment_Gateways->payment_gateways();
    $available_gateways = apply_filters( 'woocommerce_available_payment_gateways', $available_gateways );
    if ( WC()->cart->needs_payment() ) {
//        $available_gateways = $WC_Payment_Gateways->payment_gateways();
        $count = count($available_gateways);
        if ( ! empty( $available_gateways ) ) {
            foreach ( $available_gateways as $gateway ) {
                if( $gateway->enabled == 'yes' ) {
                    if($pay_method == $gateway->id ){
                        $order->set_payment_method_title($gateway->get_title());
                        $order->set_payment_method($gateway->id);
                        $set_stat = 'set_order';
                        break;
                    }
                }
            }
        }
    }

//    if( WC()->cart->needs_payment() ){
//        $WC_Payment_Gateways = new WC_Payment_Gateways();
//        $available_gateways = $WC_Payment_Gateways->get_available_payment_gateways();
//        if ( ! empty( $available_gateways ) ) {
//            foreach ( $available_gateways as $gateway ) {
//                if($pay_method == $gateway->id ){
//                    $order->set_payment_method_title($gateway->get_title());
//                    $order->set_payment_method($gateway->id);
//                    $set_stat = 'set_order';
//                    break;
//                }
//            }
//        }
//    }

    if(isset($_POST['mess'])){
        $order->add_order_note($_POST['mess']);
    }

    $order->set_address( $address, 'billing' );
    //
    $order->calculate_totals();
    if($pay_method == 'cod'){
        $order->update_status("processing");
    } else{
        $order->update_status("pending payment");
    }

    $order->save();

    $order_url_1 = $order->get_checkout_order_received_url();
    $order_url_2 = get_site_url() . '/checkout/?key=' . $order->get_order_key() . '&order=' . $order->get_id();

    $result = array(
        'result'          => 'add order',
        'set_stat'          => $set_stat,
        'order_url'     => $pay_method == 'cod' ? $order_url_1 : $order_url_2,
    );
    echo json_encode($result);
    die();

}

?>