<?php /* Template Name: سبد خرید*/ ?>
<?php

unset($_COOKIE['MAIN_REFERER']);
setcookie('MAIN_REFERER', '', time() - 3600, '/');


get_header();

global $post;
$page_slug = $post->post_name;
?>
<div class="progressbar-box d-none d-lg-block position-relative">
    <ul class="progressbar">
        <li class="item active">
            <div class="square"></div>
            <div class="text">سبد خرید</div>
        </li>

        <li class="item flex-grow-1">
            <div class="square"></div>
            <div class="text">ارسال و تحویل کالا</div>
        </li>

        <li class="item">
            <div class="square"></div>
            <div class="text">پرداخت</div>
        </li>
    </ul>
</div>

<div id="cart-wrapper" class="container-fluid">

    <?php
    echo '<div class="mj-notices-wrapper">';
    wc_print_notices();
    echo '</div>';
    ?>

    <div class="d-block d-lg-flex">
        <div class="cart-box">

            <div class="cart-heading">
                <div class="d-flex justify-content-between">
                    <div class="d-flex">
                        <div class="icon-box"><i class="trash-2"></i></div>
                        <div class="title">
                            <h1>سبد خرید</h1>
                        </div>
                    </div>

                    <div class="d-none d-md-block">
                        <div class="remove-all-box">
                            <a class="remove-all-link" href="<?php echo wc_get_cart_url(); ?>?prowc_empty_cart=yes">
                                <i class="icon trash"></i>
                                <span>حذف محصولات سبد خرید</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cart-content">
                <?php the_content(); ?>
            </div>

        </div>

        <div class="express-cart-price-box">
            <?php
            /**
             * Cart collaterals hook.
             *
             * @hooked woocommerce_cross_sell_display
             * @hooked woocommerce_cart_totals - 10
             */
            do_action('woocommerce_cart_collaterals');
            ?>
        </div>
    </div>
</div>

<!-- Feature of shopping from us [start] -->
<div class="shop-features">
    <div class="container-fluid">
        <div class="inner-box">
            <div class="row">
                <div class="col-lg-3 mb-4 mb-lg-0">
                    <div class="d-flex">
                        <div class="icon-box"><img src="<?php vertuka_show_image('assets/images/headphone.svg'); ?>" alt="icon"></div>
                        <div class="text-box">
                            <h3>پشتیبانی تلفنی</h3>
                            <div class="d-flex">
                                <span>
                                    تماس با:
                                </span>
                                <div class="d-flex ms-2">
                                    <div class="me-1"><span><?php echo vertuka_the_persian_number('0003'); ?></span></div>
                                    <div class="me-1"><span><?php echo vertuka_the_persian_number('9109'); ?></span></div>
                                    <div class="me-1">-</div>
                                    <div><span><?php echo vertuka_the_persian_number('021'); ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 mb-4 mb-lg-0">
                    <div class="d-flex">
                        <div class="icon-box"><img src="<?php vertuka_show_image('assets/images/7-day.svg'); ?>" alt="icon"></div>
                        <div class="text-box">
                            <h3>فرصت 7 روزه بازگشت کالا</h3>
                            <p>ضمانت بازگشت کالا تا 7 روز</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 mb-4 mb-lg-0">
                    <div class="d-flex">
                        <div class="icon-box"><img src="<?php vertuka_show_image('assets/images/Approve.svg'); ?>" alt="icon"></div>
                        <div class="text-box">
                            <h3>تضمین کیفیت کالا</h3>
                            <p>خرید بهترین کالای موجود</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 mb-4 mb-lg-0">
                    <div class="d-flex">
                        <div class="icon-box"><img src="<?php vertuka_show_image('assets/images/credit-card.svg'); ?>" alt="icon"></div>
                        <div class="text-box">
                            <h3>پرداخت امن از درگاه بانکی</h3>
                            <p>امنیت در خریدهای آنلاین</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Feature of shopping from us [End] -->
<?php
get_footer();
?>