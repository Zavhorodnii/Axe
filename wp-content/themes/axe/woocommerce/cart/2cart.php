<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

echo 'cart page';



do_action( 'woocommerce_before_cart' ); ?>



<div class="container">
    <h1 class="page__name">Корзина</h1>

    <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
        <?php do_action( 'woocommerce_before_cart_table' ); ?>

        <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents " cellspacing="0">
<!--            <thead>-->
<!--            <tr>-->
<!--                <th class="product-remove">&nbsp;</th>-->
<!--                <th class="product-thumbnail">&nbsp;</th>-->
<!--                <th class="product-name">--><?php //esc_html_e( 'Product', 'woocommerce' ); ?><!--</th>-->
<!--                <th class="product-price">--><?php //esc_html_e( 'Price', 'woocommerce' ); ?><!--</th>-->
<!--                <th class="product-quantity">--><?php //esc_html_e( 'Quantity', 'woocommerce' ); ?><!--</th>-->
<!--                <th class="product-subtotal">--><?php //esc_html_e( 'Subtotal', 'woocommerce' ); ?><!--</th>-->
<!--            </tr>-->
<!--            </thead>-->
            <tbody>
            <?php do_action( 'woocommerce_before_cart_contents' ); ?>

            <?php
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
//            WC()->cart->remove_cart_item($product_id);

                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                    ?>
                    <table class="basket__wrapp-card shop_table shop_table_responsive cart woocommerce-cart-form__contents  woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                        <tr>
                            <td rowspan="4" class="product-thumbnail basket__img-inner">
                                <?php
                                $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                                if ( ! $product_permalink ) {
                                    echo $thumbnail; // PHPCS: XSS ok.
                                } else {
                                    printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                                }
                                ?>
                            </td>
<!--                            <td rowspan="3">span 3 rows</td>-->
                            <td></td>
                            <td>
                                <p class="basket__column-name">Цена</p>
                            </td>
                            <td>
                                <p class="basket__column-name">Количество</p>
                            </td>
                            <td>
                                <p class="basket__column-name">Сумма</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                                <?php
                                if ( ! $product_permalink ) {
                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                                } else {
                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a class="basket__name" href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                }

                                do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                                // Meta data.
                                echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                                // Backorder notification.
                                if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                                }
                                ?>
                            </td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                                <?php
                                if ( ! $product_permalink ) {
                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_description(), $cart_item, $cart_item_key ) . '&nbsp;' );
                                } else {
                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a class="basket__subname" href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_description() ), $cart_item, $cart_item_key ) );
                                }

                                do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                                // Meta data.
                                echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                                // Backorder notification.
                                if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                                }
                                ?>
                            </td>
                            <td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">

                                <p class="basket__price-one">
                                    <?php
                                    echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                    ?>
                                </p>
                            </td>
                            <td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">

                                <div class="basket__count-inner js_find_class">
                                    <button class="count-btn minus js_sub_input_val">-</button>
                                    <?php
                                    if ( $_product->is_sold_individually() ) {
                                        $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                    } else {
                                        $product_quantity = woocommerce_quantity_input(
                                            array(
                                                'input_name'   => "cart[{$cart_item_key}][qty]",
                                                'input_value'  => $cart_item['quantity'],
                                                'max_value'    => $_product->get_max_purchase_quantity(),
                                                'min_value'    => '0',
                                                'product_name' => $_product->get_name(),
                                            ),
                                            $_product,
                                            false
                                        );
                                    }

                                    echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                                    ?>
                                    <button class="count-btn plus js_add_input_val">+</button>

                                </div>
                            </td>
                            <td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                                <p class="basket__price-sum">
                                    <?php
                                    echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                    ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4"></td>
                        </tr>
                        <tr>
                            <td class="product-remove basket__img-block">
                                <?php
                                echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                    'woocommerce_cart_item_remove_link',
                                    sprintf(
                                        '<a href="%s" class="basket__img-delete" aria-label="%s" data-product_id="%s" data-product_sku="%s">Удалить</a>',
                                        esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                        esc_html__( 'Remove this item', 'woocommerce' ),
                                        esc_attr( $product_id ),
                                        esc_attr( $_product->get_sku() )
                                    ),
                                    $cart_item_key
                                );
                                ?>
                            </td>
                            <td colspan="4"></td>
                        </tr>
                    </table>



                    <?php
                }
            }
            ?>

            <?php do_action( 'woocommerce_cart_contents' ); ?>

            <tr>
                <td  class="actions">

