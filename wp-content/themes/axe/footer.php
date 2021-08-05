<?php

?>

<!-- подвал сайта -->
<footer class="footer">
    <div class="footer__wrapp">
        <div class="container">
            <div class="footer__row">
                <div class="footer__block">
                    <a href="<?php echo get_home_url() ?>" class="footer-logo"><img src="<?php echo get_field('site_footer_logo_field', 'option')['url'] ?>" alt="" class="img-logo"></a>
                    <div class="footer__social">
                        <?php
                        $vk = get_field('site_footer_vk_field', 'option');
                        if(isset($vk)){
                            ?>
                            <a href="<?php echo $vk ?>" class="icon-social vk">
                                <svg class="icon">
                                    <use xlink:href="<?php echo get_template_directory_uri() ?>/img/svg/sprite.svg#vk"></use>
                                </svg>
                            </a>
                            <?php
                        }
                        $instagram = get_field('site_footer_instagram_field', 'option');
                        if(isset($vk)){
                            ?>
                            <a href="<?php echo $instagram ?>" class="icon-social vk">
                                <svg class="icon">
                                    <use xlink:href="<?php echo get_template_directory_uri() ?>/img/svg/sprite.svg#instagram"></use>
                                </svg>
                            </a>
                            <?php
                        }
                        $youtube = get_field('site_footer_youtube_field', 'option');
                        if(isset($vk)){
                            ?>
                            <a href="<?php echo $youtube ?>" class="icon-social vk">
                                <svg class="icon">
                                    <use xlink:href="<?php echo get_template_directory_uri() ?>/img/svg/sprite.svg#youtube"></use>
                                </svg>
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <?php
                $menu_items = wp_get_nav_menu_items( 'Меню в подвале' );

                if(is_array($menu_items)){
                    foreach ($menu_items as $menu_item){

                        if($menu_item->menu_item_parent == '0'){
                            ?>
                            <div class="footer__column flex-grow">
                            <h5 class="footer__title"><?php echo $menu_item->title ?> </h5>
                            <?php
                            $open_sub_menu = false;
                            foreach ($menu_items as $sub_menu){
                                if($sub_menu->menu_item_parent == $menu_item->ID){
                                    if(!$open_sub_menu){
                                        ?>
                                        <ul class="footer__info">
                                        <?php
                                        $open_sub_menu = true;
                                    }
                                    ?>
                                    <li class="info__item"><a href="<?php echo $sub_menu->url ?>" class="info__link"><?php echo $sub_menu->title ?></a></li>
                                    <?php
                                }
                            }
                            if($open_sub_menu){
                            ?>
                                </ul>
                                </div>
                            <?php
                            }
                        }
                    }
                }

                ?>
                <div class="footer__input-block">
                    <a href="tel:<?php echo get_field('site_footer_phone_field', 'option') ?>" class="footer__phone"><?php echo get_field('site_footer_phone_field', 'option') ?></a>
                    <p class="footer__text"><?php echo get_field('site_footer_subscribe_field', 'option') ?></p>
                    <form action="#" method="get" class="js_get_form_info">
                        <input class="footer__input js_get_mail js_clear" type="email" placeholder="Введите Ваш e-mail">
                        <button class="footer__submit js_get_footer_form" href="#"  >Отправить</button>
                    </form>
                </div>
                <span class="bg-center"><?php echo get_field('site_footer_year_field', 'option') ?></span>
            </div>
        </div>
    </div>
    <div class="footer__agreement">
        <a href="<?php echo get_field('site_footer_terms_of_use', 'option') ?>" class="link__agreement">Пользовательское соглашение</a>
        <a href="<?php echo get_field('site_footer_offer', 'option') ?>" class="link__agreement">Оферта</a>
        <a class="link__agreement"><?php echo get_field('site_footer_copyright_field', 'option') ?></a>
    </div>
</footer>
</div>


<div class="fancybox-success-send_review" style="display: none;" id="fncbx-success-send_review">
    <div class="f-one__wrapp">
        <h4 class="f-one__page ">Отзыв успешно отправлен!</h4>
    </div>
</div>

<div class="fancybox-success-add-order" style="display: none;" id="fncbx-add-order">
    <div class="f-one__wrapp">
        <h4 class="f-one__page ">Заказ оформлен</h4>
    </div>
</div>
<div class="fancybox-success-following-send" style="display: none;" id="fncbx-success-following-send">
    <div class="f-one__wrapp">
        <h4 class="f-one__page ">Подписка оформлена!</h4>
    </div>
</div>
<div class="fancybox-success-following-send" style="display: none;" id="fncbx-success-contact-send">
    <div class="f-one__wrapp">
        <h4 class="f-one__page ">Сообщение отправлено!</h4>
    </div>
</div>
<div class="fancybox-success-following-send" style="display: none;" id="fncbx-success-bay-in-one-click">
    <div class="f-one__wrapp">
        <h4 class="f-one__page ">Спасибо за покупку!</h4>
    </div>
</div>
<div class="fancybox-success-following-send" style="display: none;" id="fncbx-error-following-send">
    <div class="f-one__wrapp">
        <h4 class="f-one__page ">При оформлении подписки произошли проблемы. Повторите попытку позже</h4>
    </div>
</div>
<div class="fancybox-success-following-send" style="display: none;" id="fncbx-error-add-to-cart">
    <div class="f-one__wrapp">
        <h4 class="f-one__page ">Ошибка добавления товара в корзину. Повторите попытку позже</h4>
    </div>
</div>
<div class="fancybox-success-following-send" style="display: none;" id="fncbx-error-ajax">
    <div class="f-one__wrapp">
        <h4 class="f-one__page ">Извините, произошла ошибка. Повторите попытку позже</h4>
    </div>
</div>
<div class="fancybox-error-send_review" style="display: none;" id="fncbx-error-send_review">
    <div class="f-one__wrapp">
        <h4 class="f-one__page ">Отправка отзыва не была успешной. Повторите попытку позже</h4>
    </div>
</div>
<div class="fancybox-prew_order" style="display: none;" id="fncbx-prew_order">
        <div class="f-one__wrapp js_get_form_info_prew_order js_loader_control" style="max-width: 700px;">
            <h4 class="f-one__page " style="text-align: center;"><?php echo get_field('text_order', 'option'); ?></h4>
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
                <button type="submit" class="btn js_show_prew_order_mail "><?php echo get_field('text_order', 'option'); ?></button>
            </div>
        </div>
</div>

<!-- кнопка прокрутки вверх -->
<div class="scroll-up js-scroll-up">
    <svg class="scroll-up__svg" viewBox="-2 -2 52 52">
        <path class="scroll-up__path js-scroll-up__path" d="M24,0 a24,24 0 0,1 0,48 a24,24 0 0,1 0,-48"/>
    </svg>
</div>

<!-- Подключеине скриптов -->
<!--<script src="libs/jquery/jquery.min.js"></script>-->
<!--<script src="libs/slick.min.js"></script>-->
<!--<script src="libs/nouislider.min.js"></script>-->
<!--<script src="libs/jquery.fancybox.min.js"></script>-->
<!--<script src="js/main.js"></script>-->

<?php wp_footer(); ?>

<?php
if (get_page_link() == get_site_url() . '/contacts/') {
    //echo '<script src="'. get_template_directory_uri() .'/js/map.js' .'"></script>';
    ?>

    <script>

        $(document).ready
        (
            function () {
                setTimeout
                (
                    function () {
                        let ymap = $('<script>').attr('src', "https://api-maps.yandex.ru/2.1/?apikey=<?php echo get_field('site_header_map_key', 'option') ?>&lang=ru_RU");
                        $(document).find('head').append(ymap);

                        let map_init = $('<script>').attr('src', "<?php echo get_template_directory_uri(); ?>/js/map.js");
                        $(document).find('head').append(map_init);
                    },
                    4000
                );
            }
        );
    </script>

    <?php
}
?>

<script>
    window.ajaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>
</body>

</html>

<!--<script src="--><?php //echo get_template_directory_uri() . "/"; ?><!--js/jquery.min.js"></script>-->
<!--<script src="--><?php //echo get_template_directory_uri() . "/"; ?><!--js/script.js"></script>-->

