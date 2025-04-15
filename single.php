<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package vertuka
 */

get_header();

?>
<style>
    #img01 {
        margin: 0 !important;
        top: 0px !important;
    }

    .col-lg-4.col-md-12.blog-aside.d-none.d-lg-block {
        position: absolute;
        left: 7%;
        width: 27%;
    }

    /* استایل‌های کلی */
    .custom-gallery-post-shortcode {
        width: 92%;
        align-content: center;
    }

    .content-wrapper .content-box .content {
        overflow-x: auto;
    }

    table {
        table-layout: fixed;
    }

    th,
    td {
        text-align: center;
        min-width: 180px !important;
    }

    /* استایل‌های دسکتاپ */
    @media only screen and (min-width: 600px) {

        .next-button,
        .prev-button {
            top: 42% !important;
        }

        .MJ-prev-button,
        .MJ-next-button {
            padding: 0px !important;
            align-content: center !important;
        }

        .product-page .product-image-gallery .gallery img {
            max-height: 70px;
            max-width: 110px;
        }

        /* .owl-item {
            margin-left: -30px !important;
        } */

        .product-page .product-image-gallery .full-screen a {
            width: 60px !important;
            height: 60px !important;
            padding-top: 32% !important;
        }
    }

    /* استایل‌ها برای صفحه نمایش کوچک */
    @media only screen and (max-width: 600px) {
        .modal-caption-container {
            padding: 10px 20px 0px 15px;
        }

        .modal-caption {
            font-size: 15px;
            line-height: 1.3em;
        }

        /* .owl-item {
            width: 65px !important;
            margin-left: -1px !important;
        } */

        .MJ-prev-button {
            width: 55px;
            height: 55px;
            border-radius: 15px 0px 0px 15px;
            padding: 0px 12px 0px 0px;
            top: 45%;
            margin-top: 0px !important;
            /* typo fixed from !imporatnt */
            align-content: center !important;
        }

        .MJ-next-button {
            width: 55px;
            height: 55px;
            border-radius: 0px 15px 15px 0px;
            padding: 0px 0px 0px 12px;
            top: 45%;
            margin-top: 0px !important;
            /* typo fixed from !imporatnt */
            align-content: center !important;
        }

        .product-page .product-image-gallery .full-screen a {
            width: 54px;
            height: 30px;
            padding-top: 0%;
        }

        .icon.fullscreen {
            width: 18px;
            height: 18px;
        }

        .custom-gallery-post-shortcode {
            width: 80% !important;
        }

        .prev-button,
        .next-button {
            width: 33px;
            height: 40px;
            position: absolute;
            text-align: center;
            padding: 0px 0px 3px 0px !important;
            top: 40%;
            margin-top: 0px !important;
            z-index: 99;
            background-color: #eee;
            align-content: center;
        }

        .prev-button {
            right: 3px;
            border-radius: 15px 0px 0px 15px;
        }

        .next-button {
            left: 3px;
            border-radius: 0px 15px 15px 0px;
        }

        .icon {
            width: 20px !important;
            height: 20px !important;
        }

        #vertuka-main-product-image>.gallery-image-post {
            border-radius: 15px 15px 0px 0px !important;
        }

        .product-page .product-image-gallery .image-box {
            padding: 0px;
        }

        .image-box.bg-white.position-relative>.p-3 {
            border-radius: 15px 15px 0px 0px !important;
            padding: 0px !important;
            border: 3px solid rgba(234, 234, 234, 0.8);
        }

        .product-page .product-image-gallery .gallery {
            border-radius: 0px 0px 15px 15px;
            position: relative;
            bottom: 0px;
            left: 0px;
            right: 0px;
        }

        .product-page .product-image-gallery .gallery img {
            max-height: 45px;
            max-width: 65px;
        }
    }
</style>

<script>
    if (window.innerWidth <= 520) {
        document.getElementById("img01").style.maxWidth = "70%";
        document.getElementById("img01").style.top = "36%";
    }
</script>

