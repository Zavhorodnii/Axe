<?php


add_action('wp_ajax_add_product_to_cart', 'add_product_to_cart');
add_action('wp_ajax_nopriv_add_product_to_cart', 'add_product_to_cart');

function add_product_to_cart(){
    if(!isset($_POST['product_id'])){
        $result = array(
            'result'    => 'error',
        );
        echo json_encode($result);
        die();
    }
    $product_id = $_POST['product_id'];

   if(isset($_POST['variation'])){
//       echo 'variation';
       $variation_colour = $_POST['variation'];
       $products_variation = wc_get_product($product_id);

       $available_variations = $products_variation->get_available_variations();
       foreach ($available_variations as $key => $variation) {
           if($variation['attributes']['attribute_pa_colour_product'] == $variation_colour){
               $variation_id = $variation['variation_id'];
               $product_cart_id = WC()->cart->generate_cart_id($product_id);
                if(!WC()->cart->find_product_in_cart($product_cart_id)) {
                    WC()->cart->add_to_cart($product_id, 1, $variation_id);
                }
               break;
           }
       }
   } else{
    $product_cart_id = WC()->cart->generate_cart_id($product_id);
    if(!WC()->cart->find_product_in_cart($product_cart_id)) {
//        echo 'add product ' . $product_id;
        WC()->cart->add_to_cart($product_id);
    }
   }

    $result = array(
        'result'    => 'add',
        'count_products'     => WC()->cart->get_cart_contents_count(),
        'total_order'     => WC()->cart->get_subtotal(),
    );
    echo json_encode($result);
    die();
}