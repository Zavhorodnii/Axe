<?php


add_action('wp_ajax_ajax_variation_product', 'ajax_variation_product');
add_action('wp_ajax_nopriv_ajax_variation_product', 'ajax_variation_product');


function ajax_variation_product(){
    $get_params['product_id'] = $_POST['product_id'];
    $get_params['variation_colour'] = $_POST['variation_colour'];
    $products_info = array();
    $saving = array();

    $products_variation = wc_get_product($get_params['product_id']);

    $available_variations = $products_variation->get_available_variations();
    foreach ($available_variations as $key => $variation) {
        if($variation['attributes']['attribute_pa_colour_product'] == $get_params['variation_colour']){
            if($variation['display_regular_price'] != $variation['display_price']){
                $products_info[] = '<p class="card__item__price js_get_price_product">'. $variation['display_price'] .' р.</p>';
                $products_info[] = '<p class="card__item__price-last">'. $variation['display_regular_price'] .' р.</p>';
                $saving[] = $variation['display_regular_price'] - $variation['display_price'];
            } else{
                $products_info[] = '<p class="card__item__price js_get_price_product">'. $variation['display_regular_price'] .' р.</p>';
            }
            break;
        }
    }

    $result = array(
        'html'      => implode($products_info),
        'saving'      => implode($saving),
    );
    echo json_encode($result);
    die();
}