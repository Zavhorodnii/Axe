<?php
function v_get_site_menu(){
    ?>
    <div class="container">
        <ul class="breadcrumbs">
            <li>
                <a href="<?php echo get_home_url() ?>">Главная</a>
            </li>
            <li>
                <span><?php echo get_the_title() ?></span>
            </li>
        </ul>
    </div>
    <?php
}