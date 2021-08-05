<?php
/*
	Template Name: Шаблон статьи 1
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
        <div class="eye__protection">
            <div class="container cnt">
                <h1 class="page__name"><?php echo get_the_title() ?></h1>
                <h2 class="page__tile"><?php echo get_field('section_2', $this_page_id)['section_2_title']; ?></h2>
                <h3 class="page__subtile red"><?php echo get_field('section_2', $this_page_id)['section_2_subtitle']; ?></h3>
                <img src="<?php echo get_field('section_2', $this_page_id)['section_2_image']['url']; ?>" alt="<?php echo get_field('section_2', $this_page_id)['section_2_image']['alt']; ?>" class="eye__protection-img">
                <div class="eye__protection-wrapp">
                    <?php
                    $advantages = get_field('section_3', $this_page_id)['scetion_3_advantages'];
                    if(is_array($advantages)){
                        $index = 1;
                        foreach ($advantages as $advantage){
                            ?>

                            <div class="info__wrapp">
                                <div class="info__tl pointer-red"><span><?php echo $index; ?></span><?php echo $advantage['title'] ?></div>
                                <div class="info__row">
                                    <?php
                                    if(is_array($advantage['image'])){
                                        ?>
                                        <div class="info-lft"><img class="info-icon" src="<?php echo $advantage['image']['url'] ?>" alt="<?php echo $advantage['image']['alt'] ?>">
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="info__rght">
                                        <p class="info__text"><?php echo $advantage['description'] ?></p>
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
                $important = get_field('section_4', $this_page_id)['important_info'];
                if(is_array($important)){
                    foreach ($important as $item){
                        ?>
                        <p class="eye__protection-note"><span>*</span><?php echo $item['information'] ?></p>
                        <?php
                    }
                }
                $link = trim(get_field('section_4', $this_page_id)['section_4_catalog']);
                if(strlen($link) > 0){
                    ?>
                    <div class="btn-center link">
                        <a href="<?php echo $link; ?>" class="btn"><?php echo get_field('section_4', $this_page_id)['title'] ?></a>
                    </div>
                    <?php
                }
                ?>

            </div>
        </div>

    </div>
    </div>

<?php get_footer(); ?>