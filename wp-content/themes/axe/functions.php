<?php
// yemplate functions
require get_template_directory() . '/template-parts/template-functions.php';
// widgets
//require get_template_directory() . '/widgets/widgets.php';
// options
require get_template_directory() . '/options/options.php';
// records
require get_template_directory() . '/records/records.php';
// plugins
require get_template_directory() . '/plugins/plugins.php';
// ajax
require get_template_directory() . '/ajax/ajax.php';




require_once ('woocommerce/get_filter_products.php');

// on thumbnails for post
//add_theme_support('post-thumbnails');
//// on title tag
//add_theme_support('title-tag');
//// on post format for post
//add_theme_support('post-formats');
//// woocommerce support
//add_theme_support('woocommerce');

add_image_size( 'news_item_image', 253, 182, true );
add_image_size( 'news_item_main_image', 855, 588, true );

function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );



// register styles
add_action('wp_enqueue_scripts', 'register_styles');
// register scripts
add_action('wp_enqueue_scripts', 'register_scripts');

add_action('get_footer', 'footer_style', 50);

// register menu
add_action('init', 'register_menus');
// event after set this theme
add_action( 'after_switch_theme', 'on_theme_set');

function register_menus(){
    $locations = array(
        //'example' => __('Example Menu', 'theme'),
        'header' => 'Шапка',
        'footer' => 'Подвал',
    );

    register_nav_menus( $locations );
}


function webp_upload_mimes($existing_mimes){
    $existing_mimes['webp'] = 'image/webp';
    return $existing_mimes;
}
add_filter('mime_types', 'webp_upload_mimes');

add_filter( 'wp_enqueue_scripts', 'change_default_jquery', PHP_INT_MAX );

function change_default_jquery( ){
    wp_dequeue_script( 'jquery');
    wp_deregister_script( 'jquery');
}


function woocommerce_ajax_add_to_cart_js() {
    if (function_exists('is_product') && is_product()) {
        wp_enqueue_script('woocommerce-ajax-add-to-cart', plugin_dir_url(__FILE__) . 'assets/ajax-add-to-cart.js', array('jquery'), '', true);
    }
}
add_action('wp_enqueue_scripts', 'woocommerce_ajax_add_to_cart_js', 99);



function register_styles(){
   // wp_enqueue_style( 'neos-normalize-style', get_template_directory_uri() . '/styles/example.css' );
	//wp_enqueue_style( 'theme-style', get_stylesheet_uri(), array(), null ); // main style css
    wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/css/jquery.fancybox.min.css' ); // main style css
    wp_enqueue_style( 'nouisider', get_template_directory_uri() . '/css/nouislider.min.css' ); // main style css
    wp_enqueue_style( 'style', get_template_directory_uri() . '/css/style.css' ); // main style css
    wp_enqueue_style( 'v_style', get_template_directory_uri() . '/css/v_style.css' ); // main style css

}

function register_scripts(){
	//wp_enqueue_script( 'theme-example-js', get_template_directory_uri() . '/js/example.js', array(), $theme_version, false );
	//wp_enqueue_script( 'theme-jquery-min-js', get_template_directory_uri() . '/js/jquery.min.js', array(), $theme_version, false );
	//wp_enqueue_script( 'theme-main-js', get_template_directory_uri() . '/js/script.js', array(), $theme_version, false );
	
}

function footer_style(){
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', get_template_directory_uri() .'/libs/jquery/jquery.min.js');
    wp_enqueue_script('slick', get_template_directory_uri() .'/libs/slick.min.js');
    wp_enqueue_script('nouislider', get_template_directory_uri() .'/libs/nouislider.min.js');
    wp_enqueue_script('fancybox', get_template_directory_uri() .'/libs/jquery.fancybox.min.js');
    wp_enqueue_script('main', get_template_directory_uri() .'/js/main.js');
    wp_enqueue_script('v__axe_main', get_template_directory_uri() .'/js/v__axe_main.js');
}

function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

//добавляю кнопки в редактор
if( !function_exists('_add_my_quicktags') ){
    function _add_my_quicktags()
    { ?>
        <script type="text/javascript">
            QTags.addButton( 'v_image_right', 'Картинка справа', '<div class="new-item__inner-reverse">', '</div>', '', 'Картинка справа', 3 );
            QTags.addButton( 'v_image_left', 'Картинка слева', '<div class="new-item__inner">', '</div>', '', 'Картинка слева', 4 );
        </script>
    <?php }
    add_action('admin_print_footer_scripts', '_add_my_quicktags');
}