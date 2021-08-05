<?php
get_header();
?>

<div class="main">
    <div class="container">
        <div class="page-404__inner">
            <div class="center__404">
                <img src="<?php echo get_template_directory_uri() ?>/img/404.png" alt="">
            </div>
            <h3 class="page-404__title">Ой... Мы не можем найти эту страницу!</h3>
            <p class="page-404__subtitle">Мы сожалеем, но страница на которую Вы пытались перейти не существует.
            </p>
            <p class="page-404__subtitle">Пожалуйста вернитесь на предыдущую страницу или воспользуйтесь
                меню сайта.</p>
            <a href="javascript:history.go(-1)" class="page-404__link btn">Предыдущая страница</a>
        </div>
    </div>
</div>

<?php
get_footer();
?>
