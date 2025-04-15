<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package vertuka
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> style="margin-top: 0 !important;">

<head>
    <script>
        ! function(t, e, n) {
            t.yektanetAnalyticsObject = n, t[n] = t[n] || function() {
                t[n].q.push(arguments)
            }, t[n].q = t[n].q || [];
            var a = new Date,
                r = a.getFullYear().toString() + "0" + a.getMonth() + "0" + a.getDate() + "0" + a.getHours(),
                c = e.getElementsByTagName("script")[0],
                s = e.createElement("script");
            s.id = "ua-script-ERUH9KRM";
            s.dataset.analyticsobject = n;
            s.async = 1;
            s.type = "text/javascript";
            s.src = "https://cdn.yektanet.com/rg_woebegone/scripts_v3/ERUH9KRM/rg.complete.js?v=" + r, c.parentNode.insertBefore(s, c)
        }(window, document, "yektanet");
    </script>
    <script type="text/javascript" src="https://s1.mediaad.org/serve/59875/retargeting.js" async></script>
    <!-- Start WebMetric Analytics -->
    <!-- <script>
        (function(i, s, o, g, r, a, m) {
            i["_wmid"] = "149c8aaa-165c-4708-bb9f-7ea31a4b9900";
            i["wms"] = 1 * new Date();
            (a = s.createElement(o)), (m = s.getElementsByTagName(o)[0]);
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m);
            a.onload = function() {
                tracker = new Webmetric("149c8aaa-165c-4708-bb9f-7ea31a4b9900");
                tracker.init();
            };
        })(
            window,
            document,
            "script",
            "//cdn.jsdelivr.net/npm/webmetric-analytics/dist/webmetric.min.js"
        );
    </script> -->
    <!-- End WebMetric Analytics -->

    <!-- Meta tags -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="profile" href="<?php echo is_ssl() ? 'https' : 'http' ?>://gmpg.org/xfn/11">

    <?php
    if (!empty($_GET['yith_wcan'])) {
        echo '<link rel="canonical" href="https://vertuka.com' . explode('?', $_SERVER['REQUEST_URI'])[0] . '">';
    }
    ?>

    <?php wp_head(); ?>

    <!-- Matomo -->
    <script>
        var _paq = window._paq = window._paq || [];
        /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function() {
            var u = "//matomo.vertuka.com/";
            _paq.push(['setTrackerUrl', u + 'matomo.php']);
            _paq.push(['setSiteId', '1']);
            var d = document,
                g = d.createElement('script'),
                s = d.getElementsByTagName('script')[0];
            g.async = true;
            g.src = u + 'matomo.js';
            s.parentNode.insertBefore(g, s);
        })();
    </script>
    <!-- End Matomo Code -->
    <!-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get the preloader element
            const preloader = document.getElementById("preloader");
            // Find the slider element
            const sliderBox = document.querySelector('.owl-item');

            // Function to hide the preloader
            const hidePreloader = () => {
                preloader.classList.add("hidden");
            };

            if (sliderBox) {
                // Try to find all img elements within sliderBox
                hidePreloader();
            } else {
                // Fallback: if sliderBox is not found, hide the preloader when the window has fully loaded
                window.addEventListener("load", function() {
                    setTimeout(function() {
                        hidePreloader();
                    }, 500); // Delay before hiding the preloader
                });
            }
        });
    </script> -->
</head>

