<?php
/*
	Template Name: Шаблон статьи 4
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
        <div class="container cnt">
            <h1 class="page__name"><?php echo get_the_title() ?></h1>
            <p><?php echo get_the_content() ?></p>

            <?php
            $section = get_field('section_2', $this_page_id);
            ?>

            <h2 class="page__tile"><?php echo $section['section_2_title'] ?></h2>

            <div class="sun-info__uv-wrapp">
                <div class="sun-info__uv-left">

                    <?php
                    $repeaters = $section['section_2_list'];
                    if(is_array($repeaters)){
                        foreach ($repeaters as $repeater){
                            ?>
                            <div class="info__wrapp">
                                <div class="info__row">
                                    <div class="info-lft">
                                        <img class="info-icon" src="<?php echo $repeater['image']['url'] ?>" alt="<?php echo $repeater['image']['alt'] ?>">
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
                <div class="sun-info__uv-right">
                    <img class="uv-img" src="<?php echo $section['section_2_image']['url'] ?>" alt="<?php echo $section['section_2_image']['alt'] ?>">
                </div>
            </div>

            <?php
            $section = get_field('section_3', $this_page_id);
            ?>

            <div class="sun-info__icon-uv">

                <?php
                $repeaters = $section['section_3_list'];
                if(is_array($repeaters)){
                    foreach($repeaters as $repeater){
                        ?>
                        <div class="info__wrapp">
                            <div class="info__row">
                                <div class="info-lft"><img class="info-icon" src="<?php echo $repeater['image']['url'] ?>" alt="<?php echo $repeater['image']['alt'] ?>">
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
            $section = get_field('section_4', $this_page_id);
            ?>
            <h2 class="page__tile"><?php echo $section['section_4_title'] ?></h2>

            <div class="sun-info__material-wrapp">

                <?php
                $repeaters = $section['section_4_list'];
                if(is_array($repeaters)){
                    foreach($repeaters as $repeater){
                        ?>
                        <div class="sun-info__material">
                            <p class="sun-info__material-title"><?php echo $repeater['title'] ?></p>
                            <p class="sun-info__material-text"><?php echo $repeater['description'] ?></p>
                        </div>
                        <?php
                    }
                }
                ?>

            </div>

            <?php
            $section = get_field('section_5', $this_page_id);
            ?>
            <h2 class="page__tile"><?php echo $section['section_5_title'] ?></h2>
            <div class="sun-info__validity-wrapp">
                <div class="sun-info__validity-left">
                    <img src="<?php echo $section['image']['url'] ?>" alt="<?php echo $section['image']['alt'] ?>">
                </div>
                <div class="sun-info__validity-right">

                    <?php
                    $repeaters = $section['section_5_list'];
                    if(is_array($repeaters)){
                        foreach($repeaters as $repeater){
                            ?>

                            <div class="info__wrapp">
                                <div class="info__tl pointer-black"> <span class="">1</span> <?php echo $repeater['title'] ?></div>
                                <div class="info__row">
                                    <div class="info__rght">
                                        <p class="info__text"><?php echo $repeater['description'] ?></p>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }
                    }
                    ?>
                </div>
            </div>

            <?php
            $section = get_field('lens_color', $this_page_id);
            ?>
            <h2 class="page__tile"><?php echo $section['title'] ?></h2>
            <div class="sun-info__color-wrapp">

                <?php
                $repeaters = $section['points'];
                if(is_array($repeaters)){
                    foreach($repeaters as $repeater){
                        ?>

                        <div class="info__wrapp">
                            <div class="info__row">
                                <div class="info-lft">
                                    <div class="info-icon__color c-1" style="background: <?php echo $repeater['colour'] ?>"></div>
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
            $section = get_field('section_6', $this_page_id);
            ?>
            <h2 class="page__tile"><?php echo $section['section_6_title'] ?></h2>
            <div class="sun-info__jis-wrapp">
                <p class="sun-info__jis-title"><?php echo $section['section_6_left'] ?></p>
                <p class="sun-info__jis-text"><?php echo $section['section_6_right'] ?></p>
            </div>

            <?php
            $link = trim(get_field('section_7', $this_page_id)['section_7_catalog']);
            if(strlen($link) > 0){
                ?>
                <div class="btn-center link">
                    <a href="<?php echo $link; ?>" class="btn"><?php echo get_field('section_7', $this_page_id)['title'] ?></a>
                </div>
                <?php
            }
            ?>

        </div>

<?php get_footer(); ?>