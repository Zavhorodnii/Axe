<?php

//do_action( 'woocommerce_before_cart' );
?>

<div class="main-wrapp">
    <div class="breadcrumbs-wrap">
        <div class="container">
            <ul class="breadcrumbs">
                <li>
                    <a href="#">Главная</a>
                </li>
                <li>
                    <span>Корзина</span>
                </li>
            </ul>
        </div>

    </div>
</div>
<div class="container js_loader_control">
    <h1 class="page__name">Корзина</h1>

    <?php
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $product = $cart_item['data'];
        $product_id = $cart_item['product_id'];
        $quantity = $cart_item['quantity'];
        $price = WC()->cart->get_product_price( $product );
        $subtotal = WC()->cart->get_product_subtotal( $product, $cart_item['quantity'] );
        $link = $product->get_permalink( $cart_item );
        // Anything related to $product, check $product tutorial
        $attributes = $product->get_attributes();
        $whatever_attribute = $product->get_attribute( 'whatever' );
        $whatever_attribute_tax = $product->get_attribute( 'pa_whatever' );
        $any_attribute = $cart_item['variation']['attribute_whatever'];
        $meta = wc_get_formatted_cart_item_data( $cart_item );
        $product_info = wc_get_product($product_id);

    ?>

        <div class="basket__wrapp-card">
            <div class="basket__column-left">
                <div class="basket__img-block">
                    <div class="basket__img-inner">
                        <?php
                        if ($product_info->is_type( 'variable' ))
                            {
                                $available_variations = $product_info->get_available_variations();
                                foreach ($available_variations as $key => $variation)
                                {
                                    if($variation['attributes']['attribute_pa_colour_product'] == $attributes['pa_colour_product']){
                                    ?>
                                        <img class="basket__img" src="<?php echo $variation['image']['url'] ?>" alt="">
                                    <?php
                                    }
                                }
                            } else {
                                ?>
                                <img class="basket__img" src="<?php echo wp_get_attachment_image_url($product_info->get_image_id(), 'full') ?>" alt="">
                                <?php
                            }
                        ?>
                    </div>
                    <button type="submit" class="basket__img-delete js_delete_product_from_cart" data-delete-product="<?php echo $cart_item_key ?>">Удалить</button>
                </div>
                <div class="basket__name-block">
                    <a href="<?php echo $link ?>" class="basket__name"><?php echo $product->get_name(); ?></a><br>
                    <a href="<?php echo $link ?>" class="basket__subname"><?php echo $product->get_description(); ?></a>
                </div>
            </div>
            <div class="basket__column-right">
                <div class="basket___one-block">
                    <p class="basket__column-name">Цена</p>
                    <p class="basket__price-one"><?php echo $product->get_price() ?></p>
                </div>
                <div class="basket___count-block">
                    <p class="basket__column-name">Количество</p>
                    <div class="basket__count-inner" data-product-id="<?php echo $cart_item_key ?>">
                        <button class="count-btn minus js_change_cart_quantity">-</button>
                        <input type="number" class="basket__count js_input_press_enter" value="<?php echo $quantity ?>">
                        <button class="count-btn plus js_change_cart_quantity">+</button>
                    </div>
                </div>
                <div class="basket___sum-block">
                    <p class="basket__column-name">Цена</p>
                    <p class="basket__price-sum"><?php echo $subtotal ?></p>
                </div>
            </div>
        </div>
        <?php
    }
    ?>


    <div class="basket__wrapp-total ">
        <div class="basket__wrapp-promo js_find_coupons">
            <div class="basket__promo-in">
                <div class="text-in">Введите промокод</div>
                <p class="cart-promo js_coupons_status"></p>
                <input class="promo-input js_get_coupons" type="text" name="" id="">
            </div>
            <button class="basket__promo-btn js_add_coupons">Применить</button>
        </div>
        <div class="basket__total">
            <div class="basket__total-group">
                <p class="basket__total-text">Товаров на суму:</p>
                <p class="basket__total-text">Купон:</p>
                <p class="basket__total-text">Доставка:</p>
                <p class="basket__total-title">Итого к оплате:</p>
            </div>
            <div class="basket__total-group">
                <p class="basket__total-price js_cart_subtotal"><?php echo WC()->cart->get_cart_subtotal(); ?></p>

                <p class="basket__total-price js_coupons">
                <?php
                $total_coupons_amount = 0.00;
                foreach ( WC()->cart->get_applied_coupons() as $cart_item_key => $coupon ) {
                    $coupon = new WC_Coupon($coupon);
                    $total_coupons_amount += $coupon->get_amount();
                }
                echo  ($total_coupons_amount == 0 ? '0.00' : '- ' . $total_coupons_amount) . '₽'
                ?>
                </p>
                <p class="basket__total-price js_paste_shipping_method">
                    <?php
                    $shossing_shipping = wc_get_chosen_shipping_method_ids();
                    $stop = false;
                    foreach ( WC()->cart->get_shipping_packages() as $package_id => $package ) {
                        // Check if a shipping for the current package exist
                        if ( WC()->session->__isset( 'shipping_for_package_'.$package_id ) ) {
                            // Loop through shipping rates for the current package
                            foreach ( WC()->session->get( 'shipping_for_package_'.$package_id )['rates'] as $shipping_rate_id => $shipping_rate ) {
                                $method_id   = $shipping_rate->get_method_id(); // The shipping method slug
                                $cost        = $shipping_rate->get_cost(); // The cost without tax
                                if($shossing_shipping[0] == $method_id){
                                    echo $cost . '₽';
                                    $stop = true;
                                    break;
                                }
                            }
                        }
                        if($stop){
                            break;
                        }
                    }
                    ?>
                </p>
                <p class="basket__total-tprice js_total_cart"><?php echo v_get_total_cart() ?></p>
            </div>
        </div>
    </div>
    <div class="basket__wrapp-btn">
        <a href="#" class="basket__btn">Продолжить</a>
    </div>
    <div class="basket__wrapp-order">
        <div class="basket__inner-order js_find_form_fields">
            <p class="basket__order-title">Оформление заказа</p>
            <p class="order-in">Ваше имя</p>
            <input class="order-input v-cart-input-style js_get_name js_clear_field" type="text">
            <p class="order-in">Ваш E-mail</p>
            <input class="order-input v-cart-input-style js_get_mail js_clear_field" type="text">
            <p class="order-in">Ваш Телефон</p>
            <input class="order-input v-cart-input-style js_get_phone js_clear_field" type="text">
            <p class="order-in">Адрес доставки</p>
            <input class="order-input v-cart-input-style js_get_address js_clear_field" type="text">
            <p class="order-in">Примечание</p>
            <textarea class="order-textarea js_get_addition_text js_clear_field" name="" id="" cols="20" rows="4"></textarea>
            <p class="order-in">Способ доставки</p>
            <div class="select-order">
                <div class="select__header-order">
                    <?php
                    $shossing_shipping = wc_get_chosen_shipping_method_ids();
                    $stop = false;
                    foreach ( WC()->cart->get_shipping_packages() as $package_id => $package ) {
                        // Check if a shipping for the current package exist
                        if ( WC()->session->__isset( 'shipping_for_package_'.$package_id ) ) {
                            // Loop through shipping rates for the current package
                            foreach ( WC()->session->get( 'shipping_for_package_'.$package_id )['rates'] as $shipping_rate_id => $shipping_rate ) {
                                $method_id   = $shipping_rate->get_method_id(); // The shipping method slug
                                if($shossing_shipping[0] == $method_id){
                                    ?>
                                    <div class="select__current-order"><?php echo $shipping_rate->get_label() . ' ' . $shipping_rate->get_cost() . '₽' ?></div>
                                    <?php
                                    $stop = true;
                                    break;
                                }
                            }
                        }
                        if($stop){
                            break;
                        }
                    }
                    ?>
