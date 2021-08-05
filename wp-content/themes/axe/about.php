<?php
/*
	Template Name: О нас
	Template Post Type: page
*/

?>
<?php
require_once ('menu.php');
get_header();
$this_page_id = get_the_ID();
?>

<div class="main-wrapp">
    <div class="breadcrumbs-wrap">
        <?php v_get_site_menu() ?>
    </div>
    <div class="container cnt">
        <h1 class="page__title"><?php echo get_the_title() ?></h1>
        <div class="abt-main__img">
            <img src="<?php the_post_thumbnail_url('full') ?>" alt="AXE">
            <span>1936</span>
        </div>
        <?php
        $block = get_field('bkock_1', $this_page_id);
        ?>
        <h4 class="abt-title"><?php echo $block['title'] ?></h4>
        <div class="abt-block">
            <?php echo $block['description'] ?>
        </div>

        <?php
        $block = get_field('bkock_2', $this_page_id);
        ?>
        <div class="abt-center__img">
            <img src="<?php echo $block['image']['url'] ?>" alt="<?php echo $block['image']['alt'] ?>">
        </div>
        <?php echo $block['text'] ?>

        <?php
        $block = get_field('bkock_3', $this_page_id);
        ?>
        <div class="abt-list__wrapp">
            <p><strong><?php echo $block['title'] ?></strong></p>
            <?php
            if(is_array($block['points'])){
                ?>
                <ul class="abt-list">
                    <?php
                    foreach ($block['points'] as $point){
                        ?>
                        <li class="abt-list__item">
                            <p><?php echo $point['point'] ?></p>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <?php
            }
            ?>
        </div>
        <div class="check__block abt-check-radius">
            <div class="check__inner"><input type="radio" class="checkbox" id=radiobtn-1 name="radio">
                <label for="radiobtn-1" class="checkbox__label">polarized</label></div>
            <div class="check__inner"> <input type="radio" class="checkbox" id=radiobtn-2 name="radio" checked>
                <label for="radiobtn-2" class="checkbox__label">polarized</label></div>
        </div>
        <div class="check__block abt-check">
            <div class="check__inner"><input type="checkbox" class="checkbox" id=checkbox_3>
                <label for="checkbox_3" class="checkbox__label">polarized</label></div>
            <div class="check__inner"> <input type="checkbox" class="checkbox" id=checkbox_4 checked>
                <label for="checkbox_4" class="checkbox__label">polarized</label></div>
        </div>

        <?php
        $block = get_field('bkock_4', $this_page_id);
        ?>
        <div class="abt-table">
            <?php echo $block['text'] ?>
        </div>
    </div>
</div>
</div>
<?php
get_footer();
?>
