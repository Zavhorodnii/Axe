<?php

add_action('wp_ajax_ajax_review_product', 'ajax_review_product');
add_action('wp_ajax_nopriv_ajax_review_product', 'ajax_review_product');

function ajax_review_product(){
    $count_file = $_POST['count_files'];
    $array_files_id = array();

    for($i = 0; $i < intval($count_file) ; $i++){
        $array_files_id[] = media_handle_upload( 'file_' . $i, 0 );
    }
    $post_data = array(
        'post_title'    => 'Заказ',
        'post_status'   => 'draft',
        'post_type'     => 'reviews',
        'post_author'   => 1,
        'meta_input'    => [
            'name'  => $_POST['name'],
            'rating'   =>  $_POST['stars'],
            'review'    =>  $_POST['text_review'],
            'photos'     =>  $array_files_id,
            'product'     => $_POST['id_product'],
        ],
    );
    $post_id = wp_insert_post( wp_slash($post_data), true );
    $update_post_title = array(
        'ID'            => $post_id,
        'post_title'    => 'Отзыв к товару: ' . $_POST['title_product'],
    );

    wp_update_post( wp_slash($update_post_title), true );
    $result = array(
        'result'      => 'ok',
    );
    echo json_encode($result);
    die();
}