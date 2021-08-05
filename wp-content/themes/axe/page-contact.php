<?php
/*
	Template Name: Контакты
	Template Post Type: page
*/

?>
<?php
require_once ('menu.php');
get_header();
$this_page_id = get_the_ID();
$contacts_addr = get_field('contact_addresses', $this_page_id);
$map_count = 0;
foreach ($contacts_addr as $item){
    if(strlen(trim($item['coordinate_map'])) > 0){
        $map_count++;
    }
}
?>

    <div class="main-wrapp">
        <div class="breadcrumbs-wrap">
            <?php
            v_get_site_menu();
            ?>
        </div>
    </div>


    <div class="container ">
        <h1 class="page__name">Контакты</h1>
        <div class="contact__city-wrapp">
            <?php
            if(is_array($contacts_addr)){
                $index = 1;
                foreach ($contacts_addr as $contact){
                    ?>
                    <p class="contact__city <?php echo $index == 1 ? 'city-active' : '' ?>" id="city_<?php echo $index ?>"><?php echo $contact['city'] ?></p>
                    <?php
                    $index++;
                }
            }
            ?>
        </div>

        <div class="select-city">
            <div class="select__header-city">
                <?php
                if(is_array($contacts_addr)){
                    ?>
                    <div class="select__current-city"><?php echo $contacts_addr[0]['city'] ?></div>
                    <?php
                }
                ?>
                <div class="select__icon-city"></div>
            </div>
            <div class="select__body-city">
                <?php
                if(is_array($contacts_addr)){
                    $index = 1;
                    foreach ($contacts_addr as $contact){
                        ?>
                        <div class="select__item-city contact__city" id="city_<?php echo $index ?>"><?php echo $contact['city'] ?></div>
                        <?php
                        $index++;
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <div class="map_count " data-map_count="<?php echo $map_count ?>"></div>

    <?php
    if(is_array($contacts_addr)){
        $index = 1;
        $map_index = 1;
        foreach ($contacts_addr as $contact){
            ?>
            <section class="city city_<?php echo $index ?>" <?php echo $index == 1 ? '' : 'style="display:none;"' ?>>
                <div class="container">
                    <p class="contact__text">
                        <?php echo $contact['description'] ?>
                    </p>
                    <div class="contact__info-wrapp">
                        <div class="contact__info-block">
                            <?php
                            if(strlen(trim($contact['address'])) > 0 ){
                                ?>
                                <div class="contact__info-element">
                                    <p class="contact__info-title">Адрес: </p>
                                    <p class="contact__info-text"><?php echo $contact['address'] ?></p>
                                </div>
                                <?php
                            }
                            if(strlen(trim($contact['phone'])) > 0 ){
                                ?>
                                <div class="contact__info-element">
                                    <p class="contact__info-title">Телефон:</p>
                                    <p class="contact__info-text"><?php echo $contact['phone'] ?></p>
                                </div>
                                <?php
                            }
                            if(strlen(trim($contact['email'])) > 0 ){
                                ?>
                                <div class="contact__info-element">
                                    <p class="contact__info-title">E-mail:</p>
                                    <p class="contact__info-text"><?php echo $contact['email'] ?></p>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                        if(is_array($contact['image'])){
                            ?>
                            <a href="#" class="info-logo"><img src="<?php echo $contact['image']['url'] ?>" alt="<?php echo $contact['image']['alt'] ?>"></a>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="contact-social">
                        <?php
                        $telegram = get_field('site_header_telegram_field', 'option');
                        if(strlen(trim($telegram)) > 0){
                            ?>
                            <a href="<?php echo $telegram ?>" class="icon-social telegram"><svg class="icon">
                                    <use xlink:href="<?php echo get_template_directory_uri() ?>/img/svg/sprite.svg#telegram"></use>
                                </svg></a>
                            <?php
                        }
                        $whatsapp = get_field('site_header_whatsapp_field', 'option');
                        if(strlen(trim($whatsapp)) > 0){
                            ?>
                            <a href="<?php echo $whatsapp ?>" class="icon-social whatsapp"><svg class="icon">
                                    <use xlink:href="<?php echo get_template_directory_uri() ?>/img/svg/sprite.svg#whatsapp"></use>
                                </svg></a>
                            <?php
                        }
                        $skype = get_field('site_header_skype_field', 'option');
                        if(strlen(trim($skype)) > 0){
                            ?>
                            <a href="<?php echo $skype ?>" class="icon-social skype"><svg class="icon">
                                    <use xlink:href="<?php echo get_template_directory_uri() ?>/img/svg/sprite.svg#skype"></use>
                                </svg></a>
                            <?php
                        }
                        $vk = get_field('site_footer_vk_field', 'option');
                        if(strlen(trim($vk)) > 0){
                            ?>
                            <a href="<?php echo $vk ?>" class="icon-social vk"><svg class="icon">
                                    <use xlink:href="<?php echo get_template_directory_uri() ?>/img/svg/sprite.svg#vk"></use>
                                </svg></a>
                            <?php
                        }
                        $instagram = get_field('site_footer_instagram_field', 'option');
                        if(strlen(trim($instagram)) > 0){
                            ?>
                            <a href="<?php echo $instagram ?>" class="icon-social instagram"><svg class="icon">
                                    <use xlink:href="<?php echo get_template_directory_uri() ?>/img/svg/sprite.svg#instagram"></use>
                                </svg></a>
                            <?php
                        }
                        $youtube = get_field('site_footer_youtube_field', 'option');
                        if(strlen(trim($youtube)) > 0){
                            ?>
                            <a href="<?php echo $youtube ?>" class="icon-social youtube"><svg class="icon">
                                    <use xlink:href="<?php echo get_template_directory_uri() ?>/img/svg/sprite.svg#youtube"></use>
                                </svg></a>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="contact__map-wrapp js_loader_control">

                        <?php
                        if(strlen(trim($contact['coordinate_map'])) > 0){
                            ?>
                            <div class="map_<?php echo $map_index ?> loading" data-address="<?php echo $contact['coordinate_map'] ?>">
                                <div id="y_masters_map_<?php echo $map_index ?>" style="width: 100%; height: 375px; border:0;"></div>
                            </div>
                            <?php
                            $map_index++;
                        }
                        ?>
                    </div>
                </div>
            </section>
            <?php
            $index++;
        }
    }
    ?>

    <section class="form">
        <div class="container">
            <h4 class="page__tile">Или заполните форму и с Вами свяжутся.</h4>
            <form class="contact__form js_get_form_info" action="">
                <p class="text-in">Ваше имя</p>
                <input class="text-input js_get_name js_clear" type="text" name="" id="">
                <p class="text-in">Ваш E-mail</p>
                <input class="text-input js_get_mail js_clear" type="email" name="" id="">
                <p class="text-in">Ваш Телефон</p>
                <input class="text-input js_get_phone js_clear" type="text" name="" id="">
                <p class="text-in">Ваше сообщение</p>
                <textarea class="user__text-input js_get_mess js_clear" name="" id="" cols="30" rows="11"></textarea>
                <input class="contact-btn btn js_send_contact_mess" type="submit" value="Отправить">
            </form>
        </div>
    </section>
    </div>

<?php get_footer(); ?>