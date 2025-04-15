<?php get_header(); ?>

<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package vertuka
 */

get_header();
$title = esc_html(get_the_title());
$url = esc_url(get_the_permalink());

?>
<main id="primary" class="site-main vertuka-archive">

    <!-- Archive page-heading [start] -->
    <div class="page-heading">
        <div class="d-flex">
            <div class="right-circle">
                <div class="shape"></div>
            </div>

            <div class="flex-grow-1 w-100 text-box">
                <div class="breadcrumb-box">
                    <ul class="d-flex">
                        <li><a href="<?php echo esc_url(get_bloginfo('url')); ?>">خانه</a></li>
                        <li><span><?php the_title(); ?></span></li>
                    </ul>
                    <h1 class="page-title"><span><?php the_title(); ?></span></h1>
                </div>
            </div>

            <div class="left-circle">
                <div class="shape"></div>
            </div>
        </div>
    </div>
    <!-- Archive page-heading [end] -->

    <div class="contact-us-wrapper">
        <div class="container">
            <div class="contact-us-box">
                <div class="row">
                    <div class="col-lg-6 col-12 contact-method-box ps-0 pe-lg-5">
                        <div class="inner-box">
                            <div class="method">
                                <div class="d-flex">
                                    <div class="me-2"><img src="<?php echo get_theme_file_uri('assets/images/phone_duotone.svg') ?>" alt="icon"></div>
                                    <div>
                                        <h2 class="mb-1">شماره تماس</h2>
                                        <div class="m-0">
                                            <a href="tel:+982191090003" class="d-flex standard-hover text-black">
                                                <div class="me-1"><strong class="font-weight-700">۰۰۰۳</strong></div>
                                                <div class="me-1"><strong class="font-weight-700">۹۱۰۹</strong></div>
                                                <div class="me-1"><span>-</span></div>
                                                <div class="me-1"><strong class="font-weight-700">۰۲۱</strong></div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="method">
                                <div class="d-flex">
                                    <div class="me-2"><img src="<?php echo get_theme_file_uri('assets/images/pin_alt_duotone.svg') ?>" alt="icon"></div>
                                    <div>
                                        <h2 class="mb-1">آدرس دفتر</h2>
                                        <p class="m-0">
                                            تهران، شهرک گلستان، بلوار گلها، پلاک ۴۳.۳
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="method">
                                <div class="d-flex">
                                    <div class="me-2"><img src="<?php echo get_theme_file_uri('assets/images/message_duotone.svg') ?>" alt="icon"></div>
                                    <div>
                                        <h2 class="mb-1">پست الکترونیکی</h2>
                                        <p class="m-0">
                                            <a class="standard-hover text-black" href="mailto:info@vertuka.com">info@vertuka.com</a>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-12">
                        <div class="inner-box contact-us-form"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</main>


<?php get_footer(); ?>