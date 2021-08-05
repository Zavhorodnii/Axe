<?php
get_header();
$this_page_id = get_the_ID();
?>

<div class="main-wrapp">
    <div class="breadcrumbs-wrap">
        <div class="container">

            <?php
            $slug = get_home_url() . '/allnews/';
            $page = get_page_by_path('/allnews/');
            ?>
            <ul class="breadcrumbs">
                <li>
                    <a href="<?php echo get_home_url() ?>">Главная</a>
                </li>
                <li>
                    <a href="<?php echo $slug ?>"><?php echo get_the_title($page->ID) ?></a>
                </li>
                <li>
                    <span><?php echo get_the_title() ?></span>
                </li>
            </ul>
        </div>

    </div>
</div>
<div class="container ">
    <h1 class="page__tile"><?php echo get_the_title() ?></h1>
    <div class="news-page__wrapp">

        <?php
        $news_repeater = get_field('news', $this_page_id);

        if(is_array($news_repeater)){
            ?>
            <div class="news-banner__block">
                <h4 class="news-banner__title filt-bg">Новости </h4>
                <?php
                foreach( $news_repeater as $item){
                    $image = get_field('image_news', $item);
                    ?>
                    <a href="<?php echo get_permalink($item) ?>" class="news__other">
                        <img src="<?php echo esc_url($image['sizes']['news_item_image']) ?>" alt="">
                        <span class="news__other-block">
                            <spna class="news__other-title"><?php echo get_the_title($item) ?></spna>
                            <spna class="news__other-date"><?php echo get_the_date('d.m.y', $post_id) ?></spna>
                        </span>
                    </a>
                    <?php
                }
                ?>

                <div class="new_link">
                    <a href="<?php echo get_field('all_news', $this_page_id) ?>" class="">Все новости>> </a>
                </div>

            </div>
            <?php
        }
        ?>

        <div class="news-page__block">
            <div class="new-item__wrapp">
                <?php
                $image = get_field('image_news', $this_page_id);
                if(isset($image)){
                    ?>
                    <div class="new-item__main-img">
                        <img src="<?php echo esc_url($image['sizes']['news_item_main_image']) ?>" alt="">
                    </div>
                    <?php
                }
                ?>
                <?php echo get_the_content() ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>
