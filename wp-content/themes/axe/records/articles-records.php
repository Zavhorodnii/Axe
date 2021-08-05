<?php

function reg_articles_records()
{
    $labels = array
    (
        'name' 					=> 'Статьи',
        'singular_name'			=> 'Статья',
        'add_new' 				=> 'Добавить',
        'add_new_item' 			=> 'Добавить',
        'edit_item' 			=> 'Редактировать',
        'new_item' 				=> 'Новое',
        'all_items' 			=> 'Все статьи',
        'view_item' 			=> 'Просмотреть',
        'search_items' 			=> 'Поиск статьи',
        'not_found' 			=> 'Решение не найдено',
        'not_found_in_trash' 	=> 'В корзине не найдено',
        'menu_name' 			=> 'Статьи'
    );
    $args = array
    (
        'labels' 				=> $labels,
        'public' 				=> true,
        'show_ui' 				=> true,
        'has_archive' 			=> false,
        'menu_icon' 			=> 'dashicons-book-alt',
        'menu_position' 		=> 10,
        'publicly_queryable'	=> true,
        'supports' 				=> array( 'title', 'custom-fields', 'thumbnail', 'editor'),
    );
    register_post_type('articles', $args);
}

add_action( 'init', 'reg_articles_records' ); // register post type

?>