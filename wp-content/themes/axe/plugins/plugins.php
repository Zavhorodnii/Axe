<?php

require_once 'class-tgm-plugin-activation.php';
//require_once get_template_directory() . '/plugins/theme-seo-plugin/theme-seo-plugin.php';

function tgm_install_plugins()
{
	$plugins = array
	(
		array
		(
			'name'			=> 'Advanced Custom Fields PRO',
			'slug' 			=> 'advanced-custom-fields-pro',
			'source' 		=> get_template_directory() . '/plugins/acf-pro.zip',
			'required' 		=> true,
		),
		array
		(
			'name' 			=> 'Classic Editor',
			'slug' 			=> 'classic-editor',
			'required' 		=> true,
		),
		array
		(
			'name' 			=> 'Save SVG',
			'slug' 			=> 'safe-svg',
			'required' 		=> true,
		),
		/*array
		(
			'name' 			=> 'GDPR Cookie Consent',
			'slug' 			=> 'cookie-law-info',
			'required' 		=> true,
		),*/
	);
	$config = array
	(
		'settings' => array
		(
			'page_title' => __('Install Required Plugins', 'bimberant-slug'),
			'menu_title' => __('Install Plugins', 'bimberant-slug'),
		),
	);
	tgmpa( $plugins, $config );
}

// load plugins from list and load theme
add_action('tgmpa_register', 'tgm_install_plugins');

?>