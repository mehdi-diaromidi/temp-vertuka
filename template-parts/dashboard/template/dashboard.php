<main class="rounded-3 page-content">
    <div class="mt-3 mb-2">
        <a class="d-flex justify-content-between page-title-dashboard-box d-lg-none" id="sidebar-mobile-menu">
            <div class="d-flex">
                <div class="me-2"><img class="icon" src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/darhboard_alt.svg')); ?>" alt="icon"></div>
                <div><h1 class="page-title-dashboard mb-0">داشبورد</h1></div>
            </div>
            <div><img class="icon" src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/Expand_left.svg')); ?>" alt="icon"></div>
        </a>
    </div>
    <div class="d-flex welcome flex-column mt-3">
        <?php $current_date = time(); ?>
        <p class="mb-0 today-date"><?php echo vertuka_the_persian_number( jdate( 'd F Y', $current_date ) ); ?></p>
        <p class="mb-0 welcome-text">خوش آمدید</p>
    </div>
    <div class="d-lg-flex mt-4">
        <div class="border my-3 my-lg-0 me-0 me-lg-3 cart-dash cart-info">
            <div class="d-flex">
                <div class="me-3">
                    <?php
                    $current_user = wp_get_current_user();
                    $user_id = $current_user->ID;
                    $author_info = get_userdata( $user_id );
                    $author_nickname = $author_info->display_name;
                    $author_avatar = get_avatar(
                        $author_info->user_email,
                        '90',
                        '',
                        $author_nickname,
                        array( 'class' => 'person-logo-2' )
                    );
                    echo $author_avatar;
                    ?>
                </div>
                <div class="d-block d-lg-flex">l
                    <div class="py-0 py-lg-3">
                        <div class="order-type-1 me-3">سطح طلایی</div>
                        <div class="me-3">
                                        <span class="fw-bold">
                                            <?php
                                            $current_user = wp_get_current_user();

                                            if ($current_user->ID) {
                                                echo $current_user->display_name;
                                            }
                                            ?>
                                        </span>
                        </div>
                    </div>
                    <div class="py-0 py-lg-4 nowrap">
                                    <span class="text-gray email nowrap">
                                    <?php
                                    if ($current_user->ID) {
                                        echo $current_user->user_email;
                                    }
                                    ?>
                                </span>
                    </div>
                </div>
            </div>
            <div class="d-flex my-4 fs-5">
                <div>
                    <span class="text-gray">مدت عضویت:</span>
                </div>
                <div>
                                <span class="fw-bold mx-1">
                                    <?php
                                    $user_registered = strtotime(get_userdata($current_user->ID)->user_registered);
                                    $current_time = time();
                                    $time_since_registration = human_time_diff($user_registered, $current_time);
                                    echo vertuka_the_persian_number($time_since_registration);
                                    ?>

                                </span>
                </div>
            </div>
            <button
                class="w-100 bg-transparent border  btn-white">
                <a href="<?php echo esc_url(get_bloginfo('url')); ?>/my-account/vertuka-account-detail/"
                   class="d-flex justify-content-center standard-hover">
                    <span class="fw-bold">ویرایش اطلاعات</span>
                    <img class="ms-2"
                         src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/Arrow_left.svg')); ?>"
                         alt="icon">
                </a>
            </button>
        </div>
        <div class="rounded-4 shadow inventory overflow-hidden">
            <div class="rounded-top-4 inventory-green p-4"></div>
            <div class="p-4 cart-dash">
                <span class="Inventory-title">موجودی کیف پول شما</span>
                <p class="my-3">
                    <span class="fw-bold fs-4">
                        <?php
                        $wallet = do_shortcode( '[fsww_balance]');
                        $wallet = str_replace( 'woocommerce-Price-currencySymbol', 'woocommerce-Price-currencySymbol d-none', $wallet );
                        echo $wallet;
                        ?>
                    </span>
                    <span class="text-gray">تومان</span>
                </p>
                <div
                    class=" d-flex flex-column flex-lg-row align-items-lg-center">
                    <button
                        class=" Inventory-increase Inventory-btn">
                        <a href="<?php echo esc_url(get_bloginfo('url')); ?>/make-a-deposit/">
                            افزایش موجودی
                        </a>
                    </button>
                    <?php if (isset($add_money)) { ?>
                        <button
                            class="btn-white Inventory-btn border bg-transparent mt-2">
                            <a href="#"
                               class="d-flex align-items-center justify-content-center justify-content-lg-between">
                                <span>نمایش جزئیات</span>
                                <img src="../img/Arrow_left.svg" alt>
                            </a>
                        </button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5">
        <h3 class="your-order">سفارش&zwnj;های شما</h3>
        <div class="d-lg-flex justify-content-between mt-4">
            <ul class="filter-orders">
                <li>
                    <a class="d-flex filter-button active" href="#order-list-user" data-filter="all">
                        <i class="squere me-2"></i>
                        <span>همه</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex filter-button" href="#order-list-user" data-filter="completed">
                        <i class="squere me-2"></i>
                        <span>تحویل داده شده</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex filter-button" href="#order-list-user" data-filter="processing">
                        <i class="squere me-2"></i>
                        <span>در حال انجام</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex filter-button" href="#order-list-user" data-filter="on-hold">
                        <i class="squere me-2"></i>
                        <span>لغو شده</span>
                    </a>
                </li>
            </ul>

        </div>
        <div id="order-list-user">
            <?php
            $customer_orders = wc_get_orders(array(
                'customer' => $current_user->ID,
            ));

            // Loop through and display order details.
            foreach ($customer_orders as $order) {
                $order_id = $order->get_id();
                $order_status = $order->get_status();
                $order_date = $order->get_date_created()->date_i18n('d M Y');
                ?>
                <div id="order-<?php echo esc_attr($order_id); ?>"
                     class="filter-item <?php echo esc_attr($order_status); ?>">
                    <div class="border rounded-3 my-4 p-3 d-lg-flex justify-content-between align-items-center">
                        <div>
                            <div class="d-flex flex-wrap">
                                <?php
                                $order_items = wc_get_order($order_id);

                                foreach ($order_items->get_items() as $item_id => $item) {
                                    echo '<div class="border rounded-3 p-3 me-2">';

                                    $product_id = $item->get_product_id();
                                    if ( wc_get_product($product_id) ){
                                        $product_name = $item->get_name();
                                        $quantity = $item->get_quantity();
                                        $subtotal = $item->get_subtotal();

                                        if ( has_post_thumbnail( $product_id ) ){
                                            $product = wc_get_product($product_id);
                                            $thumbnail = $product->get_image(array(64, 64));
                                            echo $thumbnail;
                                        }
                                    }

                                    echo '</div>';
                                }

                                ?>
                            </div>
                            <div class="d-flex my-3">
                                <div><p class="fw-bold order-id m-0">سفارش #<?php echo esc_attr($order_id); ?></p></div>
                                <div class="d-flex align-items-center mx-2">
                                    <div>
                                        <img class="me-1"
                                             src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/Time_duotone.svg')); ?>"
                                             alt="icon">
                                    </div>
                                    <div>
                                        <span class="text-gray order-time"><?php echo $order_date; ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $persian_status = '';

                            if ($order_status == 'on-hold') {
                                $persian_status = 'لغو شده';
                            } elseif ($order_status == 'completed') {
                                $persian_status = 'تحویل داده شده';
                            } elseif ($order_status == 'processing') {
                                $persian_status = 'در حال انجام';
                            }
                            ?>
                            <div class="bg-txt-green d-inline-block font-smaller"><?php echo $persian_status; ?></div>
                        </div>
                        <div class="action">
                            <?php $o_url = add_query_arg( 'order', esc_attr($order_id), esc_url(get_bloginfo('url')).'/my-account/view-order' ); ?>
                            <a class="btn d-inline-block font-smaller bg-transparent border rounded-3 mt-3"
                               href="<?php echo $o_url; ?>">
                                <span>مشخصات</span>
                                <img class="icon"
                                     src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/Expand_left.svg')); ?>"
                                     alt="icon">
                            </a>
                        </div>
                    </div>
                </div>
                <?php

            }
            ?>
        </div>

    </div>
</main>