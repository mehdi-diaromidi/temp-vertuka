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
$title = esc_html( get_the_title() );
$url = esc_url( get_the_permalink() );

?>
<main id="primary" class="site-main vertuka-archive">

    <!-- Archive page-heading [start] -->
    <!-- <div class="page-heading">
        <div class="w-100 text-center about-us-heading"><img class="w-100" src="<?php echo get_theme_file_uri('assets/images/italic-logo.svg'); ?>" alt="<?php echo  esc_html( get_bloginfo( 'name' ) )?>"></div>
    </div> -->
    <!-- Archive page-heading [end] -->

    <div class="about-us-wrapper">
        <div class="container-fluid">
            <div class="about-us-box">
                <div class="row px-2">
                    <div class="col-lg-12 col-12 text-box pe-0 pe-lg-4 pe-xl-5">
                        <h2 class="mb-4"><?php the_title(); ?></h2>
                        <div class="content-box text-justify">
                            <?php the_content(); ?>
                        </div>
                    </div>

                    <div class="col-lg-6 col-12 d-none">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="inner-item">
                                    <div class="img-box"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/calender.svg') ); ?>" alt="icon"></div>
                                    <div class="title-box"><h4 class="title">9 سال فعالیت</h4></div>
                                    <div class="content-box"><p class="content">اولین مارکت وردپرس و قالب آماده</p></div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="inner-item">
                                    <div class="img-box"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/user.png') ); ?>" alt="icon"></div>
                                    <div class="title-box"><h4 class="title">1 میلیون</h4></div>
                                    <div class="content-box"><p class="content">رضایت از خرید</p></div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="inner-item">
                                    <div class="img-box"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/code.png') ); ?>" alt="icon"></div>
                                    <div class="title-box"><h4 class="title">92200 تو‌سعه‌دهنده</h4></div>
                                    <div class="content-box"><p class="content">در زمینه کدنویسی و طراحی</p></div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="inner-item">
                                    <div class="img-box"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/basket.png') ); ?>" alt="icon"></div>
                                    <div class="title-box"><h4 class="title">95000 محصول</h4></div>
                                    <div class="content-box"><p class="content">وردپرس، جوملا و قالب خام</p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="our-teams-box d-none">
        <div class="container-fluid">
            <div class="our-teams">
                <div class="row">
                    <div class="col-12 subject">
                        <h3>Our Team</h3>
                        <h2>تیم ما</h2>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-12 p-3">
                        <div class="user-team p-32 bg-white">
                            <div class="img-box mb-4"><img src="<?php echo get_theme_file_uri('assets/images/team-user-7.png'); ?>" alt="user"></div>
                            <div class="title-box mb-3"><h2 class="m-0">محمود قانونی</h2></div>
                            <div class="descb-box"><p class="m-0">کارشناس کنترل کیفیت</p></div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-6 col-12 p-3">
                        <div class="user-team p-32 bg-white">
                            <div class="img-box mb-4"><img src="<?php echo get_theme_file_uri('assets/images/team-user-1.png'); ?>" alt="user"></div>
                            <div class="title-box mb-3"><h2 class="m-0">علی رضوانی کیا</h2></div>
                            <div class="descb-box"><p class="m-0">توسعه دهنده فرانت اند</p></div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-6 col-12 p-3">
                        <div class="user-team p-32 bg-white">
                            <div class="img-box mb-4"><img src="<?php echo get_theme_file_uri('assets/images/team-user-2.png'); ?>" alt="user"></div>
                            <div class="title-box mb-3"><h2 class="m-0">کیوان خسروی</h2></div>
                            <div class="descb-box"><p class="m-0">کارشناس کنترل کیفیت</p></div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-6 col-12 p-3">
                        <div class="user-team p-32 bg-white">
                            <div class="img-box mb-4"><img src="<?php echo get_theme_file_uri('assets/images/team-user-3.png'); ?>" alt="user"></div>
                            <div class="title-box mb-3"><h2 class="m-0">محسن ترکی</h2></div>
                            <div class="descb-box"><p class="m-0">کارشناس مارکتینگ</p></div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-6 col-12 p-3">
                        <div class="user-team p-32 bg-white">
                            <div class="img-box mb-4"><img src="<?php echo get_theme_file_uri('assets/images/team-user-4.png'); ?>" alt="user"></div>
                            <div class="title-box mb-3"><h2 class="m-0">محمود قانونی</h2></div>
                            <div class="descb-box"><p class="m-0">کارشناس کنترل کیفیت</p></div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-6 col-12 p-3">
                        <div class="user-team p-32 bg-white">
                            <div class="img-box mb-4"><img src="<?php echo get_theme_file_uri('assets/images/team-user-5.png'); ?>" alt="user"></div>
                            <div class="title-box mb-3"><h2 class="m-0">علی رضوانی کیا</h2></div>
                            <div class="descb-box"><p class="m-0">توسعه دهنده فرانت اند</p></div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-6 col-12 p-3">
                        <div class="user-team p-32 bg-white">
                            <div class="img-box mb-4"><img src="<?php echo get_theme_file_uri('assets/images/team-user-6.png'); ?>" alt="user"></div>
                            <div class="title-box mb-3"><h2 class="m-0">کیوان خسروی</h2></div>
                            <div class="descb-box"><p class="m-0">کارشناس کنترل کیفیت</p></div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-6 col-12 p-3">
                        <div class="user-team p-32 bg-white">
                            <div class="img-box mb-4"><img src="<?php echo get_theme_file_uri('assets/images/team-user-7.png'); ?>" alt="user"></div>
                            <div class="title-box mb-3"><h2 class="m-0">محسن ترکی</h2></div>
                            <div class="descb-box"><p class="m-0">کارشناس مارکتینگ</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="social-media-box d-none">
        <div class="container-fluid">
            <div class="w-100 inner-box">
                <h2>Active community</h2>
                <h3>جامعه کاربران فعال</h3>
                <div class="social-media-link-box">
                    <ul>
                        <li><a href="#"><i class="icon white linkedin m-0"></i></a></li>
                        <li><a href="#"><i class="icon white facebook m-0"></i></a></li>
                        <li><a href="#"><i class="icon white telegram m-0"></i></a></li>
                        <li><a class="px-3" href="#"><i class="icon white instagram m-0"></i><span class="me-2">@pluspro</span></a></li>
                        <li class="m-0"><a href="#"><i class="icon white youtube m-0"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</main>


<?php get_footer(); ?>
