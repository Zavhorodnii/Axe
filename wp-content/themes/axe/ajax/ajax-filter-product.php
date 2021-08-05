<?php

add_action('wp_ajax_ajax_filter_product', 'ajax_filter_product');
add_action('wp_ajax_nopriv_ajax_filter_product', 'ajax_filter_product');

function ajax_filter_product(){

    $get_params['taxonomy'] = $_POST['taxonomy'];
    $get_params['slug'] = $_POST['slug'];
    $get_params['functional'] = $_POST['functional'] ? $_POST['functional'] : null;
    $get_params['style'] = $_POST['style'] ? $_POST['style'] : null;
    $get_params['price'] = $_POST['price'];
    $get_params['purpose'] = $_POST['purpose'] ? $_POST['purpose'] : null;
    $get_params['orderby'] = $_POST['orderby'] ? $_POST['orderby'] : 'popularity';

    $products_info = filter_product($get_params);

    $result = array(
        'html'      => $products_info['html'],
        'count'       => $products_info['count'],
        'url'       => $products_info['url'],
    );
    echo json_encode($result);
    die();
}