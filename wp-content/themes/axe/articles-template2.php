<?php
/*
	Template Name: Шаблон статьи 2
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
        <div class="eye__care">
            <div class="container">
                <h1 class="page__name"><?php echo get_the_title() ?></h1>
                <p><?php echo get_field('section_1_text', $this_page_id) ?></p>
                <?php
                $section_2 = get_field('section_2', $this_page_id);
                ?>
                <h2 class="page__tile"><?php echo $section_2['section_2_title'] ?></h2>
                <h3 class="page__subtile red"><?php echo $section_2['section_2_subtitle'] ?></h3>
                <img src="<?php echo $section_2['section_2_image']['url'] ?>" alt="<?php echo $section_2['section_2_image']['alt'] ?>" class="eye__care-img">
                <?php
                $section_3 = get_field('section_3', $this_page_id);
                ?>
                <div class="eye_care-info__block-1">
                    <div class="block1-img">
                        <img src="<?php echo $section_3['section_3_bgmage_2']['url'] ?>" alt="<?php echo $section_3['section_3_bgmage_2']['alt'] ?>">
                        <p>
                            <span><?php echo $section_3['section_3_title_1'] ?></span><br>
                            <?php echo $section_3['section_3_description_field_2'] ?></p>
                    </div>
                    <div class="eye__care-wrapp-1">

                        <?php
                        if(is_array($section_3['section_3_advantages_1'])){
                            $index = 1;
                            foreach($section_3['section_3_advantages_1'] as $item){
                                ?>
                                <div class="info__wrapp">
                                    <div class="info__tl pointer-black"><span><?php echo $index ?></span><?php echo $item['title'] ?></div>
                                    <div class="info__row">
                                        <div class="info-lft"><img class="info-icon" src="<?php echo $item['image']['url'] ?>" alt="<?php echo $item['image']['alt'] ?>">
                                        </div>
                                        <div class="info__rght">
                                            <p class="info__text"><?php echo $item['description'] ?></p>
                                            <?php
                                            if(strlen(trim($item['important'])) > 0){
                                                ?>
                                                <span class="note">* <?php echo $item['important'] ?></span>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $index++;
                            }
                        }
                        ?>


                    </div>
                </div>

                <div class="eye__care-info__block-2">
                    <div class="eye__care-wrapp-2">
                        <?php
                        if(is_array($section_3['section_3_advantages_2'])){
                            foreach($section_3['section_3_advantages_2'] as $item){
                                ?>
                                <div class="info__wrapp">
                                    <div class="info__tl pointer-red"><span><?php echo $item['leter'] ?></span><?php echo $item['title'] ?></div>
                                    <div class="info__row">
                                        <div class="info-lft"><img class="info-icon" src="<?php echo $item['image']['url'] ?>" alt="<?php echo $item['image']['alt'] ?>">
                                        </div>
                                        <div class="info__rght">
                                            <p class="info__text"><?php echo $item['description'] ?>
                                                <?php
                                                if(strlen(trim($item['important'])) > 0){
                                                    ?>
                                                    <span class="note">* <?php echo $item['important'] ?></span>
                                                    <?php
                                                }
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>

                    </div>
                </div>
                <div class="children-wrapp">
                    <?php
                    $banner = $section_3['section_3_baner']
                    ?>
                    <img src="<?php echo get_template_directory_uri() ?>/img/eye_care/icon-1.svg" alt="" class="child-icon">
                    <div class="child-text_info">
                        <p class="child-title"><?php echo $banner['title'] ?></p>
                        <p class="child-text"><?php echo $banner['description'] ?></p>
                    </div>
                    <img src="<?php echo $banner['glasses']['url'] ?>" alt="<?php echo $banner['glasses']['alt'] ?>" class="child-img">
                    <img src="<?php echo $banner['information']['url'] ?>" alt="<?php echo $banner['information']['alt'] ?>" class="child-info">
                    <img src="<?php echo get_template_directory_uri() ?>/img/eye_care/icon-2.svg" alt="" class="child-icon">
                </div>

                <div class="eye__care-poor__eyesight">
                    <div class="eye__care-poor__eyesight-img">
                        <img src="<?php echo $section_3['section_3_image_2']['url'] ?>" alt="<?php echo $section_3['section_3_image_2']['alt'] ?>">
                    </div>
                    <div class="eye__care-poor__eyesight-txt">
                        <p class="eye__care-poor__eyesight-title"><?php echo $section_3['section_3_title_2'] ?></p>
                        <p class="eye__care-poor__eyesight-text"><?php echo $section_3['section_3_description_2'] ?></p>
                    </div>
                </div>
                <?php
                $section_4 = get_field('section_4', $this_page_id);
                ?>
                <div class="eye__care-moisture-wrap">
                    <div class="eye__care-moisture-l">
                        <p class="l-title"><?php echo $section_4['section_4_title_1'] ?></p>
                        <div class="l-block">
                            <p class="l-text"><?php echo $section_4['section_4_description_1'] ?></p>
                            <img src="<?php echo $section_4['section_4_image']['url'] ?>" alt="<?php echo $section_4['section_4_image']['alt'] ?>" class="l-img">
                        </div>
                        <?php
                        if(is_array($section_4['section_4_gallery'])){
                            foreach ($section_4['section_4_gallery'] as $item){
                                ?>
                                <img src="<?php echo $item['url'] ?>" alt="<?php echo $item['alt'] ?>" class="l-image">
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="eye__care-moisture-r">
                        <p class="r-title"><?php echo $section_4['section_4_title_2'] ?></p>
                        <?php
                        if(is_array($section_4['points'])){
                            foreach ($section_4['points'] as $items){
                                ?>
                                <p class="r-text"><?php echo $items['point'] ?></p>
                                <?php
                            }
                        }
                        ?>
                        <?php
                        echo $section_4['section_4_descrion_2'];

                        if(strlen(trim($section_4['important'])) > 0){
                            ?>
                            <p class="note">* <?php echo $section_4['important'] ?></p>
                            <?php
                        }if(strlen(trim($section_4['add_text'])) > 0){
                            ?>
                            <p ><?php echo $section_4['add_text'] ?></p>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <?php
                $section_5 = get_field('section_5', $this_page_id);
                ?>
                <h2 class="page__tile"><?php echo $section_5['section_5_title'] ?></h2>
                <div class="eye__care-treatment-wrapp">
                    <h4 class="eye__care-treatment-title red"><?php echo $section_5['sub_title'] ?></h4>
                    <div class="eye__care-treatment-inner">
                        <div class="l-block">
                            <?php
                            echo $section_5['section_5_description'];
                            if(is_array($section_5['images'])){
                                foreach($section_5['images'] as $image){
                                    ?>
                                    <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>" class="l-img">
                                    <?php
                                }
                            }
                            ?>

                            <p class="eye__care-treatment-txt">
                                <?php echo $section_5['addition_text'] ?>
                            </p>
                        </div>
                        <div class="r-block">
                            <?php
                             $add = $section_5['section_5_advantages'];
                             if(is_array($add)){
                                 foreach($add as $item){
                                     ?>
                                     <div class="r-element">
                                         <p class="r-txt"><?php echo $item['title'] ?></p>
                                         <img src="<?php echo $item['image']['url'] ?>" alt="<?php echo $item['image']['alt'] ?>" class="r-img">
                                     </div>
                                     <?php
                                 }
                             }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                $section = get_field('section_6', $this_page_id);
                ?>
                <h2 class="page__tile"><?php echo $section['section_6_title'] ?></h2>
                <div class="eye__care-dry-wrapp">
                    <p class="eye__care-dry-title"><?php echo $section['section_6_subtitle'] ?></p>
                    <p class="eye__care-dry-text"><?php echo $section['section_6_description'] ?></p>
                </div>

                <?php
                $section = get_field('section_7', $this_page_id);
                ?>
                <h4 class="page__tile red sleza-title"><?php echo $section['section_7_title_1'] ?></h4>
                <p class="dry-text"><?php echo $section['under_title_line'] ?></p>
                <p class="dry-text-main">
                    <?php
                    $points = $section['point_functions'];
                    $index = 1;
                    if(is_array($points)){
                        foreach ($points as $point){
                            ?>
                            <span><?php echo $index ?>.</span> <?php echo $point['point'] ?>
                            <?php
                            $index++;
                        }
                    }
                    ?>
                </p>
                <p class="dry-text"><?php echo $section['section_7_description'] ?></p>

                <div class="dry-symptoms__wrapp">
                    <div class="dry__symptoms-txt">
                        <p class="dry__symptoms-title"><?php echo $section['section_7_title_2'] ?></p>
                        <p class="dry__symptoms-text">
                            <?php
                            $points = $section['section_7_list'];
                            $index = 1;
                            if(is_array($points)){
                                foreach ($points as $point){
                                    ?>
                                    <span><?php echo $index ?>.</span> <?php echo $point['line'] ?>
                                    <?php
                                    $index++;
                                }
                            }
                            ?>
                        </p>
                    </div>
                    <div class="dry__symptoms-img">
                        <img src="<?php echo $section['section_7_image']['url'] ?>" alt="<?php echo $section['section_7_image']['alt'] ?>">
                    </div>
                </div>

                <?php
                $section = get_field('section_8', $this_page_id);
                ?>
                <h4 class="page__tile red"><?php echo $section['section_8_title'] ?></h4>
                <p class="list-dry__title"><?php echo $section['section_8_subtitle_1'] ?></p>
                <div class="list-dry__wrap">
                    <?php
                    $repeater = $section['section_8_list'];
                    if(is_array($repeater)){
                        $count = ceil(count($repeater) / 2);
                        $index = 1;
                        foreach($repeater as $item){
                            if($index == 1 || $index == $count+1){
                                ?>
                                <ul class="list-dry__column">
                                <?php
                            }
                            ?>
                                <li class="list-dry__item">
                                    <p><?php echo $item['line'] ?></p>
                                </li>
                            <?php
                            if($index == $count || $index == count($repeater)){
                                ?>
                                </ul>
                                <?php
                            }
                            $index++;
                        }
                    }
                    ?>
                </div>
                <p class="dry-symptoms-disc"><?php echo $section['section_8_subtitle_2'] ?></p>
                <?php
                if(strlen(trim($section['section_8_description'])) > 0){
                    ?>
                    <p class="dry-symptoms-note"><span>*</span> <?php echo $section['section_8_description'] ?></p>
                    <?php
                }
                ?>

                <?php
                $section = get_field('section_9', $this_page_id);
                ?>
                <div class="block-inf">
                    <p class="block-inf__title"><?php echo $section['section_9_title'] ?></p>
                    <?php
                    $repeater = $section['section_9_list'];
                    if(is_array($repeater)){
                        $index = 1;
                        foreach ($repeater as $item){
                            ?>
                            <div class="block-inf__inner">
                                <span class="num-list"><?php echo $index ?></span>
                                <p class="inf__title"><?php echo $item['title'] ?></p>
                                <p class="inf__text"><?php echo $item['description'] ?></p>
                            </div>
                            <?php
                            $index++;
                        }
                    }
                    ?>
                </div>

                <?php
                $section = get_field('section_10', $this_page_id);
                ?>
                <div class="block-inf">
                    <p class="block-inf__title"><?php echo $section['section_10_title'] ?></p>
                    <?php
                    $repeater = $section['section_10_list'];
                    if(is_array($repeater)){
                        $index = 1;
                        foreach ($repeater as $item){
                            ?>
                            <div class="block-inf__inner">
                                <span class="num-list"><?php echo $index ?></span>
                                <p class="inf__title"><?php echo $item['title'] ?></p>
                                <p class="inf__text"><?php echo $item['description'] ?></p>
                            </div>
                            <?php
                            $index++;
                        }
                    }
                    ?>
                </div>
                <?php
                $link = trim(get_field('section_11', $this_page_id)['section_11_catalog']);
                if(strlen($link) > 0){
                    ?>
                    <div class="btn-center link">
                        <a href="<?php echo $link; ?>" class="btn"><?php echo get_field('section_11', $this_page_id)['title'] ?></a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

    </div>
    </div>

<?php get_footer(); ?>