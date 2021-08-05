<?php


add_action('wp_ajax_select_shipping', 'select_shipping');
add_action('wp_ajax_nopriv_select_shipping', 'select_shipping');

function select_shipping(){
    $count = WC()->cart->cart_contents_count;
    if(!isset($_POST['shipping'])){
        $result = array(
            'result'    => 'error',
            'count'     => $count,
        );
        echo json_encode($result);
        die();
    }
    $shipping = $_POST['shipping'];
    $status = 'not found shipping';
    $costs = 0;

    $count = 0;

    $stop = false;
    foreach ( WC()->cart->get_shipping_packages() as $package_id => $package ) {
        // Check if a shipping for the current package exist
        if ( WC()->session->__isset( 'shipping_for_package_'.$package_id ) ) {
            // Loop through shipping rates for the current package
            foreach ( WC()->session->get( 'shipping_for_package_'.$package_id )['rates'] as $shipping_rate_id => $shipping_rate ) {
                $rate_id     = $shipping_rate->get_id();
                $method_id   = $shipping_rate->get_method_id(); // The shipping method slug
                $cost        = $shipping_rate->get_cost(); // The cost without tax
                if($shipping == $method_id){
//                    WC()->session->set('chosen_shipping_methods', array( 'purolator_shipping' ) );

                    WC()->session->set('chosen_shipping_methods', array( $rate_id ) );

                    WC()->cart->set_shipping_total($cost);
                    $costs = $cost;
                    $status = $method_id;
                    $stop = true;
                    break;
                }
            }
        }
        if($stop){
            break;
        }
    }

//    $WC_Customer = WC()->customer;
//    $WC_Customer_Data_Store_Session = new WC_Customer_Data_Store_Session();
//    $WC_Customer_Data_Store_Session->update( $WC_Customer );


    $payment = array();

//    do_action( 'woocommerce_review_order_before_payment' );

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
                    if(isset($gateway->settings['enable_for_methods']) && is_array($gateway->settings['enable_for_methods'])){
                        if(in_array($shipping ,$gateway->settings['enable_for_methods'])){
                            $payment[] = '<div class="select__item-order" data-pay-method="' . esc_attr($gateway->id) . '">' . $gateway->get_title() . '</div>';
                        }
                    }else{
                        $payment[] = '<div class="select__item-order" data-pay-method="' . esc_attr($gateway->id) . '">' . $gateway->get_title() . '</div>';
                    }
                }
            }
        }
    }

//    $available_gateways = WC()->payment_gateways->get_available_payment_gateways();
//    $gateways = WC()->payment_gateways->get_available_payment_gateways();
//    $enabled_gateways = [];
//    if( $gateways ) {
//        foreach( $gateways as $gateway ) {
//            if( $gateway->enabled == 'yes' ) {
//                $enabled_gateways[] = $gateway;
//            }
//        }
//    }
//    echo '<pre>';
//    print_r( $enabled_gateways ); // Should return an array of enabled gateways
//    echo '</pre>';
//    do_action( 'woocommerce_review_order_after_payment' );


    $result = array(
        'result'    => 'add',
        'status'   => $status,
        'cost'      => $costs,
        'count__'      => $count,
        'payment'      => implode($payment),
        'total_cost'    => v_get_total_cart(),
    );
    echo json_encode($result);
    die();
}