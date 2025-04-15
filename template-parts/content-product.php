<?php
// die('test');
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;
/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

// if (post_password_required()) {
//     echo get_the_password_form(); // WPCS: XSS ok.
//     return;
// }

//get data
$esc_title = esc_html(get_the_title());
$product_id = get_the_ID();
$esc_thumbnail_url = esc_url(get_the_post_thumbnail_url($product_id, 'full'));



?>
<div class="show-more-to-buy d-block d-lg-none d-none">
    <i class="icon bottom-arrow my-0 mx-auto"></i>
</div>
<div class="mt-3">
    <div class="row">

        <div class="col-xl-8 col-lg-7 col-md-12 col-12 product-image-gallery pe-lg-3">
            <div class="row mb-4">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="image-box bg-white position-relative">
                        <div id="vertuka-main-product-image" class="product-image p-3">
                            <img class="no-lazy" src="<?php echo $esc_thumbnail_url; ?>" alt="<?php echo $esc_title; ?>">
                            <div class="next-button">
                                <i class="icon left-arrow-3 mx-auto mt-1"></i>
                            </div>

                            <div class="prev-button">
                                <i class="icon right-arrow mx-auto mt-1"></i>
                            </div>
                        </div>
                        <div class=" gallery d-flex justify-content-between flex-row-reverse " style="background:rgba(234, 234, 234,0.8)!important; ">
                            <div style="width: 85%;">
                                <div class="owl-theme owl-carousel pt-1">
                                    <?php
                                    $i = 1;
                                    $attachment_ids = $product->get_gallery_image_ids();
                                    if ($attachment_ids) {
                                        foreach ($attachment_ids as $attachment_id) {
                                            $image_link = wp_get_attachment_url($attachment_id);
                                            $image_title = get_the_title($attachment_id);

                                            echo '<div class="item" id="item-' . $i . '" ><a href="#vertuka-main-product-image" class="vertuka-product-thumbnail-gallery" title="' . $image_title . '">';
                                            // echo wp_get_attachment_image($attachment_id, 'full');
                                            echo '<img class="no-lazy" src="' . $image_link . '" alt="' . $image_title . '">';
                                            echo '</a></div>';

                                            $i++;
                                        }
                                    }
                                    ?>
                                    <div class="item" <?php echo 'id="item-' . $i . '"'; ?>>
                                        <a href="#" class="vertuka-product-thumbnail-gallery">
                                            <img src="<?php echo $esc_thumbnail_url; ?>" alt="<?php echo $esc_title; ?>">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="full-screen">
                                <div>
                                    <a id="MJ-pro-vertuka-expand" href="#MJ-pro-vertuka-image-modal"><i class="icon fullscreen"></i></a>
                                </div>

                                <div id="MJ-pro-vertuka-image-modal" class="MJ-pro-vertuka-image-modal">
                                    <div class="MJ-next-button">
                                        <i class="icon left-arrow-3 mx-auto mt-1" id="MJ-next-button-left"></i>
                                    </div>

                                    <span class="close">&times;</span>
                                    <img class="modal-content" id="img01" src="<?php echo $esc_thumbnail_url; ?>" alt="<?php echo $esc_title; ?>">
                                    <div class="caption"></div>

                                    <div class="MJ-prev-button">
                                        <i class="icon right-arrow mx-auto mt-1" id="MJ-prev-button-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 ps-lg-3">
                    <div class="action-buttons d-block d-lg-none my-3">
                        <ul>
                            <li><a target="_blank" href="<?php echo esc_url(get_bloginfo('url') . '/compare?item=' . get_the_ID()); ?>"><i class="icon exposure"></i></a></li>
                            <li class="position-relative">
                                <a class="vertuka-copy-mode" data-copy-mode="<?php the_permalink(); ?>">
                                    <i class="icon share"></i>
                                </a>
                                <div class="tooltip-copy mobile">لینک صفحه کپی شد!</div>
                            </li>
                            <!--                            <li><a href="#"><i class="icon star"></i></a></li>-->
                        </ul>
                    </div>
                    <div class="product-info">
                        <div>
                            <?php
                            $primary_category = get_the_terms(get_the_ID(), 'product_cat');
                            if ($primary_category && !is_wp_error($primary_category)) {
                                if ($primary_category[0]->slug == 'offers') {
                                    $category_name = $primary_category[1]->name;
                                    $category_link = get_term_link($primary_category[1]);
                                } else {
                                    $category_name = $primary_category[0]->name;
                                    $category_link = get_term_link($primary_category[0]);
                                }


                                echo '<a class="category mb-2 d-block" href="' . esc_url($category_link) . '">' . esc_html($category_name) . '</a>';
                            }
                            ?>

                        </div>
                        <div>
                            <h1 class="title"><?php the_title(); ?></h1>
                        </div>
                        <div>
                            <h2 class="sec-title"><?php echo get_post_meta(get_the_ID(), "vertuka-product-english-title-mb", true); ?></h2>
                        </div>
                        <div class="description">
                            <?php //the_excerpt(); 
                            ?>
                        </div>
                        <div class="tech-info">
                            <?php
                            echo get_post_meta(get_the_ID(), "vertuka-product-features-mb", true);
                            ?>
                            <ul class="mt-3">

                                <li>
                                    <a class="read-more text-black" href="#vertuka-product-technical-information">جزئیات فنی</a>
                                </li>
                            </ul>
                        </div>

                        <div class="py-2 bg-white mobile-option-to-buy">
                            <div class="buy-section box-shadow-none border-0">

                                <?php
                                if (method_exists($product, 'get_available_variations')) {
                                ?>
                                    <div class="option-to-buy">
                                        <div class="vertuka-color-option">

                                            <div class="row">
                                                <?php
                                                
                                                $vars = $product->get_available_variations();
                                                $available_color = array();
                                                $mj_temp_prices = array();
                                                foreach ($vars as $var) {
                                                    if ($var['is_in_stock']) {
                                                        foreach ($var['attributes'] as $color) {
                                                            $available_color[] = $color;
                                                            $mj_temp_prices[] = $var['display_price'];
                                                        }
                                                    }
                                                }
                                                // $lowest_price = min($mj_temp_prices);
                                                if (!empty($mj_temp_prices)) {
                                                    $lowest_price = min($mj_temp_prices);
                                                } else {
                                                    $lowest_price = false;
                                                }
                                                //
                                                sort($mj_temp_prices);
                                                foreach ($mj_temp_prices as $value) {
                                                    if (vertuka_diacount_calculator($product_id, $value)) {
                                                        $lowest_price = $value;
                                                        break;
                                                    }
                                                }
                                                //

                                                $mj_temp_min_price_slug = false;
                                                $mj_temp_min_price_slug_guarantee = false;
                                                foreach ($vars as $var) {

                                                    if ($lowest_price == $var['display_price']) {
                                                        $mj_temp_min_price_slug = $var['attributes']['attribute_pa_color'];
                                                        $mj_temp_min_price_slug_guarantee = $var['attributes']['attribute_pa_guarantee'];
                                                    }
                                                }


                                                $terms = wc_get_product_terms(
                                                    $product->get_id(),
                                                    'pa_color',
                                                    array(
                                                        'fields' => 'all',
                                                    )
                                                );
                                                $is_color_available = false;
                                                if (count($available_color)) {
                                                ?>
                                                    <h3>رنگ:</h3>
                                                    <?php
                                                }

                                                foreach ($terms as $term) {
                                                    if (in_array(esc_attr($term->slug), $available_color)) {
                                                        $color = vertuka_variable_color_getter($term->name);
                                                    ?>
                                                        <div class="col-4 col-lg-6 px-1 px-md-2 vertuka-enable-option vertuka-option-var">
                                                            <div id="<?php echo esc_attr($term->slug); ?>" class="color-option enable 1 <?php if ($mj_temp_min_price_slug == $term->slug) {
                                                                                                                                            echo 'active';
                                                                                                                                        } ?>">
                                                                <div class="d-flex">
                                                                    <div class="me-2">
                                                                        <div class="color" style="background-color: <?php echo $color; ?>;width: 25px;height: 25px;margin-top: 5px;"></div>
                                                                    </div>
                                                                    <div>
                                                                        <p class="text m-0 p-0" style="font-size: 12px;"><?php echo esc_html($term->name); ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                        $is_color_available = true;
                                                    } elseif (isset($change_mind)) {
                                                    ?>
                                                        <div class="col-4 col-lg-6 px-1 px-md-2 vertuka-option-var vertuka-option-var">
                                                            <div id="<?php echo esc_attr($term->slug); ?>" class="color-option disable">
                                                                <div class="d-flex">
                                                                    <div class="me-2">
                                                                        <div class="color" style="background-color: <?php echo $color; ?>"></div>
                                                                    </div>
                                                                    <div>
                                                                        <p class="text m-0 p-0"><?php echo esc_html($term->name); ?><span class="ms-2 text-10px text-muted">(ناموجود)</span></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                <?php
                                                    }
                                                }
                                                ?>

                                                <!-- /////////////////////////////////////// -->
                                                <div class="mj-guarantee col-12 col-lg-12 px-1 px-md-2 " id="mj-guarantee-mob">

                                                </div>
                                                <!-- /////////////////////////////////////// -->

                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="option-to-buy">
                                    <div class="vertuka-text-option">
                                        <ul class="m-0 p-0">

                                            <?php if (isset($remain)) { ?>
                                                <li class="d-flex">
                                                    <div><i class="icon dropbox"></i></div>
                                                    <div>
                                                        <p class="m-0">۱ عدد باقی مانده</p>
                                                    </div>
                                                </li>
                                            <?php } ?>

                                            <!-- <li class="d-flex">
                                                <div><i class="icon shield"></i></div>
                                                <div>
                                                    <p class="m-0">۱۸ ماه گارانتی شرکتی</p>
                                                </div>
                                            </li> -->

                                            <li class="d-flex mj_popup_7">
                                                <div><i class="icon process"></i></div>
                                                <div>
                                                    <p class="m-0">ضمانت ۷ روزه
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                                                        </svg>
                                                    </p>
                                                </div>
                                            </li>

                                            <li class="d-flex mj_popup_shipping">
                                                <div><i class="icon transport primary-4"></i></div>
                                                <div>
                                                    <p class="text-primary-4 m-0">ارسال توربو
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                                                        </svg>
                                                    </p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="quantity pt-3 pt-lg-0">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <p class="m-0 title">تعداد:</p>
                                        </div>

                                        <div>
                                            <div class="vertuka-q-input">
                                                <div class="increase">+</div>
                                                <div class="numb">1</div>
                                                <div class="decrease">-</div>
                                            </div>
                                            <input id="quantity" class="d-none" name="quantity" hidden="" type="number" value="1">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-100 mt-1">
                <div class="tabs-wrapper mb-3">
                    <div class="inner-box">
                        <ul class="pp-section-gp">
                            <?php if (has_excerpt() != '') { ?>
                                <li class="active"><a href="#vertuka-product-description">توضیحات محصول</a></li>
                                <li><a href="#vertuka-product-technical-information">مشخصات فنی</a></li>
                                <li><a href="#vertuka-product-comment">نظرات کاربران</a></li>
                            <?php } else { ?>
                                <li class="active"><a href="#vertuka-product-technical-information">مشخصات فنی</a></li>
                                <li><a href="#vertuka-product-comment">نظرات کاربران</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

                <?php if (has_excerpt() != '') { ?>
                    <div id="vertuka-product-description" class="about-product-section">
                        <div class="inner-box">
                            <div id="about-product-section-text" style="text-align: justify">
                                <?php the_excerpt(); ?>
                            </div>
                            <div class="text-center pt-1 pt-md-3 pt-lg-0">
                                <a class="vertuka-show-more" href="#vertuka-product-description">
                                    <span>ادامه مطلب</span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>


                <div id="vertuka-product-technical-information" class="technical-information about-tech-product-section mt-4">
                    <div class="inner-box bg-white br-16 p-32">
                        <div>
                            <h3 class="title">مشخصات فنی</h3>
                        </div>
                        <div id="about-tech-product-section-text">
                            <ul class="p-0 mt-4 mx-0 mb-0">

                                <?php
                                // die('test2');
                                $label_group = '';
                                $attributes_fixed_obj = array();
                                $attributes_fixed_array = array();
                                // var_dump(get_taxonomies());
                                foreach (get_taxonomies() as $taxonomy) {
                                    $label = get_taxonomy($taxonomy)->labels->singular_name;
                                    // var_dump(strstr($label, '--'));
                                    if (strstr($label, '--')) {
                                        $value = $product->get_attribute($taxonomy);
                                        // var_dump($taxonomy);
                                        if ($value) {
                                            //$label = get_taxonomy( $taxonomy )->labels->singular_name;
                                            if (!$label) {
                                                $label = vertuka_get_feature_lable($taxonomy);
                                            }
                                            $label_array = explode('--', $label);
                                            if ($label_array[0] !== $label_group) {
                                                //                                            echo '<h4 class="product-group-title">'.$label_array[0].'</h4>';
                                                $label_group = $label_array[0];
                                            }
                                            $attributes_fixed_obj[$label_array[0]][$label_array[1]] = vertuka_the_persian_number($value);
                                            $attributes_fixed_array[$label] = vertuka_the_persian_number($value);



                                            //                                        echo '<li>';
                                            //                                        echo '<span class="text-caption-2">' . $label_array[1] . ' :</span>';
                                            //                                        echo '<strong class="ms-1">'.vertuka_the_persian_number( $value ).'</strong>';
                                            //                                        echo '</li>';
                                        }
                                    }
                                }
                                //echo '--------------------';
                                // var_dump($attributes_fixed_obj);
                                function customSort($array, $priority)
                                {
                                    $sortedArray = array();

                                    foreach ($priority as $index => $feature) {
                                        if (isset($array[$feature])) {
                                            $sortedArray[$feature] = $array[$feature];
                                            unset($array[$feature]);
                                        }
                                    }

                                    // Append any remaining elements to the end of the sorted array
                                    $sortedArray += $array;

                                    return $sortedArray;
                                }

                                $priorityArray = [
                                    'شبکه--تکنولوژی شبکه',
                                    'معرفی--تاریخ معرفی',
                                    'بدنه--ابعاد',
                                    'بدنه--وزن',
                                    'بدنه--جنس بدنه',
                                    'بدنه--تعداد سیم‌کارت',
                                    'بدنه--استاندارد ضدآب بودن',
                                    'نمایشگر--نوع نمایشگر',
                                    'نمایشگر--اندازه نمایشگر',
                                    'نمایشگر--رزولوشن نمایشگر',
                                    'نمایشگر--فرکانس نمایشگر',
                                    'نمایشگر--تراکم پیکسلی',
                                    'نمایشگر--محافظ نمایشگر',
                                    'نمایشگر--ویژگی‌های نمایشگر',
                                    'سخت‌افزار و سیستم عامل--سیستم عامل',
                                    'سخت‌افزار و سیستم عامل--نسخه سیستم عامل در زمان عرضه',
                                    'سخت‌افزار و سیستم عامل--رابط کاربری',
                                    'سخت‌افزار و سیستم عامل--چیپست',
                                    'سخت‌افزار و سیستم عامل--CPU',
                                    'سخت‌افزار و سیستم عامل--پردازنده گرافیکی',
                                    'حافظه و رم--درگاه کارت حافظه',
                                    'حافظه و رم--حافظه داخلی',
                                    'حافظه و رم--رم',

                                    'صدا--جک ۳.۵ میلی‌متری',
                                    'صدا--مشخصات اسپیکر',
                                    'ارتباطات--WLAN',
                                    'ارتباطات--بلوتوث',
                                    'ارتباطات--موقعیت‌یابی',
                                    'ارتباطات--NFC',
                                    'ارتباطات--اینفرارد',
                                    'ارتباطات--رادیو',
                                    'ارتباطات--درگاه ارتباطی',
                                    'ارتباطات--قابلیت OTG',
                                    'حسگر و ویژگی‌ها--قابلیت تشخیص چهره',
                                    'حسگر و ویژگی‌ها--حسگر اثر انگشت',
                                    'حسگر و ویژگی‌ها--سایر حسگرها',
                                    'حسگر و ویژگی‌ها--سایر ویژگی‌ها',
                                    'باتری--نوع باتری',
                                    'باتری--ظرفیت باتری',
                                    'باتری--قابلیت شارژ سریع',
                                    'باتری--شارژ بی‌سیم',
                                    'باتری--توضیحات شارژ',

                                    //---------------------------------------------------------------------
                                    'معرفی--تاریخ معرفی',

                                    'مشخصات ظاهری و فیزیکی--نوع کاربری',
                                    'مشخصات ظاهری و فیزیکی--مناسب برای',
                                    'مشخصات ظاهری و فیزیکی--سایز',
                                    'مشخصات ظاهری و فیزیکی--جنس بدنه',
                                    'مشخصات ظاهری و فیزیکی--رنگ بدنه',
                                    'مشخصات ظاهری و فیزیکی--نوع بند',
                                    'مشخصات ظاهری و فیزیکی--رنگ بند',
                                    'مشخصات ظاهری و فیزیکی--ابعاد',
                                    'مشخصات ظاهری و فیزیکی--وزن',
                                    'مشخصات ظاهری و فیزیکی--مقاومت در برابر آب و گرد و غبار',

                                    'صفحه نمایش--صفحه نمایش رنگی',
                                    'صفحه نمایش--صفحه نمایش لمسی',
                                    'صفحه نمایش--فناوری ساخت',
                                    'صفحه نمایش--حداکثر روشنایی',
                                    'صفحه نمایش--اندازه (اینچ)',
                                    'صفحه نمایش--رزولوشن',
                                    'صفحه نمایش--تراکم پیکسلی',
                                    'صفحه نمایش--فرم صفحه نمایش',
                                    'صفحه نمایش--محافظ نمایشگر',
                                    'صفحه نمایش--سایر ویژگی‌های نمایشگر',

                                    'سیستم‌عامل--سیستم‌عامل',
                                    'سیستم‌عامل--سازگاری',
                                    'سیستم‌عامل--اپلیکیشن انحصاری',
                                    'سیستم‌عامل--پشتیبانی از زبان فارسی در اعلان و پیام',

                                    'مشخصات سخت‌افزاری--چیپ‌ست',
                                    'مشخصات سخت‌افزاری--پردازنده مرکزی',
                                    'مشخصات سخت‌افزاری--پردازنده گرافیکی',
                                    'مشخصات سخت‌افزاری--حافظه داخلی',
                                    'مشخصات سخت‌افزاری--حافظه رم',

                                    'صدا--اسپیکر',
                                    'صدا--میکروفون',


                                    'امکانات ارتباطی--قابلیت اتصال به شبکه موبایل',
                                    'امکانات ارتباطی--قابلیت مکالمه',
                                    'امکانات ارتباطی--وای‌فای',
                                    'امکانات ارتباطی--بلوتوث',
                                    'امکانات ارتباطی--موقعیت‌یابی',
                                    'امکانات ارتباطی--NFC',

                                    'حسگر و ویژگی‌ها--حسگرها',
                                    'حسگر و ویژگی‌ها--سایر ویژگی‌ها',

                                    'باتری--نوع باتری',
                                    'باتری--ظرفیت باتری',
                                    'باتری--عمر باتری',
                                    'باتری--نحوه شارژ',
                                    'باتری--توضیحات باتری',

                                    'محتویات جعبه--محتویات جعبه',

                                    'دوربین اصلی--نوع دوربین اصلی',
                                    'دوربین اصلی--پیکربندی دوربین‌ها',
                                    'دوربین اصلی--رزولوشن دوربین اصلی',
                                    'دوربین اصلی--ویژگی‌های دوربین اصلی',
                                    'دوربین اصلی--دوربین اولترا واید',
                                    'دوربین اصلی--مشخصات دوربین اولترا واید',
                                    'دوربین اصلی--دوربین تله',
                                    'دوربین اصلی--مشخصات دوربین تله',
                                    'دوربین اصلی--دوربین ماکرو',
                                    'دوربین اصلی--مشخصات دوربین ماکرو',
                                    'دوربین اصلی--دوربین تشخیص عمق',
                                    'دوربین اصلی--مشخصات دوربین تشخیص عمق',
                                    'دوربین اصلی--رزولوشن فیلم‌برداری',
                                    'دوربین اصلی--قابلیت‌های فیلم‌برداری دوربین اصلی',
                                    'دوربین سلفی--نوع دوربین سلفی',
                                    'دوربین سلفی--رزولوشن دوربین سلفی',
                                    'دوربین سلفی--ویژگی‌های دوربین سلفی',
                                    'دوربین سلفی--قابلیت‌های فیلم‌برداری دوربین سلفی',
                                ];


                                $sortedArray = customSort($attributes_fixed_array, $priorityArray);
                                // var_dump($attributes_fixed_obj);
                                $attributes_fixed_obj = array();
                                foreach ($sortedArray as $item => $value) {
                                    $label_array = explode('--', $item);
                                    $attributes_fixed_obj[$label_array[0]][$label_array[1]] = vertuka_the_persian_number($value);
                                }

                                echo '<table>';
                                foreach ($attributes_fixed_obj as $g_name => $g_array) {
                                    echo '<tr >';
                                    echo '<th  colspan="2"><h4 class="product-group-title">' . $g_name . '<h4></th>';
                                    echo '</tr>';
                                    foreach ($g_array as $item_name => $item_info) {
                                        echo '<tr>';
                                        echo '<td class="text-caption-2 mj-product-attributes-title">' . $item_name . ' :</td>';
                                        echo '<td class="ms-1"><strong class="mr-2">' . $item_info . '</strong></td>';
                                        echo '</tr>';
                                    }
                                }
                                echo '</table>';
                                ?>
                            </ul>
                        </div>
                        <div class="text-center pt-1 pt-md-3 pt-lg-4">
                            <a class="vertuka-show-more" href="#vertuka-product-technical-information">
                                <span>ادامه مطلب</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-100 mt-5 mb-3 my-md-5 mx-0" id="vertuka-product-comment">
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
                                $comments = get_approved_comments(get_the_ID());

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

        <div class="col-xl-4 col-lg-5 col-md-12 col-12 ps-lg-34 section-buyer-single">
            <div class="buy-section">

                <div class="option-to-buy">

                    <?php
                    if (method_exists($product, 'get_available_variations')) {
                    ?>
                        <div class="vertuka-color-option">
                            <div class="row">
                                <?php

                                $is_color_available = false;
                                // echo "<pre>";var_dump($terms);die;
                                if (count($available_color)) {
                                ?>
                                    <h3>رنگ:</h3>
                                    <?php
                                }
                                // var_dump($mj_temp_min_price_slug);
                                foreach ($terms as $term) {
                                    $color = vertuka_variable_color_getter($term->name);
                                    if (in_array(esc_attr($term->slug), $available_color)) {
                                        // if (in_array(esc_attr($term->slug), $available_color)) {
                                    ?>
                                        <div class="col-4 col-lg-6 px-1 px-md-2 vertuka-enable-option vertuka-option-var">
                                            <div id="<?php echo esc_attr($term->slug); ?>" class="color-option enable <?php if ($mj_temp_min_price_slug == $term->slug) {
                                                                                                                            echo 'active';
                                                                                                                        } ?>">
                                                <div class="d-flex">
                                                    <div class="me-2">
                                                        <div class="color" style="background-color: <?php echo $color; ?>"></div>
                                                    </div>
                                                    <div>
                                                        <p class="text m-0 p-0"><?php echo esc_html($term->name); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        $is_color_available = true;
                                    } elseif (isset($change_mind)) {
                                    ?>
                                        <div class="col-4 col-lg-6 px-1 px-md-2 vertuka-option-var vertuka-option-var">
                                            <div id="<?php echo esc_attr($term->slug); ?>" class="color-option disable">
                                                <div class="d-flex">
                                                    <div class="me-2">
                                                        <div class="color" style="background-color: <?php echo $color; ?>"></div>
                                                    </div>
                                                    <div>
                                                        <p class="text m-0 p-0"><?php echo esc_html($term->name); ?><span class="ms-2 text-10px text-muted">(ناموجود)</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                                <!-- /////////////////////////////////////// -->
                                <div class="mj-guarantee col-12 col-lg-12 px-1 px-md-2 " id="mj-guarantee">

                                </div>
                                <!-- /////////////////////////////////////// -->
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>

                <div class="option-to-buy pb-2 d-none d-lg-block">
                    <div class="vertuka-text-option">
                        <ul class="m-0 p-0">

                            <?php if (isset($remain)) { ?>
                                <li class="d-flex">
                                    <div><i class="icon dropbox"></i></div>
                                    <div>
                                        <p class="m-0">۱ عدد باقی مانده</p>
                                    </div>
                                </li>
                            <?php } ?>

                            <!-- <li class="d-flex">
                                <div><i class="icon shield"></i></div>
                                <div>
                                    <p class="m-0">۱۸ ماه گارانتی شرکتی</p>
                                </div>
                            </li> -->

                            <li class="d-flex mj_popup_7">
                                <div><i class="icon process"></i></div>
                                <div>
                                    <p class="m-0">ضمانت ۷ روزه
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                                        </svg>
                                    </p>
                                </div>
                            </li>

                            <li class="d-flex mj_popup_shipping">
                                <div><i class="icon transport primary-4"></i></div>
                                <div>
                                    <p class="text-primary-4 m-0">ارسال رایگان
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                                        </svg>
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="quantity pt-3 pt-lg-0">
                    <div class="d-flex">
                        <div class="me-3">
                            <p class="m-0 title">تعداد:</p>
                        </div>

                        <div>
                            <div class="vertuka-q-input">
                                <div class="increase">+</div>
                                <div class="numb">1</div>
                                <div class="decrease">-</div>
                            </div>
                            <input id="quantity" class="d-none" name="quantity" hidden="" type="number" value="1">
                        </div>
                    </div>
                </div>

                <div class="price-box px-3 px-md-4 mb-2 pb-3 pb-md-4 pt-3 pt-md-0">
                    <!-- <p class="p-0 mb-1 d-none d-sm-block">قیمت</p> -->
                    <?php do_action('vertuka/single/add-to-cart-button'); ?>
                </div>
            </div>


            <div class="express-buy">
                <div class="info">
                    <div class="d-flex">
                        <div class="img-box"><img class="img-fluid" src="<?php echo $esc_thumbnail_url; ?>" alt="<?php echo $esc_title; ?>"></div>
                        <div class="pt-3">
                            <p class="m-0">نام محصول:</p>
                            <p class="mb-0 title"><?php echo $esc_title; ?></p>
                        </div>
                    </div>
                    <div class="my-1">
                        <ul class="M-0 P-0">
                            <?php
                            if (method_exists($product, 'get_available_variations')) {
                            ?>
                                <li>
                                    <span>رنگ:</span>
                                    <span class="express-color"></span>
                                    <strong class="express-text"></strong>
                                </li>
                            <?php
                            }
                            ?>
                            <li>
                                <span>گارانتی:</span>
                                <strong class="fix-text-guarantee"></strong>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <?php
                        $product_id = $product->get_id();
                        $add_to_cart_url = esc_url(wc_get_cart_url()) . '?add-to-cart=' . $product_id;

                        // Output the link
                        if ($is_color_available) {
                            echo '<button id="single_add_to_cart_button-2" class="single_add_to_cart_button-2 w-100"><i class="icon cart green"></i>افزودن به سبد خرید</button>';
                        }
                        ?>
                    </div>
                </div>
                <div class="option"></div>
                <div class="action"></div>
            </div>
        </div>

    </div>
</div>


<!-- MJ add popup -->
<!-- The Modal -->
<div id="mj_popup_shipping" class="modal mjModal">
    <!-- Modal content -->
    <div class="modal-content d-flex">
        <div class="remove remove-item">
            <i class="icon close m-0"></i>
        </div>
        <div class="img-box"><img src="<?php vertuka_show_image('assets/images/product-page-popup-free-delivery.jpg'); ?>" alt="ورتوکا"></div>
        <br>

        <p>ما در ورتوکا تلاش می‌کنیم تا در سریع‌ترین زمان ممکن سفارشات شما را به دست‌تان برسانیم. برای ارسال سفارشات روش‌های زیر در دسترس شما هستند:</p>
        <ul>
            <li>ارسال با پست پیشتاز (سراسر کشور)</li>
            <li>ارسال عادی (برای ساکنین مناطق ۲۲ گانه شهر تهران)</li>
            <li>ارسال توربو مخصوص شهر تهران (برای ساکنین مناطق ۲۲ گانه شهر تهران)</li>
        </ul>
        <p class="h5">
            ارسال با پست پیشتاز (سراسر کشور)
        </p>
        <p>
            در این روش ارسال، سفارشات شما نهایتا تا ظهر روز کاری بعد از ثبت‌سفارش تحویل اداره پست می‌گردند و کد رهگیری مرسوله نیز از‌طریق پیامک برای شما ارسال خواهد شد. ضمنا سفارشاتی که ازطریق پست ارسال می‌شوند، دارای بیمه‌ی ارسال نیز هستند.
            این روش ارسال برای سفارش‌های بالای 10 میلیون تومان رایگان است.</p>

        <p class="h5">
            ارسال عادی (برای مناطق ۲۲ گانه شهر تهران)
        </p>
        <p>در این روش ۲ بازه برای دریافت سفارش توسط شما وجود دارد:</p>
        <ul>
            <li>بازه‌ی صبح از ساعت ۹ تا ۱۵</li>
            <li>بازه‌ی عصر از ساعت ۱۵ تا ۲۱</li>
        </ul>
        <p>در صورت ثبت سفارش تا ساعت ۱۴:۳۰، می‌توانید در بازه‌ی صبح روز بعد سفارش خود را تحویل بگیرید. بازه‌ی عصر روز بعد نیز تا ساعت ۲۴ روز ثبت سفارش قابل‌انتخاب است. در این روش همچنین می‌توانید تا ۳ روز بعد از ثبت سفارش را نیز برای دریافت سفارشتان انتخاب کنید. این روش ارسال برای سفارش‌های بالای 10 میلیون تومان رایگان است.</p>

        <p class="h5">
            ارسال توربو مخصوص شهر تهران (برای مناطق ۲۲ گانه شهر تهران)
        </p>
        <p>
            در روز‌های کاری، اگر تمایل دارید در همان روز سفارشتان را تحویل بگیرید می‌توانید از گزینه‌ی ارسال توربو استفاده کنید. در این روش اگر تا قبل از ساعت ۱۷ ثبت‌سفارش انجام شود، سفارش در همان روز و ازطریق پیک به دستتان خواهد رسید.

        </p>

    </div>
</div>

<div id="mj_popup_7" class="modal mjModal">
    <!-- Modal content -->
    <div class="modal-content d-flex">
        <div class="remove remove-item">
            <i class="icon close m-0"></i>
        </div>
        <div class="img-box"><img src="<?php vertuka_show_image('assets/images/product-page-popup-return-cash.jpg'); ?>" alt="ورتوکا"></div>
        <br>
        <p>
            سرویس گارانتی ۷ روزه ورتوکا بر اساس قوانین تجارت الکترونیک برای همه‌ی محصولات برقرار است و اگر از خرید خود منصرف شده‌اید، می‌توانید تا ۷ روز پس از دریافت کالا اقدام به بازگرداندن آن کنید. شرایط دریافت کالا فقط برای محصولاتی که هنوز <strong class="h6">پلمب</strong> هستند مصداق دارد و <strong class="h6">در صورت مخدوش شدن پلمب یا بارکد محصول از پذیرش آن معذوریم</strong>. برای هماهنگی بازگشت کالا می‌توانید با شماره‌ی ۹۱۰۹۰۰۰۳-۰۲۱ تماس بگیرید. پس از عودت کالا و دریافت آن توسط ورتوکا، وجه پرداختی شما تا ۷۲ ساعت بعد(ساعات کاری) به حساب شما عودت داده خواهد شد. توجه داشته باشید که عودت وجه تنها به حساب بانکی‌ای که کالا از آن خریداری شده است امکان‌پذیر است. همچنین هزینه‌ی عودت کالا برعهده‌ی خریدار خواهد بود.
        </p>
        <p>
            ضمانت سلامت محصول بر عهده‌ی شرکت گارانتی‌کننده است و ورتوکا در این زمینه دخل و تصرفی ندارد؛ در صورت مشاهده‌ی مشکل فنی با تیم پشتیبانی ورتوکا تماس بگیرید تا برای ارتباط با شرکت گارانتی کننده شما را راهنمایی کند.

        </p>
        <p>
            برای محصولات فاقد گارانتی، در صورت بروز مشکل فنی می‌توانید با پشتیبانی ورتوکا تماس بگیرید.

        </p>
    </div>
</div>
<!-- MJ end popup -->

<script>
    jQuery(document).ready(function() {
        jQuery('#pa_color').val(jQuery('div.vertuka-option-var .active').attr('id')).change();
        jQuery('.express-buy ul > li .express-color').css('background', jQuery('div.vertuka-option-var .active').find('.color').css('background'));
        jQuery('.express-buy ul > li .express-text').text(jQuery('div.vertuka-option-var .active').find('.text').first().text());
        setTimeout(() => {
            var isMobile = false; //initiate as false
            // device detection
            if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) ||
                /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0, 4))) {
                isMobile = true;
            }
            if (isMobile) {
                jQuery('.mobile-option-to-buy .vertuka-option-var .active').trigger("click");
                jQuery(".mj-guarantee-select")
                    .val("<?php echo $mj_temp_min_price_slug_guarantee; ?>")
                    .change();

                jQuery('body').css("padding-bottom", "120px");
            } else {
                jQuery('.vertuka-option-var .active').trigger("click");
                jQuery(".mj-guarantee-select")
                    .val("<?php echo $mj_temp_min_price_slug_guarantee; ?>")
                    .change();
            }


        }, "1000");
        // MJ at first load
        // jQuery('.variations_form').clone().appendTo('#mj-guarantee');
        // jQuery("#mj-guarantee").empty();
        // jQuery("#pa_guarantee").clone().appendTo("#mj-guarantee");
        // jQuery("#mj-guarantee #pa_guarantee").addClass("mj-guarantee-select form-select");


        jQuery('.mj_popup_shipping').click(function() {
            var modal = document.getElementById('mj_popup_shipping');
            modal.style.display = "block";

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        });
        jQuery('.mj_popup_7').click(function() {
            var modal = document.getElementById('mj_popup_7');
            modal.style.display = "block";

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        });

        jQuery('.remove-item').click(function() {
            var modal = document.getElementById('mj_popup_shipping');
            modal.style.display = "none";


            var modal = document.getElementById('mj_popup_7');
            modal.style.display = "none";

        });

    });
</script>


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
    // function enqueue_mehdi_custom_script()
    // {
    //     wp_register_script('mehdi-custom-script', get_template_directory_uri() . '/assets/js/product-script.js', array('jquery'), '1.0.0', true);
    //     wp_enqueue_script('mehdi-custom-script');
    // }
    // add_action('wp_enqueue_scripts', 'enqueue_mehdi_custom_script');
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