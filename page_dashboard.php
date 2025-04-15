<?php /* Template Name: صفحه داشبورد */ ?>
<?php
if (!is_user_logged_in()) {
    $login_url = add_query_arg('message', 'login-please', esc_url(get_bloginfo('url') . '/login'));
    wp_redirect($login_url);
    exit();
}
get_header();

$url = get_permalink();
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$slug = str_replace(home_url(), "", $url);

// MJ
// temp redirect to orders and IF it has product on cart redirect to cart
if ($slug == '/my-account/') {

    if (count(WC()->cart->get_cart()) && $_SERVER['HTTP_REFERER'] == esc_url(get_bloginfo('url')) . '/member-authenticate/') {
        wp_redirect('/cart/');
        exit;
    }

    if (count(WC()->cart->get_cart()) && isset($_COOKIE['MAIN_REFERER'])) {
        unset($_COOKIE['MAIN_REFERER']);
        setcookie('MAIN_REFERER', '', time() - 3600, '/');

        wp_redirect('https://vertuka.com/checkout/');
        exit;
    }
    wp_redirect('/my-account/orders/');
    exit;
}
// end MJ
?>
<div class="dashboard-container">

    <div id="navbarSearch" class="collapse py-3">
        <div id="topbar-search-box" class="border-box">
            <form method="get" action="<?php echo esc_url(get_bloginfo('url')); ?>" class="d-block text-center">
                <div class="position-relative d-inline-block mx-auto text-center">
                    <input class="search-input" type="text" placeholder="جستجو بین محصولات" name="s">
                    <input class="search-input-btn" type="submit" value="">
                </div>
            </form>
        </div>
    </div>

    <div class="row p-0 m-0">
        <div class="col-xl-3 col-lg-4 d-lg-block menu d-none d-lg-block">
            <div class="logo-box">
                <a class="d-block text-center" href="<?php echo esc_url(get_bloginfo('url')); ?>">
                    <img src="<?php vertuka_show_image('assets/images/logo.svg') ?>" alt="<?php echo esc_html(get_bloginfo('name')); ?>" class="img-logo">
                </a>
            </div>

            <div class="menu-items">
                <a class="standard-hover d-flex mb-1 <?php if ($slug == '/my-account/' || $slug == '/my-account') { ?>align-items-center orders-menu<?php } ?>" href="<?php echo esc_url(get_bloginfo('url')); ?>">
                    <img src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/darhboard_alt2.svg')); ?>" alt="icon">
                    <span class="mx-2">بازگشت به فروشگاه</span>
                </a>

                <a class="standard-hover d-flex my-1 <?php if ($slug == '/my-account/orders/' || $slug == '/my-account/orders') { ?>align-items-center orders-menu<?php } ?>" href="<?php echo esc_url(get_bloginfo('url')); ?>/my-account/orders/">
                    <img src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/cart3.svg')); ?>" alt="icon">
                    <span class="mt-1 text-gray mx-2">سفارش&zwnj;ها</span>
                </a>

                <?php if (isset($support) && $support) { ?>
                    <a class="standard-hover d-flex my-1 <?php if ($support) { ?>align-items-center orders-menu<?php } ?>">
                        <img src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/Headphones_fill.svg')); ?>" alt="icon">
                        <span class="mt-1 mx-2 text-gray ">پشتیبانی</span>
                    </a>
                <?php } ?>

                <a class="standard-hover d-flex my-1 <?php if ($slug == '/my-account/vertuka-account-detail/' || $slug == '/my-account/vertuka-account-detail') { ?>align-items-center orders-menu<?php } ?>" href="<?php echo esc_url(get_bloginfo('url')); ?>/my-account/vertuka-account-detail/">
                    <img src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/User.svg')); ?>" alt="icon">
                    <span class=" mt-1 mx-2 text-gray">اطلاعات کاربری</span>
                </a>

                <a class="standard-hover d-flex my-1 <?php if ($slug == '/my-account/bank/' || $slug == '/my-account/bank') { ?>align-items-center orders-menu<?php } ?>" href="<?php echo esc_url(get_bloginfo('url')); ?>/my-account/bank/">
                    <img src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/credit card.svg')); ?>" alt="icon">
                    <span class=" mt-1 mx-2 text-gray">اطلاعات بانکی</span>
                </a>

                <!-- <a class="standard-hover d-flex my-1 <?php if ($slug == '/my-account/wallet/' || $slug == '/my-account/wallet') { ?>align-items-center orders-menu<?php } ?>" href="<?php echo esc_url(get_bloginfo('url')); ?>/my-account/wallet/">
                    <img src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/credit card.svg')); ?>" alt="icon">
                    <span class="mt-1 mx-2 text-gray">کیف
                            پول</span>
                </a> -->

                <?php if (isset($support) && $support) { ?>
                    <a class="standard-hover d-flex my-1 <?php if ($support) { ?>align-items-center orders-menu<?php } ?>">
                        <img src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/Ring.svg')); ?>" alt="icon">
                        <span class="mt-1 mx-2 text-gray ">پیغام ها</span>
                    </a>
                <?php } ?>

                <?php if (isset($wishlist) && $wishlist) { ?>
                    <a class="standard-hover d-flex my-1 <?php if ($wishlist) { ?>align-items-center orders-menu<?php } ?>">
                        <img src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/star shape.svg')); ?>" alt="icon">
                        <span href class="mt-1 mx-2 text-gray ">مورد علاقه ها</span>
                    </a>
                <?php } ?>

                <a class="standard-hover d-flex my-1 <?php if ($slug == '/my-account/addresses/' || $slug == '/my-account/addresses') { ?>align-items-center orders-menu<?php } ?>" href="<?php echo esc_url(get_bloginfo('url')); ?>/my-account/addresses/">
                    <img src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/Vector6.svg')); ?>" alt="icon">
                    <span class="mt-1 mx-2 text-gray">آدرس ها</span>
                </a>

                <a class="standard-hover d-flex my-1 standard-hover" href="<?php echo wp_logout_url(home_url()); ?>">
                    <img src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/power.png')); ?>" alt="icon">
                    <span class="mt-1 mx-2 text-gray">خروج</span>
                </a>
            </div>
        </div>

        <div class="col-xl-9 col-lg-8 col-12">

            <div class="content">
                <header id="header">
                    <div class="d-flex justify-content-between align-content-center d-lg-none">
                        <div class="user-img-box">
                            <a href="<?php echo esc_url(get_bloginfo('url')); ?>" class="d-block">
                                <img class="logo" src="<?php vertuka_show_image('assets/images/logo.svg') ?>" alt="<?php echo esc_html(get_bloginfo('name')); ?>">
                            </a>
                        </div>
                        <div>
                            <div>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <button class="navbar-toggler ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                            </div>

                            <!--                            <div>-->
                            <!--                                <a id="mobile-search-toggler" href="#" class="box-cart-header py-0 px-2">-->
                            <!--                                    <img src="--><?php //echo esc_url(get_theme_file_uri('template-parts/dashboard/img/search.svg')); 
                                                                                    ?><!--" alt="icon">-->
                            <!--                                </a>-->
                            <!--                            </div>-->
                            <!---->
                            <!--                            <div class="ms-3">-->
                            <!--                                <a id="mobile-menu-toggler" href="#mobile-menu-header" class="box-cart-header py-0 px-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">-->
                            <!--                                    <img src="--><?php //echo esc_url(get_theme_file_uri('template-parts/dashboard/img/hamb-icon.svg')); 
                                                                                    ?><!--" alt="icon">-->
                            <!--                                </a>-->
                            <!--                            </div>-->
                        </div>
                    </div>
                    <div class="d-none d-lg-flex justify-content-lg-between align-items-lg-center mb-3">
                        <div class="d-block position-relative heading-form-input"></div>

                        <div class="d-flex align-items-lg-center justify-content-between">
                            <div class="me-3 pr-2 d-none d-xl-block">
                                <a href="<?php echo esc_url(get_bloginfo('url')); ?>/cart/" class="box-cart-header py-0 px-2">
                                    <img src="<?php echo esc_url(get_theme_file_uri('assets/icons/shopping/cart.svg')); ?>" alt="icon" class="natural-5">
                                </a>
                            </div>
                            <div class="d-flex align-items-center">
                                <a class="font-small user-nick-name standard-hover" href="<?php echo esc_url(get_bloginfo('url')); ?>/my-account/">
                                    <?php
                                    $current_user = wp_get_current_user();
                                    $user_id = $current_user->ID;
                                    $author_info = get_userdata($user_id);

                                    $author_nickname = $author_info->display_name;

                                    // MJ
                                    $first_name = get_user_meta($user_id, 'first_name', true);
                                    $last_name = get_user_meta($user_id, 'last_name', true);
                                    if (!empty($first_name) && !empty($last_name)) {
                                        echo ($first_name . " " . $last_name);
                                    } else {
                                        echo $author_nickname;
                                    }
                                    // end MJ
                                    // if ( $user_id ) {
                                    //     echo $author_nickname;
                                    // }
                                    ?>
                                </a>
                            </div>
                            <div class="user-img-box ms-3">
                                <?php
                                // $author_avatar = get_avatar(
                                //     $author_info->user_email,
                                //     '64',
                                //     '',
                                //     $author_nickname,
                                //     array( 'class' => 'person-logo' )
                                // );
                                // echo $author_avatar;
                                ?>
                                <img src="<?php vertuka_show_image('assets/images/avatar.svg'); ?>" alt="<?php $author_nickname ?>" width="40" height="40">
                            </div>
                        </div>
                    </div>
                </header>

                <div class="collapse navbar-collapse" id="navbarText">
                    <?php echo vertuka_mobile_navbar(); ?>
                </div>

                <div id="mobile-menu-header">
                    <div class="close-box text-end mb-3"><a class="close" href="#">X</a></div>
                    <div class="menu p-0">
                        <div class="logo-box">
                            <a class="d-block text-center" href="<?php echo esc_url(get_bloginfo('url')); ?>">
                                <img src="<?php vertuka_show_image('assets/images/logo.svg') ?>" alt="<?php echo esc_html(get_bloginfo('name')); ?>" class="img-logo">
                            </a>
                        </div>
                        <div class="menu-items">
                            <a class="standard-hover d-flex mb-1 <?php if ($slug == '/my-account/' || $slug == '/my-account') { ?>align-items-center orders-menu<?php } ?>" href="<?php echo esc_url(get_bloginfo('url')); ?>">
                                <img src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/darhboard_alt2.svg')); ?>" alt="icon">
                                <span class="mx-2">بازگشت به فروشگاه</span>
                            </a>

                            <a class="standard-hover d-flex my-1 <?php if ($slug == '/my-account/orders/' || $slug == '/my-account/orders') { ?>align-items-center orders-menu<?php } ?>" href="<?php echo esc_url(get_bloginfo('url')); ?>/my-account/orders/">
                                <img src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/cart3.svg')); ?>" alt="icon">
                                <span class="mt-1 text-gray mx-2">سفارش&zwnj;ها</span>
                            </a>

                            <?php if (isset($support) && $support) { ?>
                                <a class="standard-hover d-flex my-1 <?php if ($support) { ?>align-items-center orders-menu<?php } ?>">
                                    <img src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/Headphones_fill.svg')); ?>" alt="icon">
                                    <span class="mt-1 mx-2 text-gray ">پشتیبانی</span>
                                </a>
                            <?php } ?>

                            <a class="standard-hover d-flex my-1 <?php if ($slug == '/my-account/vertuka-account-detail/' || $slug == '/my-account/vertuka-account-detail') { ?>align-items-center orders-menu<?php } ?>" href="<?php echo esc_url(get_bloginfo('url')); ?>/my-account/vertuka-account-detail/">
                                <img src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/User.svg')); ?>" alt="icon">
                                <span class=" mt-1 mx-2 text-gray">اطلاعات کاربری</span>
                            </a>

                            <a class="standard-hover d-flex my-1 <?php if ($slug == '/my-account/bank/' || $slug == '/my-account/bank') { ?>align-items-center orders-menu<?php } ?>" href="<?php echo esc_url(get_bloginfo('url')); ?>/my-account/bank/">
                                <img src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/credit card.svg')); ?>" alt="icon">
                                <span class=" mt-1 mx-2 text-gray">اطلاعات بانکی</span>
                            </a>

                            <!-- <a class="standard-hover d-flex my-1 <?php if ($slug == '/my-account/wallet/' || $slug == '/my-account/wallet') { ?>align-items-center orders-menu<?php } ?>" href="<?php echo esc_url(get_bloginfo('url')); ?>/my-account/wallet/">
                                <img src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/credit card.svg')); ?>" alt="icon">
                                <span class="mt-1 mx-2 text-gray">کیف
                            پول</span>
                            </a> -->

                            <?php if (isset($support) && $support) { ?>
                                <a class="standard-hover d-flex my-1 <?php if ($support) { ?>align-items-center orders-menu<?php } ?>">
                                    <img src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/Ring.svg')); ?>" alt="icon">
                                    <span class="mt-1 mx-2 text-gray ">پیغام ها</span>
                                </a>
                            <?php } ?>

                            <?php if (isset($wishlist) && $wishlist) { ?>
                                <a class="standard-hover d-flex my-1 <?php if ($wishlist) { ?>align-items-center orders-menu<?php } ?>">
                                    <img src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/star shape.svg')); ?>" alt="icon">
                                    <span href class="mt-1 mx-2 text-gray ">مورد علاقه ها</span>
                                </a>
                            <?php } ?>

                            <a class="standard-hover d-flex my-1 <?php if ($slug == '/my-account/address/' || $slug == '/my-account/address') { ?>align-items-center orders-menu<?php } ?>" href="<?php echo esc_url(get_bloginfo('url')); ?>/my-account/addresses/">
                                <img src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/Vector6.svg')); ?>" alt="icon">
                                <span class="mt-1 mx-2 text-gray">آدرس ها</span>
                            </a>

                            <a class="standard-hover d-flex my-1 standard-hover" href="<?php echo wp_logout_url(home_url()); ?>">
                                <img src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/power.png')); ?>" alt="icon">
                                <span class="mt-1 mx-2 text-gray">خروج</span>
                            </a>
                        </div>
                    </div>
                </div>

                <?php
                if ($slug == '/my-account/' || $slug == '/my-account') {
                    get_template_part('template-parts/dashboard/template/dashboard');
                } elseif ($slug == '/my-account/orders/' || $slug == '/my-account/orders') {
                    get_template_part('template-parts/dashboard/template/orders');
                } elseif ($slug == '/my-account/vertuka-account-detail/' || $slug == '/my-account/vertuka-account-detail') {
                    get_template_part('template-parts/dashboard/template/user');
                } elseif ($slug == '/my-account/wallet/' || $slug == '/my-account/wallet') {
                    get_template_part('template-parts/dashboard/template/wallet');
                } else {

                    if (isset($_GET['order']) && is_numeric($_GET['order'])) {
                        get_template_part('template-parts/dashboard/template/order');
                    } else {
                ?>
                        <main>
                            <div class="my-3">
                                <a class="d-flex justify-content-between page-title-dashboard-box d-lg-none" id="sidebar-mobile-menu">
                                    <div class="d-flex">
                                        <div class="me-2"><img class="icon" src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/Vector6.svg')); ?>" alt="icon"></div>
                                        <div>
                                            <h1 class="page-title-dashboard mb-0">آدرس ها</h1>
                                        </div>
                                    </div>
                                    <div><img class="icon" src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/Expand_left.svg')); ?>" alt="icon"></div>
                                </a>
                            </div>

                            <?php
                            if ($slug != '/my-account/addresses/' && $slug != '/my-account/addresses' && $slug != '/my-account/bank/') {
                            ?>
                                <div class="d-lg-flex align-items-center my-3">
                                    <a href="<?php echo esc_url(get_bloginfo('url')); ?>/my-account/" class="btn return-to-orders d-flex justify-content-center align-content-center my-2 py-1 py-lg-2 px-lg-2">
                                        <img src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/right arrow.svg')); ?>" alt="icon">
                                        <span>بازگشت به حساب کاربری</span>
                                    </a>
                                </div>
                            <?PHP
                            }
                            ?>

                            <?php the_content(); ?>
                        </main>
                <?php
                    }
                }
                ?>

                <footer class="py-4 px-0 px-md-3">
                    <div class="px-0 py-4 py-md-2 d-block d-lg-flex justify-content-between flex-lg-row-reverse">
                        <div class="d-flex justify-content-between">
                            <div class="social-media-gp">
                                <ul class="social-media-gp justify-content-center justify-content-sm-start">
                                    <li><a href="https://www.instagram.com/vertuka_com/" target=”_blank”><i class="icon instagram"></i></a></li>
                                    <li><a href="https://www.linkedin.com/company/vertuka"><i class="icon linkedin"></i></a></li>
                                    <!-- <li><a href="#"><i class="icon youtube"></i></a></li>
								<li><a href="#"><i class="icon facebook"></i></a></li> -->
                                    <li class="mx-0"><a href="https://t.me/vertuka_com"><i class="icon telegram"></i></a></li>
                                </ul>
                            </div>

                            <div class="px-0 px-sm-1">
                                <a class="go-to-top" href="#header">
                                    <span>بازگشت به بالا</span>
                                    <img class="icon" src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/Vector 10.svg')); ?>" alt="آیکن بازگشت به بالا">
                                </a>
                            </div>
                        </div>

                        <div class="copy-right pt-2 mt-3 mt-lg-0">
                            <p class="copyright-text mb-0">
                                © تمامی حقوق محفوظ است.
                            </p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
