<?php


add_action('wp_ajax_select_shipping_method', 'select_shipping_method');
add_action('wp_ajax_nopriv_select_shipping_method', 'select_shipping_method');

function select_shipping_method(){
    if(!isset($_POST['selected_shipping'])){
        $result = array(
            'result'    => 'error',
        );
        echo json_encode($result);
        die();
    }


    WC()->session->set('chosen_shipping_methods', array( $_POST['selected_shipping'] ) );


    $result = array(
        'result'        => 'add',

    );
    echo json_encode($result);
    die();
}