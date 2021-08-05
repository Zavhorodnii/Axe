<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
//do_action( 'woocommerce_before_single_product' );

$pa_stil = $product->attributes['pa_stil'];
if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>

<section class="card__item-sctn">
    <div class="container">
        <div class="card__item-wrapp">
            <div class="card__item-row">
                <div class="card__item-column-l">
                    <div class="card__item__block-img">
                        <?php
                        $gallery_image_ids = $product->get_gallery_image_ids();
                        ?>
                        <div class="slider-for">
                            <?php
                            $id_skip = null;
                            $skip = true;
                            foreach($gallery_image_ids as $gallery_image_id){
                                if($skip) {
                                    $id_skip = $gallery_image_id;
                                    $skip = false;
                                    continue;
                                }
                                ?>
                                <div class="slider-for__element">
                                    <img src="<?php echo wp_get_attachment_image_url($gallery_image_id, 'full') ?>" alt="img" data-fancybox href="#img">
                                </div>
                                <?php
                            }
                            if($id_skip){
                                ?>
                                <div class="slider-for__element">
                                    <img src="<?php echo wp_get_attachment_image_url($id_skip, 'full') ?>" alt="img" data-fancybox href="#img">
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="card__item-slider-wrapp ">
                            <div class="card__item-slider  slider-nav">
                                <?php
                                foreach($gallery_image_ids as $gallery_image_id){
                                    ?>
                                    <div class="card__item-slider_element-wrapp">
                                        <div class="card__item-slider_element">
                                            <img src="<?php echo wp_get_attachment_image_url($gallery_image_id, 'full') ?>" alt="">
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>


                    <?php
                    $no_icons = array();
                    $yes_icons = array();
                    $field = get_field('uv_protection', get_the_ID());
                    if($field == 'Нету') {
                        $no_icons = no_icon($no_icons, get_template_directory_uri() . '/img/v_image/636.png');
                    } elseif ($field == 'Есть'){
                        $yes_icons = yes_icon($yes_icons, get_template_directory_uri() . '/img/v_image/620.png');
                    }
                    $field = get_field('polarized_lenses', get_the_ID());
                    if($field == 'Нету') {
                        $no_icons = no_icon($no_icons, get_template_directory_uri() . '/img/v_image/643.png');
                    } elseif ($field == 'Есть'){
                        $yes_icons = yes_icon($yes_icons, get_template_directory_uri() . '/img/v_image/631.png');
                    }
                    $field = get_field('aspherical_lenses', get_the_ID());
                    if($field == 'Нету') {
                        $no_icons = no_icon($no_icons, get_template_directory_uri() . '/img/v_image/640.png');
                    } elseif ($field == 'Есть'){
                        $yes_icons = yes_icon($yes_icons, get_template_directory_uri() . '/img/v_image/624.png');
                    }
                    $field = get_field('spring_hinge', get_the_ID());
                    if($field == 'Нету') {
                        $no_icons = no_icon($no_icons, get_template_directory_uri() . '/img/v_image/646.png');
                    } elseif ($field == 'Есть'){
                        $yes_icons = yes_icon($yes_icons, get_template_directory_uri() . '/img/v_image/627.png');
                    }
                    $field = get_field('flexible_rubber_temple', get_the_ID());
                    if($field == 'Нету') {
                        $no_icons = no_icon($no_icons, get_template_directory_uri() . '/img/v_image/637.png');
                    } elseif ($field == 'Есть'){
                        $yes_icons = yes_icon($yes_icons, get_template_directory_uri() . '/img/v_image/621.png');
                    }
                    $field = get_field('non-slip_temple', get_the_ID());
                    if($field == 'Нету') {
                        $no_icons = no_icon($no_icons, get_template_directory_uri() . '/img/v_image/639.png');
                    } elseif ($field == 'Есть'){
                        $yes_icons = yes_icon($yes_icons, get_template_directory_uri() . '/img/v_image/623.png');
                    }
                    $field = get_field('flexible_nasal_cushion', get_the_ID());
                    if($field == 'Нету') {
                        $no_icons = no_icon($no_icons, get_template_directory_uri() . '/img/v_image/641.png');
                    } elseif ($field == 'Есть'){
                        $yes_icons = yes_icon($yes_icons, get_template_directory_uri() . '/img/v_image/625.png');
                    }
                    $field = get_field('fits_on_glass', get_the_ID());
                    if($field == 'Нету') {
                        $no_icons = no_icon($no_icons, get_template_directory_uri() . '/img/v_image/680.png');
                    } elseif ($field == 'Есть'){
                        $yes_icons = yes_icon($yes_icons, get_template_directory_uri() . '/img/v_image/679.png');
                    }
                    $field = get_field('optical_lenses', get_the_ID());
                    if($field == 'Нету') {
                        $no_icons = no_icon($no_icons, get_template_directory_uri() . '/img/v_image/682.png');
                    } elseif ($field == 'Есть'){
                        $yes_icons = yes_icon($yes_icons, get_template_directory_uri() . '/img/v_image/681.png');
                    }
                    $field = get_field('internal_frame', get_the_ID());
                    if($field == 'Нету') {
                        $no_icons = no_icon($no_icons, get_template_directory_uri() . '/img/v_image/684.png');
                    } elseif ($field == 'Есть'){
                        $yes_icons = yes_icon($yes_icons, get_template_directory_uri() . '/img/v_image/683.png');
                    }
                    $field = get_field('glasses_over', get_the_ID());
                    if($field == 'Нету') {
                        $no_icons = no_icon($no_icons, get_template_directory_uri() . '/img/v_image/650.png');
                    } elseif ($field == 'Есть'){
                        $yes_icons = yes_icon($yes_icons, get_template_directory_uri() . '/img/v_image/630.png');
                    }
                    $field = get_field('wearing_with_helmet', get_the_ID());
                    if($field == 'Нету') {
                        $no_icons = no_icon($no_icons, get_template_directory_uri() . '/img/v_image/649.png');
                    } elseif ($field == 'Есть'){
                        $yes_icons = yes_icon($yes_icons, get_template_directory_uri() . '/img/v_image/629.png');
                    }
                    $field = get_field('dual_lenses', get_the_ID());
                    if($field == 'Нету') {
                        $no_icons = no_icon($no_icons, get_template_directory_uri() . '/img/v_image/651.png');
                    } elseif ($field == 'Есть'){
                        $yes_icons = yes_icon($yes_icons, get_template_directory_uri() . '/img/v_image/14.png');
                    }
                    $field = get_field('light_lenses', get_the_ID());
                    if($field == 'Нету') {
                        $no_icons = no_icon($no_icons, get_template_directory_uri() . '/img/v_image/648.png');
                    } elseif ($field == 'Есть'){
                        $yes_icons = yes_icon($yes_icons, get_template_directory_uri() . '/img/v_image/628.png');
                    }
                    $field = get_field('computer_work', get_the_ID());
                    if($field == 'Нету') {
                        $no_icons = no_icon($no_icons, get_template_directory_uri() . '/img/v_image/644.png');
                    } elseif ($field == 'Есть'){
                        $yes_icons = yes_icon($yes_icons, get_template_directory_uri() . '/img/v_image/634.png');
                    }
                    $field = get_field('worn_outdoors', get_the_ID());
                    if($field == 'Нету') {
                        $no_icons = no_icon($no_icons, get_template_directory_uri() . '/img/v_image/676.png');
                    } elseif ($field == 'Есть'){
                        $yes_icons = yes_icon($yes_icons, get_template_directory_uri() . '/img/v_image/677.png');
                    }
                    $field = get_field('moisturizing_eyes', get_the_ID());
                    if($field == 'Нету') {
                        $no_icons = no_icon($no_icons, get_template_directory_uri() . '/img/v_image/647.png');
                    } elseif ($field == 'Есть'){
                        $yes_icons = yes_icon($yes_icons, get_template_directory_uri() . '/img/v_image/633.png');
                    }

                    function yes_icon($yes_icons, $url_svg){
                        $yes_icons[] = '<div class="card__item-icon-red">';
                        $yes_icons[] = '<img src="' . $url_svg . '" alt="">';
                        $yes_icons[] = '</div>';
                        return $yes_icons;
                    }
                    function no_icon($no_icons, $url_svg){
                        $no_icons[] = '<div class="card__item-icon-grey">';
                        $no_icons[] = '<img src="' . $url_svg . '" alt="">';
                        $no_icons[] = '</div>';
                        return $no_icons;
                    }
                    ?>

                    <div class="card__item__block-icon-wrapp">
                        <div class="card__item__block-icon">
                            <?php echo implode($yes_icons) ?>
                        </div>
                        <div class="card__item__block-icon">
                            <?php echo implode($no_icons) ?>
                        </div>
                    </div>
                </div>
                <div class="card__item-column-r">
                    <div class="card-item-column-r__inner">
                        <div class="card__item__title-block">
                            <h1 class="card__item-title"><?php echo $product->name ?></h1>
                            <?php
                            $additional_label = get_field('additional_label', $product->ID);
                            if(is_array($additional_label)) {
                                foreach ($additional_label as $label) {
                                    ?>
                                    <span style="background-color: <?php echo $label['colour'] ?>" class="man"> <?php echo $label['title'] ?></span>
                                    <?php
                                }
                            }
                            if(is_array($pa_stil['options'])){
                                foreach($pa_stil['options'] as $item){
                                    ?>
                                    <span style="background-color: <?php echo get_field( 'right_colour' , 'pa_stil_' . $item ) ?>"
                                          class="man"> <?php echo get_field( 'right_text' , 'pa_stil_' . $item ) ?></span>
                                    <?php
                                }
                            }
                            ?>
<!--                            <span class="man">MEN's</span>-->
<!--                            <span class="new">NEW</span>-->
                        </div>
                        <div class="card__item-price_btn">
                            <p class="card__item-subtitle"><?php echo $product->description ?></p>

                            <?php
                                if ($product->is_type( 'variable' ))
                                {
                                    $index = true;
                                    $available_variations = $product->get_available_variations();
                                    ?>
                                    <div class="card__item__color-block">
                                        <p class="card__item__color-text">Цвет</p>
                                        <div class="card__item__color__img-block" data-product-index="<?php echo get_the_ID(); ?>">
                                        <?php
                                        foreach ($available_variations as $key => $variation)
                                        {
                                            ?>
                                            <div class="card__item__color__img js_get_product_variation js_get_variable_product <?php echo $index ? 'color-active' : '' ?>" data-variation_id="<?php echo  $variation['variation_id'] ?>" data-colour_product="<?php echo $variation['attributes']['attribute_pa_colour_product'] ?>">
                                                <img class="js_get_image_url" src="<?php echo $variation['image']['url'] ?>" alt="">
                                            </div>
                                            <?php
                                            $index = false;
                                        }
                                        ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                            ?>

                            <div class="card__item__price-block">
                                <?php
                                if ($product->is_type( 'variable' ))
                                {
                                    $available_variations = $product->get_available_variations();
                                    if($available_variations[0]['display_price'] != $available_variations[0]['display_regular_price']){
                                        ?>
                                        <p class="card__item__price js_get_price_product"><?php echo $available_variations[0]['display_price'] ?> р.</p>
                                        <p class="card__item__price-last"><?php echo $available_variations[0]['display_regular_price'] ?> р.</p>
                                        <?php
                                    } else{
                                        ?>
                                        <p class="card__item__price js_get_price_product"><?php echo $available_variations[0]['display_regular_price'] ?> р.</p>
                                        <?php
                                    }
                                } else {
                                    if($product->price != $product->regular_price){
                                        ?>
                                        <p class="card__item__price"><?php echo $product->price ?> р.</p>
                                        <p class="card__item__price-last"><?php echo $product->regular_price ?> р.</p>
                                        <?php
                                    } else {
                                        ?>
                                        <p class="product__prise"><?php echo $product->price ?> р.</p>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <?php
                            if ($product->is_type( 'variable' ))
                            {
                                $available_variations = $product->get_available_variations();
                                if(isset($available_variations[0]['display_price'])){
                                    ?>
                                    <p class="card__item__discount-text">Вы экономите <?php echo $available_variations[0]['display_regular_price']-$available_variations[0]['display_price'] ?> р.</p>
                                    <?php
                                }
                            } else {
                                ?>
                                <p class="card__item__discount-text">Вы экономите <?php echo $product->regular_price - $product->price ?> р.</p>
                                <?php
                            }

                            $catalog_mod = get_field('catalog_mod', 'option');
                            if($catalog_mod){
                                ?>
                                <button href="#" class="card__item__btn btn bask-btn js_show_prew_order js_has_variation" data-product_id="<?php echo get_the_ID() ?>">
                                    <?php
                                    echo get_field('text_order', 'option');
                                    ?>
                                </button>
                                <?php
                            } else {
                                ?>
                                <div class="card__item__btn-block">
                                    <button class="card__item__btn btn bask-btn js_get_success_form_info js_add_product_to_cart js_has_variation" data-product_id="<?php echo get_the_ID() ?>" data-fancybox
                                            href="#fncbx-basket">В
                                        корзину</button>
                                    <button class="card__item__btn btn one-btn" data-product_id="<?php echo get_the_ID() ?>" data-fancybox
                                            href="#fncbx-one">Купить
                                        в один клик</button>
                                </div>
                                <?php
                            }

                            ?>
                        </div>
                        <table class="card__item__tabel">
                            <th class="card__item__tabel-title">Характеристики</th>

                            <?php
                                wc_display_product_attributes($product);
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
$gallery_image_ids = $product->get_gallery_image_ids();
if(is_array($gallery_image_ids)){
    ?>
    <div class="fancybox-slider" style="display: none;" id="img">
        <div class="card__item__block-img">
            <div class="fslider-for">
                <?php
                $id_skip = null;
                $skip = true;
                foreach($gallery_image_ids as $gallery_image_id){
                    if($skip) {
                        $id_skip = $gallery_image_id;
                        $skip = false;
                        continue;
                    }
                    ?>
                    <div class="slider-for__element">
                        <img src="<?php echo wp_get_attachment_image_url($gallery_image_id, 'full') ?>" alt="img" data-fancybox href="#img">
                    </div>
                    <?php
                }
                if($id_skip){
                    ?>
                    <div class="slider-for__element">
                        <img src="<?php echo wp_get_attachment_image_url($id_skip, 'full') ?>" alt="img" data-fancybox href="#img">
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="fcard__item-slider-wrapp ">
                <div class="fcard__item-slider  fslider-nav">
                    <?php
                    foreach($gallery_image_ids as $gallery_image_id){
                        ?>
                        <div class="card__item-slider_element-wrapp">
                            <div class="card__item-slider_element">
                                <img src="<?php echo wp_get_attachment_image_url($gallery_image_id, 'full') ?>" alt="">
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>


<div class="fancybox-basket" style="display: none;" id="fncbx-basket">
    <div class="f-basket__wrapp">
        <h4 class="f-basket__page ">Товар добавлен в корзину</h4>
        <div class="f-basket__card">
            <div class="f-basket__card-left">
                <div class="f-basket__img-block">
                    <?php
                    if ($product->is_type( 'variable' ))
                    {
                        ?>
                        <img class="js_paste_url_image" src="" alt="">
                        <?php
                    } else {
                        echo $product->get_image();
                    }
                    ?>
                </div>
            </div>
            <div class="f-basket__card-right">
                <p class="f-basket__card-name"><?php echo $product->get_name() ?></p>
                <p class="f-basket__card-subname"><?php echo $product->get_description() ?></p>
                <?php
                if ($product->is_type( 'variable' ))
                {
                    ?>
                    <p class="f-basket__card-price js_paste_price_product"></p>
                    <?php
                } else {
                    ?>
                    <p class="f-basket__card-price "><?php echo $product->get_price() ?></p>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="f-basket__btn-block">
            <a href="<?php echo get_home_url() ?>" class="f-basket__btn btn">Продолжить покупки </a>
            <a href="<?php echo wc_get_cart_url()  ?>" class="f-basket__btn btn">Перейти в корзину </a>
        </div>
        <?php
        $advertising_blocks = get_field('advertising_blocks', $product->ID);
        if(is_array($advertising_blocks)){
            ?>
            <div class="f-basket__offer-block">
            <?php
            foreach ($advertising_blocks as $block){
                ?>
                <a class="f-basket__offer offer-l" href="<?php echo $block['link'] ?>">
                    <img src="<?php echo $block['image']['url'] ?>" alt="<?php echo $block['image']['alt'] ?>">
                    <span>Подробнее>></span>
                </a>
                <?php
            }
            ?>
            </div>
            <?php
        }
        ?>
    </div>
</div>


<div class="fancybox-one" style="display: none;" id="fncbx-one">
    <div class="f-one__wrapp js_get_form_info js_loader_control">
        <h4 class="f-one__page ">Купить в один клик </h4>
        <p class="text-in required">Ваше имя</p>
        <input class=" text-input js_get_name js_clear_input" required type="text" name="">
        <p class="text-in ">Ваш E-mail</p>
        <input class=" text-input js_get_email js_clear_input" required type="text" name="">
        <p class="text-in required">Ваш Телефон</p>
        <input class=" text-input js_get_phone js_clear_input" required type="text" name="">
        <p class="text-in required">Адрес доставки</p>
        <input class=" text-input js_get_address js_clear_input" required type="text" name="">
        <!--        <div class="captcha-input"><img src="img/card__item/captcha.png" alt=""></div>-->
        <div class="review-btn ">
            <button type="submit" class="btn js_bay_product_in_one_click js_has_variation" data-product_id="<?php echo get_the_ID() ?>">Купить</button>
        </div>
    </div>
</div>


<?php //do_action( 'woocommerce_after_single_product' ); ?>
