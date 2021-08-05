<?php

function reg_news()
{
	$labels = array
	(
		'name' 					=> 'Новости',
		'singular_name'			=> 'Новость',
		'add_new' 				=> 'Добавить',
		'add_new_item' 			=> 'Добавить', 
		'edit_item' 			=> 'Редактировать',
		'new_item' 				=> 'Новое',
		'all_items' 			=> 'Все новости',
		'view_item' 			=> 'Просмотреть',
		'search_items' 			=> 'Поиск новости',
		'not_found' 			=> 'Решение не найдено',
		'not_found_in_trash' 	=> 'В корзине не найдено',
		'menu_name' 			=> 'Новости'
	);
	$args = array
	(
		'labels' 				=> $labels,
		'public' 				=> true,
		'show_ui' 				=> true, 
		'has_archive' 			=> false, 
		'menu_icon' 			=> 'dashicons-admin-customizer', 
		'menu_position' 		=> 10, 
		'publicly_queryable'	=> true, 
		'supports' 				=> array( 'title', 'custom-fields', 'thumbnail', 'editor'),
	);
	register_post_type('news', $args);
}

add_action( 'init', 'reg_news' ); // register post type

?>