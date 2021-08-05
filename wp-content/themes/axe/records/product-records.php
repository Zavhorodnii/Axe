<?php

function reg_filter()
{
	register_taxonomy
	( 
		'filter', 
		'product',
		array
		(
			'labels' => array
			(
				'name'              => 'Фильтр',
				'singular_name'     => 'Фильтр',
				'search_items'      => 'Поиск фильтра',
				'all_items'         => 'Все фильтры',
				'view_item '        => 'Посмотреть фильтр',
				'parent_item'       => 'Родительский фильтр',
				'parent_item_colon' => 'Родительский фильтр',
				'edit_item'         => 'Редактировать',
				'update_item'       => 'Обновить',
				'add_new_item'      => 'Добавить',
				'new_item_name'     => 'Название фильтра',
			),
			'show_admin_column'     => false,
			'hierarchical'			=> true,
			'public_queryble'		=> false,
		)
	);
}

//add_action('init', 'reg_filter'); // register post taxonomy

?>