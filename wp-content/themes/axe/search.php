<?php
get_header();
$cookie = explode('&', $_COOKIE["Cookie_like_product"]);
?>

<div class="main">
    <div class="breadcrumbs-wrap">
        <div class="container">
            <ul class="breadcrumbs">
                <li>
                    <a href="<?php echo get_home_url() ?>">Главная</a>
                </li>
                <li>
                    <span>Результаты поиска</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="container">

        <h1 class="page__tile">Результаты поиска</h1>
        <div class="filter-product__row v_wrap_products">
            <?php
            while (have_posts()) {
                the_post();
                $product = get_the_ID();
                if (get_post_type(get_the_ID()) == 'product') {

                    $product_info = wc_get_product($product);
                    ?>
                    <div class="__item card__item-price_btn js_loader_control">
                        <div class="like-hit__row">
                            <a href="#" class="like js_click_like <?php echo in_array($product, $cookie) ? 'v_active_like' : '' ?>" data-id_product="<?php echo $product ?>"></a>
                            <div class="hit__group">
                                <?php
                                $pa_stil = $product_info->get_attributes()['pa_stil'];
                                //                                                            var_export($pa_stil);
                                $additional_label = get_field('additional_label', $product);
                                if(is_array($additional_label)) {
                                    foreach ($additional_label as $label) {
                                        ?>
                                        <a href="<?php echo get_permalink($product) ?>" style="color: <?php echo $label['colour'] ?>" class="man"> <?php echo $label['title'] ?></a>
                                        <?php
                                    }
                                }
                                if(is_array($pa_stil['options'])){
                                    foreach($pa_stil['options'] as $item){
                                        ?>
                                        <a href="<?php echo get_permalink($product) ?>"
                                           style="color: <?php echo get_field( 'right_colour' , 'pa_stil_' . $item ) ?>"
                                           class="hit"><?php echo get_field( 'right_text' , 'pa_stil_' . $item ) ?>
                                        </a>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <a href="<?php echo get_page_link($product) ?>"
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
                        <a href="<?php echo get_page_link($product) ?>"
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
                        WC()->cart->find_product_in_cart()
                        ?>
                        <a href="#" class="btn red js_add_product_to_cart <?php echo $product_info->is_type('variable') ? 'js_has_variation' : '' ?>" data-product_id="<?php echo $product ?>">
                            <?php
                            $product_cart_id = WC()->cart->generate_cart_id( $product );
                            $in_cart = WC()->cart->find_product_in_cart( $product_cart_id );

                            if ( $in_cart ) {
                                echo 'В корзине';
                            } else{
                                echo 'В корзину';
                            }
                            ?>
                        </a>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>

<?php
get_footer();
?>
