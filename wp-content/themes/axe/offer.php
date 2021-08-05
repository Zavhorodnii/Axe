<?php
/*
	Template Name: Оферта
	Template Post Type: page
*/
require_once ('menu.php');
get_header();
?>


<div class="main__wrapp">
    <div class="breadcrumbs-wrap">
        <?php v_get_site_menu() ?>
    </div>
    <div class="catalog__text-group">
        <div class="container">
            <h1 class="catalog__name"><?php echo get_the_title() ?></h1>
            <p class="catalog__text"><?php echo get_the_content() ?></p>
        </div>
    </div>
</div>

<?php
get_footer();
?>
