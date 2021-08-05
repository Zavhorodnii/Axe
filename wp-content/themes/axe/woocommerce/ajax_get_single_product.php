<?php

function ajax_get_single_product()
{
    $skip_count = 0;
    $product_html = array();
    defined('ABSPATH') || exit;

    global $product;

    // Ensure visibility.
    if (empty($product) || !$product->is_visible()) {
        return 'product not found';
    }
    $cookie = explode('&', $_COOKIE["Cookie_like_product"]);
    $pa_stil = $product->attributes['pa_stil'];
    $product_id = get_the_ID();
    $product_link = get_permalink($product_id);

    $product_info = wc_get_product($product_id);
//    var_export($product);
    if ($product_info->is_in_stock() ) {

        $product_html[] = '<div class="__item card__item-price_btn js_loader_control">';
        $product_html[] = '<div class="like-hit__row">';
        $product_html[] = '<a href="#" class="like js_click_like ' . (in_array($product_id, $cookie) ? 'v_active_like' : '') . '" data-id_product="' . $product_id . '"></a>';
        $product_html[] = '<div class="hit__group">';
        $pa_stil = $product_info->get_attributes()['pa_stil'];
//                                                            var_export($pa_stil);
        $additional_label = get_field('additional_label', $product_id);
        if (is_array($additional_label)) {
            foreach ($additional_label as $label) {
                $product_html[] = '<a href="' . get_permalink($product_id) . '" style="color: ' . $label['colour'] . '" class="man"> ' . $label['title'] . '</a>';
            }
        }
        if (is_array($pa_stil['options'])) {
            foreach ($pa_stil['options'] as $item) {
                $product_html[] = '<a href="' . get_permalink($product_id) . '"';
                $product_html[] = 'style="color: ' . get_field('right_colour', 'pa_stil_' . $item) . '"';
                $product_html[] = 'class="hit">' . get_field('right_text', 'pa_stil_' . $item);
                $product_html[] = '</a>';
            }
        }
        $product_html[] = '</div>';
        $product_html[] = '</div>';
        $product_html[] = '<a href="' . get_page_link($product_id) . '"';
        $product_html[] = 'class="product__img">';
        if ($product_info->is_type('variable')) {
            $available_variations = $product_info->get_available_variations();
            $product_html[] = '<img class="js_get_variable_product" data-colour_product="' . $available_variations[0]['attributes']['attribute_pa_colour_product'] . '"  src="' . $available_variations[0]['image']['url'] . '" alt="">';
        } else {
            $product_html[] = $product_info->get_image();
        }
        $product_html[] = '</a>';
        $product_html[] = '<a href="' . get_page_link($product_id) . '"';
        $product_html[] = 'class="product__name">' . $product_info->get_name() . '</a>';
        $product_html[] = '<p class="product__subname">' . $product_info->get_description() . '</p>';
        if ($product_info->is_type('variable')) {
            $available_variations = $product_info->get_available_variations();
            if ($available_variations[0]['display_price'] != $available_variations[0]['display_regular_price']) {
                $product_html[] = '<p class="product__last-prise">' . $available_variations[0]['display_regular_price'] . ' р.</p>';
                $product_html[] = '<p class="product__prise">' . $available_variations[0]['display_price'] . ' р.</p>';
            } else {
                $product_html[] = '<p class="product__prise">' . $available_variations[0]['display_regular_price'] . ' р.</p>';
            }
        } else {
            if ($product_info->get_regular_price() != $product_info->get_price()) {
                $product_html[] = '<p class="product__last-prise">' . $product_info->get_regular_price() . '</p>';
                $product_html[] = '<p class="product__prise">' . $product_info->get_price() . '</p>';
            } else {
                $product_html[] = '<p class="product__prise">' . $product_info->get_price() . '</p>';
            }
        }

        $catalog_mod = get_field('catalog_mod', 'option');
        if($catalog_mod){
            $product_html[] = '<a href="#" class="btn red js_show_prew_order ' . ($product_info->is_type('variable') ? 'js_has_variation' : '') .'" data-product_id="'. $product_id .'">';
                $product_html[] = get_field('text_order', 'option');
            $product_html[] = '</a>';
        } else {
            $product_html[] = '<a href="#" class="btn red js_add_product_to_cart '. ($product_info->is_type('variable') ? 'js_has_variation' : '') .'" data-product_id="'. $product_id .'">';
                $product_cart_id = WC()->cart->generate_cart_id( $product_id );
                $in_cart = WC()->cart->find_product_in_cart( $product_cart_id );
                if ( $in_cart ) {
                    $product_html[] =  'В корзине';
                } else{
                    $product_html[] =  'В корзину';
                }
            $product_html[] = '</a>';
        }

//        $product_html[] = '<a href="#" class="btn red js_add_product_to_cart ' . ($product_info->is_type('variable') ? 'js_has_variation' : '') . '" data-product_id="' . $product_id . '">';
//
//        $product_cart_id = WC()->cart->generate_cart_id($product_id);
//        $in_cart = WC()->cart->find_product_in_cart($product_cart_id);
//
//        if ($in_cart) {
//            $product_html[] = 'В корзине';
//        } else {
//            $product_html[] = 'В корзину';
//        }
//
//        $product_html[] = '</a>';
        $product_html[] = '</div>';
    } else{
        $skip_count++;
    }

    return array(
        'html' => implode($product_html),
        'skip_count' => $skip_count);
}/*
