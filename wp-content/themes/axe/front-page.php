<?php
get_header();
$this_page_id = get_the_ID();

$cookie = explode('&', $_COOKIE["Cookie_like_product"]);
?>

    <div class="main__wrap">
        <div class="container cnt">
            <div class="slider-main">
                <?php
                $section_1 = get_field('section_1', $this_page_id)['section_1_slider'];
                if (is_array($section_1)) {
                    foreach ($section_1 as $item) {
                        ?>
                        <div class="slider-inner">
                            <div class="slider__column-left">
                                <h1 class="slider__tile"><span><?php echo $item['name'] ?></span></h1>
                                <h4 class="slider__subtitle"><?php echo $item['title'] ?></h4>
                                <p class="slider__text"><?php echo $item['description'] ?></p>
                                <a href="<?php echo get_term_link($item['link'], 'product_cat') ?>" class="slider__link">Каталог</a>
                            </div>
                            <div class="slider__column-right sbg-1">
                                <img class="slider-img " src="<?php echo $item['image'] ?>" alt="img">
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>

            </div>
        </div>


        <?php
        $categories = get_field('categories', $this_page_id);


        $has_image = true;
        if (is_array($categories)) {
            foreach ($categories as $category) {
                $has_image = $category['is_image'];
                    ?>
                    <section class="categoria">
                        <div class="container cnt">
                            <h1 class="page__title"><?php echo $category['title'] ?></h1>
                            <?php
                                if($has_image){
                                    ?>
                                    <div class="axe-group">
                                        <div class="axe-block">
                                            <div class="axe-row">
                                                <div class="axe-icon">
                                                    <img src="<?php echo $category['icon'] ?>" alt="">
                                                </div>
                                                <div class="axe-img"><img src="<?php echo $category['image'] ?>" alt=""></div>
                                                <div class="axe-arrow">
                                                    <div class="arrow-top">
                                                        <svg class="arr">
                                                            <use xlink:href="<?php echo get_template_directory_uri() ?>/img/svg/sprite.svg#arrow"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="arrow-bottom">
                                                        <svg class="arr">
                                                            <use xlink:href="<?php echo get_template_directory_uri() ?>/img/svg/sprite.svg#arrow"></use>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        <h4 class="axe-sub"><?php echo $category['title_under_image'] ?></h4>
                                    </div>
                                    <?php
                                }
                                ?>
                                    <div class="slider__product">
                                        <?php
                                        if (isset($category['products'])) {
                                            foreach ($category['products'] as $product) {
                                                $product_info = wc_get_product($product->ID);
                                                if ($product_info->is_in_stock() ){
                                                    ?>
                                                    <div class="__item card__item-price_btn js_loader_control">
                                                        <div class="like-hit__row">
                                                            <a href="#" class="like js_click_like <?php echo in_array($product->ID, $cookie) ? 'v_active_like' : '' ?>" data-id_product="<?php echo $product->ID ?>"></a>
                                                            <div class="hit__group">
                                                                <?php
                                                                $pa_stil = $product_info->get_attributes()['pa_stil'];
    //                                                            var_export($pa_stil);
                                                                $additional_label = get_field('additional_label', $product->ID);
                                                                if(is_array($additional_label)) {
                                                                    foreach ($additional_label as $label) {
                                                                        ?>
                                                                        <a href="<?php echo get_permalink($product->ID) ?>" style="color: <?php echo $label['colour'] ?>" class="man"> <?php echo $label['title'] ?></a>
                                                                        <?php
                                                                    }
                                                                }
                                                                if(is_array($pa_stil['options'])){
                                                                    foreach($pa_stil['options'] as $item){
                                                                        ?>
                                                                        <a href="<?php echo get_permalink($product->ID) ?>"
                                                                           style="color: <?php echo get_field( 'right_colour' , 'pa_stil_' . $item ) ?>"
                                                                           class="hit"><?php echo get_field( 'right_text' , 'pa_stil_' . $item ) ?>
                                                                        </a>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <a href="<?php echo get_page_link($product->ID) ?>"
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
                                                        <a href="<?php echo get_page_link($product->ID) ?>"
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
                                                            <a href="#" class="btn red js_show_prew_order <?php echo $product_info->is_type('variable') ? 'js_has_variation' : '' ?>" data-product_id="<?php echo $product->ID ?>">
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
<!--                                                        <a href="#" class="btn red js_add_product_to_cart --><?php //echo $product_info->is_type('variable') ? 'js_has_variation' : '' ?><!--" data-product_id="--><?php //echo $product->ID ?><!--">-->
<!--                                                            --><?php
//                                                            $product_cart_id = WC()->cart->generate_cart_id( $product->ID );
//                                                            $in_cart = WC()->cart->find_product_in_cart( $product_cart_id );
//
//                                                            if ( $in_cart ) {
//                                                                echo 'В корзине';
//                                                            } else{
//                                                                echo 'В корзину';
//                                                            }
//                                                            ?>
<!--                                                        </a>-->
                                                    </div>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                <?php
                                    if($has_image){
                                ?>
                                    </div>
                                <?php
                                }
                            ?>
                        </div>
                    </section>
                    <?php
            }
        }
        ?>
        <sectinon class="functional">
            <div class="container cnt">
                <div class="functional__wrapp">
                    <h1 class="page__title"><?php echo get_field('section_5', $this_page_id)['sesction_5_title'] ?></h1>
                    <div class="functional__inner">
                        <?php
                        $section_5_lists = get_field('section_5', $this_page_id)['section_5_list'];
                        if (is_array($section_5_lists)) {
                            $index_block = 1;
                            foreach ($section_5_lists as $list) {
                                ?>
                                <div class="functional__column">
                                    <a href="<?php echo $list['block1']['link'] ?>"
                                       class="<?php echo ($index_block == 2) || ($index_block == 3) ? 'functional__small' : 'functional__big' ?> fb-<?php echo $index_block++ ?>">
                                        <img src="<?php echo $list['block1']['image'] ?>" alt="">
                                        <span class="fname"><?php echo $list['block1']['title'] ?></span>
                                        <span class="details">подробнее>></span>
                                    </a>

                                    <a href="<?php echo $list['block2']['link'] ?>"
                                       class="<?php echo ($index_block == 2) || ($index_block == 3) ? 'functional__small' : 'functional__big' ?> fb-<?php echo $index_block++ ?>">
                                        <img src="<?php echo $list['block2']['image'] ?>" alt="">
                                        <span class="fname"><?php echo $list['block2']['title'] ?></span>
                                        <span class="details">подробнее>></span>
                                    </a>
                                </div>
                                <?php
                                if ($index_block == 5)
                                    $index_block = 1;
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </sectinon>
        <sectinon class="news">
            <div class="container cnt">
                <?php
                $query = new WP_Query( [
                    'post_type' => 'news',
                    'posts_per_page' => 6,
                ] );
                if($query->post_count > 0){
                    ?>
                    <div class="news__wrapp">
                        <h1 class="page__title">Новости</h1>
                        <div class="slider__news">

                            <?php
                                while ( $query->have_posts() ) {
                                    $query->the_post();
                                    $post_id = $query->post->ID;
                                    ?>
                                    <a href="<?php echo get_permalink($post_id) ?>" class="slider__new">
                                        <img src="<?php echo get_field('image_news', $post_id)['url'] ?>" alt="<?php echo get_field('image_news', $post_id)['alt'] ?>">
                                        <span class="snew-block">
                                        <spna class="snew-title"><?php echo get_the_title($post_id) ?></spna>
                                        <spna class="snew-date"><?php echo get_the_date( 'd.m.y', $post_id ); ?></spna>
                                    </span>
                                    </a>
                                    <?php
                                }
                            ?>



                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </sectinon>
        <section class="about">
            <div class="container cnt">
                <div class="about__block">
                    <h1 class="page__title"><?php echo get_field('section_6', $this_page_id)['section_6_title'] ?></h1>
                    <h4 class="page__subtitle red"><?php echo get_field('section_6', $this_page_id)['section_6_subtitle'] ?></h4>
                    <?php echo get_field('section_6', $this_page_id)['section_6_about'] ?>
                    <a href="#" class="more">Подробнее>></a>
                    <div class="about__slider">
                        <?php
                        $section_6_links = get_field('section_6', $this_page_id)['section_6_links'];
                        if (is_array($section_6_links)) {
                            foreach ($section_6_links as $info) {
                                $link = '';
                                if($info['link_file']){
                                    $link = $info['link'];
                                } else {
                                    $link = $info['file']['url'];
                                }
                                ?>
                                <div class="about__elem">
                                    <a href="<?php echo $link ?>" target="_blank" class="">
                                        <img src="<?php echo $info['image']['url'] ?>" alt="<?php echo $info['image']['alt'] ?>">
                                    </a>
                                    <a href="<?php echo $link ?>" target="_blank" class="">Скачать>></a>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </div>

<?php get_footer(); ?>