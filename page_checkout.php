<?php /* Template Name: مراحل سفارش و پرداخت*/ ?>
<?php


unset($_COOKIE['MAIN_REFERER']);
setcookie('MAIN_REFERER', '', time() - 3600, '/');
// if (count(WC()->cart->get_cart()) && isset( $_COOKIE['MAIN_REFERER'] )) {
//     // setcookie('MAIN_REFERER', null, strtotime('-1 day'));
//     wp_redirect('https://vertuka.com/login');
//     exit;
// }

date_default_timezone_set('Asia/Tehran');

get_header();

global $post;
$page_slug = $post->post_name;

if (!is_user_logged_in()) {
?>
    <script>
        // wait to load everything
        jQuery("document").ready(function() {
            jQuery("#mjModal").css("display", "none");
        });


        (function($) {
            "use strict";
            jQuery(document).ready(function($) {
                $('.page-checkout-wrapper').css('position', 'relative').css('z-index', '-1');
                $('.progressbar-box').css('z-index', '-1');
                $('.warning-login.logins').removeClass('d-none');
            });
        })(jQuery);
    </script>

    <script>
        // Wait for the DOM to be ready
        (function($) {
            "use strict";
            jQuery(document).ready(function($) {

                var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

                $("#registerpress-form-id-1112").submit(function(e) {
                    registerpress_authenticate(e);
                });

                function registerpress_authenticate(e) {

                    // Prevent the default form submission
                    e.preventDefault();

                    // Get the value of the national_code input
                    var phone = $("#med-rp-phone-number").val();

                    // Perform AJAX request to save the national_code
                    if (phone.length == 11) {
                        $('.med-error').addClass('d-none');
                        $('.login-box-modal').css('filter', 'brightness(0.4)');
                        $.ajax({
                            type: "POST",
                            url: ajaxurl, // Assuming ajaxurl is defined in your WordPress environment
                            data: {
                                action: "registerpress_login_ajaxy",
                                phone: phone
                            },
                            success: function(response) {
                                var res = JSON.parse(response);
                                if (typeof res == "object") {

                                    let html = 'خطا';
                                    if (res[0] === 'too_many_attempt') {
                                        html = 'دفعات زیادی برای این شماره تلفن پیامک ارسال شده است. لطفا بعد از 2 دقیقه مجددا امتحان کنید.';
                                    }

                                    if (res[0] === 'user_not_found') {
                                        html = 'برای شماره وارد شده حساب کاربری یافت نشد.' + ' <a href="<?php echo avertuka_url_getter('main'); ?>/register/">ثبت نام</a>'
                                    }
                                    $('.med-error').removeClass('d-none');
                                    $('.login-box-modal').css('filter', 'brightness(1)');

                                    $('.login-box-modal .med-error').html(html);
                                } else {
                                    $('.med-rp-login-box > form').remove();
                                    $('.med-rp-login-box > .counter-box-wraper').remove();
                                    $('.login-box-modal').css('filter', 'brightness(1)');

                                    $('.med-rp-login-box').append(res);
                                    $('.warning-login .login-box-modal .content-box .text').html('کد پیامک شده را وارد نمایید: ' + phone + ' <a href="<?php echo avertuka_url_getter('main'); ?>/checkout/"> ویرایش شماره </a>');

                                    $('#resend-code').prop('disabled', true);
                                    setTimeout(function() {
                                        $('#resend-code').prop('disabled', false);
                                        $("#resend-code").css("background-color", "rgb(31, 154, 23)");
                                        $("#resend-code").css("color", "#F5F8FF");
                                    }, 120000);



                                    const inputFields = document.querySelectorAll('.med-authenticate-gp .med-input');

                                    inputFields.forEach((input, index) => {
                                        input.addEventListener('input', (event) => {
                                            const currentInput = event.target;

                                            if (currentInput.value.length === 1) {
                                                if (index < inputFields.length - 1) {
                                                    inputFields[index + 1].focus();

                                                } else {
                                                    // All inputs are filled, you can perform any action you want here
                                                }
                                            }
                                        });
                                    });

                                    var med_duration = 120;
                                    var target_date = new Date().getTime() + (1000 * (med_duration)); // set the countdown date
                                    // alerts 'Some string to translate'
                                    var days, hours, minutes, seconds; // variables for time units
                                    var countdown = document.getElementById("tiles"); // get tag element

                                    getCountdown();

                                    setInterval(function() {
                                        getCountdown();
                                    }, 1000);

                                    function getCountdown() {

                                        // find the amount of "seconds" between now and target
                                        var current_date = new Date().getTime();
                                        var seconds_left = (target_date - current_date) / 1000;

                                        days = pad(parseInt(seconds_left / 86400));
                                        seconds_left = seconds_left % 86400;

                                        hours = pad(parseInt(seconds_left / 3600));
                                        seconds_left = seconds_left % 3600;

                                        minutes = pad(parseInt(seconds_left / 60));
                                        seconds = pad(parseInt(seconds_left % 60));

                                        // format countdown string + set tag value
                                        countdown.innerHTML = "<span class='seconds'>" + seconds + "</span><span class='seprator'>:</span><span class='minutes'>" + minutes + "</span>";
                                    }

                                    function pad(n) {

                                        if (n < 0) {
                                            if ($('resend-code').length < 1) {
                                                $('.login-wrapper .med-form-container input[type="submit"]').addClass('d-none');
                                                $('.login-wrapper .med-form-container #resend-code').removeClass('d-none');
                                            }

                                            return '00';
                                        }
                                        return (n < 10 ? '0' : '') + n;

                                    }
                                }

                            },
                            error: function(error) {
                                $('.med-error').removeClass('d-none');
                                $('.login-box-modal').css('filter', 'brightness(1)');
                                let html = 'برای شماره وارد شده حساب کاربری یافت نشد.' + ' <a href="<?php echo avertuka_url_getter('main'); ?>/register/">ثبت نام</a>'
                                $('.login-box-modal .med-error').html(html);

                            }
                        });
                    } else {
                        $('.med-error').removeClass('d-none');
                        $('.login-box-modal .med-error').html();
                        let html = 'شماره وارد شده معتبر نیست.';

                        $('.login-box-modal .med-error').text(html);
                    }
                }

                $(document).on('submit', '#registerpress-form-id-1112-test', function(e) {
                    registerpress_authenticate(e);
                });


                $(".login-box-modal").on("click", '#med_registerpress_authenticate_button', function(e) {

                    // Prevent the default form submission
                    e.preventDefault();

                    // Get the value of the national_code input
                    var code1 = $("#user_athenticate_code_1").val();
                    var code2 = $("#user_athenticate_code_2").val();
                    var code3 = $("#user_athenticate_code_3").val();
                    var code4 = $("#user_athenticate_code_4").val();
                    var code5 = $("#user_athenticate_code_5").val();
                    var code = code1 + code2 + code3 + code4 + code5;
                    var phone = $("#user_login").val();

                    // Perform AJAX request to save the national_code
                    if (code.length == 5) {
                        $('.med-error ').addClass('d-none');
                        $('.login-box-modal').css('filter', 'brightness(0.4)');
                        $.ajax({
                            type: "POST",
                            url: ajaxurl, // Assuming ajaxurl is defined in your WordPress environment
                            data: {
                                action: "registerpress_authenticate_ajaxy",
                                code: code,
                                phone: phone
                            },
                            success: function(response) {
                                var res = JSON.parse(response);
                                $('.login-box-modal').css('filter', 'brightness(1)');
                                if (res === 'ok') {

                                    // MD - Save user data in local storage - Start
                                    var storedData = JSON.parse(localStorage.getItem('userData')) || [];

                                    // اضافه کردن مقدار جدید به آرایه
                                    storedData.push({
                                        phone: phone
                                    });

                                    // ذخیره مجدد در localStorage
                                    localStorage.setItem('userData', JSON.stringify(storedData));
                                    // MD - Save user data in local storage - End

                                    setTimeout(function() {
                                        location.reload();
                                    }, 1000);

                                } else {
                                    $('.med-error ').removeClass('d-none');
                                    if (res === 'Authenticate_not_ok') {
                                        $('.med-error ').text('کد وارد شده صحیح نمی باشد.');
                                    }

                                    if (res === 'time_not_ok') {
                                        $('.med-error ').text('زمان وارد کردن کد به اتمام رسیده');
                                        setTimeout(function() {
                                            location.reload();
                                        }, 4000);
                                    }

                                    if (res === 'access_not_ok' || res === 'user_not_found' || res === 'nothing') {
                                        $('.med-error ').text('دسترسی غیر مجاز');
                                        setTimeout(function() {
                                            location.reload();
                                        }, 4000);
                                    }
                                }

                            },
                            error: function(error) {
                                $('.med-error ').removeClass('d-none');
                                $('.med-error ').text('خطای سرور. در صورت مشاهده مجدد این خطا با پشتیبانی تماس بگیرید');
                                setTimeout(function() {
                                    location.reload();
                                }, 3000);

                            }
                        });
                    } else {

                        $('.med-error').removeClass('d-none');
                        $('.login-box-modal .med-error').html();
                        let html = 'کد وارد شده را بصورت کامل وارد نمایید';
                        $('.login-box-modal .med-error').text(html);

                    }
                });

            });


        })(jQuery);
    </script>

    <style>
        .remain-time {
            color: #000;
            font-size: 14px;
            font-weight: 400;
            line-height: 55px;
        }

        .med-rp-counter>.tiles>span,
        .med-rp-counter>.labels>span {
            width: 25px !important;
            color: #1F9A17 !important;
            font-size: 17px !important;
            font-weight: 700 !important;
            line-height: 22px !important;
        }

        .med-form-container {
            width: 100%;
        }

        #authenticateform {
            width: 375px;
            margin: 0 auto;
            max-width: 100%;
        }

        #resend-code {
            border-radius: 10px;
            background: #F0F0F0;
            padding: 8px 16px;
            color: #080808;
            font-size: 14px;
            font-weight: 800;
            line-height: 18px;
        }

        .med-rp-counter {
            width: auto !important;
            margin: 0;
        }

        .warning-login {
            background: rgba(0, 0, 0, 0.27);
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 999;
            padding-top: 10px;
        }

        .warning-login .login-box-modal {
            border-radius: 15px;
            background: #E8E8E8;
            overflow: hidden;
            width: 100%;
        }

        .warning-login .login-box-modal .title-box {
            background: #E8E8E8;
        }

        .warning-login .login-box-modal .content-box {
            background: #fff;
            padding: 36px 32px;
        }

        .warning-login .login-box-modal .content-box #med_registerpress_authenticate_button,
        .warning-login .login-box-modal .content-box #med_registerpress_login_button {
            color: #F5F8FF !important;
            text-align: center !important;
            font-size: 18px !important;
            font-weight: 500 !important;
            line-height: 23px !important;
            padding: 16px !important;
        }

        .warning-login .login-box-modal .content-box #med_registerpress_authenticate_button {
            background: #1F9A17 !important;
            border-radius: 15px !important;
        }

        .warning-login .login-box-modal .content-box .text {
            color: #080808;
            text-align: right;
            font-size: 16px;
            font-weight: 600;
            line-height: 21px;
        }

        .login-box-modal .med-authenticate-gp input[type="tel"],
        .login-box-modal .med-authenticate-gp input[type="number"],
        .login-box-modal .med-authenticate-gp input[type="text"] {
            display: inline-block !important;
            width: 56px !important;
            height: 56px;
            text-align: center;
            padding: 4px !important;
            border: 2px solid #ECECEC;
            color: #B3B3B3;
            font-size: 14px;
            font-weight: 500;
            margin: 0 6px;
            border-radius: 19px;
            background: #F0F0F0;
        }

        @media (max-width: 420px) {

            .login-box-modal .med-authenticate-gp input[type="tel"],
            .login-box-modal .med-authenticate-gp input[type="number"],
            .login-box-modal .med-authenticate-gp input[type="text"] {
                width: 45px !important;
                height: 45px;
                margin: 0 4px;
            }

            .remain-time {
                font-size: 13px !important;
            }
        }

        .login-box-modal .med-authenticate-gp input[type="tel"]:focus,
        .login-box-modal .med-authenticate-gp input[type="number"]:focus,
        .login-box-modal .med-authenticate-gp input[type="text"]:focus {
            border: 2px solid #1F9A17;
            background: #fff;
            outline: none;
        }
    </style>
    <?php
} else {
    $user_natioanl_code = get_user_meta(get_current_user_id(), 'national_code', true);
    if ($user_natioanl_code == "" || $user_natioanl_code == null) {

    ?>
        <script>
            (function($) {
                "use strict";
                jQuery(document).ready(function($) {
                    $('.page-checkout-wrapper.national-code').css('position', 'relative').css('z-index', '-1');
                    $('.progressbar-box.national-code').css('z-index', '-1');
                    $('.warning-login.national-code').removeClass('d-none');
                });
            })(jQuery);
        </script>

        <script>
            // Wait for the DOM to be ready
            (function($) {
                "use strict";
                jQuery(document).ready(function($) {

                    var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

                    $("#med_registerpress_nationalcode_button").on("click", function(e) {

                        // Prevent the default form submission
                        e.preventDefault();

                        $('#alert-national-code').removeClass('d-none');
                        $('#alert-national-code .general').removeClass('d-none');
                        $('.formNationalCode').addClass('d-none');

                        // Get the value of the national_code input
                        var nationalCodeValue = $("#national_code").val();
                        var name = $("#f_name_user").val();
                        var family = $("#l_name_user").val();


                        // Perform AJAX request to save the national_code
                        if (nationalCodeValue.length == 10 && name != '' && family != '') {
                            $('#alert-national-code .f-error').addClass('d-none');
                            $.ajax({
                                type: "POST",
                                url: ajaxurl, // Assuming ajaxurl is defined in your WordPress environment
                                data: {
                                    action: "save_national_code",
                                    national_code: nationalCodeValue,
                                    name: name,
                                    family: family
                                },
                                success: function(response) {
                                    $('#alert-national-code .general').fadeOut(50);
                                    $('#alert-national-code .success').delay(1500).removeClass('d-none');

                                    setTimeout(function() {
                                        $('.warning-login.national-code').addClass('d-none');
                                    }, 2000);

                                    var storedData = JSON.parse(localStorage.getItem('userData')) || [];

                                    var newUser = {
                                        national_code: nationalCodeValue,
                                        name: name,
                                        family: family
                                    };
                                    storedData.push(newUser);

                                    localStorage.setItem('userData', JSON.stringify(storedData));
                                },
                                error: function(error) {
                                    $('#alert-national-code .general').fadeOut(50);
                                    $('.formNationalCode').removeClass('d-none');
                                    $('#alert-national-code .error').removeClass('d-none');
                                }
                            });
                        } else {
                            $('#alert-national-code').addClass('mt-3');
                            $('#alert-national-code .general').addClass('d-none');
                            $('#alert-national-code .f-error').removeClass('d-none');
                            $('.formNationalCode').removeClass('d-none');
                        }
                    });
                });
            })(jQuery);
        </script>
    <?php
    }
    ?>
    <style>
        .warning-login {
            background: rgba(0, 0, 0, 0.27);
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 999;
            padding-top: 98px;
        }

        .warning-login .login-box-modal {
            border-radius: 15px;
            background: #E8E8E8;
            overflow: hidden;
            width: 100%;
        }

        .warning-login .login-box-modal .title-box {
            background: #E8E8E8;
        }

        .warning-login .login-box-modal .content-box {
            background: #fff;
            padding: 36px 32px;
        }

        .warning-login .login-box-modal.add-address-lightbox .content-box {
            padding: 32px 24px;
        }

        .warning-login .login-box-modal .content-box #med_registerpress_nationalcode_button,
        .warning-login .login-box-modal .content-box #med_registerpress_authenticate_button,
        .warning-login .login-box-modal .content-box #med_registerpress_login_button {
            color: #F5F8FF !important;
            text-align: center !important;
            font-size: 18px !important;
            font-weight: 500 !important;
            line-height: 23px !important;
            padding: 16px !important;
            border-radius: 15px !important;
            border: none;
        }

        .warning-login .login-box-modal .content-box .text {
            color: #080808;
            text-align: right;
            font-size: 16px;
            font-weight: 600;
            line-height: 21px;
        }
    </style>
