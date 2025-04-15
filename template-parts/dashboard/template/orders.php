<div class="mt-5">
    <div class="mb-3">
        <a class="d-flex justify-content-between page-title-dashboard-box d-lg-none" id="sidebar-mobile-menu">
            <div class="d-flex">
                <div class="me-2"><img class="icon" src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/cart.svg')); ?>" alt="icon"></div>
                <div>
                    <h1 class="page-title-dashboard mb-0">سفارش&zwnj;های شما</h1>
                </div>
            </div>
            <div><img class="icon" src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/Expand_left.svg')); ?>" alt="icon"></div>
        </a>
    </div>
    <div class="d-lg-flex justify-content-between mt-4">
        <ul class="filter-orders" id="filter-orders">

            <li>
                <a class="d-flex filter-button active" href="#order-list-user" data-filter="all">
                    <span>همه</span>
                </a>
            </li>
            <li>
                <a class="d-flex filter-button" href="#order-list-user" data-filter="processing">
                    <span>در حال انجام</span>
                </a>
            </li>
            <li>
                <a class="d-flex filter-button" href="#order-list-user" data-filter="completed">
                    <span>تحویل داده شده</span>
                </a>
            </li>
            <li>
                <a class="d-flex filter-button" href="#order-list-user" data-filter="on-hold">
                    <span>لغو شده</span>
                </a>
            </li>
            <li>
                <a class="d-flex filter-button" href="#order-list-user" data-filter="returned">
                    <span>مرجوع شده</span>
                </a>
            </li>

            <div class="mj-orders-menu-scroll .d-none .d-sm-block .d-md-none " id="mj-orders-menu-scroll">
                <img class="icon" src="https://vertuka.com/wp-content/themes/vertuka/template-parts/dashboard/img/Expand_left.svg" alt="icon" style="margin-right: -2px;">
            </div>

        </ul>


    </div>
    <div id="order-list-user">
        <?php
        $current_user = wp_get_current_user();
        $customer_orders = wc_get_orders(array(
            'customer' => $current_user->ID,
        ));

        // Loop through and display order details.
        // echo '<pre>';var_dump($customer_orders);die;
        foreach ($customer_orders as $order) {
            $order_id = $order->get_id();
            $order_status = $order->get_status();

            // if ($order_status == 'cancelled') {
            //     $order_status = 'on-hold';
            // }

            if ($order_status == 'processing' || $order_status == 'accepted' || $order_status == 'receive-warehouse' || $order_status == 'preparation' || $order_status == 'delivery-carrier' || $order_status == 'case1' || $order_status == 'case2' || $order_status == 'case3' || $order_status == 'case31' || $order_status == 'case32' || $order_status == 'case33' || $order_status == 'case34' ) {
                $order_status = 'processing';
            }

            // if ($order_status == 'case1') {
            //     $order_status = 'on-hold';
            // }

            if ($order_status == 'completed') {
                $order_status = 'completed';
            }

            if ($order_status == 'cancelled') {
                $order_status = 'on-hold';
            }

            if ($order_status == 'case35' || $order_status == 'returned-sale') {
                $order_status = 'returned';
            }

            $order_date = $order->get_date_created()->date_i18n('d M Y');
            if ($order_status == 'on-hold' || $order_status == 'completed' || $order_status == 'processing' || $order_status == 'returned') {
        ?>
                <div id="order-<?php echo esc_attr($order_id); ?>" class="filter-item <?php echo esc_attr($order_status); ?>">
                    <div class="border rounded-3 my-4 p-3 d-lg-flex justify-content-between align-items-center">
                        <div>
                            <div class="d-flex flex-wrap">
                                <?php
                                $order_items = wc_get_order($order_id);

                                foreach ($order_items->get_items() as $item_id => $item) {
                                    echo '<div class="border rounded-3 p-1 me-2">';
                                    $product_id = $item->get_product_id();
                                    if (wc_get_product($product_id)) {
                                        $product_name = $item->get_name();
                                        $quantity = $item->get_quantity();
                                        $subtotal = $item->get_subtotal();

                                        if (has_post_thumbnail($product_id)) {
                                            $product = wc_get_product($product_id);
                                            $thumbnail = $product->get_image(array(50, 50));
                                            echo $thumbnail;
                                        }
                                    }
                                    echo '</div>';
                                }

                                ?>
                            </div>
                            <div class="d-flex my-3">
                                <div>
                                    <p class="fw-bold order-id m-0">سفارش #<?php echo esc_attr($order_id); ?></p>
                                </div>
                                <div class="d-flex align-items-center mx-2">
                                    <div>
                                        <img class="me-1" src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/Time_duotone.svg')); ?>" alt="icon">
                                    </div>
                                    <div>
                                        <span class="text-gray order-time"><?php echo $order_date; ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $persian_status = '';

                            if ($order_status == 'on-hold' || $order_status == 'cancelled') {
                                $persian_status = 'لغو شده';
                            } elseif ($order_status == 'completed') {
                                $persian_status = 'تحویل داده شده';
                            } elseif ($order_status == 'processing') {
                                $persian_status = 'در حال انجام';
                            } elseif($order_status == 'returned') {
                                $persian_status = 'مرجوع شده';
                            }
                            ?>
                            <div class="bg-txt-green d-inline-block font-smaller"><?php echo $persian_status; ?></div>
                        </div>
                        <div class="action">
                            <?php $o_url = add_query_arg('order', esc_attr($order_id), esc_url(get_bloginfo('url')) . '/my-account/view-order'); ?>
                            <a class="btn d-inline-block font-smaller bg-transparent border rounded-3 mt-3" href="<?php echo $o_url; ?>">
                                <span>مشخصات</span>
                                <img class="icon" src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/Expand_left.svg')); ?>" alt="icon">
                            </a>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>

</div>

<script>
    jQuery(document).ready(function() {
        jQuery("div.d-lg-flex.justify-content-between.mt-4 > ul > li:nth-child(1) > a").click();

        document.getElementById("mj-orders-menu-scroll").onclick = () => {
            document.getElementById("filter-orders").scrollBy({
                left: -80,
                top: 0,
                behavior: 'smooth'
            })
        };

    });
</script>