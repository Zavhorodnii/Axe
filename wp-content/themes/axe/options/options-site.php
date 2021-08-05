<?php 

function reg_main_site_settings_acf()
{
	acf_add_local_field_group
	(
		array
		(
			'key' => 'site_options_group',
			'title' => 'Базовые настройки',
			'location' => array 
			(
				array 
				(
					array 
					(
						'param' 		=> 'options_page',
						'operator' 		=> '==',
						'value' 		=> 'main_site_settings_acf',
					),
				),
			)
		)
	);
	
	acf_add_local_field
	( 
		array 
		(
            'key'               => 'site_options_tab_1_field',
            'label'             => 'Шапка',
            'name'              => '',
            'type' 				=> 'tab',
			'placement' 		=> 'top',
			'parent'            => 'site_options_group',
			'required' 			=> 0,
			'conditional_logic' => 0,
			'endpoint' 			=> 0,
		)
	);
	
	acf_add_local_field
	( 
		array
		(
            'key'               => 'site_header_logo_field',
            'label'             => 'Лого',
            'name'              => 'header_logo',
            'type' 				=> 'image',
			'parent'            => 'site_options_group',
		)
	);

	acf_add_local_field
	( 
		array
		(
            'key'               => 'site_header_phone_field',
            'label'             => 'Телефон',
            'name'              => 'header_phone',
            'type' 				=> 'text',
			'parent'            => 'site_options_group',
			'default_value'		=> '8 (450) 111 11 11',
		)
	);

	acf_add_local_field
	( 
		array 
		(
            'key'               => 'site_options_tab_2_field',
            'label'             => 'Подвал',
            'name'              => '',
            'type' 				=> 'tab',
			'placement' 		=> 'top',
			'parent'            => 'site_options_group',
			'required' 			=> 0,
			'conditional_logic' => 0,
			'endpoint' 			=> 0,
		)
	);

	acf_add_local_field
	( 
		array
		(
            'key'               => 'site_footer_logo_field',
            'label'             => 'Лого',
            'name'              => 'footer_logo',
            'type' 				=> 'image',
			'parent'            => 'site_options_group',
		)
	);
	
	acf_add_local_field
	( 
		array
		(
            'key'               => 'site_footer_offer',
            'label'             => 'Оферта',
            'name'              => 'footer_offer',
            'type' 				=> 'url',
			'parent'            => 'site_options_group',
		)
	);

	acf_add_local_field
	(
		array
		(
            'key'               => 'site_footer_terms_of_use',
            'label'             => 'Пользовательское соглашение',
            'name'              => 'footer_terms_of_use',
            'type' 				=> 'url',
			'parent'            => 'site_options_group',
		)
	);

	acf_add_local_field
	(
		array
		(
            'key'               => 'site_footer_year_field',
            'label'             => 'Год',
            'name'              => 'footer_year_field',
            'type' 				=> 'number',
			'parent'            => 'site_options_group',
		)
	);

	acf_add_local_field
	(
		array
		(
            'key'               => 'site_footer_copyright_field',
            'label'             => 'Copyright',
            'name'              => 'footer_copyright',
            'type' 				=> 'text',
			'parent'            => 'site_options_group',
			'default_value'		=> 'Copyright 2021 AXE. All Right Reserved',
		)
	);

	acf_add_local_field
	( 
		array
		(
            'key'               => 'site_footer_phone_field',
            'label'             => 'Телефон',
            'name'              => 'footer_phone',
            'type' 				=> 'text',
			'parent'            => 'site_options_group',
			'default_value'		=> '8(450) 111 11 11',
		)
	);

	acf_add_local_field
	(
		array
		(
            'key'               => 'site_footer_subscribe_field',
            'label'             => 'Подпишитесь',
            'name'              => 'footer_subscribe',
            'type' 				=> 'text',
			'parent'            => 'site_options_group',
		)
	);

	acf_add_local_field
	( 
		array 
		(
            'key'               => 'site_options_tab_3_field',
            'label'             => 'Социальные ссылки',
            'name'              => '',
            'type' 				=> 'tab',
			'placement' 		=> 'top',
			'parent'            => 'site_options_group',
			'required' 			=> 0,
			'conditional_logic' => 0,
			'endpoint' 			=> 0,
		)
	);

	acf_add_local_field
	( 
		array
		(
            'key'               => 'site_header_telegram_field',
            'label'             => 'Telegram',
            'name'              => 'header_telegram',
            'type' 				=> 'url',
			'parent'            => 'site_options_group',
		)
	);

	acf_add_local_field
	( 
		array
		(
            'key'               => 'site_header_whatsapp_field',
            'label'             => 'Whatsapp',
            'name'              => 'header_whatsapp',
            'type' 				=> 'url',
			'parent'            => 'site_options_group',
		)
	);

	acf_add_local_field
	(
		array
		(
            'key'               => 'site_header_skype_field',
            'label'             => 'Skype',
            'name'              => 'header_skype',
            'type' 				=> 'url',
			'parent'            => 'site_options_group',
		)
	);
	
	acf_add_local_field
	( 
		array
		(
            'key'               => 'site_footer_vk_field',
            'label'             => 'ВК',
            'name'              => 'footer_vk',
            'type' 				=> 'url',
			'parent'            => 'site_options_group',
		)
	);

	acf_add_local_field
	( 
		array
		(
            'key'               => 'site_footer_instagram_field',
            'label'             => 'Instagram',
            'name'              => 'footer_instagram',
            'type' 				=> 'url',
			'parent'            => 'site_options_group',
		)
	);

	acf_add_local_field
	( 
		array
		(
            'key'               => 'site_footer_youtube_field',
            'label'             => 'YouTube',
            'name'              => 'footer_youtube',
            'type' 				=> 'url',
			'parent'            => 'site_options_group',
		)
	);

	acf_add_local_field
	( 
		array 
		(
            'key'               => 'site_options_tab_4_field',
            'label'             => 'Нотификация',
            'name'              => '',
            'type' 				=> 'tab',
			'placement' 		=> 'top',
			'parent'            => 'site_options_group',
			'required' 			=> 0,
			'conditional_logic' => 0,
			'endpoint' 			=> 0,
		)
	);

	acf_add_local_field
	( 
		array
		(
            'key'               => 'site_notify_backcall_field',
            'label'             => 'Почта для формы обратной связи',
            'name'              => 'notify_backcall',
            'type' 				=> 'email',
			'parent'            => 'site_options_group',
		)
	);

	acf_add_local_field
	( 
		array
		(
            'key'               => 'site_notify_order_field',
            'label'             => 'Почта для заказов',
            'name'              => 'notify_order',
            'type' 				=> 'email',
			'parent'            => 'site_options_group',
		)
	);
    acf_add_local_field
    (
        array
        (
            'key'               => 'site_options_tab_5_field',
            'label'             => 'Фильтр',
            'name'              => '',
            'type' 				=> 'tab',
            'placement' 		=> 'top',
            'parent'            => 'site_options_group',
            'required' 			=> 0,
            'conditional_logic' => 0,
            'endpoint' 			=> 0,
        )
    );

    acf_add_local_field
    (
        array
        (
            'key'               => 'site_header_min_price',
            'label'             => 'Минимальная цена',
            'name'              => 'min_price',
            'type' 				=> 'number',
            'parent'            => 'site_options_group',
            'default_value'		=> '0',
        )
    );

    acf_add_local_field
    (
        array
        (
            'key'               => 'site_header_max_price',
            'label'             => 'Максимальная цена',
            'name'              => 'max_price',
            'type' 				=> 'number',
            'parent'            => 'site_options_group',
            'default_value'		=> '20000',
        )
    );
    acf_add_local_field
    (
        array
        (
            'key'               => 'site_header_product_not_found',
            'label'             => 'Товар не найден',
            'name'              => 'product_not_found',
            'type' 				=> 'text',
            'parent'            => 'site_options_group',
            'default_value'		=> 'По заданным параметрам товаров не найдено',
        )
    );

    acf_add_local_field
    (
        array
        (
            'key'               => 'site_options_tab_6_field',
            'label'             => 'Ключи',
            'name'              => '',
            'type' 				=> 'tab',
            'placement' 		=> 'top',
            'parent'            => 'site_options_group',
            'required' 			=> 0,
            'conditional_logic' => 0,
            'endpoint' 			=> 0,
        )
    );

    acf_add_local_field
    (
        array
        (
            'key'               => 'site_header_site_key',
            'label'             => 'Ключ сайта',
            'name'              => 'site_key',
            'type' 				=> 'text',
            'parent'            => 'site_options_group',
        )
    );
    acf_add_local_field
    (
        array
        (
            'key'               => 'site_header_secret_key',
            'label'             => 'Секретный ключ',
            'name'              => 'secret_key',
            'type' 				=> 'text',
            'parent'            => 'site_options_group',
        )
    );
    acf_add_local_field
    (
        array
        (
            'key'               => 'site_header_map_key',
            'label'             => 'Ключ карты',
            'name'              => 'map_key',
            'type' 				=> 'text',
            'parent'            => 'site_options_group',
        )
    );

}

if(function_exists('acf_add_options_page')) 
{
	acf_add_options_page(array(
		'page_title' 	=> 'Настройки сайта',
		'menu_title'	=> 'Настройки сайта',
		'menu_slug' 	=> 'main_site_settings_acf',
		'redirect'		=> false
	));
}

add_action('acf/init', 'reg_main_site_settings_acf'); // register fields

?>