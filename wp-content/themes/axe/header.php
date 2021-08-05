<?php

?>
<!DOCTYPE html>
<!-- Оболочка документа -->
<html lang="ru">

<!-- Заголовок страницы, контейнер для других важных данных (не отображается) -->

<head>
    <!--        <title>Главная</title>-->
    <!-- Подключение CSS -->
    <!--        <link rel="stylesheet" href="css/style.css">-->

    <?php wp_head(); ?>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/img/icons/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo get_field('site_header_site_key', 'option') ?>"></script>
</head>

<body>
<!-- ОБОЛОЧКА -->
<div class="wrapper">
    <!-- шапка сайта -->
    <header class="header">
        <?php
        $cookie = explode('&', $_COOKIE["Cookie_like_product"]);
        $count_product = count($cookie)-1;
        ?>
        <div class="container js_get_reCAPTCHA_site_key" data-reCAPTCHA_site_key="<?php echo get_field('site_header_site_key', 'option') ?>">
            <div class="header__row">
                <a href="<?php echo get_home_url() ?>"
                   class="logo"><img src="<?php echo get_field('site_header_logo_field', 'option')['url'] ?>" alt=""
                                     class="img-logo"></a>
<!--                <div class="header__search">-->
<!--                    <input class="header__input" type="text" placeholder="поиск">-->
<!--                    <button class="header__search-btn"></button>-->
<!--                </div>-->

                <?php get_search_form(); ?>

                <div class="header__contact">
                    <a href="tel:<?php echo get_field('site_header_phone_field', 'option') ?>"
                       class="header__phone"><?php echo get_field('site_header_phone_field', 'option') ?></a>
                    <div class="header__social">
                        <?php
                        $telegram = get_field('site_header_telegram_field', 'option');
                        if (isset($telegram)) {
                            ?>
                            <a href="<?php echo $telegram ?>" class="icon-social telegram">
                                <svg class="icon">
                                    <use xlink:href="<?php echo get_template_directory_uri() ?>/img/svg/sprite.svg#telegram"></use>
                                </svg>
                            </a>
                            <?php
                        }
                        $whatsapp = get_field('site_header_whatsapp_field', 'option');
                        if (isset($whatsapp)) {
                            ?>
                            <a href="<?php echo $whatsapp ?>" class="icon-social whatsapp">
                                <svg class="icon">
                                    <use xlink:href="<?php echo get_template_directory_uri() ?>/img/svg/sprite.svg#whatsapp"></use>
                                </svg>
                            </a>
                            <?php
                        }
                        $skype = get_field('site_header_skype_field', 'option');
                        if (isset($whatsapp)) {
                            ?>
                            <a href="<?php echo $skype ?>" class="icon-social skype">
                                <svg class="icon">
                                    <use xlink:href="<?php echo get_template_directory_uri() ?>/img/svg/sprite.svg#skype"></use>
                                </svg>
                            </a>
                            <?php
                        }
                        ?>

                    </div>
                </div>
                <div class="like-basket__block">
                    <div class="menu__btn"><span></span></div>
                    <a href="<?php echo get_field('liked_product', 'option') ?>" class="icon__like">
                        <span class="like__counter counter <?php echo $count_product > 0 ? 'v_like_header' : '' ?>"><?php echo $count_product ?></span>
                    </a>
                    <?php
                        $catalog_mod = get_field('catalog_mod', 'option');
                        if(!$catalog_mod){
                            ?>
                            <div class="basket__block">
                                <a href="<?php echo wc_get_cart_url() ?>" class="icon__basket">
                                    <span class="basket__counter counter"><?php echo WC()->cart->get_cart_contents_count() ?></span>
                                </a>
                                <?php
                                $subtotal = WC()->cart->get_subtotal();
                                if($subtotal == 0){
                                    ?>
                                    <span class="basket__text">Нету покупок</span>
                                    <?php
                                } else{
                                    ?>
                                    <span class="basket__text">В корзине<span class="light-red"> <?php echo $subtotal ?> </span>р.</span>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                    ?>

                </div>
            </div>
        </div>
        <div class="menu__wrapp">
            <div class="container">
                <div class="menu__row">
                    <nav class="menu">
                        <?php
                        $menu_items = wp_get_nav_menu_items( 'Main_top_menu' );
//                        var_export($menu_items);

                        if(is_array($menu_items)){
                            ?>
                            <ul class="menu__list">
                            <?php
                            foreach ($menu_items as $menu_item){

                                if($menu_item->menu_item_parent == '0'){
                                    ?>
                                    <li class="menu__item">
                                    <?php
                                    if(get_field('add_icon', $menu_item->ID)){
                                        $icon = get_field('icon', $menu_item->ID);
                                        if($icon == 'left'){
                                            ?>
                                            <span>
                                                <a class="menu__link">
                                                    <span class="ml_burger"></span><?php echo $menu_item->title ?>
                                                </a>
                                                <span class="ml_arrow ml_arrow-b">
                                                    <svg class="icon">
                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/img/svg/sprite.svg#arrow-link"></use>
                                                    </svg>
                                                </span>
                                            </span>
                                            <?php
                                        } else {
                                            ?>
                                            <span>
                                                <a class="menu__link"><?php echo $menu_item->title ?></a>
                                                <span class="ml_arrow">
                                                    <svg class="icon">
                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/img/svg/sprite.svg#arrow-link"></use>
                                                    </svg>
                                                </span>
                                            </span>
                                            <?php
                                        }
                                    } else{
                                        ?>
                                        <a href="<?php echo $menu_item->url ?>" class="menu__link"><?php echo $menu_item->title ?></a>
                                        <?php
                                    }
                                    $open_sub_menu = false;
                                    foreach ($menu_items as $sub_menu){
                                        if($sub_menu->menu_item_parent == $menu_item->ID){
                                            if(!$open_sub_menu){
                                                ?>
                                                <ul class="menu__list drop__list drop__list-l">
                                                <?php
                                                $open_sub_menu = true;
                                            }
                                            ?>
                                            <li class="menu__item"><a href="<?php echo $sub_menu->url ?>" class="menu__link"><?php echo $sub_menu->title ?></a></li>
                                            <?php
                                        }
                                    }
                                    if($open_sub_menu){
                                        ?>
                                        </ul>
                                        <?php
                                    }

                                    ?>
                                    </li>
                                <?php
                                }

                            }
                            ?>
                            </ul>
                            <?php
                        }

                        ?>
                    </nav>
                    <div class="like-basket__block">
                        <a href="<?php echo get_field('liked_product', 'option') ?>" class="icon__like ">
                            <span class="like__counter counter <?php echo $count_product > 0 ? 'v_like_header' : '' ?>"><?php echo $count_product ?></span>
                        </a>
                        <?php
                        $catalog_mod = get_field('catalog_mod', 'option');
                        if(!$catalog_mod){
                            ?>
                            <div class="basket__block">
                                <a href="<?php echo wc_get_cart_url() ?>" class="icon__basket js_paste_count_cart_products">
                                    <span class="basket__counter counter <?php echo WC()->cart->get_cart_contents_count() > 0 ? 'v_like_header' : '' ?>"><?php echo WC()->cart->get_cart_contents_count() ?></span>
                                </a>
                                <div class="v_order_info js_paste_cart_statistic">
                                    <?php
                                    $subtotal = WC()->cart->get_subtotal();
                                    if($subtotal == 0){
                                        ?>
                                        <span class="basket__text">Нету покупок</span>
                                        <?php
                                    } else{
                                        ?>
                                        <span class="basket__text">В корзине<span class="light-red"> <?php echo $subtotal ?> </span>р.</span>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="header__contact">
                        <a href="tel:<?php echo get_Field('site_header_phone_field', 'option') ?>" class="header__phone"><?php echo get_Field('site_header_phone_field', 'option') ?></a>
                        <div class="header__social">

                            <?php
                            $telegram = get_field('site_header_telegram_field', 'option');
                            if (isset($telegram)) {
                                ?>
                                <a href="<?php echo $telegram ?>" class="icon-social telegram">
                                    <svg class="icon">
                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/img/svg/sprite.svg#telegram"></use>
                                    </svg>
                                </a>
                                <?php
                            }
                            $whatsapp = get_field('site_header_whatsapp_field', 'option');
                            if (isset($whatsapp)) {
                                ?>
                                <a href="<?php echo $whatsapp ?>" class="icon-social whatsapp">
                                    <svg class="icon">
                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/img/svg/sprite.svg#whatsapp"></use>
                                    </svg>
                                </a>
                                <?php
                            }
                            $skype = get_field('site_header_skype_field', 'option');
                            if (isset($whatsapp)) {
                                ?>
                                <a href="<?php echo $skype ?>" class="icon-social skype">
                                    <svg class="icon">
                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/img/svg/sprite.svg#skype"></use>
                                    </svg>
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
