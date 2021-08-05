<?php
require_once('ajax_get_single_product.php');

function filter_product($get_params){
    $query_params = null;
    $ajax_result_html = array();
    $url_get_params = array();

    $query_params = [
        'post_type'         => 'product',
        'post_status'       => 'publish',
        'posts_per_page'    => -1,
        'tax_query'         => [
            'relation'      => 'AND',
            [
                'taxonomy'  => $get_params['taxonomy'],
                'field'     => 'slug',
                'terms'     => $get_params['slug'],
            ],
        ],
    ];
    if ($get_params['price']) {
        $query_params['meta_query'] = [
            [
                'key'     => '_price',
                'value'   => explode(';', $get_params['price']),
                'type'    => 'numeric',
                'compare' => 'BETWEEN'
            ]
        ];
        $url_get_params[] = implode(array('price', $get_params['price']), '=');
    }
    if ($get_params['orderby'] == 'popularity') {
        $query_params['meta_key'] = 'total_sales';
        $query_params['orderby'] = 'meta_value_num';
        $url_get_params[] = implode(array('orderby', $get_params['orderby']), '=');
    }
    if ($get_params['orderby'] == 'ascending_price') {
        $query_params['orderby'] = 'meta_value_num';
        $query_params['meta_key'] = '_price';
        $query_params['order'] = 'ASC';
        $url_get_params[] = implode(array('orderby', $get_params['orderby']), '=');
    }
    if ($get_params['orderby'] == 'descending_price') {
        $query_params['orderby'] = 'meta_value_num';
        $query_params['meta_key'] = '_price';
        $query_params['order'] = 'DESC';
        $url_get_params[] = implode(array('orderby', $get_params['orderby']), '=');
    }
    if ($get_params['functional']) {
        $params = explode(';', $get_params['functional']);
        $query_params['tax_query'][] = [
            'taxonomy'  => 'pa_funktsional',
            'field'     => 'slug',
            'terms'     => $params,
            'operator'  => 'AND',
        ];
        $url_get_params[] = implode(array('functional', $get_params['functional']), '=');
    }
    if ($get_params['style']) {
        $params = explode(';', $get_params['style']);
        $query_params['tax_query'][] = [
            'taxonomy'  => 'pa_stil',
            'field'     => 'slug',
            'terms'     => $params,
            'operator'  => 'AND',
        ];
        $url_get_params[] = implode(array('style', $get_params['style']), '=');
    }
    if ($get_params['purpose']) {
        $params = explode(';', $get_params['purpose']);
        $query_params['tax_query'][] = [
            'taxonomy'  => 'pa_naznachenie',
            'field'     => 'slug',
            'terms'     => $params,
            'operator'  => 'AND',
        ];
        $url_get_params[] = implode(array('purpose', $get_params['purpose']), '=');
    }

//    var_export($query_params);
    $query = new WP_Query($query_params);
//    $query->post_count ;

    $skip_count = 0;


    while ($query->have_posts()) {
        $query->the_post();

//        wc_get_template_part('content', 'product');

        $buff_res = ajax_get_single_product();

        $ajax_result_html[] = $buff_res['html'];
        $skip_count += intval($buff_res['skip_count']);
    }
    wp_reset_postdata();

    if($query->post_count == 0){
        $ajax_result_html[] = '<p>' . get_field('site_header_product_not_found', 'option') . '</p>';
    }

    $result = array();
    $result['html'] = implode($ajax_result_html);
    $result['count'] = $query->post_count - $skip_count;
    $result['url'] = '?' . implode($url_get_params, '&');
    return $result;
}