<body <?php body_class(); ?>>

    <!-- Google Tag Manager (noscript) -->
    <!-- End Google Tag Manager (noscript) -->

    <?php
    if (function_exists('wp_body_open')) {
        wp_body_open();
    }
    ?>
    <?php
    $class = '';
    if (is_page_template('page_login.php')) {
        $class = 'login-page';
    }

    if (is_singular()) {
        if (get_post_type(get_the_ID()) == 'product') {
            $class = 'product-page';
        }
    }
    ?>
    <!-- Wrapper [start] -->
    <div class="wrapper <?php echo $class; ?>">

        <?php if (!is_page_template('page_login.php') && !is_page_template('page_dashboard.php')) { ?>
            <header class="header">
                <div id="navbarSearch" class="collapse py-3" style="max-height: 81px !important;">
                    <div id="topbar-search-box" class="border-box">
                        <?php do_shortcode('[wc_ls_live_search]'); ?>

                    </div>
                </div>
                <!-- Topbar header [Start]-->
                <div class="topbar-container">
                    <!-- <div class="announcement">
                        سفارش‌های پستی‌ای که تا تاریخ
                        <span class="bold">10 تا 15 فروردین</span>
                        ثبت شوند در روز
                        <span class="bold">16 فروردین</span>
                        ارسال خواهند شد.
                    </div> -->
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
                                    <img class="logo" src="<?php vertuka_show_image('assets/images/logo.svg') ?>" alt="<?php echo esc_html(get_bloginfo('name')); ?>" width="170">
                                </a>

                                <div class="collapse navbar-collapse" id="navbarText">
                                    <?php echo vertuka_mobile_navbar(); ?>

                                    <?php if (is_user_logged_in()) { ?>
                                        <div class="d-block d-md-flex">
                                            <div class="mx-0 me-md-3 mb-3 mb-md-0">
                                                <a class="button secondary d-block w-100" href="/my-account/">
                                                    <i class="icon user"></i>
                                                    <span class="">پروفایل کاربری</span>
                                                </a>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="d-block d-md-flex">
                                            <div class="mx-0 me-md-3 mb-3 mb-md-0">
                                                <a class="button secondary d-block w-100" href="/login/">
                                                    <i class="icon user"></i>
                                                    <span class="">ورود به پنل کاربری</span>
                                                </a>
                                            </div>

                                            <div class="pe-1">
                                                <a class="button bg-success text-white d-block w-100" href="/register/">
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
                            <div class="logo-box"><a href="<?php echo avertuka_url_getter('main'); ?>"><img class="logo" src="<?php vertuka_show_image('assets/images/logo.svg') ?>" alt="<?php echo esc_html(get_bloginfo('name')); ?>"></a></div>
                            <div>
                                <div class="d-flex">
                                    <div id="topbar-search-box" class="position-relative border-box d-none d-md-block">
                                        <?php do_shortcode('[wc_ls_live_search]'); ?>
                                    </div>
                                    <!-- <div class="user-status-set" style="display: flex;"> -->
                                    <?php if (is_user_logged_in()) { ?>
                                        <div class="mr-12">
                                            <a class="button secondary" href="/my-account/">
                                                <span class="">پروفایل کاربری</span>
                                            </a>
                                        </div>
                                    <?php } else { ?>
                                        <div class="mr-12">
                                            <a class="button secondary" href="/login/">
                                                <span class="">ورود به پنل کاربری</span>
                                            </a>
                                        </div>

                                        <div class="mr-12">
                                            <a class="button bg-success text-white" href="/register/">
                                                <span class="">ثبت نام</span>
                                            </a>
                                        </div>
                                    <?php } ?>
                                    <!-- </div> -->
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
                                                    echo '<div class="count"><span>' . vertuka_the_persian_number($cart_item_count) . '</span></div>';
                                                } else {
                                                    echo '<div class="count"><span>' . vertuka_the_persian_number(0) . '</span></div>';
                                                }
                                            }
                                            ?>
                                        </a>
                                        <?php if ($cart_item_count > 0) { ?>
                                            <div class="cart-details">
                                                <div class="d-flex justify-content-between mb-4">
                                                    <div class="d-flex">
                                                        <div class="me-2">
                                                            <h3 class="title mb-0">سبد خرید</h3>
                                                        </div>
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
                                                                <?php echo vertuka_persian_number($cart_total = WC()->cart->get_cart_total()); ?>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <a href="/cart" class="d-block checkout">تسویه حساب</a>
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
            <!-- header [End]-->
            <!-- Footer [End] -->
        <?php } ?>
        <!-- Content [start] -->
        <div class="page-wrapper m-0 p-0">
            <div class="page-content">