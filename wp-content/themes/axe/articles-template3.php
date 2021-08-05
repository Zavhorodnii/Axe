<?php
/*
	Template Name: Шаблон статьи 3
	Template Post Type: articles
*/

?>
<?php
require_once ('menu.php');
get_header();
$this_page_id = get_the_ID();
?>

    <div class="main-wrapp">
        <div class="breadcrumbs-wrap">
            <?php
            v_get_site_menu();
            ?>
        </div>
        <div class="container">
            <h1 class="page__name"><?php echo get_the_title() ?></h1>
            <p><?php echo get_field('section_1_text', $this_page_id) ?></p>

            <?php
            $section = get_field('section_2', $this_page_id);
            ?>
            <h2 class="page__tile"><?php echo $section['section_2_title'] ?></h2>
            <p class="info-sport__note"><?php echo $section['section_2_subtitle'] ?></p>

            <div class="sport-info__icon">

                <?php
                $repeater = $section['section_2_list'];
                if(is_array($repeater)){
                    foreach ($repeater as $item) {
                        ?>
                        <div class="info__wrapp">
                            <div class="info__row">
                                <div class="info-lft"><img class="info-icon" src="<?php echo $item['image']['url'] ?>" alt="<?php echo $item['image']['alt'] ?>">
                                </div>
                                <div class="info__rght">
                                    <div class="info__tl"><?php echo $item['title'] ?></div>
                                    <p class="info__text"><?php echo $item['description'] ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>

            <?php
            $section = get_field('section_3', $this_page_id);
            ?>
            <h2 class="page__tile"><?php echo $section['section_3_title'] ?></h2>
            <div class="panoramic__lens-wrapp">
                <img src="<?php echo $section['section_3_image']['url'] ?>" alt="<?php echo $section['section_3_image']['alt'] ?>" class="panoramic__lens-img">
                <div class="panoramic__lens-text__block">
                    <?php
                    $marks = $section['marks'];
                    if(is_array($marks)){
                        foreach ($marks as $mark){
                            ?>
                            <div class="panoramic__lens-metka"><?php echo $mark['mark'] ?></div>
                            <?php
                        }
                    }
                    ?>
                    <p class="panoramic__lens-title"><?php echo $section['title_2'] ?></p>
                    <p class="panoramic__lens-sutitle"><?php echo $section['title_3'] ?></p>
                    <p class="panoramic__lens-text"><?php echo $section['section_3_description'] ?></p>
                    <?php
                    $important = trim($section['important']);
                    if(strlen($important) > 0){
                        ?>
                        <p class="panoramic__lens-note"><span>*</span> <?php echo $important ?></p>
                        <?php
                    }
                    ?>
                </div>
            </div>

            <?php
            $section = get_field('section_4', $this_page_id);
            ?>
            <h2 class="page__tile"><?php echo $section['section_4_title_1'] ?></h2>
            <div class="regular__lenses-wrapp">
                <div class="regular__lenses-row">
                    <?php
                    $images = $section['section_4_images_1'];
                    if(is_array($images)){
                        $index = 1;
                        foreach ($images as $image){
                            ?>
                            <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>" class="<?php echo $index % 2 != 0 ? 'regular__lenses-img-l' : 'regular__lenses-img-r' ?>">
                            <?php
                            $index++;
                        }
                    }
                    ?>
                </div>
                <h2 class="page__tile lens"><?php echo $section['section_4_title_2'] ?></h2>
                <div class="regular__lenses-row">
                    <?php
                    $images = $section['section_4_images_2'];
                    if(is_array($images)){
                        $index = 1;
                        foreach ($images as $image){
                            ?>
                            <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>" class="<?php echo $index % 2 != 0 ? 'regular__lenses-img-l' : 'regular__lenses-img-r' ?>">
                            <?php
                            $index++;
                        }
                    }
                    ?>
                </div>

                <?php
                $section = get_field('section_5', $this_page_id);
                ?>
                <div class="regular__lenses-row">
                    <?php
                    if(is_array($section)){
                        foreach ($section as $item){
                            ?>
                            <div class="regular__lenses-block">
                                <p class="regular__lenses-title"><?php echo $item['section_5_title_1'] ?></p>
                                <p class="regular__lenses-text"><?php echo $item['section_5_description_1'] ?></p>
                                <img class="regular__lenses-img" src="<?php echo $item['section_5_image_1']['url'] ?>" alt="<?php echo $item['section_5_image_1']['alt'] ?>">
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <?php
            $section = get_field('section_6', $this_page_id);
            ?>
            <h2 class="page__tile"><?php echo $section['section_6_title'] ?></h2>
            <div class="lens__table-wrapp">

                <div class="lens__table-header">
                    <div class="lens__table-header__item">
                        <p class="lens__table-header-text">Варианты цвета линз</p>
                    </div>
                    <div class="lens__table-header__item colum-center">
                        <p class="lens__table-header-text">Особенности линзы </p>
                    </div>
                    <div class="lens__table-header__item">
                        <p class="lens__table-header-text">Погода</p>
                        <div class="icon__weather-wrapp">
                            <div class="icon__weather-item">
                                <div class="weather-icon clear"></div>
                                <p class="weather-text">Ясно</p>
                            </div>
                            <div class="icon__weather-item">
                                <div class="weather-icon cloudy"></div>
                                <p class="weather-text">Облачно</p>
                            </div>
                            <div class="icon__weather-item">
                                <div class="weather-icon mainly-cloudy"></div>
                                <p class="weather-text">Пасмурно</p>
                            </div>
                            <div class="icon__weather-item">
                                <div class="weather-icon snow"></div>
                                <p class="weather-text">Снег</p>
                            </div>
                            <div class="icon__weather-item">
                                <div class="weather-icon night"></div>
                                <p class="weather-text">Ночь</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lens__table-body">

                    <?php
                    $repeaters = $section['section_6_list'];
                    if(is_array($repeaters)){
                        $index = 1;
                        foreach ($repeaters as $repeater){
                            ?>

                            <div class="lens__table-row <?php echo $index % 2 == 0 ? 'invert' : '' ?>">
                                <div class="lens__table-row__item column-1">
                                    <p class="lens__table-row__title"><?php echo $repeater['title'] ?></p>
                                    <img class="lens__table-row__img" src="<?php echo $repeater['image']['url'] ?>" alt="<?php echo $repeater['image']['alt'] ?>">
                                    <p class="lens__table-header-text lens-mob">Варианты цвета линз</p>
                                </div>
                                <div class="lens__table-row__item colum-center column-2">
                                    <p class="lens__table-row-text"><?php echo $repeater['description'] ?></p>
                                    <p class="lens__table-row-btxt"><?php echo $repeater['note'] ?></p>
                                    <p class="lens__table-header-text lens-mob">Особенности линзы </p>
                                </div>
                                <div class="lens__table-row__item column-3">
                                    <div class="lens__table-row__circle
                                    <?php
                                    $result = $repeater['vision_1'];
                                    if($result == 'v1'){
                                        echo 'semicircle';
                                    }elseif($result == 'v2'){
                                        echo 'full-circle';
                                    }
                                    ?> "></div>
                                    <div class="lens__table-row__circle
                                    <?php
                                    $result = $repeater['vision_2'];
                                    if($result == 'v1'){
                                        echo 'semicircle';
                                    }elseif($result == 'v2'){
                                        echo 'full-circle';
                                    }
                                    ?>"></div>
                                    <div class="lens__table-row__circle
                                    <?php
                                    $result = $repeater['vision_3'];
                                    if($result == 'v1'){
                                        echo 'semicircle';
                                    }elseif($result == 'v2'){
                                        echo 'full-circle';
                                    }
                                    ?>"></div>
                                    <div class="lens__table-row__circle
                                    <?php
                                    $result = $repeater['vision_4'];
                                    if($result == 'v1'){
                                        echo 'semicircle';
                                    }elseif($result == 'v2'){
                                        echo 'full-circle';
                                    }
                                    ?>"></div>
                                    <div class="lens__table-row__circle
                                    <?php
                                    $result = $repeater['vision_5'];
                                    if($result == 'v1'){
                                        echo 'semicircle';
                                    }elseif($result == 'v2'){
                                        echo 'full-circle';
                                    }
                                    ?>"></div>
                                    <div class="lens__table-header__item lens-mob">
                                        <p class="lens__table-header-text">Погода</p>
                                        <div class="icon__weather-wrapp">
                                            <div class="icon__weather-item">
                                                <div class="weather-icon clear"></div>
                                                <p class="weather-text">Ясно</p>
                                            </div>
                                            <div class="icon__weather-item">
                                                <div class="weather-icon cloudy"></div>
                                                <p class="weather-text">Облачно</p>
                                            </div>
                                            <div class="icon__weather-item">
                                                <div class="weather-icon mainly-cloudy"></div>
                                                <p class="weather-text">Пасмурно</p>
                                            </div>
                                            <div class="icon__weather-item">
                                                <div class="weather-icon snow"></div>
                                                <p class="weather-text">Снег</p>
                                            </div>
                                            <div class="icon__weather-item">
                                                <div class="weather-icon night"></div>
                                                <p class="weather-text">Ночь</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $index++;
                        }
                    }
                    ?>

                </div>

            <?php
            $section = get_field('section_7', $this_page_id);
            ?>

            </div>
            <h2 class="page__tile"><?php echo $section['section_7_title'] ?></h2>
            <div class="sport-info__main-wrapp">
                <img src="<?php echo $section['section_7_image']['url'] ?>" alt="<?php echo $section['section_7_image']['alt'] ?>" class="sport-info__main-img">
            </div>

            <?php
            $section = get_field('section_8', $this_page_id);
            ?>
            <h2 class="page__tile"><?php echo $section['section_7_title'] ?></h2>
            <div class="sport-info__axe-wrapp">

                <?php
                $repeaters = $section['section_7_list'];
                if(is_array($repeaters)){
                    foreach($repeaters as $repeater){
                        ?>
                        <div class="info__wrapp">
                            <div class="info__row">
                                <div class="info-lft">
                                    <img src="<?php echo $repeater['image']['url'] ?>" alt="<?php echo $repeater['image']['alt'] ?>" class="img-axe__function">
                                </div>
                                <div class="info__rght">
                                    <div class="info__tl"><?php echo $repeater['title'] ?></div>
                                    <p class="info__text"><?php echo $repeater['description'] ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>

            </div>

            <?php
            $link = trim(get_field('section_9', $this_page_id)['section_9_catalog']);
            if(strlen($link) > 0){
                ?>
                <div class="btn-center link">
                    <a href="<?php echo $link; ?>" class="btn"><?php echo get_field('section_9', $this_page_id)['title'] ?></a>
                </div>
                <?php
            }
            ?>
        </div>

<?php get_footer(); ?>