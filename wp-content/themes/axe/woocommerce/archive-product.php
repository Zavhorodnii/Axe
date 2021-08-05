<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header();
require_once ('get_filter_products.php');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
//do_action( 'woocommerce_before_main_content' ); хлебные крошки
$this_page_id = get_the_ID();
$product_cat_object = get_queried_object();
//echo $product_cat_object->term_id . '<br>';
//echo $this_page_id;
?>


    <div class="main__wrapp">
    <div class="container">
        <div class="__page-img">
            <?php
            $thumbnail_id = get_term_meta( $product_cat_object->term_id, 'thumbnail_id', true);
            ?>
            <img src="<?php echo wp_get_attachment_url($thumbnail_id) ?>" alt="" class="page__img">
            <div class="axe-ico">
                <div class="axe-icon">
                    <img class="axe-icon" src="<?php echo get_field('icon', 'product_cat_' . $product_cat_object->term_id)['url']; ?>" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="breadcrumbs-wrap">
        <div class="container">
            <ul class="breadcrumbs">
                <li>
                    <a href="<?php echo get_home_url() ?>">Главная</a>
                </li>
                <li>
                    <?php
                    $cate = get_queried_object();
                    ?>
                    <span><?php echo $cate->name ?></span>
                </li>
            </ul>
        </div>
    </div>
    <div class="catalog__text-group">
        <div class="container">
            <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                <h1 class=" catalog__name"><?php woocommerce_page_title(); ?></h1>
            <?php endif;
            echo get_field('description', 'product_cat_' . $product_cat_object->term_id);
            ?>
<!--            <h1 class="catalog__name">Солнцезащитные очки</h1>-->

        </div>
    </div>
    <div class="filter-product__wrapp">
        <div class="container ">
            <div class="filter-product__row">

                <?php wc_get_template('category_filter.php') ?>

                <div class="products__wrap">
                    <div class="sort-count__block">
                        <div class="filter__btn btn">Фильтры</div>
                        <div class="sort-column">
                            <div class="sort-text"> Сортировать по:</div>
                            <div class="select">
                                <div class="select__header">
                                    <span class="select__current " data-orderby="<?php echo $_GET['orderby'] ?>">
                                        <?php
                                        if($_GET['orderby'] == 'ascending_price'){
                                            ?>
                                            Цене
                                            <span class="select__arrow" >
                                                <svg class="icon">
                                                    <use xlink:href="<?php echo get_template_directory_uri() ?>/img/svg/sprite.svg#catalog-price__arrow-up"></use>
                                                </svg>
                                            </span>
                                            <?php
                                        }
                                        elseif($_GET['orderby'] == 'descending_price'){
                                            ?>
                                            Цене
                                            <span class="select__arrow">
                                                <svg class="icon">
                                                    <use xlink:href="<?php echo get_template_directory_uri() ?>/img/svg/sprite.svg#catalog-price__arrow-down"></use>
                                                </svg>
                                            </span>
                                            <?php
                                        }
                                        else {
                                            ?>
                                            Популярности
                                            <span class="current__arrow"></span>
                                            <?php
                                        }
                                        ?>
                                    </span>
                                    <div class="select__icon"></div>
                                </div>
                                <div class="select__body">
                                    <div class="select__item js_change_select_filter_order" data-orderby="popularity">Популярности<span class="select__arrow"><span>
                                    </div>
                                    <div class="select__item js_change_select_filter_order" data-orderby="ascending_price">Цене
                                        <span class="select__arrow">
                                            <svg class="icon">
                                                <use xlink:href="<?php echo get_template_directory_uri() ?>/img/svg/sprite.svg#catalog-price__arrow-up"></use>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="select__item js_change_select_filter_order" data-orderby="descending_price">Цене
                                        <span class="select__arrow">
                                            <svg class="icon">
                                                <use xlink:href="<?php echo get_template_directory_uri() ?>/img/svg/sprite.svg#catalog-price__arrow-down"></use>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php

                            $get_params['taxonomy'] = $product_cat_object->taxonomy;
                            $get_params['slug'] = $product_cat_object->slug;
                            $get_params['functional'] = $_GET['functional'] ? $_GET['functional'] : null;
                            $get_params['style'] = $_GET['style'] ? $_GET['style'] : null;
                            $get_params['price'] = $_GET['price'];
                            $get_params['min_price'] = $_GET['min_price'] ? $_GET['min_price'] : null;
                            $get_params['max_price'] = $_GET['max_price'] ? $_GET['max_price'] : null;
                            $get_params['purpose'] = $_GET['purpose'] ? $_GET['purpose'] : null;
                            $get_params['orderby'] = $_GET['orderby'] ? $_GET['orderby'] : 'popularity';
                            $products_info = filter_product($get_params);
                        ?>

                        <div class="count-colum">Товаров: <span class="red"><?php echo $products_info['count'] ?></span></div>
                    </div>
                    <div class="products__inner" data-js-taxonomy="<?php echo $product_cat_object->taxonomy ?>" data-js-slug="<?php echo $product_cat_object->slug ?>">

                    <?php echo $products_info['html']; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
    get_footer();
?>
