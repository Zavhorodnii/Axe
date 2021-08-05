<?php
require_once 'query_menu.php';

$product_cat_object = get_queried_object();

$index = 1;
?>
<div class="filters__wrap">
    <h4 class="filter__title filt-bg">Фильтры
        <span class="filter__close"></span>
    </h4>
    <?php
    $title = true;
    $terms = get_terms( [
        'taxonomy' => 'pa_funktsional',
        'hide_empty' => false,
    ] );
    foreach( $terms as $term ){
        if (get_query_menu($product_cat_object , $term)){
            $functional = explode(';', $_GET['functional']);
            if($title){
                ?>
                    <h5 class="filter__title">функционал</h5>
                    <div class="check__block js_change_select_filter">
                <?php
                $title = false;
            }
            ?>

            <div class="input-box">
                <input type="checkbox" <?php echo in_array($term->slug, $functional) ? 'checked' : '' ?> class="checkbox" id=checkbox_<?php echo $index ?>>
                <label for="checkbox_<?php echo $index ?>" class="checkbox__label js_get_filter_param" data-filter-params="<?php echo 'functional=' . $term->slug ?>"><?php echo $term->name ?>
                    <span class="under"><?php echo get_field('text_under_parameter', $term->taxonomy . '_' . $term->term_id) ?></span>
                </label>
            </div>
            <?php
            $index++;
        }
    }
    if(!$title){
        ?>
            </div>
        <?php
    }
    $title = true;
    $terms = get_terms([
        'taxonomy' => 'pa_stil',
        'hide_empty' => false,
    ]);
    foreach ($terms as $term){
        if (get_query_menu($product_cat_object, $term)){
            $style = explode(';', $_GET['style']);
            if ($title){
                ?>
                    <h5 class="filter__title">Стиль</h5>
                    <div class="check__block js_change_select_filter">
                <?php
                $title = false;
            }
            ?>
            <div class="input-box">
                <input type="checkbox" <?php echo in_array($term->slug, $style) ? 'checked' : '' ?> class="checkbox" id=checkbox_<?php echo $index ?>>
                <label for="checkbox_<?php echo $index ?>" style="color: <?php echo get_field('right_colour', $term->taxonomy . '_' . $term->term_id) ?>" class="checkbox__label man-s js_get_filter_param" data-filter-params="<?php echo 'style=' . $term->slug ?>"><?php echo $term->name ?>
                    <span class="man" style="background-color: <?php echo get_field('right_colour', $term->taxonomy . '_' . $term->term_id) ?>"><?php echo get_field('right_text', $term->taxonomy . '_' . $term->term_id) ?></span>
                </label>
            </div>
            <?php
            $index++;
        }
    }
    if (!$title){
        ?>
        </div>
        <?php
    }
?>

    <h5 class="filter__title">Цена</h5>


    <div class="check__block">
        <div class="filter-price__inputs">
            <label class="filter-price__label">
                <input type="number" min="500" max="999999" placeholder="1000"
                       class="filter-price__input" id="input-0">

            </label>
            <span>-</span>
            <label class="filter-price__label">
                <input type="number" min="500" max="999999" placeholder="30000"
                       class="filter-price__input" id="input-1">

            </label>
        </div>

        <div class="filter-price__slider" id="range-slider" data-get_params_price="<?php echo
         $_GET['price'] ? $_GET['price'] : get_field('site_header_min_price', 'option') .';'. get_field('site_header_max_price', 'option') ?>" data-price="<?php echo get_field('site_header_min_price', 'option') ?>;<?php echo get_field('site_header_max_price', 'option') ?>"></div>
    </div>


    <?php
        $title = true;
        $terms = get_terms([
            'taxonomy' => 'pa_naznachenie',
            'hide_empty' => false,
        ]);
        foreach ($terms as $term){
            if (get_query_menu($product_cat_object, $term)){
                $purpose = explode(';', $_GET['purpose']);
                if ($title){
                    ?>
                        <h5 class="filter__title">Назначение</h5>
                        <div class="check__block js_change_select_filter">
                    <?php
                    $title = false;
                }
                ?>
                <div class="input-box">
                    <input type="checkbox" <?php echo in_array($term->slug, $purpose) ? 'checked' : '' ?> class="checkbox" id=checkbox_<?php echo $index ?>>
                    <label for="checkbox_<?php echo $index ?>" class="checkbox__label unnone js_get_filter_param" data-filter-params="<?php echo 'purpose=' . $term->slug ?>"><?php echo $term->name ?></label>
                </div>
                <?php
                $index++;
            }
        }
        if (!$title){
            ?>
                </div>
            <?php
        }
        $cate = get_queried_object();
        $posts_cat = get_field('linked_articles', 'product_cat_' .$cate->term_id);
        if(is_array($posts_cat)){
            foreach ($posts_cat as $item){
                ?>
                <a href="<?php echo get_permalink($item) ?>" class="filter-img">
                    <img src="<?php echo get_the_post_thumbnail_url($item) ?>" alt="">
                    <span class="filter-name"><?php echo get_the_title($item) ?></span>
                    <span class="filter-details">Подробнее>></span>
                </a>
                <?php
            }
        }
    ?>
</div>