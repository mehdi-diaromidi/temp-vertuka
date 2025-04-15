<!-- header [Start]-->

<!-- <div style="background: #1F9A17 !important;">

    <p style="color: white; font-size: 14px;text-align:center; padding:10px">

    با توجه به تعطیلات نوروز، از ۲۹ اسفند تا ۴ فروردین قادر به‌پاسخ‌گویی تلفنی نخواهیم بود. سفارشاتی که در این بازه ثبت شوند از ۵ فروردین پردازش و ارسال می‌شوند.

    </p>

</div> -->

<header class="header">

    <div id="navbarSearch" class="collapse py-3" >

        <div id="topbar-search-box" class="border-box">

            <form method="get" action="<?php echo esc_url( get_bloginfo( 'url' ) ); ?>" class="d-block text-center">

                <div class="position-relative d-inline-block mx-auto text-center">

                    <input class="search-input" type="text" placeholder="جستجو بین محصولات" name="s">

                    <input class="search-input-btn" type="submit" value="">

                </div>

            </form>

        </div>

    </div>

    <!-- Topbar header [Start]-->

    <div class="topbar-container">

        <div>

            <nav class="navbar navbar-expand-lg navbar-light bg-white d-block d-lg-none">

                <div class="container-fluid">



                    <div>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">

                            <span class="navbar-toggler-icon"></span>

                        </button>



                        <button class="navbar-toggler ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false" aria-label="Toggle navigation">

                            <span class="navbar-toggler-icon"></span>

                        </button>

                    </div>



                    <a class="navbar-brand" href="<?php echo avertuka_url_getter('main'); ?>">

                        <img class="logo" src="<?php vertuka_show_image('assets/images/logo.svg') ?>" alt="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>">

                    </a>



                    <div class="collapse navbar-collapse" id="navbarText">

                        <?php echo vertuka_mobile_navbar(); ?>



                        <?php if ( is_user_logged_in() ){ ?>

                            <div class="d-block d-md-flex">

                                <div class="mx-0 me-md-3 mb-3 mb-md-0">

                                    <a class="button secondary d-block w-100" href="<?php echo esc_url( get_bloginfo('url') ); ?>/my-account/">

                                        <i class="icon user"></i>

                                        <span class="">پروفایل کاربری</span>

                                    </a>

                                </div>

                            </div>



                        <?php }else{ ?>

                            <div class="d-block d-md-flex">

                                <div class="mx-0 me-md-3 mb-3 mb-md-0">

                                    <a class="button secondary d-block w-100" href="<?php echo esc_url( get_bloginfo('url') ); ?>/login/">

                                        <i class="icon user"></i>

                                        <span class="">ورود به پنل کاربری</span>

                                    </a>

                                </div>



                                <div class="pe-1">

                                    <a class="button bg-success text-white d-block w-100" href="<?php echo esc_url( get_bloginfo('url') ); ?>/register/">

                                        <i class="icon user white"></i>

                                        <span class="">ثبت نام</span>

                                    </a>

                                </div>

                            </div>

                        <?php } ?>

                    </div>

                </div>

            </nav>

        </div>



        <div class="container-fluid d-none d-lg-block">

            <div class="d-flex justify-content-between">

                <div class="logo-box"><a href="<?php echo avertuka_url_getter('main'); ?>"><img class="logo" src="<?php vertuka_show_image('assets/images/logo.svg') ?>" alt="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>"></a></div>

                <div>

                    <div class="d-flex">

                        <div id="topbar-search-box" class="position-relative border-box d-none d-md-block">

                            <form method="get" action="<?php echo esc_url( get_bloginfo( 'url' ) ); ?>">

                                <input class="search-input" type="text" placeholder="جستجو بین محصولات" name="s">

                                <input class="search-input-btn" type="submit" value="">

                            </form>

                        </div>







                        <?php if ( is_user_logged_in() ){ ?>

                            <div class="mr-12">

                                <a class="button secondary" href="<?php echo esc_url( get_bloginfo('url') ); ?>/my-account/">

                                    <i class="icon user d-xl-inline d-lg-none"></i>

                                    <span class="">پروفایل کاربری</span>

                                </a>

                            </div>

                        <?php }else{ ?>

                            <div class="mr-12">

                                <a class="button secondary" href="<?php echo esc_url( get_bloginfo('url') ); ?>/login/">

                                    <i class="icon user d-xl-inline d-lg-none"></i>

                                    <span class="">ورود به پنل کاربری</span>

                                </a>

                            </div>



                            <div class="mr-12">

                                <a class="button bg-success text-white" href="<?php echo esc_url( get_bloginfo('url') ); ?>/register/">

                                    <i class="icon user white d-xl-inline d-lg-none"></i>

                                    <span class="">ثبت نام</span>

                                </a>

                            </div>

                        <?php } ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Topbar header [End]-->



    <!-- Main Header [Start]-->

    <div class="main-header-container">

        <div class="container-fluid">

            <div class="main-header">

                <div class="menu-box">

                    <?php echo vertuka_main_navbar(); ?>

                </div>

                <div class="action-button">

                    <div class="cart position-relative">

                        <a class="cart-counter" href="<?php echo avertuka_url_getter('cart'); ?>">

                            <div><i class="icon natural-5 cart"></i></div>

                            <?php

                            // Check if WooCommerce is active

                            if (class_exists('WooCommerce')) {

                                // Get the cart object

                                $cart = WC()->cart;

                                // Get the total number of items in the cart

                                $cart_item_count = $cart->get_cart_contents_count();



                                // Display the cart item count

                                if ($cart_item_count > 0) {

                                    echo '<div class="count"><span>'.vertuka_the_persian_number($cart_item_count).'</span></div>';

                                }else {

                                    echo '<div class="count"><span>'.vertuka_the_persian_number(0).'</span></div>';

                                }

                            }

                            ?>





                        </a>



                        <?php if ($cart_item_count > 0) { ?>

                        <div class="cart-details">

                            <div class="d-flex justify-content-between mb-4">

                                <div class="d-flex">

                                    <div class="me-2"><h3 class="title mb-0">سبد خرید</h3></div>

                                    <div>

                                        <span class="product-count"><?php echo vertuka_the_persian_number($cart_item_count); ?></span>

                                        <span class="product-count">کالا</span>

                                    </div>

                                </div>



                                <div>

                                    <div class="remove-all-box">

                                        <a class="remove-all-link" href="<?php echo wc_get_cart_url(); ?>?prowc_empty_cart=yes">

                                            <i class="icon trash"></i>

                                            <span>حذف محصولات سبد خرید</span>

                                        </a>

                                    </div>

                                </div>

                            </div>

                            <?php get_template_part('template-parts/header/cart-excerpt'); ?>

                            <hr>

                            <div class="cart-details-footer">

                                <div class="d-flex justify-content-between">

                                    <div class="total-price">

                                        <div class="label">مبلغ قابل پرداخت</div>

                                        <div class="price">

                                            <?php echo vertuka_persian_number( $cart_total = WC()->cart->get_cart_total() ); ?>

                                        </div>

                                    </div>

                                    

                                    <div>

                                        <a href="<?php echo esc_url( get_bloginfo( 'url' ) ); ?>/cart" class="d-block checkout">تسویه حساب</a>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <?php } ?>



                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Main Header [End]-->

</header>

<!-- MJ Mehran Jafari -->

<!-- header [End]-->



