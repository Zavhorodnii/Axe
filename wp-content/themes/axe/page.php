<?php get_header(); ?>
<?php

$product_id = intval(270);

    $product_cart_id = WC()->cart->generate_cart_id($product_id);

    if(!WC()->cart->find_product_in_cart($product_cart_id))
        WC()->cart->add_to_cart($product_id);

?>
<?php the_content(); ?>

<?php get_footer(); ?>