<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$this_page_id = get_the_ID();
$cookie = explode('&', $_COOKIE["Cookie_product"]);

if(!in_array(strval($this_page_id), $cookie)){
    $cookie[] = $this_page_id;
}
$visit_product = get_field('visit_products', 'option');
$count = count($cookie);
if($count > $visit_product) {
//    array_reverse($cookie);
    $cookie = array_slice($cookie, $count - $visit_product);
}
setcookie("Cookie_product", implode('&', $cookie), time() + 3600 * 24 * 365, "/", null, null, true);

get_header(); ?>
    <div class="main__wrap">
        <div class="breadcrumbs-wrap">
            <div class="container">
                <ul class="breadcrumbs">
                    <li>
                        <a href="<?php echo get_home_url() ?>">Главная</a>
                    </li>
                    <li>
                        <?php
                        $terms = get_the_terms ( $this_page_id, 'product_cat' );
                        ?>
                        <a href="<?php echo get_term_link($terms[0]->term_id, 'product_cat') ?>"><?php echo $terms[0]->name ?></a>
                    </li>
                    <li>
                        <span><?php echo get_the_title() ?></span>
                    </li>
                </ul>
            </div>
        </div>
        <?php while ( have_posts() ) : ?>
            <?php the_post(); ?>

            <?php wc_get_template_part( 'content', 'single-product' ); ?>

        <?php endwhile; // end of the loop.

        $query = new WP_Query( [
            'posts_per_page' => -1,
            'post_type' => 'reviews',
            'meta_query' => [ [
                'key' => 'product',
                'value' => $this_page_id,
            ] ],
        ]);
        ?>
        <section class="card__tabs">
            <div class="container">
                <div class="card__tabs-row">
                    <div class="trapezoid__block">
                        <div class="trapezoid-wrapp">
                            <div class="trapezoid trapezoid-active" id="tab__description">
                                <span class="">Описание</span>
                            </div>
                        </div>
                        <div class="trapezoid-wrapp">
                            <div class="trapezoid" id="tab__video">
                                <span>Видео</span>
                            </div>
                        </div>
                        <div class="trapezoid-wrapp">
                            <div class="trapezoid" id="tab__reviews">
                                <span>Отзывы (<?php echo $query->post_count ?>)</span>
                            </div>
                        </div>
                    </div>



                    <div class="trapezoid__block-mob">
                        <div class="select-tr">
                            <div class="select__header-tr">
                                <span class="select__current-tr">Описание</span>
                                <div class="select__icon-tr"></div>
                            </div>
                            <div class="select__body-tr">
                                <div class="select__item-tr trapezoid" id="tab__description">Описание</div>
                                <div class="select__item-tr trapezoid" id="tab__video">Видео</div>
                                <div class="select__item-tr trapezoid" id="tab__reviews">Отзывы (<?php echo $query->post_count ?>)</div>
                            </div>
                        </div>

                    </div>
                    <div class="card__social-block">
                        <?php
                        $permalink = urlencode(get_the_permalink());
                        $title = get_the_title();
                        ?>
                        <a href="http://vk.com/share.php?url=<?php echo $permalink;?>&title=<?php echo $title;?>&description=<?php echo get_the_content() ?>&image=" target="_blank" class="card__social-link">
                            <img src="<?php echo get_template_directory_uri() ?>/img/card__item/social/vk.svg" alt="">
                        </a>
                        <a href="https://www.facebook.com/sharer?u=&lt;<?php the_permalink();?>&gt;&amp;t=&lt;<?php the_title(); ?>&gt;" target="_blank" rel="noopener noreferrer" class="card__social-link">
                            <img src="<?php echo get_template_directory_uri() ?>/img/card__item/social/facebook.svg" alt="">
                        </a>
                        <a href="https://connect.ok.ru/dk?st.cmd=WidgetSharePreview&st.shareUrl=<?php echo $permalink;?>" target="_blank" class="card__social-link">
                            <img src="<?php echo get_template_directory_uri() ?>/img/card__item/social/ok.svg" alt="">
                        </a>
                        <a href="https://t.me/share/url?url=<?php echo $permalink ?>" target="_blank" class="card__social-link">
                            <img src="<?php echo get_template_directory_uri() ?>/img/card__item/social/telegram.svg" alt="">
                        </a>
                        <a href="http://twitter.com/share?url=<?php echo $permalink ?>&text=<?php echo $title ?>" target="_blank" class="card__social-link">
                            <img src="<?php echo get_template_directory_uri() ?>/img/card__item/social/twitter.svg" alt="">
                        </a>
                        <a href="https://wa.me/?text=<?php echo $permalink ?>" target="_blank" class="card__social-link">
                            <img src="<?php echo get_template_directory_uri() ?>/img/card__item/social/whatsapp.svg"  alt="">
                        </a>
                        <a href="https://www.tumblr.com/widgets/share/tool?canonicalUrl=<?php echo $permalink ?>&title=<?php echo $title ?>&caption=&tags=" target="_blank" class="card__social-link">
                            <img src="<?php echo get_template_directory_uri() ?>/img/card__item/social/tumblr.svg" alt="">
                        </a>
                        <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=&lt;<?php echo $permalink ?>&gt;&amp;title=&lt;<?php echo $title ?>&gt;&amp;summary=&amp;source=&lt;<?php bloginfo('name'); ?>&gt;" target="_new" rel="noopener noreferrer" class="card__social-link">
                            <img src="<?php echo get_template_directory_uri() ?>/img/card__item/social/linkedin.svg" alt="">
                        </a>
                    </div>
                </div>
                <section class=" tab tab__description" style="display:block;">
                    <div class="container">
                        <div class="tab__wrapp">
                            <?php
                            $fields_description = get_field('fields_description', $this_page_id);
                            if(is_array($fields_description)){
                                foreach($fields_description as $item){
                                    ?>
                                    <div class="tab__block-text">
                                        <p class="tab__title"><?php echo $item['title'] ?></p>
                                        <?php
                                        if(is_array($item['image'])){
                                            ?>
                                            <div class="tab__block__size">
                                            <?php
                                            foreach ($item['image'] as $img){
                                                ?>
                                                <img src="<?php echo $img['url'] ?>" alt="img">
                                                <?php
                                            }
                                            ?>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <p class="tab__text"><?php echo $item['description'] ?></p>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </section>
                <section class="tab tab__video" style="display:none;">
                    <div class="container">
                        <div class="tab__wrapp">
                            <?php
                            $video_product = get_field('video_product', $this_page_id);
                            if(is_array($video_product)){
                                foreach($video_product as $item){
                                    ?>
                                    <div class="tab__block-text mr">
                                        <h5 class="tab__title tt"><?php echo $item['title'] ?></h5>
                                        <p class="tab__text"><?php echo $item['description'] ?></p>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                            <div class="tab__vido-block" data-link-video="<?php echo $item['video_link'] ?>">

                            </div>
                        </div>
                    </div>
                </section>
                <section class="tab tab__reviews" style="display:none">
                    <div class="container">
                        <h3 class="tab__title mb-60">Отзывы покупателей</h3>
                        <?php
                        while ( $query->have_posts() ) {
                            $query->the_post();
                            $post_id = $query->post->ID;
                            ?>
                            <div class="tab__reviews-wrapp">
                                <div class="tab__reviews-user">
                                    <div class="user-icno">
                                        <img src="<?php echo get_template_directory_uri() ?>/img/card__item/reviews-icon.svg" alt="">
                                    </div>
                                    <div class="user-info">
                                        <p class="user-date"><?php echo get_the_date( 'j.n.y', $post_id ); ?></p>
                                        <p class="user-name"><?php echo get_field('name', $post_id) ?></p>
                                    </div>
                                    <div class="user-stars">
                                        <?php
                                        $star = get_field('rating', $post_id);
                                        for ($i = 0 ; $i < 5 ; $i++){
                                            ?>
                                            <div class="user-strars_item-1">
                                                <svg class="star <?php echo $i < $star ? 'star-red' : '' ?>">
                                                    <use xlink:href="<?php echo get_template_directory_uri() ?>/img/svg/sprite.svg#star"></use>
                                                </svg>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <p class="tab__reviews-text"><?php echo get_field('review', $post_id) ?></p>
                                <?php
                                $review_image = get_field('photos', $post_id);
                                if(is_array($review_image)){
                                    ?>
                                    <div class="tab__reviews-block-img">
                                    <?php
                                    foreach ($review_image as $image){
                                        ?>
                                        <a href="<?php echo $image['url'] ?>" data-fancybox="review-1">
                                            <img src="<?php echo $image['url'] ?>" alt="img" class="tab__reviews-img">
                                        </a>
                                        <?php
                                    }
                                    ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                        wp_reset_postdata();
                        ?>
                        <div class="tab__reviews-in js_get_form_info" data-title-product="<?php echo get_the_title() ?>" data-id-product="<?php echo $this_page_id ?>">
                            <form action="?" method="POST">
                                <h3 class="tab__title mb-40">Добавить отзыв</h3>
                                <p class="user__name-in text-in required">Ваше имя</p>
                                <input class="user__name-input text-input js_get_name" type="text" name="">
                                <div class="selected_file">
                                </div>
                                <span class="none input_select_photo">
                                </span>
                                <div class="photo__upload-block">
                                    <p class="photo__name-up text-in">Загрузить фото
                                    </p>
                                    <span class="photo__name-up__btn v_hide_input js_open_input"></span>
                                </div>
                                <div class="rating__block js_get_appraisal" data-appraisal="0">
                                    <p class="raring__user text-in ">Оценка:</p>
                                    <div class="rating-area">
                                        <input type="radio" id="star-5" name="rating" value="5">
                                        <label for="star-5" class="js_click_app_label" data-appr="5" title="Оценка «5»"></label>
                                        <input type="radio" id="star-4" name="rating" value="4">
                                        <label for="star-4" class="js_click_app_label" data-appr="4" title="Оценка «4»"></label>
                                        <input type="radio" id="star-3" name="rating" value="3">
                                        <label for="star-3" class="js_click_app_label" data-appr="3" title="Оценка «3»"></label>
                                        <input type="radio" id="star-2" name="rating" value="2">
                                        <label for="star-2" class="js_click_app_label" data-appr="2" title="Оценка «2»"></label>
                                        <input type="radio" id="star-1" name="rating" value="1">
                                        <label for="star-1" class="js_click_app_label" data-appr="1" title="Оценка «1»"></label>
                                    </div>
                                </div>
                                <p class="user__text-in text-in required">Текст отзыва</p>
                                <textarea class="user__text-input js_get_text_message" id="" cols="40" rows="10"></textarea>
                                <div class="review-btn js_send_review">
<!--                                    <a class="btn" href="" >Добавить</a>-->
                                    <button class="btn" href="#">Добавить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
        </section>
        <section class="accessories">
            <div class="container cnt">
                <?php
                $accessories = get_field('products', $this_page_id);
//                var_export($accessories);
                if(is_array($accessories)){
                    ?>
                    <h1 class="page__title mt-60">Аксессуары</h1>
                    <div class="slider__product">

                        <?php
                        foreach ($accessories as $product){
                            get_product_by_id($product->ID);
                        }
                        ?>
                    <?php
                }
                ?>
                </div>
            </div>
        </section>
        <section class="recent">
            <div class="container cnt">
                <h1 class="page__title mt-100">Вы недавно смотрели</h1>
                <div class="recent__block">

                    <?php
                    $cookie = array_reverse($cookie);
                    foreach ($cookie as $product_id){
                        if (intval(trim($product_id))) {
                            get_product_by_id($product_id);
                        }
                    }
                    ?>

            </div>
        </section>
    </div>
    </div>




<?php

function get_product_by_id($product_id){
    $product_info = wc_get_product($product_id);
    $cookie_like = explode('&', $_COOKIE["Cookie_like_product"]);
    ?>
    <div class="__item  js_loader_control">
        <div class="like-hit__row">
            <a href="#" class="like js_click_like <?php echo in_array($product_id, $cookie_like) ? 'v_active_like' : '' ?>" data-id_product="<?php echo $product_id ?>"></a>
            <div class="hit__group">
                <?php
                $pa_stil = $product_info->get_attributes()['pa_stil'];
                //                                                            var_export($pa_stil);
                $additional_label = get_field('additional_label', $product_id);
                if(is_array($additional_label)) {
                    foreach ($additional_label as $label) {
                        ?>
                        <a href="<?php echo get_permalink($product_id) ?>" style="color: <?php echo $label['colour'] ?>" class="man"> <?php echo $label['title'] ?></a>
                        <?php
                    }
                }
                if(is_array($pa_stil['options'])){
                    foreach($pa_stil['options'] as $item){
                        ?>
                        <a href="<?php echo get_permalink($product_id) ?>"
                           style="color: <?php echo get_field( 'right_colour' , 'pa_stil_' . $item ) ?>"
                           class="hit"><?php echo get_field( 'right_text' , 'pa_stil_' . $item ) ?>
                        </a>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <a href="<?php echo get_page_link($product_id) ?>"
           class="product__img">
            <?php
            if ($product_info->is_type( 'variable' ))
            {
                $available_variations = $product_info->get_available_variations();
                ?>
                <img class="js_get_variable_product" data-colour_product="<?php echo $available_variations[0]['attributes']['attribute_pa_colour_product'] ?>"  src="<?php echo $available_variations[0]['image']['url'] ?>" alt="">
                <?php
            } else {
                echo $product_info->get_image();
            }
            ?>
        </a>
        <a href="<?php echo get_page_link($product_id) ?>"
           class="product__name"><?php echo $product_info->get_name() ?></a>
        <p class="product__subname"><?php echo $product_info->get_description() ?></p>
        <?php
        if ($product_info->is_type( 'variable' ))
        {
            $available_variations = $product_info->get_available_variations();
            if($available_variations[0]['display_price'] != $available_variations[0]['display_regular_price']){
                ?>
                <p class="product__last-prise"><?php echo $available_variations[0]['display_regular_price'] ?> р.</p>
                <p class="product__prise"><?php echo $available_variations[0]['display_price'] ?> р.</p>
                <?php
            } else{
                ?>
                <p class="product__prise"><?php echo $available_variations[0]['display_regular_price'] ?> р.</p>
                <?php
            }
        } else {
            if($product_info->get_regular_price() != $product_info->get_price()){
                ?>
                <p class="product__last-prise"><?php echo $product_info->get_regular_price() ?></p>
                <p class="product__prise"><?php echo $product_info->get_price() ?></p>
                <?php
            } else {
                ?>
                <p class="product__prise"><?php echo $product_info->get_price() ?></p>
                <?php
            }
        }
        WC()->cart->find_product_in_cart();
        $catalog_mod = get_field('catalog_mod', 'option');
        if($catalog_mod){
            ?>
            <a href="#" class="btn red js_show_prew_order <?php echo $product_info->is_type('variable') ? 'js_has_variation' : '' ?>" data-product_id="<?php echo $product_id ?>">
                <?php
                echo get_field('text_order', 'option');
                ?>
            </a>
            <?
        } else {
            ?>
            <a href="#" class="btn red js_add_product_to_cart <?php echo $product_info->is_type('variable') ? 'js_has_variation' : '' ?>" data-product_id="<?php echo $product_id ?>">
                <?php
                $product_cart_id = WC()->cart->generate_cart_id( $product_id );
                $in_cart = WC()->cart->find_product_in_cart( $product_cart_id );

                if ( $in_cart ) {
                    echo 'В корзине';
                } else{
                    echo 'В корзину';
                }
                ?>
            </a>
            <?
        }
        ?>

    </div>
    <?php
}


get_footer();

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
