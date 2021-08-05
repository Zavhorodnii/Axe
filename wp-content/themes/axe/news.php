<?php
/*
 * Template Name: news
 */
get_header();
require_once ('menu.php');
$this_page_id = get_the_ID();
?>

<div class="main-wrapp">
    <div class="breadcrumbs-wrap">
        <?php
        v_get_site_menu();
        ?>
    </div>
</div>
<div class="container ">
    <h1 class="page__name">Новости</h1>
    <div class="news-page__wrapp">
        <?php
        $promotions = get_field('promotions', $this_page_id);
        if(is_array($promotions)){
            ?>
            <div class="news-banner__block">
                <h4 class="news-banner__title filt-bg">Акции </h4>
                <?php
                foreach ($promotions as $promotion){
                    ?>
                    <a href="<?php echo $promotion['link'] ?>" class="banner__item">
                        <img src="<?php echo $promotion['image_promotion']['url'] ?>" alt="<?php echo $promotion['image_promotion']['alt'] ?>">
                        <span>Подробнее>></span>
                    </a>
                    <?php
                }
                ?>
            </div>
            <?php
        }
        ?>
        <div class="news-page__block">

            <?php
                $step = 6;
                $link = get_permalink();
                $_page = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
                $count_posts = wp_count_posts($type = 'news');
                $published_posts = $count_posts->publish;
                $count_pages = ceil($published_posts / $step);

                $query = new WP_Query([
                    'post_type' => 'news',
                    'posts_per_page' => $step,
                    'paged' => $_page,
                ]);

                if($query->post_count > 0){

                    while ( $query->have_posts() ) {
                        $query->the_post();
                        $post_id = $query->post->ID;
                        ?>
                        <div class="news-page__item">
                            <div class="news-page__img">
                                <a href="<?php echo get_permalink($post_id) ?>"><img src="<?php echo get_field('image_news', $post_id)['url'] ?>" alt="<?php echo get_field('image_news', $post_id)['alt'] ?>"></a>
                            </div>
                            <div class="news-page__text-block">
                                <p class="news-page__date"><?php echo get_the_date('d.m.y', $post_id) ?></p>
                                <a href="<?php echo get_permalink($post_id) ?>" class="news-page__title"><?php echo get_the_title($post_id) ?></a>
                                <p class="news-page__text"><?php echo get_field('short_description', $post_id) ?></p>
                                <a href="<?php echo get_permalink($post_id) ?>" class="news-page__disc">Читать >></a>
                            </div>
                        </div>
                        <?php
                    }
                    wp_reset_postdata();
                    ?>
                    <?php
                }
            ?>

            <div class="news-page__pagination-wrapp">
                <?php
                if($_page > 1){
                    ?>
                    <a href="<?php echo $link . 'page/' . ($_page-1)?>" class="news-page__pagination-prev"></a>
                    <?php
                }
                if($_page > 3 && $count_pages > 5){
                    ?>
                    <a class="news-page__pagination-item">...</a>
                    <?php
                }
                $max_repeat = $count_pages < 5 ? $count_pages : 5;
                $index_page = 1;
                if($_page > 0 && $_page <4 || $count_pages <= 5){
                    $index_page = 1;
                } else if($count_pages - 2 > $_page){
                    $index_page = $_page - 2;
                } else if($count_pages - 1 == $_page){
                    $index_page = $_page - 3;
                } else if($count_pages == $_page){
                    $index_page = $_page - 4;
                } else {
                    echo 'else';
                }

                for($i = 0; $i < $max_repeat; $i++){
                    ?>
                    <a href="<?php echo $link . 'page/' . $index_page ?>" class="news-page__pagination-item <?php echo $_page == $index_page ? 'pagination-active' : '' ?>"><?php echo $index_page ?></a>
                    <?php
                    $index_page++;
                }
                ?>
                <?php
                if($_page < $count_pages - 2 && $count_pages > 5){
                    ?>
                    <a class="news-page__pagination-item">...</a>
                    <?php
                }
                if($count_pages > $_page){
                    ?>
                    <a href="<?php  echo $link . 'page/' . ($_page+1) ?>" class="news-page__pagination-next"></a>
                    <?php
                }
                ?>
<!--                <a href="#" class="news-page__pagination-prev"></a>-->
<!--                <a href="#" class="news-page__pagination-item pagination-active">1</a>-->
<!--                <a href="#" class="news-page__pagination-item">2</a>-->
<!--                <a href="#" class="news-page__pagination-item">3</a>-->
<!--                <a href="#" class="news-page__pagination-item">4</a>-->
<!--                <a href="#" class="news-page__pagination-item">5</a>-->
<!--                <a href="#" class="news-page__pagination-item">...</a>-->
<!--                <a href="#" class="news-page__pagination-next"></a>-->
            </div>
        </div>
    </div>
</div>
</div>

<?php
get_footer();
?>