<?php
}

?>

<div class="warning-login logins d-none">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-9 col-12 mx-auto">
                <div class="login-box-modal">
                    <div class="m-4 d-none">
                        <div class="remove remove-item">
                            <i class="icon close m-0"></i>
                        </div>
                    </div>

                    <div class="header-box text-center">
                        <img src="<?php echo esc_url(get_theme_file_uri('assets/images/mobile-in-hand.png')); ?>" alt="mobile">
                    </div>
                    <div class="content-box">
                        <p class="text">لطفا شماره موبایلتان را برای ورود یا ثبت‌نام وارد کنید</p>
                        <p class="med-error d-none"></p>
                        <div><?php echo do_shortcode('[registerpress-login-form id="1112"]'); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="warning-login national-code d-none">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-9 col-12 mx-auto">
                <div class="login-box-modal">
                    <div class="header-box text-center">
                        <img src="<?php echo esc_url(get_theme_file_uri('assets/images/mobile-in-hand.png')); ?>" alt="mobile">
                    </div>
                    <div class="content-box">
                        <p class="text text-center">لطفا مشخصات خود را وارد کنید</p>
                        <div class="med-form-container">
                            <form class="formNationalCode" action="" method="post">
                                <div class="d-flex">
                                    <p class="form-group login-username me-1">
                                        <input type="text" name="f_name_user" id="f_name_user" class="form-control" placeholder="نام" required>
                                    </p>
                                    <p class="form-group login-username">
                                        <input type="text" name="l_name_user" id="l_name_user" class="form-control" placeholder="نام خانوادگی" required>
                                    </p>
                                </div>
                                <p class="form-group login-username">
                                    <input type="phone" name="national_code" id="national_code" class="form-control" placeholder="کد ملی" required>
                                </p>
                                <div>
                                    <button id="med_registerpress_nationalcode_button" class="w-100" style="background-color: #1f9a17">ثبت</button>
                                </div>
                            </form>
                            <!-- <div id="alert-national-code" class="alert bg-light d-none">
                                <p class="general text-muted m-0 d-none">در حال بررسی اطلاعات وارد شده...</p>
                                <p class="result_user_data m-0 d-none">میخواهم پیغام در اینجا نمایش داده شود</p>
                            </div> -->
                            <div id="alert-national-code" class="alert bg-light d-none">
                                <p class="general text-muted m-0 d-none">در حال بررسی اطلاعات وارد شده...</p>
                                <p class="success text-success m-0 d-none">اطلاعات شما با موفقیت ثبت گردید</p>
                                <p class="error text-danger m-0 d-none">کد ملی وارد شده با شماره تماس مطابقت ندارد!</p>
                                <!-- <p class="error-2-4 text-danger m-0 d-none">خطا در برقراری با سرویس</p> -->
                                <p class="f-error text-danger m-0 d-none">لطفا فرم را کامل کنید و کد ملی معتبر وارد کنید.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="warning-login add-address-lightbox pt-4 d-none">
    <div class="container">
        <div class="row">
            <div class="col-xl-7 col-lg-9 col-md-11 col-12 mx-auto">
                <div class="login-box-modal">
                    <div class="content-box">
                        <div class="mb-4 d-flex">
                            <div class="me-4">
                                <div class="remove remove-item">
                                    <i class="icon close m-0"></i>
                                </div>
                            </div>
                            <div>
                                <h3>افزودن آدرس</h3>
                            </div>
                        </div>
                        <div>
                            <h4>مشخصات تحویل‌گیرنده</h4>
                        </div>
                        <div><?php echo do_shortcode('[addresspress_add_address_form]'); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="progressbar-box d-none d-lg-block position-relative">
    <ul class="progressbar">
        <li class="item active prev">
            <div class="square"></div>
            <div class="text">سبد خرید</div>
        </li>

        <li class="item flex-grow-1 active <?php if (isset($_GET['key'])) {
                                                echo 'prev';
                                            } ?>">
            <div class="square"></div>
            <div class="text">ارسال و تحویل کالا</div>
        </li>

        <li class="item <?php if (isset($_GET['key'])) {
                            echo 'active';
                        } ?>">
            <div class="square"></div>
            <div class="text">پرداخت</div>
        </li>
    </ul>
