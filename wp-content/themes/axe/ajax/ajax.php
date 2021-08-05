<?php

require_once ('useful_info.php');

// обратная связь
require 'ajax-backcall.php';
// избранное
require 'ajax-favorites.php';
// заказ
require_once ('ajax-add_product_to_cart.php');
// товар
require 'ajax-product.php';
// отзывы
require 'ajax-review.php';

require_once ('ajax-filter-product.php');
require_once ('ajax-variations_product.php');

//require 'ajax-custom-order-product.php';
require_once ('ajax-custom-order-product.php');
require_once ('ajax-select-shipping.php');
require_once ('ajax-delete-product-from-cart.php');
require_once ('ajax-change-quantity.php');
require_once ('ajax-add_product_coupons.php');
require_once ('ajax-order_in_one_click.php');
require_once ('ajax-prew_order.php');

?>