<!--                    <div class="select__current-order">Выберите вариант доставки</div>-->
                    <div class="select__icon-order"></div>
                </div>
                <div class="select__body-order">
                    <?php
                    foreach ( WC()->cart->get_shipping_packages() as $package_id => $package ) {
                        // Check if a shipping for the current package exist
                        if ( WC()->session->__isset( 'shipping_for_package_'.$package_id ) ) {
                            // Loop through shipping rates for the current package
                            foreach ( WC()->session->get( 'shipping_for_package_'.$package_id )['rates'] as $shipping_rate_id => $shipping_rate ) {
                                $rate_id     = $shipping_rate->get_id(); // same thing that $shipping_rate_id variable (combination of the shipping method and instance ID)
                                $method_id   = $shipping_rate->get_method_id(); // The shipping method slug
                                $instance_id = $shipping_rate->get_instance_id(); // The instance ID
                                $label_name  = $shipping_rate->get_label(); // The label name of the method
                                $cost        = $shipping_rate->get_cost(); // The cost without tax
                                $tax_cost    = $shipping_rate->get_shipping_tax(); // The tax cost
                                $taxes       = $shipping_rate->get_taxes(); // The taxes details (array)
                                ?>
                                <div class="select__item-order js_click_select_shipping" data-shipping="<?php echo $method_id ?>"><?php echo $label_name . ' ' . $cost . '₽' ?></div>
                                <?php
                            }
                        }
                    }
                    ?>
<!--                    <div class="select__item-order">Пошта-1</div>-->
<!--                    <div class="select__item-order">Пошта-2</div>-->
<!--                    <div class="select__item-order">Пошта-3</div>-->
                </div>
            </div>
            <p class="order-in">Способ оплаты</p>
            <div class="select-order ">
                <div class="select__header-order order-add-error">
                    <div class="select__current-order js_get_pay_method" data-pay-method="0">Выберите метод оплаты</div>
                    <div class="select__icon-order"></div>
                </div>
                <div class="select__body-order js_paste_payment">
                    <?php
                    if ( WC()->cart->needs_payment() ) : ?>
                        <?php
                        $WC_Payment_Gateways = new WC_Payment_Gateways();
                        $available_gateways = $WC_Payment_Gateways->get_available_payment_gateways();
//                        echo 'count = ' . count($available_gateways);
                        if ( ! empty( $available_gateways ) ) {
                            foreach ( $available_gateways as $gateway ) {
//                                var_export($gateway);
//                                echo $gateway->payment_fields();
                                ?>
                                <div class="select__item-order" data-pay-method="<?php echo esc_attr( $gateway->id ); ?>"><?php echo $gateway->get_title(); ?></div>
                                <?php
                            }
                        }
                    endif; ?>
                </div>
            </div>
<!--            <button class=" order-btn btn js_add_product_order btn one-btn" data-fancybox-->
<!--                    href="#fncbx-add-order"></button>-->
            <div class="order-btn btn js_add_product_order">Заказ подтверждаю</div>
        </div>
    </div>
</div>
</div>

