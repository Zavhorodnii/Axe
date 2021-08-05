<?php

function register_widget_areas() {
	if (function_exists('register_sidebar')) {
		/*register_sidebar( array(
			'name'          => 'Example widget', // Widget Name
			'id'            => 'example-widget-id', // Widget ID
			'description'   => 'Widget About', // Widget description
			'before_widget' => '<div id="%1$s" class="widget %2$s">', // Widget start div
			'after_widget'  => '</div>', // Widget end div
			'before_title'  => '', // title start div
			'after_title'   => '', // title end div
        ) );*/
	}
}

function register_widgets() {
	//register_widget( 'exmapleWidgetClassName' );
}

function add_default_widgets() {
	//add_widget_to_sidebar('example_widget_id', array(/*'param' => 'widget param'*/), 'widget_area_id');
}

/*
	add_widget_to_sidebar() - create widget instace and add widget if he not exist
	is_contains() - check for widgets exist
	add_new_widget() - add widget instance to area
*/
function add_widget_to_sidebar($widget_id, $widget_data, $sidebar_id) {
	$sidebars = get_option( 'sidebars_widgets', array() );
	$widget_instances = get_option( 'widget_' . $widget_id, array());
	
	$key = array_filter( array_keys( $widget_instances ), 'is_int' );
	$key = $key ? max( $key ) + 1 : 2;
	
	if( ! isset($sidebars[ $sidebar_id ])) {
		$sidebars[ $sidebar_id ] = array();
		add_new_widget( $widget_id, $widget_instances, $widget_data, $key, $sidebar_id, $sidebars);
	}
	else {
		if( ! is_contains( $widget_id, $sidebars[ $sidebar_id ]))
			add_new_widget( $widget_id, $widget_instances, $widget_data, $key, $sidebar_id, $sidebars);
	}
		
}

function is_contains($widget_id, $sidebar) {
	foreach($sidebar as $widget) {
		if( stristr ($widget, $widget_id) !== false)
			return true;
	}
	return false;
}

function add_new_widget($widget_id, $widget_instances, $widget_data, $key, $sidebar_id, $sidebars ) {
	$sidebars[ $sidebar_id ][] = $widget_id . '-'. $key;
	$widget_instances[ $key ] = $widget_data;
	update_option( 'sidebars_widgets', $sidebars);
	update_option( 'widget_' . $widget_id, $widget_instances );
}

// widgets files
//require get_template_directory() . '/widgets/widget-example.php';
//require 'widget-example.php';

// register areas for widgets
register_widget_areas();
// register widgets
add_action( 'widgets_init', 'register_widgets' );
// event for add some widgets to site
add_action( 'after_switch_theme', 'on_theme_set' );
?>