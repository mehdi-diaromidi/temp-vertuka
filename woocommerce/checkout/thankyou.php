<?php

/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined('ABSPATH') || exit;
?>

<div class="woocommerce-order vertuka-thanks">

    <?php
    if ($order) :

        do_action('woocommerce_before_thankyou', $order->get_id());
    ?>

        <?php if ($order->has_status('failed')) : ?>
            <div class="image-box">
                <div class="row">
                    <div class="col-xl-6 col-lg-7 col-md-12 col-12 mx-auto">
                        <div class="img-box text-center">
                            <img src="<?php vertuka_show_image('assets/images/payment-unsuccessfull.svg'); ?>" alt="unsuccessful payment">
                        </div>
                        <div class="title">
                            <h1>پرداخت ناموفق</h1>
                        </div>
                        <div class="payment-info">
                            <p class="text woocommerce-thankyou-order-failed"><?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce'); ?></p>
                        </div>
                        <div>
                            <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                                <a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>" class="button pay"><?php esc_html_e('Pay', 'woocommerce'); ?></a>
                                <?php if (is_user_logged_in()) : ?>
                                    <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="button pay"><?php esc_html_e('My account', 'woocommerce'); ?></a>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>




        <?php else : ?>
            <div class="image-box">
                <div class="row">
                    <div class="col-xl-6 col-lg-7 col-md-12 col-12 mx-auto">
                        <div class="img-box text-center">
                            <img src="<?php vertuka_show_image('assets/images/payment-successfull.svg'); ?>" alt="thanks">
                        </div>
                        <div class="title text-center">
                            <h2>سفارش با موفقیت ثبت شد</h2>
                        </div>
                        <div class="payment-info">
                            <ul class="m-0">
                                <li class="d-flex">
                                    <div><i class="icon transport"></i></div>
                                    <div><span class="title me-2"><?php esc_html_e('Order number:', 'woocommerce'); ?></span></div>
                                    <div><span class="value">#<?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                                ?></span></div>
                                </li>

                                <?php if ($order->get_payment_method_title()) : ?>
                                    <li class="d-flex">
                                        <div><i class="icon cart"></i></div>
                                        <div><span class="title me-2"><?php esc_html_e('Payment method:', 'woocommerce'); ?></span></div>
                                        <div><span class="value"><?php echo wp_kses_post($order->get_payment_method_title()); ?></span></div>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class="order-successfull-box mb-4">
                            <div class="inner-box">
                                <h2 class="title">جزئیات سفارش</h2>
                                <div>
                                    <?php
                                    $order_items = wc_get_order($order->get_order_number());
                                    $cart_number = 0;
                                    $dis_amount = 0;
                                    $all_subtotlal = 0;
                                    foreach ($order_items->get_items() as $item_id => $item) {
                                        $product_name = $item->get_name();
                                        $quantity = $item->get_quantity();
                                        $data_Stored = $item->get_data_store();
                                        $subtotal = $item->get_subtotal();
                                        $product_id = $item->get_product_id();
                                        $product = wc_get_product($product_id);
                                        $thumbnail = $product->get_image(array(186, 186));
                                        $cart_number += $quantity;

                                    ?>
                                        <div class="order-detail-item mt-3">
                                            <div class="d-flex justify-content-between">
                                                <div class="item-info-box">
                                                    <div class="d-flex">
                                                        <div class="me-3 pt-4 pt-md-0">
                                                            <div class="thumbnail-box">
                                                                <?php echo $thumbnail; ?>
                                                            </div>
                                                        </div>

                                                        <div class="position-relative w-100">
                                                            <div class="inner-box-float py-4">
                                                                <div class="category mb-2"><?php vertuka_get_category_html($product_id); ?></div>
                                                                <div class="quantity mb-0 mb-md-2">تعداد: <strong><?php echo $quantity; ?></strong></div>
                                                                <div class="product-name mb-2">
                                                                    <h2 class="title"><?php echo $product_name; ?></h2>
                                                                </div>
                                                                <div class="mt-2">
                                                                    <div class="m-0 price position-relative top-0 d-flex left-0">
                                                                        <p class="mb-0 orginal-price-discounted-product-2 me-2">
                                                                            <del>
                                                                                <?php


                                                                                if ($product_id == $product_id) {
                                                                                    // Get regular price
                                                                                    $regular_price = $item->get_product()->get_regular_price();

                                                                                    // Get discounted price
                                                                                    $discounted_price = $item->get_product()->get_price();

                                                                                    //discounted amount
                                                                                    $all_reg = $quantity * $regular_price;
                                                                                    $dis_amount += ($all_reg - $subtotal);
                                                                                    $all_subtotlal += $subtotal;

                                                                                    // Output the prices
                                                                                    if ($all_reg > $subtotal) {
                                                                                        echo vertuka_the_persian_number(number_format($all_reg));
                                                                                    }
                                                                                }

                                                                                ?>
                                                                            </del>
                                                                        </p>
                                                                        <p class="m-0 mobile-price">
                                                                            <?php echo vertuka_the_persian_number(number_format($subtotal)); ?><span> تومان</span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="address-box mt-3">
                                    <h3 class="title mb-2 mt-0">آدرس تحویل سفارش</h3>
                                    <address class="address mb-2 mt-0">
                                        <?php

                                        $shipping_address = $order->get_formatted_shipping_address();
                                        $shipping_address = str_replace(array('<br/>', '<br>', '< br>', '</ br>'), ', ', $shipping_address);
                                        echo $shipping_address;
                                        ?>
                                    </address>
                                    <h6 class="giver my-0">
                                        <?php
                                        $current_user = wp_get_current_user();
                                        $user_id = $current_user->ID;
                                        $author_info = get_userdata($user_id);
                                        $author_nickname = $author_info->display_name;

                                        if ($user_id) {
                                            echo $author_nickname;
                                        }
                                        ?>
                                    </h6>
                                </div>

                                <div class="mt-3 order-delevary-details">
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="subject">زمان تحویل سفارش</div>
                                        <div class="value">
                                            <?php
                                            // Get the custom text field value
                                            // $arrive = get_post_meta($order->get_id(), '_vertuka_custom_text_field', true);
                                            // echo esc_html($arrive);
                                            ?>
                                            <?php

                                            $shipping_type = explode(" ", $order->get_meta('_vertuka_custom_text_field', true));

                                            if ($order->get_meta('_vertuka_custom_text_field', true) == 'پست') {
                                                echo 'روش ارسال: پست';
                                            }

                                            if ($order->get_meta('_vertuka_custom_text_field', true) == 'پست-رایگان') {
                                                echo 'روش ارسال: پست';
                                            }

                                            if ($order->get_meta('_vertuka_custom_text_field', true) == 'پیک-توربو') {
                                                echo 'ارسال توربو ' . jdate('d-m-Y', strtotime($order->get_date_created()));
                                            }

                                            if ($shipping_type[0] == 'ساعت') {
                                                echo 'ارسال عادی: ' . explode("-", $shipping_type[1])[2] . ' بازه (' . explode("-", $shipping_type[1])[0] . '-' . explode("-", $shipping_type[1])[1] . ')';
                                            }

                                            ?>

                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="subject">تعداد محصولات</div>
                                        <div class="value-3"><?php echo vertuka_persian_number($cart_number); ?></div>
                                    </div>

                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="subject">جمع تخفیف ها</div>
                                        <div class="value-2"><?php echo vertuka_persian_number(number_format($dis_amount+$order->get_discount_total())); ?> تومان</div>
                                    </div>

                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="subject">مبلغ کل</div>
                                        <div class="value-2 text-black"><?php echo vertuka_persian_number(number_format($order->get_total())); ?> تومان</div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <div class="d-flex">
                                        <div class="me-3 w-100">
                                            <a href="<?php echo esc_url(get_bloginfo('url')); ?>/my-account/" class="d-block w-100 btn-thank-you">

                                                <i class="icon user"></i>
                                                <span>حساب کاربری</span>
                                            </a>
                                        </div>
                                        <div class="w-100">
                                            <a href="#" onclick="window.print(); return false;" class="d-block w-100 btn-thank-you">
                                                <i class="icon print"></i>
                                                <span>پرینت</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <?php //do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); 
        ?>
        <?php //do_action( 'woocommerce_thankyou', $order->get_id() ); 
        ?>

    <?php else : ?>

        <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'woocommerce'), null); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                                                                        ?></p>

    <?php endif; ?>

</div>