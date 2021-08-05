
<form role="search" method="get" class="header__search" id="searchform" action="<?php echo home_url( '/' ) ?>" >
<!--    <label class="screen-reader-text" for="s">Поиск: </label>-->
    <input class="header__input" placeholder="поиск" type="text" value="<?php echo get_search_query() ?>" name="s" id="s" />
    <button type="submit" class="header__search-btn" id="searchsubmit" value="найти" > </button>
</form>