<!--                    --><?php //if ( wc_coupons_enabled() ) { ?>
<!--                        <div class="coupon">-->
<!--                            <label for="coupon_code">--><?php //esc_html_e( 'Coupon:', 'woocommerce' ); ?><!--</label>-->
<!--                            <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="--><?php //esc_attr_e( 'Coupon code', 'woocommerce' ); ?><!--" />-->
<!--                            <button type="submit" class="button" name="apply_coupon" value="--><?php //esc_attr_e( 'Apply coupon', 'woocommerce' ); ?><!--">--><?php //esc_attr_e( 'Apply coupon', 'woocommerce' ); ?><!--</button>-->
<!--                            --><?php //do_action( 'woocommerce_cart_coupon' ); ?>
<!--                        </div>-->
<!--                    --><?php //} ?>

                    <button type="submit" class="button" style="display: none" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

                    <?php do_action( 'woocommerce_cart_actions' ); ?>

                    <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                </td>
            </tr>



            <div class="position_table">

                <table class="v_coupon_table_style">
                    <tr >
                        <td>
                            <div class="basket__wrapp-promo">
                                <div class="text-in">Введите промокод</div>
                            </div>
                        </td>
                        <td class="basket__wrapp-promo"></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="basket__wrapp-promo">
                                <input type="text" name="coupon_code" class=" promo-input" id="coupon_code" value=""  />
                            </div>
                        </td>
                        <td>
                            <div class="basket__wrapp-promo">
                                <!--                            button-->
                                <button type="submit" class=" basket__promo-btn" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>">Применить</button>
                            </div>
                        </td>
                        <?php do_action( 'woocommerce_cart_actions' ); ?>

                        <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                    </tr>
                </table>

                <?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<!--                <div class="cart-collaterals">-->
                    <?php
                    /**
                     * Cart collaterals hook.
                     *
                     * @hooked woocommerce_cross_sell_display
                     * @hooked woocommerce_cart_totals - 10
                     */
                    do_action( 'woocommerce_cart_collaterals' );
                    ?>
<!--                </div>-->

                <?php do_action( 'woocommerce_after_cart' ); ?>
            </div>


            <?php do_action( 'woocommerce_after_cart_contents' ); ?>
            </tbody>
        </table>
        <?php do_action( 'woocommerce_after_cart_table' ); ?>
    </form>
<!-------------------------------------------------------------------------------->

    <div class="basket__wrapp-order">
        <div class="basket__inner-order js_find_form_fields">
            <p class="basket__order-title">Оформление заказа</p>
            <p class="order-in">Ваше имя</p>
            <input class="order-input v_style_border js_get_name js_clear_field" type="text">
            <p class="order-in">Ваш E-mail</p>
            <input class="order-input v_style_border  js_get_mail js_clear_field" type="text">
            <p class="order-in">Ваш Телефон</p>
            <input class="order-input v_style_border  js_get_phone js_clear_field" type="text">
            <p class="order-in">Адрес доставки</p>
            <input class="order-input v_style_border  js_get_address js_clear_field" type="text">
            <p class="order-in">Примечание</p>
            <textarea class="order-textarea v_style_border  js_get_addition_text js_clear_field" name="" id="" cols="20" rows="4"></textarea>
            <p class="order-in">Способ доставки</p>
            <div class="select-order">
                <div class="select__header-order">
                    <div class="select__current-order">Выберите способ оплаты</div>
                    <div class="select__icon-order"></div>
                </div>
                <div class="select__body-order">
<!--                    --><?php
//                    foreach ( WC()->cart->get_shipping_packages() as $package_id => $package ) {
//                        // Check if a shipping for the current package exist
//                        if ( WC()->session->__isset( 'shipping_for_package_'.$package_id ) ) {
//                            // Loop through shipping rates for the current package
//                            foreach ( WC()->session->get( 'shipping_for_package_'.$package_id )['rates'] as $shipping_rate_id => $shipping_rate ) {
//                                $rate_id     = $shipping_rate->get_id(); // same thing that $shipping_rate_id variable (combination of the shipping method and instance ID)
//                                $method_id   = $shipping_rate->get_method_id(); // The shipping method slug
//                                $instance_id = $shipping_rate->get_instance_id(); // The instance ID
//                                $label_name  = $shipping_rate->get_label(); // The label name of the method
//                                $cost        = $shipping_rate->get_cost(); // The cost without tax
//                                $tax_cost    = $shipping_rate->get_shipping_tax(); // The tax cost
//                                $taxes       = $shipping_rate->get_taxes(); // The taxes details (array)
//                                ?>
<!--                                <div class="select__item-order js_click_select_shipping " data-shipping="--><?php //echo $method_id ?><!--">--><?php //echo $label_name . ' ' . $cost . '₽' ?><!--</div>-->
<!--                                --><?php
//                            }
//                        }
//                    }
//                    ?>
                    <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

                        <?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

                        <?php wc_cart_totals_shipping_html(); ?>

                        <?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

                    <?php endif; ?>
                </div>
            </div>
            <p class="order-in">Способ оплаты</p>
            <div class="select-order">
                <div class="select__header-order">
                    <div class="select__current-order">Оплата-1</div>
                    <div class="select__icon-order"></div>
                </div>
                <div class="select__body-order">
                    <div class="select__item-order">Оплата-1</div>
                    <div class="select__item-order">Оплата-2</div>
                    <div class="select__item-order">Оплата-3</div>
                </div>
            </div>
            <div class="order-btn btn js_add_product_order">Заказ подтверждаю</div>
        </div>
    </div>

</div>




<?php //do_action( 'woocommerce_before_cart_collaterals' ); ?>
<!---->
<!--<div class="cart-collaterals">-->
<!--    --><?php
//    /**
//     * Cart collaterals hook.
//     *
//     * @hooked woocommerce_cross_sell_display
//     * @hooked woocommerce_cart_totals - 10
//     */
//    do_action( 'woocommerce_cart_collaterals' );
//    ?>
<!--</div>-->
<!---->
<?php //do_action( 'woocommerce_after_cart' ); ?>


