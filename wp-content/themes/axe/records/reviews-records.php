<?php

function reg_reviews_records()
{
	$labels = array(
		'name' 					=> 'Отзывы',
		'singular_name'			=> 'Отзыв', 
		'add_new' 				=> 'Добавить',
		'add_new_item' 			=> 'Добавить', 
		'edit_item' 			=> 'Редактировать',
		'new_item' 				=> 'Новое',
		'all_items' 			=> 'Все отзывы',
		'view_item' 			=> 'Просмотреть',
		'search_items' 			=> 'Поиск отзыва',
		'not_found' 			=> 'Решение не найдено',
		'not_found_in_trash' 	=> 'В корзине не найдено',
		'menu_name' 			=> 'Отзывы' 
	);
	$args = array(
		'labels' 				=> $labels,
		'public' 				=> true,
		'show_ui' 				=> true, 
		'has_archive' 			=> false, 
		'menu_icon' 			=> 'dashicons-format-chat', 
		'menu_position' 		=> 10, 
		'publicly_queryable'	=> false, 
		'supports' 				=> array( 'title', 'custom-fields'),
	);
	register_post_type('reviews', $args);
}

add_action( 'init', 'reg_reviews_records' ); // register post type

?>