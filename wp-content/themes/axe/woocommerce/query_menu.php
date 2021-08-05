<?php

function get_query_menu ($product_cat_object, $term){
    $query_params = array();
    $query_params = [
        'post_type' => 'product',
        'posts_per_page' => 1,
        'tax_query' => [
            'relation' => 'AND',
            [
                'taxonomy' => $product_cat_object->taxonomy,
                'field' => 'slug',
                'terms' => $product_cat_object->slug,
            ],
            [
                'taxonomy' => $term->taxonomy,
                'field' => 'slug',
                'terms' => $term->slug,
            ],
        ],
    ];
    $query = new WP_Query($query_params);
    if($query->post_count > 0){
        return true;
    } else
        return false;
}