</div>

<div class="container-fluid page-checkout-wrapper" style="margin-bottom: 100px;">

    <?php if (isset($_GET['key'])) {
    ?>
        <div class="d-block">
            <?php the_content(); ?>
        </div>
    <?php
    } else {
    ?>
        <div class="MJ-error">

        </div>
        <div class="d-block d-lg-flex">
            <div class="cart-box">

                <div class="cart-heading">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <div>
                                <div class="icon-box"><i class="trash-2"></i></div>
                            </div>

                            <div class="title">
                                <h2>شیوه ارسال و زمان تحویل</h2>
                            </div>
                        </div>

                        <div class="d-none d-md-block">
                            <div class="remove-all-box">
                                <a class="remove-all-link" href="/cart/?prowc_empty_cart=yes">
                                    <i class="icon trash"></i>
                                    <span>حذف محصولات سبد خرید</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cart-content">
                    <div class="py-2">
                        <div class="row">
                            <?php
                            do_action('woocommerce_review_order_before_cart_contents');

                            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                                $esc_thumbnail_url = esc_url(get_the_post_thumbnail_url($cart_item['product_id'], 'full'));

                                $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

                                if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) {
                            ?>
                                    <div class="col-4 col-md-3 col-lg-3 col-xl-2">
                                        <div class="inner-box-checkout p-2">
                                            <div class="img-box">
                                                <img class="img-fluid" src="<?php echo esc_url($esc_thumbnail_url); ?>" alt="<?php echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key)) . '&nbsp;'; ?>">

                                                <div class="count-item">
                                                    <span>
                                                        <?php echo apply_filters('woocommerce_checkout_cart_item_quantity', ' <span>' . sprintf('&times;&nbsp;%s', $cart_item['quantity']) . '</span>', $cart_item, $cart_item_key); ?>
                                                    </span>
                                                </div>

                                            </div>
                                            <!--                                        <div>-->
                                            <!--                                            <h2 class="title text-center mt-2">-->
                                            <!--                                                --><?php //echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key)) . '&nbsp;'; 
                                                                                                    ?>
                                            <!--                                                --><?php //echo wc_get_formatted_cart_item_data($cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                                                                    ?>
                                            <!--                                            </h2>-->
                                            <!--                                        </div>-->
                                        </div>
                                    </div>
                            <?php
                                }
                            }

                            do_action('woocommerce_review_order_after_cart_contents');
                            ?>
                        </div>
                    </div>




                    <div class="warning-login edit-address-lightbox pt-4 d-none">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-7 col-lg-9 col-md-11 col-12 mx-auto">
                                    <div class="login-box-modal">
                                        <div class="content-box">
                                            <div class="mb-4 d-flex">
                                                <div class="me-4">
                                                    <div class="remove remove-item">
                                                        <i class="icon close m-0"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h3>افزودن آدرس</h3>
                                                </div>
                                            </div>
                                            <div>
                                                <h4>مشخصات خریدار</h4>
                                            </div>
                                            <div><?php echo do_shortcode('[addresspress_edit_address_form]'); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div id="vertuka-address-delivery" class="choose-delivery-method">
                        <div class="title">
                            <h2>انتخاب آدرس</h2>
                        </div>
                        <div class="delivery-methods">
                            <?php echo do_shortcode('[addresspress_address_list]'); ?>
                            <div>
                                <a href="#vertuka-shipping-delivery-add-address" id="vertuka-shipping-delivery-add-address" class="add-new-address">افزودن آدرس جدید</a>
                            </div>
                        </div>
                    </div>
                    <?php

                    // MD - return correct shipping methods - START
                    // function bbloomer_get_all_shipping_zones()
                    // {
                    //     $data_store = WC_Data_Store::load('shipping-zone');
                    //     $raw_zones = $data_store->get_zones();
                    //     foreach ($raw_zones as $raw_zone) {
                    //         $zones[] = new WC_Shipping_Zone($raw_zone);
                    //     }
                    //     return $zones;
                    // }

                    // function filter_shipping_methods_by_location($input_location)
                    // {
                    //     $filtered_shipping_methods = [];

                    //     foreach (bbloomer_get_all_shipping_zones() as $zone) {
                    //         $zone_name = $zone->get_zone_name();
                    //         $zone_locations = $zone->get_zone_locations();
                    //         $zone_shipping_methods = $zone->get_shipping_methods();

                    //         $is_input_location_in_zone = false;
                    //         foreach ($zone_locations as $location) {
                    //             if ($input_location == 'تهران') {
                    //                 $is_input_location_in_zone = true;
                    //                 break;
                    //             }
                    //         }

                    //         foreach ($zone_shipping_methods as $method) {
                    //             if ($is_input_location_in_zone) {
                    //                 if (
                    //                     $method->id === 'free_shipping' ||
                    //                     ($method->id === 'flat_rate' && $method->title === 'ارسال توربو') ||
                    //                     ($method->id === 'flat_rate' && $method->title === 'ارسال عادی')
                    //                 ) {
                    //                     $filtered_shipping_methods[] = [
                    //                         'Zone Name' => $zone_name,
                    //                         'Method ID' => $method->id,
                    //                         'Title' => $method->title,
                    //                         'Enabled' => $method->enabled === 'yes' ? 'Yes' : 'No',
                    //                         'Cost' => isset($method->cost) ? $method->cost : 'Free',
                    //                         'Settings' => $method->settings,
                    //                     ];
                    //                 }
                    //             } else {
                    //                 if (
                    //                     $method->id === 'free_shipping' ||
                    //                     $method->id === 'post'
                    //                 ) {
                    //                     $filtered_shipping_methods[] = [
                    //                         'Zone Name' => $zone_name,
                    //                         'Method ID' => $method->id,
                    //                         'Title' => $method->title,
                    //                         'Enabled' => $method->enabled === 'yes' ? 'Yes' : 'No',
                    //                         'Cost' => isset($method->cost) ? $method->cost : 'Free',
                    //                         'Settings' => $method->settings,
                    //                     ];
                    //                 }
                    //             }
                    //         }
                    //     }

                    //     return $filtered_shipping_methods;
                    // }

                    // $input_location = "تهران";

                    // $filtered_methods = filter_shipping_methods_by_location($input_location);

                    // foreach ($filtered_methods as $method) {
                    //     echo "Zone Name: " . $method['Zone Name'] . "<br>";
                    //     echo "Method ID: " . $method['Method ID'] . "<br>";
                    //     echo "Title: " . $method['Title'] . "<br>";
                    //     echo "Enabled: " . $method['Enabled'] . "<br>";
                    //     echo "Cost: " . $method['Cost'] . "<br>";
                    //     echo "Settings: <pre>" . print_r($method['Settings'], true) . "</pre><br>";
                    //     echo "----------------------------------------<br>";
                    // }
                    // MD - return correct shipping methods - END
                    ?>


                    <?php
                    /**
                     * Renders the main container for shipping methods.
                     *
                     * @return string The HTML structure of the main container.
                     */
                    function render_shipping_methods_container()
                    {
                        return '<div id="vertuka-shipping-delivery" class="choose-delivery-method checkout-choose-delivery-method py-32 my-32">' .
                            render_shipping_title() .
                            render_delivery_methods() .
                            '</div>';
                    }

                    /**
                     * Renders the title section of the shipping methods.
                     *
                     * @return string The HTML structure of the title section.
                     */
                    function render_shipping_title()
                    {
                        return '<div class="title"><h2>انتخاب روش ارسال</h2></div>';
                    }

                    /**
                     * Renders the delivery methods section.
                     *
                     * @return string The HTML structure of the delivery methods.
                     */
                    function render_delivery_methods()
                    {
                        return '<div class="delivery-methods"><div><div class="d-flex">' .
                            render_post_method() .
                            render_standard_shipping_method() .
                            render_turbo_shipping_method() .
                            '</div></div></div>';
                    }

                    /**
                     * Renders the post shipping method.
                     *
                     * @return string The HTML structure of the post shipping method.
                     */
                    function render_post_method()
                    {
                        $cart_total = WC()->cart->get_cart_contents_total();
                        $free_shipping = ($cart_total >= 10000000) ? '<p><span class="fee">(رایگان)</span></p>' : '';

                        return '<div id="vertuka_shipping_method_0_post" class="method transport active">' .
                            '<div><div class="img-box-i d-flex justify-content-center"><img src="' . get_theme_file_uri('assets/images/post.png') . '" alt="post method"></div></div>' .
                            '<div style="margin-top: -3px;"><div class="d-lg-block justify-content-center">' .
                            '<p><span class="title"> پست</span></p>' .
                            $free_shipping .
                            '</div></div></div>';
                    }

                    /**
                     * Renders the standard shipping method.
                     *
                     * @return string The HTML structure of the standard shipping method.
                     */
                    function render_standard_shipping_method()
                    {
                        $cart_total = WC()->cart->get_cart_contents_total();
                        $free_shipping = ($cart_total >= 10000000) ? '<p><span class="fee">(رایگان)</span></p>' : '';

                        return '<div id="vertuka_shipping_method_0_aady" class="method transport vertuka_shipping_method_0_aady">' .
                            '<div><div class="img-box-i d-flex justify-content-center"><img src="' . get_theme_file_uri('assets/images/ady.png') . '" alt="post method"></div></div>' .
                            '<div><div class="d-lg-block justify-content-center">' .
                            '<p><span class="title"> ارسال عادی</span></p>' .
                            $free_shipping .
                            '</div></div></div>';
                    }
                    /**
                     * Renders the turbo shipping method if conditions are met.
                     *
                     * @return string The HTML structure of the turbo shipping method or an empty string if conditions are not met.
                     */
                    function render_turbo_shipping_method()
                    {
                        $current_date = time();
                        $is_holiday = IsHoliday(
                            convert2english(jdate("Y", $current_date)),
                            convert2english(jdate("m", $current_date)),
                            convert2english(jdate("d", $current_date))
                        );

                        if (!$is_holiday) {
                            $weekday = jgetdate($current_date)['weekday'];
                            $hour = date('H');

                            if (($weekday == 'پنجشنبه' && $hour < 14) || ($weekday != 'پنجشنبه' && $hour < 17)) {
                                return '<div id="vertuka_shipping_method_0_flat_rate5" class="method transport vertuka_shipping_method_0_flat_rate5" style="margin-left: 0;">' .
                                    '<div><div class="img-box-i d-flex justify-content-center"><img src="' . get_theme_file_uri('assets/images/torbo.png') . '" alt="post method"></div></div>' .
                                    '<div><div class="d-lg-block justify-content-center">' .
                                    '<p><span class="title"> ارسال توربو</span></p>' .
                                    '<p><span class="fee">(امروز تحویل بگیرید)</span></p>' .
                                    '</div></div></div>';
                            }
                        }

                        return '';
                    }

                    ?>

                    <!-- MD - print shipping methodes - START -->
                    <?php echo render_shipping_methods_container(); ?>
                    <!-- MD - print shipping methodes - END -->


                    <div id="vertuka-time-delivery" class="choose-delivery-method-timeline mb-4 d-none">
                        <div class="title">
                            <h2>انتخاب زمان دریافت</h2>
                        </div>
                        <div class="delivery-methods">
                            <div>
                                <div class="d-flex">
                                    <?php
                                    $current_date = time();
                                    $i = 0;

                                    while ($i < 3) {
                                        $current_date = strtotime('+1 day', $current_date);
                                        date_default_timezone_set('Asia/Tehran');

                                        if (!IsHoliday(convert2english(jdate("Y", $current_date)), convert2english(jdate("m", $current_date)), convert2english(jdate("d", $current_date)))) {
                                            $i++; ?>
                                            <div class="col-4 <?php if ($i == 1) {
                                                                    echo 'pl-2 ';
                                                                } ?>
                                                                        <?php if ($i == 2) {
                                                                            echo 'px-1 dactive';
                                                                        } ?>
                                                                        <?php if ($i == 3) {
                                                                            echo 'pr-2 ';
                                                                        } ?>
                                                                        "
                                                <?php if ($i == 3) {
                                                    echo 'style="margin-left: 0;"';
                                                } ?>>
                                                <div class="method" <?php if ((int)date('Hi') >= 1430 && $i == 1) {
                                                                        echo 'style="display: none;"';
                                                                    } ?>>
                                                    <div>
                                                        <div>
                                                            <p><?php echo vertuka_jalali_convert_week_name(date('D', $current_date)); ?></p>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <p class="m-0">
                                                            <span class="title">
                                                                <?php echo vertuka_the_persian_number(jdate('d F Y', $current_date)) ?>
                                                            </span>
                                                        </p>
                                                    </div>

                                                    <div class="mb-1">
                                                        <div class="ms-auto">
                                                            <p>
                                                                <input class="form-check-input MJ-selected-method-date-time" type="hidden" name="MJ-selected-method-date-time" value="ساعت 15-9-<?php echo vertuka_the_persian_number(jdate('y/m/d', $current_date)) ?>">
                                                                ساعت 15-9
                                                            </p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>

                                </div>


                                <div class="d-flex">
                                    <?php
                                    $current_date = time();
                                    $i = 0;

                                    while ($i < 3) {
                                        $current_date = strtotime('+1 day', $current_date);
                                        date_default_timezone_set('Asia/Tehran');

                                        if (!IsHoliday(convert2english(jdate("Y", $current_date)), convert2english(jdate("m", $current_date)), convert2english(jdate("d", $current_date)))) {
                                            // if (0) {
                                            $i++; ?>
                                            <div class="col-4 <?php if ($i == 1) {
                                                                    echo 'pl-2 ';
                                                                } ?>
                                                                        <?php if ($i == 2) {
                                                                            echo 'px-1 dactive';
                                                                        } ?>
                                                                        <?php if ($i == 3) {
                                                                            echo 'pr-2 ';
                                                                        } ?>
                                                                        "
                                                <?php if ($i == 3) {
                                                    echo 'style="margin-left: 0;"';
                                                } ?>>
                                                <div class="method">
                                                    <div>
                                                        <div>
                                                            <p><?php echo vertuka_jalali_convert_week_name(date('D', $current_date)); ?></p>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <p class="m-0">
                                                            <span class="title">
                                                                <?php echo vertuka_the_persian_number(jdate('d F Y', $current_date)) ?>
                                                            </span>
                                                        </p>
                                                    </div>

                                                    <div class="mb-1">
                                                        <div class="ms-auto">
                                                            <p>
                                                                <input class="form-check-input MJ-selected-method-date-time" type="hidden" name="MJ-selected-method-date-time" value="ساعت 21-15-<?php echo vertuka_the_persian_number(jdate('y/m/d', $current_date)) ?>">
                                                                ساعت 21-15
                                                            </p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>

                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- mj coupon -->
                    <div id="mj-coupon-container" class="mb-4 mj-checkout_coupon-form">
                        <a href="#" class="showcoupon text-black">
                            <div class="woocommerce-form-coupon-toggle-mj">
                                <i>
                                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 16H38V32C38 35.7712 38 37.6569 36.8284 38.8284C35.6569 40 33.7712 40 30 40H18C14.2288 40 12.3431 40 11.1716 38.8284C10 37.6569 10 35.7712 10 32V16Z" fill="#D8D8D8" />
                                        <path d="M24 16L23.5216 11.6942C23.2246 9.02178 20.9345 7 18.2456 7V7C15.3676 7 13 9.33309 13 12.2111V12.2111C13 13.9535 13.8708 15.5805 15.3205 16.547L19 19" stroke="#515151" stroke-width="2" stroke-linecap="round" />
                                        <path d="M24 16L24.4784 11.6942C24.7754 9.02178 27.0655 7 29.7544 7V7C32.6324 7 35 9.33309 35 12.2111V12.2111C35 13.9535 34.1292 15.5805 32.6795 16.547L29 19" stroke="#515151" stroke-width="2" stroke-linecap="round" />
                                        <rect x="8" y="16" width="32" height="6" rx="2" fill="#515151" />
                                        <path d="M24 22V30" stroke="#515151" stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                </i>
                                <span class="woocommerce-info-MJ">
                                    آیا کد تخفیف دارید؟
                                </span>
                            </div>
                        </a>

                        <form class="checkout_coupon woocommerce-form-coupon" method="post" style="display:none">
                            <div class="d-md-flex">
                                <div class="mobile-w-100 mt-1 mb-3"><input type="text" name="coupon_code" class="mj-coupon-input mobile-w-100" placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" id="coupon_code"></div>
                                <div class="mobile-w-100 m-1 text-center mt-1"><input type="submit" name="apply_coupon" class="button bg-success text-white box-shadow-none border-0" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>"></div>
                            </div>

                            <div class="clear"></div>
                        </form>
                    </div>


                    <div id="vertuka-order-type" class="choose-delivery-method pt-4">
                        <div class="title">
                            <h2>نوع خرید</h2>
                        </div>
                        <div class="option-to-buy">
                            <div class="vertuka-insurance-option">
                                <div class="d-flex">
                                    <div class="d-flex ml-12">
                                        <div>
                                            <p class="insurance-text" style="line-height: 40px;">خرید حقوقی</p>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="vertuka-checkbox"><span></span></div>
                                    </div>
                                </div>
                                <p class="mj-hoghoghy-force d-none"><?php
                                                                    if (
                                                                        get_user_meta(get_current_user_id(), 'company', true) != ''
                                                                        && get_user_meta(get_current_user_id(), 'economic_id', true) != ''
                                                                        && get_user_meta(get_current_user_id(), 'company_national_code', true) != ''
                                                                        && get_user_meta(get_current_user_id(), 'registration_id', true) != ''
                                                                        && get_user_meta(get_current_user_id(), 'company_address', true) != ''
                                                                    ) {
                                                                        echo 'no';
                                                                    } else {
                                                                        echo 'لطفا اطلاعات حقوقی خود را در <a href="/my-account/vertuka-account-detail/" style="color: red;text-decoration: underline;">پروفایل کاربری</a> تکمیل کنید.';
                                                                    }
                                                                    ?></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="express-cart-price-box">
                <?php the_content(); ?>
            </div>
        </div>
    <?php
    }
    ?>


</div>

<!-- MJ add popup -->
<!-- The Modal -->
<!-- <div id="mjModal" class="modal" style="display: block;"> -->
<!-- Modal content -->
<!-- <div class="modal-content d-flex"> -->
<!-- <p>در حال بروزرسانی ...</p> -->
<!-- </div> -->
<!-- </div> -->
<!-- MJ end popup -->

<style>
    .vertuka-thanks {
        margin-top: 72px;
    }

    .vertuka-thanks .title {
        margin-top: 16px;
    }

    .vertuka-thanks .title h1 {
        color: #000;
        text-align: center;
        font-size: 64px;
        font-weight: 900;
        line-height: 80px;
    }

    .vertuka-thanks .payment-info {
        margin-top: 48px;
    }

    .vertuka-thanks .payment-info ul {
        /* padding-right: 148px; */
    }

    .vertuka-thanks .payment-info ul li {
        margin-bottom: 20px;
    }

    .vertuka-thanks .payment-info ul li .title {
        color: #828282;
        text-align: right;
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
    }

    .vertuka-thanks .payment-info ul li .value {
        color: #003DCE;
        text-align: right;
        font-size: 18px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
    }

    .vertuka-thanks .payment-info .text {
        color: #000;
        text-align: center;
        font-size: 18px;
        font-style: normal;
        font-weight: 600;
        line-height: 32px;
    }

    .woocommerce-order>p:nth-child(2) {
        display: none;
    }

    .vertuka-order-details {}

    .vertuka-order-details .cart-box {
        padding: 32px;
        border-radius: 20px;
        border: 1px solid #E4E4E4;
        background: #FFF;
        width: 100% !important;
    }

    .vertuka-order-details .cart-box h3 {
        color: #6A6A6A;
        text-align: right;
        font-size: 16px;
        font-weight: 400;
        line-height: 21px;
        margin-bottom: 16px;
    }


    .woocommerce-Price-currencySymbol {
        margin-right: 5px;
    }
</style>
<script src="https://static.neshan.org/sdk/mapboxgl/v1.13.2/neshan-sdk/v1.0.8/index.js"></script>
<script>
    jQuery("document").ready(function() {
        jQuery(".showcoupon").ready(function() {
            jQuery(this).trigger("click");
        });

        if (!jQuery("#vertuka-address-delivery .delivery-methods .position-relative").length) {
            jQuery("#mjModal").css('display', 'none');
            jQuery(".express-cart-price-box #vertuka-shipping-method-price").css("display", "none");
        }
    });

    // MJ
    jQuery(".remove-item").on('click', function(event) {
        event.preventDefault();
        jQuery(".price-box").removeClass('d-none');
        jQuery('.warning-login.logins').addClass('d-none');
    });


    jQuery(document).ready(function() {
        setTimeout(function() {
            jQuery("#vertuka-address-delivery .active").click();

            var radioValue1 = jQuery("input[name='shipping_method[0]']:checked").val();
            if (radioValue1 == 'post') {
                jQuery("#vertuka_shipping_method_0_post").click();
            }
            if (radioValue1 == 'aady') {
                jQuery("#vertuka_shipping_method_0_aady").click();
            }
            if (radioValue1 == 'flat_rate:5') {
                jQuery("#vertuka_shipping_method_0_flat_rate5").click();
            }
        }, 3000);

    });
</script>


<?php
get_footer();
?>