<div class="single-blog-wrapper">
    <div class="container-fluid">
        <div class="page-heading">
            <div class="justify-content-between">
                <div>
                    <div class="flex-grow-1 w-100 text-box">
                        <div class="breadcrumb-box mj-horizontal-scroll">
                            <ul class="mj-horizontal-scroll">
                                <li><a href="<?php echo esc_url(get_bloginfo('url')); ?>">خانه</a></li>
                                <li><a href="/blog">وبلاگ</a></li>
                                <?php
                                $categories = get_categories(array(
                                    'orderby' => 'name',
                                    'order'   => 'ASC'
                                ));

                                foreach ($categories as $category) {
                                    echo '<li>';
                                    if ($category->name != '') {
                                        $category_link = sprintf(
                                            '<a href="%1$s" alt="%2$s">%3$s</a>',
                                            esc_url(get_category_link($category->term_id)),
                                            esc_attr(sprintf(__('View all posts in %s', 'textdomain'), $category->name)),
                                            esc_html($category->name)
                                        );
                                        echo sprintf($category_link);
                                    }
                                    echo '</li>';
                                }
                                ?>
                                <li><span><?php the_title(); ?></span></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- <div>
					<div class="d-flex">
						<div class="comment-number d-flex">
							<div>2.5K</div>
							<div class="icon-box"><i class="icon comment"></i></div>
						</div>
					</div>
				</div> -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-md-12 content-wrapper">
                <div class="thumbnail-box">
                    <?php $thumbnail_url = get_the_post_thumbnail_url(get_the_ID()); ?>
                    <img class="thumbnail" src="<?php echo $thumbnail_url; ?>" alt="<?php the_title(); ?>">
                </div>

                <div class="content-box">
                    <div class="post-meta-data-box px-32 pt-3 pb-2">
                        <div class="tag-box">
                            <?php
                            $post_tags = wp_get_post_tags(get_the_ID());

                            if (!empty($post_tags)) {
                                echo '<div class="post-tags">';
                                echo 'Tags: ';
                                foreach ($post_tags as $tag) {
                                    $tag_link = get_tag_link($tag->term_id);
                                    echo '<a href="' . esc_url($tag_link) . '">' . esc_html($tag->name) . '</a> ';
                                }
                                echo '</div>';
                            }
                            ?>
                        </div>
                        <div class="title-box">
                            <h1><?php the_title(); ?></h1>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="author-box">
                                <div class="d-flex">
                                    <div class="avatar-box">
                                        <?php
                                        $author_id = get_the_author_meta('ID');
                                        echo get_avatar($author_id, 96);
                                        ?>
                                    </div>
                                    <div class="author-detail">
                                        <div>
                                            <h6 class="name"><?php vertuka_posted_by(); ?></h6>
                                        </div>
                                        <div class="time"><?php echo get_the_date('Y M d') ?></div>
                                    </div>
                                </div>
                            </div>

                            <div class="info-box">
                                <div class="d-flex">
                                    <div class="study-time-box">
                                        <div class="icon-box"><img src="" alt=""></div>
                                        <div><span></span></div>
                                    </div>

                                    <div class="publish-time-box">
                                        <div class="icon-box"><img src="" alt=""></div>
                                        <div><span></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content">
                        <?php the_content(); ?>
                    </div>



                    <div id="vertuka-product-comment" class="w-100 mb-5 mb-3 md-5 mx-0">
                        <div class="comment-wrapper-header">
                            <div class="header-wrapper mb-3">
                                <div class="d-block d-lg-flex justify-content-between">
                                    <div class="d-flex pt-2 justify-content-between justify-content-lg-end">
                                        <div class="me-4">
                                            <h3 class="comment-title-product">نظرات کاربران</h3>
                                        </div>
                                        <div>
                                            <p class="comment-count-product m-0">
                                                <span>تعداد کامنت‌ها: </span>
                                                <span class="numb">
                                                    <?php echo vertuka_the_persian_number(get_comments_number(get_the_ID())); ?>
                                                </span>
                                            </p>
                                        </div>
                                    </div>

                                    <!-- <div class="my-3 my-lg-0">
								<?php
                                $comment_url = get_the_permalink() . '/?comment_sort=asc';
                                $comment_label = esc_html__('جدیدترین', 'vertuka');
                                if (isset($_GET['comment_sort']) && esc_attr($_GET['comment_sort']) == 'asc') {
                                    $comment_url = get_the_permalink() . '/?comment_sort=desc';
                                    $comment_label = esc_html__('قدیمی ترین', 'vertuka');
                                }
                                ?>
								<a class="button secondary d-block d-lg-inline-block" href="<?php echo esc_url($comment_url); ?>">
									<span><?php echo $comment_label; ?></span>
									<i class="icon left-arrow"></i>
								</a>
							</div> -->
                                </div>
                            </div>
                        </div>
                        <div class="m-0 p-0">
                            <div class="col-12 col-lg-5">
                                <div class="comment-inner-box">
                                    <?php
                                    // Check if comments are open or we have at least one comment, then display the comment form
                                    if (comments_open() || get_comments_number()) {
                                        if (is_user_logged_in()) {
                                            comment_form();
                                        } else {
                                    ?>
                                            <span>برای درج نظر وارد حساب کاربری شوید.</span>
                                            <a href="#" id="mj_login_link" class="link-success">ورود به حساب کاربری</a>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="col-12 col-lg-7 mt-4 mt-lg-3 px-0">
                                <div class="vertuka-comment-list">
                                    <div class="review-box p-0 m-0">
                                        <?php
                                        $comment_list_args = array(
                                            'short_ping'  => true, // Display pingbacks/trackbacks differently
                                            'avatar_size' => 50,   // Set the size of avatars
                                        );

                                        // Display the comments with custom arguments
                                        $args = array(
                                            'post_type' => 'post',
                                            'post_id' => get_the_ID()
                                        );
                                        $comments = get_comments($args);
                                        $mj_commets = array();
                                        foreach ($comments as $com) {
                                            if ($com->comment_approved ==  1) {
                                                $mj_commets[] = $com;
                                            }
                                        }

                                        $all_comments = wp_list_comments(
                                            array(
                                                'callback' => 'woocommerce_comments',
                                                'echo'              => false,
                                            ),
                                            $comments
                                        );

                                        if (!is_null($all_comments)) {
                                            echo $all_comments;
                                        } else {
                                        ?>
                                            <div class="text-center pt-4">
                                                <img class="img-fluid" src="<?php echo esc_url(get_theme_file_uri('assets/images/empty-comment.png')) ?>" alt="empty comment">
                                            </div>
                                        <?php

                                        }


                                        ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 blog-aside d-none d-lg-block">
                <div class="inner-box">
                    <div class="widget related-links">
                        <div class="title-box">
                            <h3 class="title">لینک های مرتبط</h3>
                        </div>
                        <div>
                            <ul>
                                <?php
                                // WP_Query arguments
                                $args = array(
                                    'posts_per_page'         => '3',
                                    'ignore_sticky_posts'    => false,
                                );

                                // The Query
                                $related_links = new WP_Query($args);

                                // The Loop
                                if ($related_links->have_posts()) {
                                    while ($related_links->have_posts()) {
                                        $related_links->the_post();
                                ?>
                                        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                <?php
                                    }
                                }

                                // Restore original Post Data
                                wp_reset_postdata();
                                ?>

                            </ul>
                        </div>
                    </div>

                    <div class="widget related-articles">
                        <div class="title-box">
                            <h3 class="title">مقالات مرتبط</h3>
                        </div>
                        <div>
                            <ul class="p-0 m-0">
                                <?php
                                // WP_Query arguments
                                $args = array(
                                    'posts_per_page'         => '3',
                                    'ignore_sticky_posts'    => false,
                                );

                                // The Query
                                $related_links = new WP_Query($args);

                                // The Loop
                                if ($related_links->have_posts()) {
                                    while ($related_links->have_posts()) {
                                        $related_links->the_post();
                                        $thumbnail_url = get_the_post_thumbnail_url(get_the_ID());
                                ?>
                                        <li class="d-flex mb-4">
                                            <div class="img-box me-2"><img src="<?php echo $thumbnail_url ?>" alt="<?php the_title(); ?>"></div>
                                            <div>
                                                <div>
                                                    <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                                </div>
                                                <!-- <div><span class="brand"><?php echo get_bloginfo('name'); ?></span></div> -->
                                            </div>
                                        </li>
                                <?php
                                    }
                                }

                                // Restore original Post Data
                                wp_reset_postdata();
                                ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- MJ most be login to add comment -->
        <?php
        if (!is_user_logged_in()) {
        ?>
            <script>
                jQuery(document).ready(function() {
                    jQuery("#commentform").on('submit', function(event) {
                        event.preventDefault();

                        jQuery('.page-checkout-wrapper').css('position', 'relative').css('z-index', '-1');
                        jQuery('.progressbar-box').css('z-index', '-1');
                        jQuery('.warning-login.logins').removeClass('d-none');

                    });
                });

                jQuery(document).ready(function() {
                    jQuery("#mj_login_link").on('click', function(event) {
                        event.preventDefault();
                        jQuery(".price-box").addClass('d-none');

                        jQuery('.page-checkout-wrapper').css('position', 'relative').css('z-index', '-1');
                        jQuery('.progressbar-box').css('z-index', '-1');
                        jQuery('.warning-login.logins').removeClass('d-none');

                    });
                    // MJ
                    jQuery(".remove-item").on('click', function(event) {
                        event.preventDefault();
                        jQuery(".price-box").removeClass('d-none');
                        jQuery('.warning-login.logins').addClass('d-none');
                    });
                });
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
                                        console.log(res);
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
                                            $('.warning-login .login-box-modal .content-box .text').html('کد پیامک شده را وارد نمایید: ' + phone + ' <a href="#"> ویرایش شماره </a>');

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
                    font-size: 11px;
                    font-weight: 400;
                    line-height: 55px;
                }

                .med-rp-counter>.tiles>span,
                .med-rp-counter>.labels>span {
                    width: 32px !important;
                    color: #1F9A17 !important;
                    font-size: 17px !important;
                    font-weight: 700 !important;
                    line-height: 22px !important;
                }

                .med-rp-counter>.labels>span.seprator {
                    width: auto !important;
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
        }

        ?>

        <div class="warning-login logins d-none">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-6 col-md-9 col-12 mx-auto">
                        <div class="login-box-modal">
                            <div class="m-4">
                                <div class="remove remove-item">
                                    <i class="icon close m-0"></i>
                                </div>
                            </div>

                            <div class="header-box text-center">
                                <img src="<?php echo esc_url(get_theme_file_uri('assets/images/mobile-in-hand.png')); ?>" alt="mobile">
                            </div>
                            <div class="content-box">
                                <p class="text">شماره موبایلتان را برای ورود یا ثبت‌نام وارد کنید</p>
                                <p class="med-error d-none"></p>
                                <div><?php echo do_shortcode('[registerpress-login-form id="1112"]'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        get_footer();
