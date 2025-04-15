<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package vertuka
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function vertuka_body_classes($classes)
{
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }


    return $classes;
}
add_filter('body_class', 'vertuka_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function vertuka_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'vertuka_pingback_header');


/**
 * Replace persian number instead English
 */
if (!function_exists('vertuka_the_persian_number')) {
    function vertuka_the_persian_number($text)
    {
        $eng = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        $per = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        if (is_string($text)) {
            $new_text = str_replace($eng, $per, $text);
        } else {
            $new_text = str_replace($eng, $per, strval($text));
        }
        return esc_html($new_text);
    }
}

/**
 * Replace persian number instead English without escape or converting to int!
 */
if (!function_exists('vertuka_persian_number')) {
    function vertuka_persian_number($text)
    {
        $eng = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        $per = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        $new_text = str_replace($eng, $per, $text);
        return $new_text;
    }
}

/**
 * Displaying Images from local directory
 */
function vertuka_show_image($string)
{
    echo esc_url(get_theme_file_uri($string));
}

function vertuka_show_image_with_size($string, $size = 'medium')
{

    $image_id = attachment_url_to_postid(get_theme_file_uri($string));


    if ($image_id) {

        $image_src = wp_get_attachment_image_src($image_id, $size);

        // اگر تصویر موجود باشد
        if ($image_src) {
            return [
                'url' => $image_src[0]
            ];
        }
    }

    return null;
}


function avertuka_url_getter($type = '')
{

    switch ($type) {
        case "main":
            $url = get_bloginfo('url');
            break;

        case "cart":
            $url = $cart_page_url = wc_get_cart_url();
            break;

        case "shop":
            $shop_page_id = wc_get_page_id('shop');
            $url = get_permalink($shop_page_id);
            break;

        case "checkout":
            $url = wc_get_checkout_url();
            break;

        case "login":
            $options = get_option('med_general_settings');
            $url = get_permalink($options['med_rp_main_login_page']);
            break;

        case "cologin":
            $url = get_bloginfo('url') . '/cologin';
            break;

        case "register":
            $options = get_option('med_general_settings');
            $url = get_permalink($options['med_rp_main_register_page']);
            break;

        case "profile":
            $options = get_option('med_general_settings');
            $url = get_permalink($options['med_rp_main_profile_page']);
            break;

        case "co-profile":
            $url = get_bloginfo('url') . '/co-profile';
            break;

        default:
            $url = get_bloginfo('url');
    }

    return esc_url($url);
}

/**
 * Customize the add-to-cart template function
 */
add_action('vertuka/single/add-to-cart-button', 'woocommerce_template_single_add_to_cart', 30);

/**
 * @param $color_name
 * @return string|null
 * Get color for products
 */
function vertuka_variable_color_getter($color_name = '')
{

    switch ($color_name) {
        case "آبی":
            $color = '#1e58bd';
            break;
        case "آبی روشن":
            $color = '#3779ed';
            break;
        case "برنزی":
            $color = '#c76d40';
            break;
        case "بنفش":
            $color = '#7d13bf';
            break;
        case "خاکستری":
            $color = '#575656';
            break;
        case "زرد":
            $color = '#ffd500';
            break;
        case "سبز":
            $color = '#5aad02';
            break;
        case "سبز زیتونی":
            $color = '#5e7001';
            break;
        case "سفید":
            $color = '#fff';
            break;
        case "صورتی":
            $color = '#FFC0CB';
            break;
        case "طلایی":
            $color = '#c7a802';
            break;
        case "قرمز":
            $color = '#de0404';
            break;
        case "گلبهی":
            $color = '#fa9687';
            break;
        case "لیمویی":
            $color = '#bfff00';
            break;
        case "مسی":
            $color = '#B87333';
            break;
        case "مشکی":
            $color = '#000000';
            break;
        case "نارنجی":
            $color = '#ff8000';
            break;
        case "نقره‌ای":
            $color = '#C0C0C0';
            break;
        case "یاسی":
            $color = '#d5d5f5';
            break;
        case "قهوه‌ای":
            $color = '#964B00';
            break;
        case "رزگلد":
            $color = '#e3a177';
            break;
        case "تیتانیوم":
            $color = '#797982';
            break;
        case "سرمه‌ای":
            $color = '#001780';
            break;
        case "آبی تیره":
            $color = '#00318b';
            break;
        case "آبی آسمانی":
            $color = '#87CEEB';
            break;
        case "مرجانی":
            $color = '#FF7F50';
            break;
        case "هفت رنگ":
            $color = '#d6c7c7';
            break;
        case "فیروزه‌‌ای":
            $color = '#05e3e3';
            break;
        case "کرم":
            $color = '#F9e4bc';
            break;
        case "استارلایت":
            $color = '#f4edc6';
            break;
        case "تیتانیوم آبی":
            $color = '#215791';
            break;
        case "تیتانیوم سفید":
            $color = '#e4e2df';
            break;
        case "تیتانیوم صحرایی":
            $color = '#b4a293';
            break;
        case "تیتانیوم مشکی":
            $color = '#403f3e';
            break;
        case "تیتانیوم طبیعی":
            $color = '#a29d96';
            break;

        default:
            $color = $color_name;
    }

    return esc_attr($color);
}

/**
 * @return string 
 * label of add-on plus price
 */
function vertuka_yith_wapo_table_total_order_label()
{
    return 'مبلغ قابل پرداخت';
}
add_action('yith_wapo_table_total_order_label', 'vertuka_yith_wapo_table_total_order_label');


function vertuka_get_feature_lable($label)
{

    switch ($label) {
        case 'video-resolution':
            $color = 'رزولوشن فیلم‌برداری';
            break;
        case 'announcement-date':
            $color = 'تاریخ عرضه';
            break;
        case 'pa_ram':
            $color = 'رم';
            break;
        case 'video-resolution':
            $color = 'رزولوشن فیلم‌برداری';
            break;
        case 'video-resolution':
            $color = 'رزولوشن فیلم‌برداری';
            break;
        case 'video-resolution':
            $color = 'رزولوشن فیلم‌برداری';
            break;
        case 'video-resolution':
            $color = 'رزولوشن فیلم‌برداری';
            break;
        case 'video-resolution':
            $color = 'رزولوشن فیلم‌برداری';
            break;
        case 'video-resolution':
            $color = 'رزولوشن فیلم‌برداری';
            break;
        case 'selfie-camera-resolution':
            $color = 'رزولوشن دوربین سلفی';
            break;
        case 'main-camera-resolution':
            $color = 'main-camera-resolution';
            break;
        case 'selfie-camera-features':
            $color = 'ویژگی‌های دوربین سلفی';
            break;
        case 'main-camera-features':
            $color = 'ویژگی‌های دوربین اصلی';
            break;
        case 'battery-type':
            $color = 'نوع باتری';
            break;
        case 'main-camera-type':
            $color = 'نوع دوربین اصلی';
            break;
        case 'rom':
            $color = 'رابط کاربری';
            break;
        case 'network-technology':
            $color = 'تکنولوژی شبکه';
            break;
        case 'battery-capacity':
            $color = 'ظرفیت باتری';
            break;
        case 'os':
            $color = 'سیستم عامل';
            break;
        case 'weight':
            $color = 'وزن';
            break;
        case 'sensors':
            $color = 'سایر حسگر ها';
            break;
        case 'wireless-charge':
            $color = 'شارژ بی سیم';
            break;
        case 'fast-charge':
            $color = 'قابلیت شارژ سریع';
            break;
        case 'pa_sim':
            $color = 'تعداد سیمکارت';
            break;
        case 'positioning':
            $color = 'موقعیت یاب';
            break;
        case 'fingerprint':
            $color = 'حسگر اثر انگشت';
            break;
        case 'other-features':
            $color = 'ویژگی های دیگر';
            break;
        case 'face-detection':
            $color = 'قابلیت تشخیص چهره';
            break;
        case 'card-slot':
            $color = 'درگاه کارت حافظه';
            break;
        case '35mm-jack':
            $color = 'جک ۳.۵ میلی‌متری';
            break;
        case 'nfc':
            $color = 'NFC';
            break;
        case 'inferared-port':
            $color = 'اینفرارد';
            break;
        case 'bluetooth':
            $color = 'بلوتوث';
            break;
        case 'dimension':
            $color = 'ابعاد';
            break;
        case 'charging-features':
            $color = '#000';
            break;
        case 'gpu':
            $color = '#1d03f3';
            break;
        case 'wlan':
            $color = 'WLAN';
            break;
        case 'otg':
            $color = '#36e6ed';
            break;
        case 'radio':
            $color = 'راذیو';
            break;
        case 'port':
            $color = 'درگاه ارتباطی';
            break;
        case "خاکستری":
            $color = '#cccccc';
            break;
        case "سبز":
            $color = '#17735D';
            break;

        default:
            $color = '';
    }

    return esc_attr($color);
}

function vertuka_get_category_html($product_id)
{
    $categories = get_the_terms($product_id, 'product_cat');
    if ($categories && !is_wp_error($categories)) {
        // Sort the categories by term ID in descending order
        usort($categories, function ($a, $b) {
            return $b->term_id - $a->term_id;
        });

        // Get the first category (which is now the latest one)
        if ($categories[0]->slug == 'offers') {
            $last_category = $categories[1];
        } else {
            $last_category = $categories[0];
        }

        $category_url = get_term_link($last_category);

        // Output the category name
        echo '<div class="category"><p class="m-0"><a href="' . $category_url . '">' . $last_category->name . '</a></p></div>';
    } else {
        //MJ
        $variation = wc_get_product($product_id);

        $categories = get_the_terms($variation->get_parent_id(), 'product_cat');

        if ($categories && !is_wp_error($categories)) {
            // Sort the categories by term ID in descending order
            usort($categories, function ($a, $b) {
                return $b->term_id - $a->term_id;
            });

            // Get the first category (which is now the latest one)
            if ($categories[0]->slug == 'offers') {
                $last_category = $categories[1];
            } else {
                $last_category = $categories[0];
            }
            $category_url = get_term_link($last_category);

            // Output the category name
            echo '<div class="category"><p class="m-0"><a href="' . $category_url . '">' . $last_category->name . '</a></p></div>';
        }
    }
}

function vertuka_get_category_array($product_id)
{
    $categories = get_the_terms($product_id, 'product_cat');
    if ($categories && !is_wp_error($categories)) {
        // Sort the categories by term ID in descending order
        usort($categories, function ($a, $b) {
            return $b->term_id - $a->term_id;
        });

        // Get the first category (which is now the latest one)
        if ($categories[0]->slug == 'offers') {
            $last_category = $categories[1];
        } else {
            $last_category = $categories[0];
        }
        $category_url = get_term_link($last_category);

        // Output the category name
        return array(
            'name' => $last_category->name,
            'url' => $category_url
        );
        //echo '<div class="category"><p class="m-0"><a href="'.$category_url.'">'.$last_category->name.'</a></p></div>';
    }
}

function vertuka_jalali_convert_week_name($label)
{

    switch ($label) {
        case 'Sat':
            $jalali = 'شنبه';
            break;

        case "Sun":
            $jalali = 'یکشنبه';
            break;

        case "Fri":
            $jalali = 'جمعه';
            break;

        case "Thu":
            $jalali = 'پنج شنبه';
            break;

        case "Wed":
            $jalali = 'چهارشنبه';
            break;

        case "Tue":
            $jalali = 'سه شنبه';
            break;

        case "Mon":
            $jalali = 'دوشنبه';
            break;

        default:
            $jalali = $label;
    }

    return esc_html($jalali);
}

function vertuka_gregorian_to_Jalali($year, $month, $day)
{
    $gregorianEpoch = 1948321; // 622-03-21 Gregorian
    $jalaliEpoch = 3178749; // 1-01-01 Jalali

    $gregorianYear = $year + 621;
    $gregorianDate = ($month > 2) ?
        ($gregorianYear * 365) + (int)(($gregorianYear + 3) / 4) - (int)(($gregorianYear + 99) / 100) + (int)(($gregorianYear + 399) / 400) + $day + 79 : ($gregorianYear * 365) + (int)(($gregorianYear + 3) / 4) - (int)(($gregorianYear + 99) / 100) + (int)(($gregorianYear + 399) / 400) + $day - 286;

    $jalaliYear = $jalaliEpoch + 4 * ($gregorianDate - $gregorianEpoch) + (int)(($gregorianYear + 3) / 4) - (int)(($gregorianYear + 99) / 100) + (int)(($gregorianYear + 399) / 400);
    $jalaliDayOfYear = $gregorianDate - ($jalaliEpoch + ($jalaliYear - 1) * 365 + (int)(($jalaliYear - 1) / 33) * 8 + (int)((($jalaliYear - 1) % 33 + 3) / 4)) + 1;

    $daysInMonths = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29];
    $jalaliMonth = 0;
    while ($jalaliMonth < 12 && $jalaliDayOfYear > $daysInMonths[$jalaliMonth]) {
        $jalaliDayOfYear -= $daysInMonths[$jalaliMonth];
        $jalaliMonth++;
    }
    $jalaliMonth++;

    return [
        'year' => $jalaliYear,
        'month' => $jalaliMonth,
        'day' => $jalaliDayOfYear,
    ];
}

function vertuka_jalali_convert_month_name($label)
{

    switch ($label) {
        case '1':
            $jalali = 'فروردین';
            break;

        case "2":
            $jalali = 'اردیبهشت';
            break;

        case "3":
            $jalali = 'خرداد';
            break;

        case "4":
            $jalali = 'تیر';
            break;

        case "5":
            $jalali = 'مرداد';
            break;

        case "6":
            $jalali = 'شهریور';
            break;

        case "7":
            $jalali = 'مهر';
            break;

        case "8":
            $jalali = 'آبان';
            break;

        case "9":
            $jalali = 'اذر';
            break;

        case "10":
            $jalali = 'دی';
            break;

        case "11":
            $jalali = 'بهمن';
            break;

        case "12":
            $jalali = 'اسفند';
            break;

        default:
            $jalali = $label;
    }

    return esc_html($jalali);
}

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);


if (!function_exists('vertuka_user_meta_fb')) {
    function vertuka_user_meta_fb()
    {
        if (isset($_POST['vertuka_extra_usermeta'])) {
?>
            <div class="d-block w-100 mb-4 bg-success mt-4 br-16">
                <p class="m-0 p-3 br-14 text-white">
                    اطلاعات ذخیره شد
                </p>
            </div>
        <?php
        }
        ?>
        <form action="" class="d-block my-3 vertuka-user-form-details" method="post" id="personal_information_form">
            <?php
            // var_dump($error_message);die;
            $user_id = get_current_user_id(); // Get the current user's ID
            $data_haghighi = array(
                'first_name'    => 'نام',
                'last_name' => 'نام خانوادگی',
                'national_code' => 'کد ملی',
                'birthday' => 'تاریخ تولد',
            );

            $data_hoghoghi = array(
                'company'   => 'نام سازمان',
                'economic_id'   => 'کد اقتصادی',
                'company_national_code' => 'شناسه ملی',
                'registration_id'   => 'شناسه ثبت',
                'company_address'   => 'آدرس و کد پستی',
            );

            foreach ($data_haghighi as $field => $label) {
                $old_data = get_user_meta($user_id, $field, true);
            ?>

                <p class="vertuka_fields_gp">
                    <label for="name"><?php echo $label; ?></label>
                    <input class="form-control <?php echo $field; ?>" type="text" name="<?php echo $field; ?>" value="<?php echo $old_data ?>" <?php
                                                                                                                                                if ($field != 'card_number' && $field != 'sheba_number' && $field != 'bank_name') {
                                                                                                                                                    echo 'required';
                                                                                                                                                }
                                                                                                                                                if ($field == 'sheba_number') {
                                                                                                                                                    echo 'placeholder="IR1...9 (۲۴ رقم)"';
                                                                                                                                                }
                                                                                                                                                if ($field == 'card_number') {
                                                                                                                                                    echo 'placeholder="**** - **** - **** - ****"';
                                                                                                                                                }
                                                                                                                                                ?>>
                </p>
            <?php

            }
            ?>

            <p id="hideButtonHoghughi" class="defult-button" style="font-size: 15px;background: #9d9d9d;">+ وارد کردن اطلاعات شخص حقوقی </p>
            <script>
                jQuery(document).ready(function() {
                    jQuery('#hideButtonHoghughi').click(function() {
                        jQuery('.hoghoghi').toggle();
                    });
                });

                jQuery('#personal_information_form').on('submit', function() {
                    // console.log(jQuery('input[name="sheba_number"]').val());
                    if (jQuery('input[name="sheba_number"]').val().length > 0 && jQuery('input[name="sheba_number"]').val().substr(0, 2) != 'ir' && jQuery('input[name="sheba_number"]').val().substr(0, 2) != 'Ir' && jQuery('input[name="sheba_number"]').val().substr(0, 2) != 'iR' && jQuery('input[name="sheba_number"]').val().substr(0, 2) != 'IR') {
                        jQuery('input[name="sheba_number"]').val('IR' + jQuery('input[name="sheba_number"]').val());
                    }
                    return true;
                });

                jQuery(function() {
                    jQuery(".birthday").persianDatepicker();
                });
            </script>
            <?php
            $show_hoghoghi = 0;

            foreach ($data_hoghoghi as $field => $label) {
                $old_data = get_user_meta($user_id, $field, true);
                if ($old_data != '') {
                    // $show_hoghoghi = 1;
                }
            }

            foreach ($data_hoghoghi as $field => $label) {
                $old_data = get_user_meta($user_id, $field, true);
            ?>
                <p class="vertuka_fields_gp hoghoghi " <?php if ($show_hoghoghi == '') { ?>style="display: none" <?php } ?>>
                    <label><?php echo $label; ?></label>
                    <input type="text" name="<?php echo $field; ?>" value="<?php echo $old_data ?>">
                </p>
            <?php

            }



            ?>
            <p class="vertuka_fields_gp">
                <input type="submit" name="vertuka_extra_usermeta" value="ذخیره اطلاعات" class="br-16 defult-button" />
            </p>
        </form>
        <?php
    }
    add_shortcode('vertuka_user_extra_details_form', 'vertuka_user_meta_fb');
}



if (!function_exists('vertuka_user_meta_fb_bank')) {
    function vertuka_user_meta_fb_bank()
    {
        if (isset($_POST['vertuka_extra_usermeta'])) {
        ?>
            <div class="d-block w-100 mb-4 bg-success mt-4 br-16">
                <p class="m-0 p-3 br-14 text-white">
                    اطلاعات ذخیره شد
                </p>
            </div>
        <?php
        }
        ?>
        <form action="" class="d-block my-3 vertuka-user-form-details" method="post" id="personal_information_form">
            <?php
            // var_dump($error_message);die;
            $user_id = get_current_user_id(); // Get the current user's ID
            $data_haghighi = array(
                'bank_name' => 'نام بانک',
                'card_number' => 'شماره کارت',
                'sheba_number' => 'شماره شبا',
            );

            foreach ($data_haghighi as $field => $label) {
                $old_data = get_user_meta($user_id, $field, true);
            ?>
                <?php
                if ($field == 'bank_name') {
                    wc_print_notices();
                }
                ?>
                <p class="vertuka_fields_gp">
                    <label for="name"><?php echo $label; ?></label>
                    <input class="form-control <?php echo $field; ?>" type="text" name="<?php echo $field; ?>" value="<?php echo $old_data ?>" <?php
                                                                                                                                                if ($field != 'card_number' && $field != 'sheba_number' && $field != 'bank_name') {
                                                                                                                                                    echo 'required';
                                                                                                                                                }
                                                                                                                                                if ($field == 'sheba_number') {
                                                                                                                                                    echo 'placeholder="IR1...9 (۲۴ رقم)"';
                                                                                                                                                }
                                                                                                                                                if ($field == 'card_number') {
                                                                                                                                                    echo 'placeholder="**** - **** - **** - ****"';
                                                                                                                                                }
                                                                                                                                                ?>>
                </p>
            <?php

            }
            ?>

            <script>
                jQuery('#personal_information_form').on('submit', function() {
                    // console.log(jQuery('input[name="sheba_number"]').val());
                    if (jQuery('input[name="sheba_number"]').val().length > 0 && jQuery('input[name="sheba_number"]').val().substr(0, 2) != 'ir' && jQuery('input[name="sheba_number"]').val().substr(0, 2) != 'Ir' && jQuery('input[name="sheba_number"]').val().substr(0, 2) != 'iR' && jQuery('input[name="sheba_number"]').val().substr(0, 2) != 'IR') {
                        jQuery('input[name="sheba_number"]').val('IR' + jQuery('input[name="sheba_number"]').val());
                    }
                    return true;
                });

                jQuery(function() {
                    jQuery(".birthday").persianDatepicker();
                });
            </script>

            <p class="vertuka_fields_gp">
                <input type="submit" name="vertuka_extra_usermeta" value="ذخیره اطلاعات" class="br-16 defult-button" />
            </p>
        </form>
        <?php
    }
    add_shortcode('vertuka_user_extra_details_form_bank', 'vertuka_user_meta_fb_bank');
}



function vertuka_regular_price($product_id, $MJ_same_off_product_price = false)
{
    // Get product object
    $product = wc_get_product($product_id);

    // Check if the product is a variable product
    if ($product->is_type('variable')) {

        $variations = $product->get_available_variations();
        $min_regular_price = $min_sale_price = 0;

        // Loop through variations to find the lowest regular and sale prices
        foreach ($variations as $variation) {
            // return price on offed variation
            $variation_id = $variation['variation_id'];
            $variation_product = wc_get_product($variation_id);

            $regular_price = $variation_product->get_regular_price();
            $sale_price = $variation_product->get_sale_price();

            if ($MJ_same_off_product_price) {
                if (($variation['is_in_stock'] || (isset($variation['onbackorder']) && $variation['onbackorder'])) && $variation['display_price'] == $MJ_same_off_product_price) {
                    $min_regular_price = $regular_price;
                }
            } else {
                if (($variation['is_in_stock'] || (isset($variation['onbackorder']) && $variation['onbackorder']))) {
                    if ($regular_price < $min_regular_price) {
                        $min_regular_price = $regular_price;
                    }

                    if ($sale_price < $min_sale_price) {
                        $min_sale_price = $sale_price;
                    }
                }
            }
        }

        return round($min_regular_price, 0);
    } else {
        return round($product->get_regular_price(), 0);
    }
}


function vertuka_diacount_calculator($product_id, $discounted_price = false)
{
    $regular_price = intval(vertuka_regular_price($product_id, $discounted_price));
    if (!$discounted_price) {

        $product = wc_get_product($product_id);

        if ($product->is_type('variable')) {

            $variations = $product->get_available_variations();
            $prices = array();
            foreach ($variations as $variation) {
                $variation_obj = new WC_Product_Variation($variation['variation_id']);
                $prices[] = $variation_obj->get_price();
            }
            // $lowest_price = min($prices);
            if (!empty($prices)) {
                $lowest_price = min($prices);
            } else {
                $lowest_price = false;
            }
        } else {
            $lowest_price = $product->get_price();
        }

        $discounted_price = intval($lowest_price);
    }
    if ($regular_price == 0) {
        return null;
    }

    if ((($regular_price - $discounted_price) / $regular_price) * 100 > 0 && (($regular_price - $discounted_price) / $regular_price) * 100 < 1) {
        // takhfif zyre yek darsad ro yek neshon bede
        return 1;
    }

    $discount_percentage = round((($regular_price - $discounted_price) / $regular_price) * 100, 0);

    return $discount_percentage;
}
//
//function vertuka_orginal_price_discounted_product( $product_id ){
//
//    $regular_price = intval( vertuka_regular_price( $product_id ) );
//    $product = wc_get_product($product_id);
//
//    if ($product->is_type('variable')) {
//        $variations = $product->get_available_variations();
//        $prices = array();
//        foreach ($variations as $variation) {
//            $variation_obj = new WC_Product_Variation($variation['variation_id']);
//            $prices[] = $variation_obj->get_price();
//        }
//        $lowest_price = min($prices);
//    } else {
//        $lowest_price = $product->get_price();
//    }
//
//    $discounted_price = intval( $lowest_price );
//
//    if ( $regular_price == $discounted_price ){
//        return false;
//    }else {
//        return $regular_price;
//    }
//
//}


function vertuka_study_minutes($post_id)
{
    // Get the post content
    $post_content = get_post_field('post_content', $post_id);

    // Count the number of paragraphs
    $paragraphs_count = substr_count($post_content, '<p>');

    if ($paragraphs_count == 0) {
        $h_1 = substr_count($post_content, '</h1>');
        $h_2 = substr_count($post_content, '</h2>');
        $h_3 = substr_count($post_content, '</h3>');
        $h_4 = substr_count($post_content, '</h4>');
        $h_5 = substr_count($post_content, '</h5>');
        $h_6 = substr_count($post_content, '</h6>');

        $paragraphs_count = ($h_1 + $h_2 + $h_3 + $h_4 + $h_5 + $h_6) * 1.5;
    }

    return round($paragraphs_count, 0);
}

function vertuka_discount_amount_product_price()
{
    // Get the cart object
    $cart = WC()->cart;

    // Initialize discount amount variable
    $total_discount_amount = 0;

    // Loop through cart items and calculate discount amount
    foreach ($cart->get_cart() as $cart_item) {
        $product = wc_get_product($cart_item['product_id']);

        // Check if the product is a variable product
        if ($product->is_type('variable')) {
            $variation_id = $cart_item['variation_id'];
            $variation = wc_get_product($variation_id);
            $regular_price = $variation->get_regular_price();
            $discounted_price = $variation->get_sale_price();
        } else {
            $regular_price = $product->get_regular_price();
            $discounted_price = $product->get_sale_price();
        }

        $quantity = $cart_item['quantity'];
        if ($discounted_price != '' && $discounted_price != 0) {
            $total_discount_amount += (($regular_price - $discounted_price) * $quantity);
        }
    }

    return $total_discount_amount;
}


function vertuka_orginal_product_price()
{
    // Get the cart object
    $cart = WC()->cart;

    $orginal_product_price = 0;
    $discounte_product_price = 0;
    // Loop through cart items and calculate discount amount
    foreach ($cart->get_cart() as $cart_item) {
        $product = wc_get_product($cart_item['product_id']);

        // Check if the product is a variable product
        if ($product->is_type('variable')) {
            $variation_id = $cart_item['variation_id'];
            $variation = wc_get_product($variation_id);
            $regular_price = $variation->get_regular_price();
            $discounted_price = $variation->get_sale_price();
        } else {
            $regular_price = $product->get_regular_price();
            $discounted_price = $product->get_sale_price();
        }
        $quantity = $cart_item['quantity'];


        $orginal_product_price += (floatval($regular_price) * $quantity);

        $discounte_product_price += (floatval($discounted_price) * $quantity);
    }
    return $orginal_product_price;
    if ($discounte_product_price != 0 && $discounte_product_price != $orginal_product_price) {
        return $orginal_product_price;
    } else {
        return false;
    }
}

/* Remove Prefix*/
add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_tax()) { //for custom post types
        $title = sprintf(__('%1$s'), single_term_title('', false));
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    }
    return $title;
});

/**
 * Display Available colors in card of product
 */

if (!function_exists('vertuka_display_available_colors')) {
    function vertuka_display_available_colors($product_id)
    {
        ////////////////////////////////////////////////////////////////////////
        $available_color = array();
        $product = wc_get_product($product_id);

        if (method_exists($product, 'get_available_variations')) {
            $vars = $product->get_available_variations();
            foreach ($vars as $var) {
                foreach ($var['attributes'] as $color) {
                    if ($var['is_in_stock'] || (isset($variation['onbackorder']) && $variation['onbackorder'])) {
                        $available_color[] = $color;
                    }
                }
            }
        }

        $return = '';
        if (count($available_color)) {
            $terms = wc_get_product_terms(
                $product_id,
                'pa_color',
                array(
                    'fields' => 'all',
                )
            );

            foreach ($terms as $term) {
                if (in_array(esc_attr($term->slug), $available_color)) {
                    $color = vertuka_variable_color_getter($term->name);
                    $return .= "<div class='color' style='background-color: " .  $color . "'></div>";
                }
            }
        }


        return $return;
    }
}


add_filter('woocommerce_billing_fields', 'wc_optional_billing_fields', 999, 1);
function wc_optional_billing_fields($address_fields)
{
    foreach ($address_fields as &$address_field) {
        $address_field['required'] = false;

        // Disable phone number validation
        if (isset($address_field['type']) && 'tel' === $address_field['type']) {
            $current_user = wp_get_current_user();
            $username = $current_user->user_login;
            if (is_numeric($username)) {
                $address_field['default'] = $username;
            } else {
                $address_field['default'] = '09120000000';
            }
        }
    }

    return $address_fields;
}

add_filter('woocommerce_shipping_fields', 'wc_optional_shipping_fields', 999, 1);
function wc_optional_shipping_fields($address_fields)
{
    foreach ($address_fields as &$address_field) {
        $address_field['required'] = false;
    }

    return $address_fields;
}


function mj_same_price_everywhere($product_id, $on_sale_first = false)
{
    $results = [
        'text' => '',
        'discount_percent' => null,
        'available_colors' => '',
        'custom_shape' => '',
        'stock_status' => 'outofstock',
        'price_in_digits_normal' => '',
        'price_in_digits_sale' => '',
    ];
    // return $results;
    $prices = array();

    $product = wc_get_product($product_id);
    $variation_stock_status = false;
    $variation_sale_status = false;

    if ($product->is_type('variable')) {
        $variations = $product->get_available_variations();
        foreach ($variations as $variation) {
            
                $variation_obj = new WC_Product_Variation($variation['variation_id']);
                if ($variation_obj->get_stock_status() == 'instock' && $variation_obj->get_stock_quantity() != 0) {
                    $variation_stock_status = true;
                    if ($variation_obj->get_sale_price()) {
                        $variation_sale_status = true;
                    }
                }
                if ($variation_obj->get_price() != 0 && $variation_obj->get_stock_quantity() != 0) {
                    if ($variation_obj->get_sale_price()) {
                        $prices[] = $variation_obj->get_sale_price();
                    } else {
                        $prices[] = $variation_obj->get_price();
                    }
                }
                if ($variation_obj->get_stock_status() == 'onbackorder') {
                    $variation_stock_status = true;

                    if ($variation_obj->get_sale_price()) {
                        $prices[] = $variation_obj->get_sale_price();
                    } else {
                        $prices[] = $variation_obj->get_price();
                    }
                }
            
        }
        // vertuka_debug_popup($variations);

        // $lowest_price = min($prices);
        if (!empty($prices)) {
            $lowest_price = min($prices);
        } else {
            $lowest_price = false;
        }
        // vertuka_debug_popup($lowest_price);

        //
        sort($prices);
        if ($on_sale_first) {
            foreach ($prices as $value) {
                // var_dump($product_id, $value);
                if (vertuka_diacount_calculator($product_id, $value)) {
                    $lowest_price = $value;
                    break;
                }
            }
        }
    } else {
        $lowest_price = $product->get_price();
    }

    $stock_status = $product->get_stock_status();

    if (
        $stock_status === 'outofstock'
        && !$variation_stock_status
    ) {
        $results['text'] = "<p class='stock out-of-stock'>ناموجود</p>";
        return $results;
    } else {
        if ($lowest_price == '0') {
            $results['text'] = "<p class='stock out-of-stock'>ناموجود</p>";
            return $results;
        }

        $currency_symbol = get_woocommerce_currency_symbol();
        $discount_percent = vertuka_diacount_calculator($product_id, $lowest_price);

        $results['text'] = "<div class='price mj-same-price-text'>
        <div class='price'>";

        if ($lowest_price != '0') {
            $results['text'] .=  "<div>
            <div class='price'>
                <span class='number'>" . vertuka_the_persian_number(number_format($lowest_price)) . "</span>";
            if ($lowest_price !== '') {
                $results['text'] .=  "<span class='currency'>
                        <span>" . $currency_symbol . "</span>
                    </span>";
            }
            $results['text'] .=  "</div></div>";


            $results['price_in_digits_sale'] = number_format($lowest_price);
        }
        if ($lowest_price != '0' && $discount_percent != 0) {
            $results['text'] .=  "
            <div class='me-2'>
                <span class='number orginal-price-discounted-product'>
                    <del>" . vertuka_persian_number(number_format(vertuka_regular_price($product_id, $lowest_price))) . "</del>
                </span>
            </div>";

            $results['discount_percent'] =
                "<div class='ticket-box'>
                <div class='ticket'>" .
                esc_html(vertuka_the_persian_number($discount_percent)) . '%'
                . "</div>
            </div>";

            $results['price_in_digits_normal'] = number_format(vertuka_regular_price($product_id, $lowest_price));
        } else {
            if (!$on_sale_first && $variation_sale_status) {
                $results['custom_shape'] = '<img class="discount-icon" src="' . get_theme_file_uri('assets/images/special-icon.png') . '" alt="off shape">';
            }
        }
        $results['text'] .= "</div></div>";

        $results['stock_status'] = 'instock';

        return $results;
    }

    return $results;
}

function mj_same_price_everywhere_discount($product_id)
{
    // get product price
    $product = wc_get_product($product_id);
    $variation_stock_status = false;
    // if ($product->is_type('variable')) {
    //     $variations = $product->get_available_variations();
    //     foreach ($variations as $variation) {
    //         $variation_obj = new WC_Product_Variation($variation['variation_id']);
    //         if ($variation_obj->get_stock_status() == 'instock' && $variation_obj->get_stock_quantity() != 0) {
    //             $variation_stock_status = true;
    //             break;
    //         }
    //     }
    // }

    if ($product->is_type('variable')) {
        $variations = $product->get_available_variations();
        $prices = array();
        foreach ($variations as $variation) {
            $variation_obj = new WC_Product_Variation($variation['variation_id']);
            if ($variation_obj->get_price() != 0 && $variation_obj->get_stock_quantity() != 0) {
                $prices[] = $variation_obj->get_price();
                $variation_stock_status = true;
            }
            // $prices[] = $variation_obj->get_price();
        }
        // $lowest_price = min($prices);
        if (!empty($prices)) {
            $lowest_price = min($prices);
        } else {
            $lowest_price = false;
        }
        //
        sort($prices);
        foreach ($prices as $value) {
            if (vertuka_diacount_calculator($product_id, $value)) {
                $lowest_price = $value;
                break;
            }
        }
        //
    } else {
        $lowest_price = $product->get_price();
    }
    // $currency_symbol = get_woocommerce_currency_symbol();
    $discount_percent = vertuka_diacount_calculator($product_id, $lowest_price);

    if ($product->stock_status == 'outofstock' && !$variation_stock_status) {
        // ناموجود
    } else {
        if ($lowest_price != '0' && $discount_percent != 0) { ?>
            <div class="ticket-box">
                <div class="ticket">
                    <?php echo esc_html(vertuka_the_persian_number($discount_percent)) . '%'; ?>
                </div>
            </div>
<?php }
    }
}

//MJ 3 months cookie login expire
add_filter('auth_cookie_expiration', 'my_expiration_filter', 99, 3);
function my_expiration_filter($seconds, $user_id, $remember)
{

    //if "remember me" is checked;
    // if ( $remember ) {
    //     //WP defaults to 2 weeks;
    //     $expiration = 14*24*60*60; //UPDATE HERE;
    // } else {
    //     //WP defaults to 48 hrs/2 days;
    //     $expiration = 2*24*60*60; //UPDATE HERE;
    // }

    $expiration = 90 * 24 * 60 * 60; //UPDATE HERE;

    //http://en.wikipedia.org/wiki/Year_2038_problem
    if (PHP_INT_MAX - time() < $expiration) {
        //Fix to a little bit earlier!
        $expiration =  PHP_INT_MAX - time() - 5;
    }

    return $expiration;
}

///////////////////////////////


function IsHoliday($year, $month, $day)
{
    $holiday_data = [
        '1403' => [
            '1' => [
                '1' => 1,
                '2' => 1,
                '3' => 1,
                '4' => 1,
                '5' => 0,
                '6' => 0,
                '7' => 0,
                '8' => 0,
                '9' => 0,
                '10' => 1,
                '11' => 0,
                '12' => 1,
                '13' => 1,
                '14' => 0,
                '15' => 0,
                '16' => 0,
                '17' => 1,
                '18' => 0,
                '19' => 0,
                '20' => 0,
                '21' => 0,
                '22' => 1,
                '23' => 1,
                '24' => 1,
                '25' => 0,
                '26' => 0,
                '27' => 0,
                '28' => 0,
                '29' => 0,
                '30' => 0,
                '31' => 1,
            ],
            '2' => [
                '1' => 0,
                '2' => 0,
                '3' => 0,
                '4' => 0,
                '5' => 0,
                '6' => 0,
                '7' => 1,
                '8' => 0,
                '9' => 0,
                '10' => 0,
                '11' => 0,
                '12' => 0,
                '13' => 0,
                '14' => 1,
                '15' => 1,
                '16' => 0,
                '17' => 0,
                '18' => 0,
                '19' => 0,
                '20' => 0,
                '21' => 1,
                '22' => 0,
                '23' => 0,
                '24' => 0,
                '25' => 0,
                '26' => 0,
                '27' => 0,
                '28' => 1,
                '29' => 0,
                '30' => 0,
                '31' => 0,
            ],
            '3' => [
                '1' => 0,
                '2' => 0,
                '3' => 0,
                '4' => 1,
                '5' => 0,
                '6' => 0,
                '7' => 0,
                '8' => 0,
                '9' => 0,
                '10' => 0,
                '11' => 1,
                '12' => 0,
                '13' => 0,
                '14' => 1,
                '15' => 1,
                '16' => 0,
                '17' => 0,
                '18' => 1,
                '19' => 0,
                '20' => 0,
                '21' => 0,
                '22' => 0,
                '23' => 0,
                '24' => 0,
                '25' => 1,
                '26' => 0,
                '27' => 0,
                '28' => 1,
                '29' => 0,
                '30' => 0,
                '31' => 0
            ],
            '4' => [
                '1' => 1,
                '2' => 0,
                '3' => 0,
                '4' => 0,
                '5' => 1,
                '6' => 0,
                '7' => 0,
                '8' => 1,
                '9' => 0,
                '10' => 0,
                '11' => 0,
                '12' => 0,
                '13' => 0,
                '14' => 0,
                '15' => 1,
                '16' => 0,
                '17' => 0,
                '18' => 0,
                '19' => 0,
                '20' => 0,
                '21' => 0,
                '22' => 1,
                '23' => 0,
                '24' => 0,
                '25' => 1,
                '26' => 1,
                '27' => 0,
                '28' => 0,
                '29' => 1,
                '30' => 0,
                '31' => 0
            ],
            '5' => [
                '1' => 0,
                '2' => 0,
                '3' => 0,
                '4' => 0,
                '5' => 1,
                '6' => 0,
                '7' => 0,
                '8' => 0,
                '9' => 0,
                '10' => 0,
                '11' => 0,
                '12' => 1,
                '13' => 0,
                '14' => 0,
                '15' => 0,
                '16' => 0,
                '17' => 0,
                '18' => 0,
                '19' => 1,
                '20' => 0,
                '21' => 0,
                '22' => 0,
                '23' => 0,
                '24' => 0,
                '25' => 0,
                '26' => 1,
                '27' => 0,
                '28' => 0,
                '29' => 0,
                '30' => 0,
                '31' => 0
            ],
            '6' => [
                '1' => 0,
                '2' => 1,
                '3' => 0,
                '4' => 1,
                '5' => 0,
                '6' => 0,
                '7' => 0,
                '8' => 0,
                '9' => 1,
                '10' => 0,
                '11' => 0,
                '12' => 1,
                '13' => 0,
                '14' => 1,
                '15' => 0,
                '16' => 1,
                '17' => 0,
                '18' => 0,
                '19' => 0,
                '20' => 0,
                '21' => 0,
                '22' => 1,
                '23' => 1,
                '24' => 0,
                '25' => 0,
                '26' => 0,
                '27' => 0,
                '28' => 0,
                '29' => 0,
                '30' => 1,
                '31' => 1
            ],
            '7' => [
                '1' => 0,
                '2' => 0,
                '3' => 0,
                '4' => 0,
                '5' => 0,
                '6' => 1,
                '7' => 0,
                '8' => 0,
                '9' => 0,
                '10' => 0,
                '11' => 0,
                '12' => 0,
                '13' => 1,
                '14' => 0,
                '15' => 0,
                '16' => 0,
                '17' => 0,
                '18' => 0,
                '19' => 0,
                '20' => 1,
                '21' => 0,
                '22' => 0,
                '23' => 0,
                '24' => 0,
                '25' => 0,
                '26' => 0,
                '27' => 1,
                '28' => 0,
                '29' => 0,
                '30' => 0
            ],
            '8' => [
                '1' => 0,
                '2' => 0,
                '3' => 0,
                '4' => 1,
                '5' => 0,
                '6' => 0,
                '7' => 0,
                '8' => 0,
                '9' => 0,
                '10' => 0,
                '11' => 1,
                '12' => 0,
                '13' => 0,
                '14' => 0,
                '15' => 0,
                '16' => 0,
                '17' => 0,
                '18' => 1,
                '19' => 0,
                '20' => 0,
                '21' => 0,
                '22' => 0,
                '23' => 0,
                '24' => 0,
                '25' => 1,
                '26' => 0,
                '27' => 0,
                '28' => 0,
                '29' => 0,
                '30' => 0
            ],
            '9' => [
                '1' => 0,
                '2' => 1,
                '3' => 0,
                '4' => 0,
                '5' => 0,
                '6' => 0,
                '7' => 0,
                '8' => 0,
                '9' => 1,
                '10' => 0,
                '11' => 0,
                '12' => 0,
                '13' => 0,
                '14' => 0,
                '15' => 1,
                '16' => 1,
                '17' => 0,
                '18' => 0,
                '19' => 0,
                '20' => 0,
                '21' => 0,
                '22' => 0,
                '23' => 1,
                '24' => 0,
                '25' => 0,
                '26' => 0,
                '27' => 0,
                '28' => 0,
                '29' => 0,
                '30' => 1
            ],
            '10' => [
                '1' => 0,
                '2' => 0,
                '3' => 0,
                '4' => 0,
                '5' => 0,
                '6' => 0,
                '7' => 1,
                '8' => 0,
                '9' => 0,
                '10' => 0,
                '11' => 0,
                '12' => 0,
                '13' => 0,
                '14' => 1,
                '15' => 0,
                '16' => 0,
                '17' => 0,
                '18' => 0,
                '19' => 0,
                '20' => 0,
                '21' => 1,
                '22' => 0,
                '23' => 0,
                '24' => 0,
                '25' => 1,
                '26' => 0,
                '27' => 0,
                '28' => 1,
                '29' => 0,
                '30' => 0
            ],
            '11' => [
                '1' => 0,
                '2' => 0,
                '3' => 0,
                '4' => 0,
                '5' => 1,
                '6' => 0,
                '7' => 0,
                '8' => 0,
                '9' => 1,
                '10' => 0,
                '11' => 0,
                '12' => 1,
                '13' => 0,
                '14' => 0,
                '15' => 0,
                '16' => 0,
                '17' => 0,
                '18' => 0,
                '19' => 1,
                '20' => 0,
                '21' => 0,
                '22' => 1,
                '23' => 0,
                '24' => 0,
                '25' => 0,
                '26' => 1,
                '27' => 0,
                '28' => 0,
                '29' => 0,
                '30' => 0
            ],
            '12' => [
                '1' => 0,
                '2' => 0,
                '3' => 1,
                '4' => 0,
                '5' => 0,
                '6' => 0,
                '7' => 0,
                '8' => 0,
                '9' => 0,
                '10' => 1,
                '11' => 0,
                '12' => 0,
                '13' => 0,
                '14' => 0,
                '15' => 0,
                '16' => 0,
                '17' => 1,
                '18' => 0,
                '19' => 0,
                '20' => 0,
                '21' => 0,
                '22' => 0,
                '23' => 0,
                '24' => 1,
                '25' => 0,
                '26' => 0,
                '27' => 0,
                '28' => 0,
                '29' => 1,
                '30' => 1
            ],
        ],
        '1404' => [
            '1' => [
                '1' => 1,
                '2' => 1,
                '3' => 1,
                '4' => 1,
                '5' => 0,
                '6' => 0,
                '7' => 0,
                '8' => 1,
                '9' => 0,
                '10' => 0,
                '11' => 1,
                '12' => 1,
                '13' => 1,
                '14' => 0,
                '15' => 1,
                '16' => 0,
                '17' => 0,
                '18' => 0,
                '19' => 0,
                '20' => 0,
                '21' => 0,
                '22' => 1,
                '23' => 0,
                '24' => 0,
                '25' => 0,
                '26' => 0,
                '27' => 0,
                '28' => 0,
                '29' => 1,
                '30' => 0,
                '31' => 0,
            ],
            '2' => [
                '1' => 0,
                '2' => 0,
                '3' => 0,
                '4' => 1,
                '5' => 1,
                '6' => 0,
                '7' => 0,
                '8' => 0,
                '9' => 0,
                '10' => 0,
                '11' => 0,
                '12' => 1,
                '13' => 0,
                '14' => 0,
                '15' => 0,
                '16' => 0,
                '17' => 0,
                '18' => 0,
                '19' => 1,
                '20' => 0,
                '21' => 0,
                '22' => 0,
                '23' => 0,
                '24' => 0,
                '25' => 0,
                '26' => 1,
                '27' => 0,
                '28' => 0,
                '29' => 0,
                '30' => 0,
                '31' => 0,
            ],
            '3' => [
                '1' => 0,
                '2' => 1,
                '3' => 0,
                '4' => 0,
                '5' => 0,
                '6' => 0,
                '7' => 0,
                '8' => 0,
                '9' => 1,
                '10' => 0,
                '11' => 0,
                '12' => 0,
                '13' => 0,
                '14' => 1,
                '15' => 1,
                '16' => 1,
                '17' => 1,
                '18' => 0,
                '19' => 0,
                '20' => 0,
                '21' => 0,
                '22' => 0,
                '23' => 1,
                '24' => 0,
                '25' => 1,
                '26' => 0,
                '27' => 0,
                '28' => 0,
                '29' => 0,
                '30' => 1,
                '31' => 0
            ], // ta inja update shode
            '4' => [
                '1' => 0,
                '2' => 0,
                '3' => 0,
                '4' => 0,
                '5' => 0,
                '6' => 0,
                '7' => 0,
                '8' => 0,
                '9' => 0,
                '10' => 0,
                '11' => 0,
                '12' => 0,
                '13' => 0,
                '14' => 0,
                '15' => 0,
                '16' => 0,
                '17' => 0,
                '18' => 0,
                '19' => 0,
                '20' => 0,
                '21' => 0,
                '22' => 0,
                '23' => 0,
                '24' => 0,
                '25' => 0,
                '26' => 0,
                '27' => 0,
                '28' => 0,
                '29' => 0,
                '30' => 0,
                '31' => 0
            ],
            '5' => [
                '1' => 0,
                '2' => 0,
                '3' => 0,
                '4' => 0,
                '5' => 0,
                '6' => 0,
                '7' => 0,
                '8' => 0,
                '9' => 0,
                '10' => 0,
                '11' => 0,
                '12' => 0,
                '13' => 0,
                '14' => 0,
                '15' => 0,
                '16' => 0,
                '17' => 0,
                '18' => 0,
                '19' => 0,
                '20' => 0,
                '21' => 0,
                '22' => 0,
                '23' => 0,
                '24' => 0,
                '25' => 0,
                '26' => 0,
                '27' => 0,
                '28' => 0,
                '29' => 0,
                '30' => 0,
                '31' => 0
            ],
            '6' => [
                '1' => 0,
                '2' => 0,
                '3' => 0,
                '4' => 0,
                '5' => 0,
                '6' => 0,
                '7' => 0,
                '8' => 0,
                '9' => 0,
                '10' => 0,
                '11' => 0,
                '12' => 0,
                '13' => 0,
                '14' => 0,
                '15' => 0,
                '16' => 0,
                '17' => 0,
                '18' => 0,
                '19' => 0,
                '20' => 0,
                '21' => 0,
                '22' => 0,
                '23' => 0,
                '24' => 0,
                '25' => 0,
                '26' => 0,
                '27' => 0,
                '28' => 0,
                '29' => 0,
                '30' => 0,
                '31' => 0
            ],
            '7' => [
                '1' => 0,
                '2' => 0,
                '3' => 0,
                '4' => 0,
                '5' => 0,
                '6' => 0,
                '7' => 0,
                '8' => 0,
                '9' => 0,
                '10' => 0,
                '11' => 0,
                '12' => 0,
                '13' => 0,
                '14' => 0,
                '15' => 0,
                '16' => 0,
                '17' => 0,
                '18' => 0,
                '19' => 0,
                '20' => 0,
                '21' => 0,
                '22' => 0,
                '23' => 0,
                '24' => 0,
                '25' => 0,
                '26' => 0,
                '27' => 0,
                '28' => 0,
                '29' => 0,
                '30' => 0
            ],
            '8' => [
                '1' => 0,
                '2' => 0,
                '3' => 0,
                '4' => 0,
                '5' => 0,
                '6' => 0,
                '7' => 0,
                '8' => 0,
                '9' => 0,
                '10' => 0,
                '11' => 0,
                '12' => 0,
                '13' => 0,
                '14' => 0,
                '15' => 0,
                '16' => 0,
                '17' => 0,
                '18' => 0,
                '19' => 0,
                '20' => 0,
                '21' => 0,
                '22' => 0,
                '23' => 0,
                '24' => 0,
                '25' => 0,
                '26' => 0,
                '27' => 0,
                '28' => 0,
                '29' => 0,
                '30' => 0
            ],
            '9' => [
                '1' => 0,
                '2' => 0,
                '3' => 0,
                '4' => 0,
                '5' => 0,
                '6' => 0,
                '7' => 0,
                '8' => 0,
                '9' => 0,
                '10' => 0,
                '11' => 0,
                '12' => 0,
                '13' => 0,
                '14' => 0,
                '15' => 0,
                '16' => 0,
                '17' => 0,
                '18' => 0,
                '19' => 0,
                '20' => 0,
                '21' => 0,
                '22' => 0,
                '23' => 0,
                '24' => 0,
                '25' => 0,
                '26' => 0,
                '27' => 0,
                '28' => 0,
                '29' => 0,
                '30' => 0
            ],
            '10' => [
                '1' => 0,
                '2' => 0,
                '3' => 0,
                '4' => 0,
                '5' => 0,
                '6' => 0,
                '7' => 0,
                '8' => 0,
                '9' => 0,
                '10' => 0,
                '11' => 0,
                '12' => 0,
                '13' => 0,
                '14' => 0,
                '15' => 0,
                '16' => 0,
                '17' => 0,
                '18' => 0,
                '19' => 0,
                '20' => 0,
                '21' => 0,
                '22' => 0,
                '23' => 0,
                '24' => 0,
                '25' => 0,
                '26' => 0,
                '27' => 0,
                '28' => 0,
                '29' => 0,
                '30' => 0
            ],
            '11' => [
                '1' => 0,
                '2' => 0,
                '3' => 0,
                '4' => 0,
                '5' => 0,
                '6' => 0,
                '7' => 0,
                '8' => 0,
                '9' => 0,
                '10' => 0,
                '11' => 0,
                '12' => 0,
                '13' => 0,
                '14' => 0,
                '15' => 0,
                '16' => 0,
                '17' => 0,
                '18' => 0,
                '19' => 0,
                '20' => 0,
                '21' => 0,
                '22' => 0,
                '23' => 0,
                '24' => 0,
                '25' => 0,
                '26' => 0,
                '27' => 0,
                '28' => 0,
                '29' => 0,
                '30' => 0
            ],
            '12' => [
                '1' => 0,
                '2' => 0,
                '3' => 0,
                '4' => 0,
                '5' => 0,
                '6' => 0,
                '7' => 0,
                '8' => 0,
                '9' => 0,
                '10' => 0,
                '11' => 0,
                '12' => 0,
                '13' => 0,
                '14' => 0,
                '15' => 0,
                '16' => 0,
                '17' => 0,
                '18' => 0,
                '19' => 0,
                '20' => 0,
                '21' => 0,
                '22' => 0,
                '23' => 0,
                '24' => 0,
                '25' => 0,
                '26' => 0,
                '27' => 0,
                '28' => 0,
                '29' => 0,
                '30' => 0
            ],
        ],
    ];

    if (isset($holiday_data[(int)$year][(int)$month][(int)$day])) {
        // return var_dump((int)$year, (int)$month, (int)$day);
        return $holiday_data[(int)$year][(int)$month][(int)$day];
    }
    return false;
}

////////////////////////////////
function convert2english($string)
{
    $newNumbers = range(0, 9);
    // 1. Persian HTML decimal
    $persianDecimal = array('&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;');
    // 2. Arabic HTML decimal
    $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
    // 3. Arabic Numeric
    $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
    // 4. Persian Numeric
    $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

    $string =  str_replace($persianDecimal, $newNumbers, $string);
    $string =  str_replace($arabicDecimal, $newNumbers, $string);
    $string =  str_replace($arabic, $newNumbers, $string);
    return str_replace($persian, $newNumbers, $string);
}


add_filter('robots_txt', 'addToRoboText');
function addToRoboText($robotext)
{
    // User-agent: Amazonbot             # Amazon's user agent
    // Disallow: /          # disallow this directory

    $additions = "
        User-agent: *
        Disallow: /compare/
        User-agent: *
        Disallow: /testing/
        User-agent: *
        Disallow: /ads.html/
    ";
    return $robotext . $additions;
}

if (!function_exists('yith_wcan_robots')) {
    function yith_wcan_robots($robots)
    {
        if (!empty($_GET['yith_wcan'])) {
            $robots['index'] = 'noindex';
            $robots['follow'] = 'nofollow';
        }
        return $robots;
    }
    add_filter('rank_math/frontend/robots', 'yith_wcan_robots');
}
//////////////////////////// CRM ////////////////////////////
function CRM_CALL($methond, $url, $data_array)
{
    $data_array['UserName'] = CRM_USER;
    $data_array['Password'] = CRM_PASSWORD;
    $data_array['UserId'] = CRM_USER_Submit;
    $data = http_build_query($data_array);
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://' . CRM_ip_and_port . $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $methond,
        CURLOPT_POSTFIELDS => $data,
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

function CRM_temp_reset()
{
    $cart = WC()->cart;
    $cart_item_count = $cart->get_cart_contents_count();
    if (!$cart_item_count) {
        # code...
    }
    $user = wp_get_current_user();
    update_user_meta($user->ID, 'CRM_user_id', 0);
    update_user_meta($user->ID, 'CRM_Last_Project_ID', 0);
    update_user_meta($user->ID, 'CRM_person_id', 0);
}
// add_action('MJ_CRM_RESET_TEMPS', 'CRM_temp_reset', 11, 3);

function register_user_to_crm()
{
    $user = wp_get_current_user();
    if (!get_user_meta($user->ID, 'CRM_user_id', true) && is_user_logged_in()) {
        $user = wp_get_current_user();
        $user_info = get_userdata($user->ID);
        $mobile = $user_info->user_login;
        $data_array = array(
            'UserName' => '',
            'Password' => '',
            'UserId' => '',
            'ApiCmpNumber' => '',
            'ApiCmpName' => 'کاربر گرامی' . $mobile,
            'ApiCmpNameEng' => '',
            'ApiCmpTitleId' => '',
            'ApiCmpFame' => '',
            'ApiCmpActivityType' => '',
            'ApiCmpGroupId' => '',
            'ApiCmpSubGroupId' => '',
            'ApiCmpGroupIdII' => '',
            'ApiCmpGroupIdIII' => '',
            'ApiCmpGroupIdIV' => '',
            'ApiCmpTypeId' => '',
            'ApiCmpPresentationId' => '',
            'ApiCmpPreTel' => '',
            'ApiCmpTel' => '',
            'ApiCmpTelUpTo' => '',
            'ApiCmpTelDesc' => '',
            'ApiCmpPreTelII' => '',
            'ApiCmpTelII' => '',
            'ApiCmpTelUpToII' => '',
            'ApiCmpTelIIDesc' => '',
            'ApiCmpMobile' => $mobile,
            'ApiCmpFax' => '',
            'ApiCmpFaxDesc' => '',
            'ApiCmpCountryId' => '',
            'ApiCmpProvinceId' => '',
            'ApiCmpCityId' => '',
            'ApiCmpAddress' => '',
            'ApiCmpAddressDesc' => '',
            'ApiCmpZipCode' => '',
            'ApiCmpPostBox' => '',
            'ApiCmpWebSite' => '',
            'ApiCmpEmail' => '',
            'ApiCmpInteresting' => '',
            'ApiCmpSpecialPoint' => '',
            'ApiCmpDescription' => '',
            'ApiCmpUserName' => '',
            'ApiCmpPassword' => '',
            'ApiCmpRegistrationNumber' => '',
            'ApiCmpEconomicCode' => '',
            'ApiCmpNationalCode' => '',
            'ApiCmpBuyLimit' => '',
            'ApiCmpAccountNumber' => '',
            'ApiCmpAccInquiry' => '',
            'ApiCmpFreight' => '',
            'ApiCmpInquiry' => '',
            'ApiCmpReferUserId' => '',
            'ApiCmpSpecialWordForCI' => '',
            'ApiCmpCode' => '', // id ke bedym karbar 
            'ApiCmpEffectiveDateTime' => '',
            'ApiCmpCoordinateLatitude' => '',
            'ApiCmpCoordinateLongitude' => '',
            'ApiCmpCoordinateLastDate' => '',
            'ApiCmpCoordinateZoomLevel' => '',
            'ApiCmpCoordinateLastUserId' => '',
            'ApiCmpFOAccessLinkedCompany' => '',
            'CmpCodeNotDup' => '',
            'CmpTelNotDup' => '',
            'CmpFaxNotDup' => '',
            'LanguageId' => '',
            'ApiCmpCampaignIds' => '',
        );
        $result = CRM_CALL('POST', '/Api/ApiCompany/Insert', $data_array);
        if (json_decode($result)->Data) {
            update_user_meta($user->ID, 'CRM_user_id', json_decode($result)->Data);
        }
        register_user_to_crm_update();
        CRM_user_company_person_insert();
    }
}
add_action('MJ_CRM_REGISTER', 'register_user_to_crm', 10, 3);


function register_user_to_crm_update()
{
    $user = wp_get_current_user();
    $user_info = get_userdata($user->ID);
    $mobile = $user_info->user_login;
    if ($mobile && get_user_meta($user->ID, 'CRM_user_id', true)) {
        $CRM_user_data = CRM_user_search_by_mobile();
        if (json_decode($CRM_user_data)->Data[0]->ApiCompanyID) {
            $CompanyID = json_decode($CRM_user_data)->Data[0]->ApiCompanyID;
            $data_array = array(
                'UserName' => '',
                'Password' => '',
                'UserId' => '',
                'ApiCompanyId' => $CompanyID,
                'ApiCmpNumber' => '',
                'ApiCmpName' => 'کاربر گرامی',
                'ApiCmpNameEng' => '',
                'ApiCmpTitleId' => '',
                'ApiCmpFame' => '',
                'ApiCmpActivityType' => '',
                'ApiCmpGroupId' => '',
                'ApiCmpSubGroupId' => '',
                'ApiCmpGroupIdII' => '',
                'ApiCmpGroupIdIII' => '',
                'ApiCmpGroupIdIV' => '',
                'ApiCmpTypeId' => '',
                'ApiCmpPresentationId' => '',
                'ApiCmpPreTel' => '',
                'ApiCmpTel' => '',
                'ApiCmpTelUpTo' => '',
                'ApiCmpTelDesc' => '',
                'ApiCmpPreTelII' => '',
                'ApiCmpTelII' => '',
                'ApiCmpTelUpToII' => '',
                'ApiCmpTelIIDesc' => '',
                'ApiCmpMobile' => '',
                'ApiCmpFax' => '',
                'ApiCmpFaxDesc' => '',
                'ApiCmpCountryId' => '',
                'ApiCmpProvinceId' => '',
                'ApiCmpCityId' => '',
                'ApiCmpAddress' => '',
                'ApiCmpAddressDesc' => '',
                'ApiCmpZipCode' => '',
                'ApiCmpPostBox' => '',
                'ApiCmpWebSite' => '',
                'ApiCmpEmail' => '',
                'ApiCmpInteresting' => '',
                'ApiCmpSpecialPoint' => '',
                'ApiCmpDescription' => '',
                'ApiCmpUserName' => '',
                'ApiCmpPassword' => '',
                'ApiCmpRegistrationNumber' => '',
                'ApiCmpEconomicCode' => '',
                'ApiCmpNationalCode' => '',
                'ApiCmpBuyLimit' => '',
                'ApiCmpAccountNumber' => '',
                'ApiCmpAccInquiry' => '',
                'ApiCmpFreight' => '',
                'ApiCmpInquiry' => '',
                'ApiCmpReferUserId' => '',
                'ApiCmpSpecialWordForCI' => '',
                'ApiCmpCode' => $user->ID,
                'ApiCmpEffectiveDatePersian' => '',
                'ApiCmpEffectiveDateTime' => '',
                'ApiCmpCoordinateLatitude' => '',
                'ApiCmpCoordinateLongitude' => '',
                'ApiCmpCoordinateLastDatePersian' => '',
                'ApiCmpCoordinateLastDate' => '',
                'ApiCmpCoordinateZoomLevel' => '',
                'ApiCmpCoordinateLastUserId' => '',
                'ApiCmpFOAccessLinkedCompany' => '',
                'ApiCmpIsDraft' => '',
                'ApiCmpKind' => 1,
                'ApiCmpMainPersonId' => '',
                'CmpCodeNotDup' => '',
                'CmpTelNotDup' => '',
                'CmpFaxNotDup' => '',
                'LanguageId' => '',
                'ApiCmpCampaignIds' => '',
            );
            $result = CRM_CALL('POST', '/Api/ApiCompany/Update', $data_array);
        }
    }
}
function CRM_user_company_person_insert()
{
    $user = wp_get_current_user();
    $user_info = get_userdata($user->ID);
    $mobile = $user_info->user_login;
    if ($mobile && get_user_meta($user->ID, 'CRM_user_id', true)) {
        $CRM_user_data = CRM_user_search_by_mobile();
        if (json_decode($CRM_user_data)->Data[0]->ApiCompanyID) {
            $CompanyID = json_decode($CRM_user_data)->Data[0]->ApiCompanyID;
            $data_array = array(
                'UserName' => '',
                'Password' => '',
                'UserId' => '',
                'ApiCompanyId' => $CompanyID,
                'ApiCmpNumber' => '',
                'ApiCmpCode' => '',
                'ApiPrsLName' => 'گرامی',
                'ApiPrsFName' => 'کاربر',
                'ApiPrsTitleId' => '',
                'ApiPrsJobId' => '',
                'ApiPrsTypeId' => '',
                'ApiPrsGroupId' => '',
                'ApiPrsSexId' => '',
                'ApiPrsEducationId' => '',
                'ApiPrsPreTel' => '',
                'ApiPrsTel' => '',
                'ApiPrsTelUpTo' => '',
                'ApiPrsTelDesc' => '',
                'ApiPrsTelII' => '',
                'ApiPrsFax' => '',
                'ApiPrsFaxDesc' => '',
                'ApiPrsMobile' => $mobile,
                'ApiPrsWebSite' => '',
                'ApiPrsEmail' => '',
                'ApiPrsEmailII' => '',
                'ApiPrsCountryId' => '',
                'ApiPrsProvinceId' => '',
                'ApiPrsCityId' => '',
                'ApiPrsAddress' => '',
                'ApiPrsAddressDesc' => '',
                'ApiPrsZipCode' => '',
                'ApiPrsPostBox' => '',
                'ApiPrsNationalCode' => '',
                'ApiPrsIdentityNumber' => '',
                'ApiPrsFatherName' => '',
                'ApiPrsBirthDateTime' => '',
                'ApiPrsBirthPlace' => '',
                'ApiPrsIsMarried' => '',
                'ApiPrsMarriageDateTime' => '',
                'ApiPrsEducationField' => '',
                'ApiPrsSkill' => '',
                'ApiPrsStudyField' => '',
                'ApiPrsInteresting' => '',
                'ApiPrsSpecialPoint' => '',
                'ApiPrsDescription' => '',
                'ApiPrsDepartmentId' => '',
                'ApiPrsStopSendSms' => '',
                'ApiPrsOrderView' => '',
                'ApiPrsWorkingOut' => '',
                'ApiPrsTelegramId' => '',
                'PrsTelNotDup' => ' ',
                'PrsFaxNotDup' => '',
                'LanguageId' => '',
            );

            $result = CRM_CALL('POST', '/Api/ApiCompanyPerson/Insert', $data_array);
            update_user_meta($user->ID, 'CRM_person_id', json_decode($result)->Data);
        }
    }
}


function CRM_user_search_by_mobile()
{
    $user = wp_get_current_user();
    $user_info = get_userdata($user->ID);
    $mobile = $user_info->user_login;

    if (!$mobile) {
        global $current_user;
        // $user = wp_get_current_user();
        $user_info = get_userdata($current_user->data->ID);
        $mobile = $user_info->data->user_login;
    }

    $data_array = array(
        'UserName' => '',
        'Password' => '',
        'UserId' => '',
        'ApiFieldName' => 'CmpMob',
        'ApiFieldValue' => $mobile,
    );
    return CRM_CALL('POST', '/Api/ApiCompany/CompanyMultiSelect', $data_array);
}
// add_action('MJ_CRM_MAKE_PROJECT', 'CRM_user_search_by_mobile', 10, 3);

function CRM_user_search_by_siteUserId()
{
    $user = wp_get_current_user();
    $data_array = array(
        'UserName' => '',
        'Password' => '',
        'UserId' => '',
        'ApiFieldName' => 'CmpCode',
        'ApiFieldValue' => $user->ID,
    );

    $result = CRM_CALL('POST', '/Api/ApiCompany/CompanyMultiSelect', $data_array);
    return $result;
}


function CRM_crate_project()
{
    $user = wp_get_current_user();
    $user_info = get_userdata($user->ID);
    $mobile = $user_info->user_login;

    $cart = WC()->cart;
    $cart_item_count = $cart->get_cart_contents_count();
    if ($mobile && $cart_item_count && is_user_logged_in()) {
        $CRM_user_data = CRM_user_search_by_mobile();
        // $CRM_user_data = CRM_user_search_by_siteUserId();
        if (json_decode($CRM_user_data)->Data[0]->ApiCompanyID) {
            $CompanyID = json_decode($CRM_user_data)->Data[0]->ApiCompanyID;
            $CmpNumber = json_decode($CRM_user_data)->Data[0]->ApiCmpNumber;
            $CmpCode = json_decode($CRM_user_data)->Data[0]->ApiCmpCode;


            $project_title = 'ورتوکا فروش آنلاین';
            $data_array = array(
                'UserName' => '',
                'Password' => '',
                'UserId' => '',
                'ApiCompanyId' => $CompanyID,
                'ApiCmpNumber' => $CmpNumber,
                'ApiCmpCode' => $CmpCode,
                'ApiPrjTitle' => $project_title,
                'ApiPrjDesc' => '',
                'ApiPrjStartDateTime' => '',
                'ApiPrjStarterUserId' => '',
                'ApiPrjFinishedStatusId' => '',
                'ApiPrjIsFinished' => '',
                'ApiPrjFinishedDateTime' => '',
                'ApiPrjFinishedUserId' => '',
                'ApiPrjGradeId' => '',
                'ApiPrjPriorityId' => '',
                'ApiPrjGroupId' => '',
                'ApiPrjCnvsStatusGroupId' => 13, //bara inke on masyr ro shenasayy kone
                'ApiPrjOrderView' => '',
                'ApiPrjPostFix' => '',
                'ApiPrjRemindDateTime' => '',
                'ApiPrjFOCmpCanSee' => '',
                'ApiPrjIsTicket' => '',
                'ApiPrjUserDepartmentId' => '',
                'ApiPrjInsertCrmProjectForbiddenFUFDPActive' => '',
                'ApiPrjInsertProjectInformationsDefualtFieldActive' => '',
                'PrjPostFixNotDup' => '',
                'PrjDescNotDup' => '',
                'LanguageId' => '',
                'ApiPrjCmpPresentationId' => '',
                'ApiPrjCmpCampaignIds' => '',
            );

            $result = CRM_CALL('POST', '/Api/ApiProject/Insert', $data_array);
            update_user_meta($user->ID, 'CRM_Last_Project_ID', json_decode($result)->Data);
        }
    }
}
// add_action('MJ_CRM_MAKE_PROJECT', 'CRM_crate_project', 10, 3);

function on_action_cart_updated()
{
    $user = wp_get_current_user();
    $user_info = get_userdata($user->ID);
    $mobile = $user_info->user_login;

    if (is_user_logged_in() && !get_user_meta($user->ID, 'CRM_Last_Project_ID', true)) {
        CRM_crate_project();
        CRM_create_Conversation();
    } else {
        CRM_conversation_update();
    }
}
add_action('MJ_CRM_MAKE_PROJECT', 'on_action_cart_updated', 10, 3);
//
function CRM_create_Conversation()
{
    $user = wp_get_current_user();
    $user_info = get_userdata($user->ID);
    $mobile = $user_info->user_login;

    if ($mobile) {
        $CRM_user_data = CRM_user_search_by_mobile();
        if (json_decode($CRM_user_data)->Data[0]->ApiCompanyID) {
            $CompanyID = json_decode($CRM_user_data)->Data[0]->ApiCompanyID;
            $CmpNumber = json_decode($CRM_user_data)->Data[0]->ApiCmpNumber;
            $CmpCode = json_decode($CRM_user_data)->Data[0]->ApiCmpCode;
            $project_title = 'ورتوکا فروش آنلاین';
            $CRM_Last_Project_ID = get_user_meta($user->ID, 'CRM_Last_Project_ID', true);
            $data_array = array(
                'UserName' => '',
                'Password' => '',
                'UserId' => '',
                'ApiCompanyId' => $CompanyID,
                'ApiCmpNumber' => $CmpNumber,
                'ApiCmpCode' => $CmpCode,
                'ApiPersonId' => '',
                'ApiProjectId' => $CRM_Last_Project_ID,
                'ApiPrjTitle' => 'تست',
                'ApiCnvsDateTime' => '',
                'ApiCnvsTopicId' => 16, // vertuka
                'ApiCnvsSubject' => '',
                'ApiCnvsDesc' => CRM_conversation_text(),
                'ApiCnvsUserId' => '',
                'ApiCnvsReferUserId' => '',
                'ApiCnvsReferDesc' => '',
                'ApiCnvsStatusId' => 125,
                'ApiCnvsPriorityId' => '',
                'ApiCnvsRemindDateTime' => '',
                'ApiCnvsRemindTime' => '',
                'ApiCnvsRemindOk' => '',
                'ApiCnvsIsBookMark' => '',
                'ApiCnvsRemindDateTimeForAllarm' => '',
                'ApiCnvsApiId' => '',
                'ApiCnvsFOCmpCanSee' => '',
                'ApiCnvsIsTicket' => '',
                'ApiCnvsCoordinateLatitude' => '',
                'ApiCnvsCoordinateLongitude' => '',
                'ApiCnvsCoordinateLastDate' => '',
                'ApiCnvsTicketIsRead' => '',
                'ApiCnvsDoingTime' => '',
                'ApiCnvsIsCopy' => '',
                'ApiCnvsReferToMultilUser' => '',
                'ApiCnvsEventPolicyNeedCheck' => '',
                'LanguageId' => '',
            );
            $result = CRM_CALL('POST', '/Api/ApiConversation/Insert', $data_array);
            update_user_meta($user->ID, 'CRM_Last_Conversation_ID', json_decode($result)->Data);
        }
    }
}

function CRM_conversation_update()
{
    $user = wp_get_current_user();
    $user_info = get_userdata($user->ID);
    $mobile = $user_info->user_login;

    if ($mobile) {
        $CRM_user_data = CRM_user_search_by_mobile();
        if (json_decode($CRM_user_data)->Data[0]->ApiCompanyID) {
            $CompanyID = json_decode($CRM_user_data)->Data[0]->ApiCompanyID;
            $CmpNumber = json_decode($CRM_user_data)->Data[0]->ApiCmpNumber;
            $CmpCode = json_decode($CRM_user_data)->Data[0]->ApiCmpCode;
            $project_title = 'ورتوکا فروش آنلاین';
            $CRM_Last_Project_ID = get_user_meta($user->ID, 'CRM_Last_Project_ID', true);
            $CRM_Last_Conversation_ID = get_user_meta($user->ID, 'CRM_Last_Conversation_ID', true);

            if (1) {

                $data_array = array(
                    'UserName' => '',
                    'Password' => '',
                    'UserId' => '',
                    'ApiCompanyId' => $CompanyID,
                    'ApiPersonId' => '',
                    'ApiProjectId' => $CRM_Last_Project_ID,
                    'ApiConversationId' => $CRM_Last_Conversation_ID,
                    'ApiCnvsDate' => '',
                    'ApiCnvsDateTime' => '',
                    'ApiCnvsTopicId' => 16, // vertuka 16
                    'ApiCnvsSubject' => '',
                    'ApiCnvsDesc' => CRM_conversation_text(),
                    'ApiCnvsUserId' => '',
                    'ApiCnvsReferUserId' => '',
                    'ApiCnvsReferDesc' => '',
                    'ApiCnvsStatusId' => 125, // 1- در انتظار پرداخت |درصد پیشرفت: 1  125
                    'ApiCnvsPriorityId' => '',
                    'ApiCnvsRemindDate' => '',
                    'ApiCnvsRemindDateTime' => '',
                    'ApiCnvsRemindTime' => '',
                    'ApiCnvsRemindOk' => '',
                    'ApiCnvsIsBookMark' => '',
                    'ApiCnvsRemindDateForAllarm' => '',
                    'ApiCnvsRemindDateTimeForAllarm' => '',
                    'ApiCnvsApiId' => '',
                    'ApiCnvsFOCmpCanSee' => '',
                    'ApiCnvsIsTicket' => '',
                    'ApiCnvsCoordinateLatitude' => '',
                    'ApiCnvsCoordinateLongitude' => '',
                    'ApiCnvsCoordinateLastDatePersian' => '',
                    'ApiCnvsCoordinateLastDate' => '',
                    'ApiCnvsTicketIsRead' => '',
                    'ApiCnvsDoingTimeStr' => '',
                    'ApiCnvsDoingTime' => '',
                    'ApiCnvsIsCopy' => '',
                    'LanguageId' => '',
                );

                $result = CRM_CALL('POST', '/Api/ApiConversation/Update', $data_array);
            }
        }
    }
}
// add_action('MJ_testing', 'CRM_conversation_update', 10, 3);

function CRM_conversation_text()
{
    $test = '';
    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
        $product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
        $test .= convert2english($cart_item['quantity'] . ' عدد ' . $product_name . " به قیمت  " . wc_get_price_excluding_tax($_product) . '
');
    }
    return $test;
}

function CRM_conversation_text_update($order)
{
    $test = '';
    // Iterating through each WC_Order_Item_Product objects
    foreach ($order->get_items() as $item_key => $item):
        $test .= convert2english($item->get_quantity() . ' عدد ' . $item->get_name() . ' به قیمت ' . $item->get_total() . '
');
    endforeach;

    $notes = wc_get_order_notes([
        'order_id' => $order->get_id(),
        // 'type' => 'customer',
    ]);
    $test .= '------- SHIPPING -------
';

    $shipping_address = $order->get_formatted_shipping_address();
    $shipping_address = str_replace(array('<br/>', '<br>', '< br>', '</ br>'), ', ', $shipping_address);
    $shipping_address = explode(", ", $shipping_address);
    unset($shipping_address[0]);
    $postcode = $shipping_address[count($shipping_address)];
    unset($shipping_address[count($shipping_address)]);


    $test .= convert2english(implode(", ", $shipping_address) . ' کد پستی ' . $order->shipping_postcode . ' آقا/خانم ' . $order->shipping_first_name . ' ' . $order->shipping_last_name) . '
';


    $test .= '------- NOTES -------
';
    foreach ($notes as $note):
        $text2 = str_replace('<span class="description">', "", $note->content);
        $text2 = str_replace('</span>', "", $text2);
        $text2 = str_replace('<br>-', "", $text2);
        $text2 = str_replace('&times;', "", $text2);
        $text2 = str_replace('&rarr;', "", $text2);

        $test .= convert2english($text2) . '

';
    endforeach;


    return $test;
}

// add_action('MJ_CRM_MAKE_PROJECT', 'CRM_conversation_text', 10, 3);

function registered_user_crm_update($data)
{
    global $current_user;
    $user_info = get_userdata($current_user->data->ID);
    $mobile = $user_info->data->user_login;
    if ($mobile) {
        if (get_user_meta($current_user->data->ID, 'CRM_user_id', true)) {
            $CompanyID = get_user_meta($current_user->data->ID, 'CRM_user_id', true);
            $haghigh_hoghoghy = 1;
            if (get_user_meta($current_user->data->ID, 'economic_id', true)) {
                $haghigh_hoghoghy = 0;
            }

            $data_array = array(
                'UserName' => '',
                'Password' => '',
                'UserId' => '',
                'ApiCompanyId' => $CompanyID,
                'ApiCmpNumber' => '',
                'ApiCmpName' => get_user_meta($current_user->data->ID, 'first_name', true) . ' ' . get_user_meta($current_user->data->ID, 'last_name', true),
                'ApiCmpNameEng' => '',
                'ApiCmpTitleId' => '',
                'ApiCmpFame' => '',
                'ApiCmpActivityType' => '',
                'ApiCmpGroupId' => '',
                'ApiCmpSubGroupId' => '',
                'ApiCmpGroupIdII' => '',
                'ApiCmpGroupIdIII' => '',
                'ApiCmpGroupIdIV' => '',
                'ApiCmpTypeId' => '',
                'ApiCmpPresentationId' => '',
                'ApiCmpPreTel' => '',
                'ApiCmpTel' => '',
                'ApiCmpTelUpTo' => '',
                'ApiCmpTelDesc' => '',
                'ApiCmpPreTelII' => '',
                'ApiCmpTelII' => '',
                'ApiCmpTelUpToII' => '',
                'ApiCmpTelIIDesc' => '',
                'ApiCmpMobile' => '',
                'ApiCmpFax' => '',
                'ApiCmpFaxDesc' => '',
                'ApiCmpCountryId' => '',
                'ApiCmpProvinceId' => '',
                'ApiCmpCityId' => '',
                'ApiCmpAddress' => '',
                'ApiCmpAddressDesc' => '',
                'ApiCmpZipCode' => '',
                'ApiCmpPostBox' => '',
                'ApiCmpWebSite' => '',
                'ApiCmpEmail' => '',
                'ApiCmpInteresting' => '',
                'ApiCmpSpecialPoint' => '',
                'ApiCmpDescription' => '',
                'ApiCmpUserName' => '',
                'ApiCmpPassword' => '',
                // MJ
                'ApiCmpNameOfficial' => '',
                // MJ
                'ApiCmpRegistrationNumber' => '',
                'ApiCmpEconomicCode' => '',
                'ApiCmpNationalCode' => '',
                'ApiCmpBuyLimit' => '',
                'ApiCmpAccountNumber' => '',
                'ApiCmpAccInquiry' => '',
                'ApiCmpFreight' => '',
                'ApiCmpInquiry' => '',
                'ApiCmpReferUserId' => '',
                'ApiCmpSpecialWordForCI' => '',
                'ApiCmpCode' => $current_user->data->ID,
                'ApiCmpEffectiveDatePersian' => '',
                'ApiCmpEffectiveDateTime' => '',
                'ApiCmpCoordinateLatitude' => '',
                'ApiCmpCoordinateLongitude' => '',
                'ApiCmpCoordinateLastDatePersian' => '',
                'ApiCmpCoordinateLastDate' => '',
                'ApiCmpCoordinateZoomLevel' => '',
                'ApiCmpCoordinateLastUserId' => '',
                'ApiCmpFOAccessLinkedCompany' => '',
                'ApiCmpIsDraft' => '',
                'ApiCmpKind' => 1, // $haghigh_hoghoghy, // 1 haghigh 0 hoghoghy
                'ApiCmpMainPersonId' => '',
                'CmpCodeNotDup' => '',
                'CmpTelNotDup' => '',
                'CmpFaxNotDup' => '',
                'LanguageId' => '',
                'ApiCmpCampaignIds' => '',
            );
            $result = CRM_CALL('POST', '/Api/ApiCompany/Update', $data_array);
            CRM_user_company_person_update();
        }
    }
}
add_action('MJ_CRM_UPDATE_PERSON', 'registered_user_crm_update', 10, 3);

function CRM_user_company_person_update()
{
    global $current_user;
    $user_info = get_userdata($current_user->data->ID);
    $mobile = $user_info->data->user_login;
    if ($mobile) {
        $CRM_user_data = CRM_user_search_by_mobile();
        if (json_decode($CRM_user_data)->Data[0]->ApiCompanyID) {
            $CompanyID = json_decode($CRM_user_data)->Data[0]->ApiCompanyID;
            $data_array = array(
                'UserName' => '',
                'Password' => '',
                'UserId' => '',
                'ApiCompanyId' => $CompanyID,
                'ApiCompanyPersonId' => get_user_meta($current_user->data->ID, 'CRM_person_id', true),
                'ApiPrsLName' =>  get_user_meta($current_user->data->ID, 'last_name', true),
                'ApiPrsFName' => get_user_meta($current_user->data->ID, 'first_name', true),
                'ApiPrsTitleId' => '',
                'ApiPrsJobId' => '',
                'ApiPrsTypeId' => '',
                'ApiPrsGroupId' => '',
                'ApiPrsSexId' => '',
                'ApiPrsEducationId' => '',
                'ApiPrsPreTel' => '',
                'ApiPrsTel' => '',
                'ApiPrsTelUpTo' => '',
                'ApiPrsTelDesc' => '',
                'ApiPrsTelII' => '',
                'ApiPrsFax' => '',
                'ApiPrsFaxDesc' => '',
                'ApiPrsMobile' => $mobile,
                'ApiPrsWebSite' => '',
                'ApiPrsEmail' => '',
                'ApiPrsEmailII' => '',
                'ApiPrsCountryId' => '',
                'ApiPrsProvinceId' => '',
                'ApiPrsCityId' => '',
                'ApiPrsAddress' => '',
                'ApiPrsAddressDesc' => '',
                'ApiPrsZipCode' => '',
                'ApiPrsPostBox' => '',
                'ApiPrsNationalCode' => '',
                'ApiPrsIdentityNumber' => '',
                'ApiPrsFatherName' => '',
                'ApiPrsBirthDate' => '',
                'ApiPrsBirthDateTime' => '',
                'ApiPrsBirthPlace' => '',
                'ApiPrsIsMarried' => '',
                'ApiPrsMarriageDate' => '',
                'ApiPrsMarriageDateTime' => '',
                'ApiPrsEducationField' => '',
                'ApiPrsSkill' => '',
                'ApiPrsStudyField' => '',
                'ApiPrsInteresting' => '',
                'ApiPrsSpecialPoint' => '',
                'ApiPrsDescription' => '',
                'ApiPrsDepartmentId' => '',
                'ApiPrsStopSendSms' => '',
                'ApiPrsOrderView' => '',
                'ApiPrsWorkingOut' => '',
                'ApiPrsTelegramId' => '',
                'PrsTelNotDup' => '',
                'PrsFaxNotDup' => '',
                'LanguageId' => '',
            );
            $result = CRM_CALL('POST', '/Api/ApiCompanyPerson/Update', $data_array);
        }
    }
}

//
function CRM_addresses_as_a_person()
{
    $user = wp_get_current_user();
    $user_info = get_userdata($user->ID);
    $mobile = $user_info->user_login;
    if ($mobile) {

        global $wpdb;
        $table = $wpdb->prefix . "med_addresspress";
        $user_data_stored = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM {$table} WHERE user_id = %s ORDER BY id DESC;",
                $user->ID
            )
        );

        if (count($user_data_stored) && get_user_meta($user->ID, 'CRM_user_id', true)) {
            $CompanyID = get_user_meta($user->ID, 'CRM_user_id', true);
            $CRM_user_data = CRM_user_search_by_mobile();
            $CompanyID = json_decode($CRM_user_data)->Data[0]->ApiCompanyID;
            $CmpNumber = json_decode($CRM_user_data)->Data[0]->ApiCmpNumber;

            if ($CompanyID) {
                $data_array = array(
                    'UserName' => '',
                    'Password' => '',
                    'ApiCompanyId' => $CompanyID,
                    'ApiCompanyPersonId' => '',
                    'LanguageId' => '',
                );
                $result = CRM_CALL('POST', '/Api/ApiCompanyPerson/Select', $data_array);
                if (get_user_meta($user->ID, 'CRM_person_id', true)) {

                    foreach (json_decode($result)->Data as $person_address) {
                        if (get_user_meta($user->ID, 'CRM_person_id', true) != $person_address->ApiCompanyPersonID) {
                            $data_array_remove = array(
                                'UserName' => '',
                                'Password' => '',
                                'ApiCompanyPersonId' => $person_address->ApiCompanyPersonID,
                                'LanguageId' => '',
                            );
                            $result_remove = CRM_CALL('POST', '/Api/ApiCompanyPerson/Delete', $data_array_remove);
                        }
                    }
                }

                foreach ($user_data_stored as $address) {
                    $data_array_insert = array(
                        'UserName' => '',
                        'Password' => '',
                        'UserId' => '',
                        'ApiCompanyId' => $CompanyID,
                        'ApiCmpNumber' => '',
                        'ApiCmpCode' => '',
                        'ApiPrsLName' => unserialize($address->address_data)['last-name'],
                        'ApiPrsFName' => unserialize($address->address_data)['first-name'],
                        'ApiPrsTitleId' => '',
                        'ApiPrsJobId' => '',
                        'ApiPrsTypeId' => '',
                        'ApiPrsGroupId' => '',
                        'ApiPrsSexId' => '',
                        'ApiPrsEducationId' => '',
                        'ApiPrsPreTel' => '',
                        'ApiPrsTel' => '',
                        'ApiPrsTelUpTo' => '',
                        'ApiPrsTelDesc' => '',
                        'ApiPrsTelII' => '',
                        'ApiPrsFax' => '',
                        'ApiPrsFaxDesc' => '',
                        'ApiPrsMobile' => unserialize($address->address_data)['phone'],
                        'ApiPrsWebSite' => '',
                        'ApiPrsEmail' => '',
                        'ApiPrsEmailII' => '',
                        'ApiPrsCountryId' => '',
                        'ApiPrsProvinceId' => '',
                        'ApiPrsCityId' => '',
                        'ApiPrsAddress' => unserialize($address->address_data)['state'] . ' - ' . unserialize($address->address_data)['city'] . ' - ' . unserialize($address->address_data)['address1'],
                        'ApiPrsAddressDesc' => '',
                        'ApiPrsZipCode' => unserialize($address->address_data)['zip-code'],
                        'ApiPrsPostBox' => '',
                        'ApiPrsNationalCode' => $address->id,
                        'ApiPrsIdentityNumber' => '',
                        'ApiPrsFatherName' => '',
                        'ApiPrsBirthDateTime' => '',
                        'ApiPrsBirthPlace' => '',
                        'ApiPrsIsMarried' => '',
                        'ApiPrsMarriageDateTime' => '',
                        'ApiPrsEducationField' => '',
                        'ApiPrsSkill' => '',
                        'ApiPrsStudyField' => '',
                        'ApiPrsInteresting' => '',
                        'ApiPrsSpecialPoint' => '',
                        'ApiPrsDescription' => 'شماره موبایل وارد شده: ' . unserialize($address->address_data)['phone'],
                        'ApiPrsDepartmentId' => '',
                        'ApiPrsStopSendSms' => '',
                        'ApiPrsOrderView' => '',
                        'ApiPrsWorkingOut' => '',
                        'ApiPrsTelegramId' => '',
                        'PrsTelNotDup' => ' ',
                        'PrsFaxNotDup' => '',
                        'LanguageId' => '',
                    );
                    $result_insert = CRM_CALL('POST', '/Api/ApiCompanyPerson/Insert', $data_array_insert);
                }
            }
        }
    }
}
add_action('MJ_CRM_UPDATE_ADDRESS', 'CRM_addresses_as_a_person', 10, 3);
//

function CRM_update_conversation($order, $customer_id, $ProjectId, $status_code)
{
    if ($customer_id && $ProjectId && $status_code) {
        $user_info = get_userdata($customer_id);
        $mobile = $user_info->user_login;
        if ($mobile) {
            $project_title = 'ورتوکا فروش آنلاین';
            $CompanyID = get_user_meta($customer_id, 'CRM_user_id', true);
            $ProjectId = get_user_meta($customer_id, 'CRM_Last_Project_ID', true);
            $PersonId = get_user_meta($customer_id, 'CRM_person_id', true);
            $data_array_select = array(
                'UserName' => '',
                'Password' => '',
                'ApiCompanyId' => $CompanyID,
                'ApiProjectId' => $ProjectId,
                'ApiConversationId' => '',
                'LanguageId' => '',
            );
            $result_select = CRM_CALL('POST', '/Api/ApiConversation/Select', $data_array_select);

            $data_array = array(
                'UserName' => '',
                'Password' => '',
                'UserId' => '',
                'ApiCompanyId' => json_decode($result_select)->Data[0]->ApiCnvsCompanyId,
                'ApiPersonId' => $PersonId,
                'ApiProjectId' => json_decode($result_select)->Data[0]->ApiCnvsProjectId,
                'ApiConversationId' => json_decode($result_select)->Data[0]->ApiConversationID,
                'ApiCnvsDate' => '',
                'ApiCnvsDateTime' => '',
                'ApiCnvsTopicId' => '',
                'ApiCnvsSubject' => '',
                'ApiCnvsDesc' => CRM_conversation_text_update($order),
                'ApiCnvsUserId' => '',
                'ApiCnvsReferUserId' => '',
                'ApiCnvsReferDesc' => '',
                'ApiCnvsStatusId' => order_status_to_conversation_status($status_code),
                'ApiCnvsPriorityId' => '',
                'ApiCnvsRemindDate' => '',
                'ApiCnvsRemindDateTime' => '',
                'ApiCnvsRemindTime' => '',
                'ApiCnvsRemindOk' => '',
                'ApiCnvsIsBookMark' => '',
                'ApiCnvsRemindDateForAllarm' => '',
                'ApiCnvsRemindDateTimeForAllarm' => '',
                'ApiCnvsApiId' => '',
                'ApiCnvsFOCmpCanSee' => '',
                'ApiCnvsIsTicket' => '',
                'ApiCnvsCoordinateLatitude' => '',
                'ApiCnvsCoordinateLongitude' => '',
                'ApiCnvsCoordinateLastDatePersian' => '',
                'ApiCnvsCoordinateLastDate' => '',
                'ApiCnvsTicketIsRead' => '',
                'ApiCnvsDoingTimeStr' => '',
                'ApiCnvsDoingTime' => '',
                'ApiCnvsIsCopy' => '',
                'LanguageId' => '',
            );
            $result = CRM_CALL('POST', '/Api/ApiConversation/Update', $data_array);
        }
    }
}
// add_action('MJ_CRM_TEST', 'CRM_update_conversation', 10, 3);

function order_status_to_conversation_status($order_status)
{
    switch ($order_status) {
        case 1:
            return 125;
            break;

        case 2:
            return 126;
            break;

        case 3:
            return 127;
            break;

        case 4:
            return 128;
            break;
        case 5:
            return 129;
            break;

        case 6:
            return 131;
            break;

        case 7:
            return 130;
            break;

        case 8:
            return 132;
            break;

        case 9:
            return 133;
            break;

        case 10:
            return 134;
            break;
        case 11:
            return 135;
            break;
        case 12:
            return 136;
            break;
        case 13:
            return 137;
            break;
        case 14:
            return 138;
            break;
        case 15:
            return 139;
            break;
        case 16:
            return 140;
            break;
        case 17:
            return 141;
            break;

        default:
            return false;
            break;
    }
}

function CRM_order_status_change($order_id, $old_status, $new_status)
{
    $order = new WC_Order($order_id);
    $ProjectId = get_post_meta($order_id, 'order_CRM_project_id', true);
    $user_info = get_userdata($order->get_customer_id());
    $mobile = $user_info->user_login;
    if ($new_status == 'pending') {
        CRM_update_conversation($order, $order->get_customer_id(), $ProjectId, 1);
    }
    if ($new_status == 'processing') {
        if (!get_post_meta($order_id, 'order_CRM_project_id', true)) {
            $ProjectId = get_user_meta($order->get_customer_id(), 'CRM_Last_Project_ID', true);
            update_post_meta($order_id, 'order_CRM_project_id', sanitize_text_field($ProjectId));
            update_user_meta($order->get_customer_id(), 'CRM_Last_Project_ID', 0);
        }

        CRM_update_conversation($order, $order->get_customer_id(), $ProjectId, 2);

        if ($order->get_meta('_vertuka_custom_radio_field', true) == 'hoghooghi') {
            update_post_meta($order_id, 'company', sanitize_text_field(get_user_meta($order->get_customer_id(), 'company', true)));
            update_post_meta($order_id, 'economic_id', sanitize_text_field(get_user_meta($order->get_customer_id(), 'economic_id', true)));
            update_post_meta($order_id, 'company_national_code', sanitize_text_field(get_user_meta($order->get_customer_id(), 'company_national_code', true)));
            update_post_meta($order_id, 'registration_id', sanitize_text_field(get_user_meta($order->get_customer_id(), 'registration_id', true)));
            update_post_meta($order_id, 'company_address', sanitize_text_field(get_user_meta($order->get_customer_id(), 'company_address', true)));

            $company_national_code = get_post_meta($order_id, 'company_national_code', true);

            if (!is_company_registered_on_CRM($company_national_code)) {
                CRM_register_company($order_id);
                CRM_register_person_company($order_id);
                CRM_register_project_company($order_id);
            } else {
                $data = get_company_info_CRM($company_national_code);
                update_post_meta($order_id, 'CRM_company_id', sanitize_text_field($data->Data[0]->ApiCompanyID));

                $personel = get_all_company_person_CRM($company_national_code);
                $is_registered = false;
                foreach ($personel as $person) {
                    if ($person->ApiPrsMobile == $mobile) {
                        $is_registered = true;
                        break;
                    }
                }
                if (!$is_registered) {
                    CRM_register_person_company($order_id);
                }
                CRM_register_project_company($order_id);
            }
            CRM_update_company_project_conversation($order_id, 2);
        }

        CRM_update_project_of_user_and_company($order_id);
    }
    if ($new_status == 'accepted') {
        CRM_update_conversation($order, $order->get_customer_id(), $ProjectId, 3);

        if ($order->get_meta('_vertuka_custom_radio_field', true) == 'hoghooghi') {
            CRM_update_company_project_conversation($order_id, 3);
        }
    }
    if ($new_status == 'receive-warehouse') {
        CRM_update_conversation($order, $order->get_customer_id(), $ProjectId, 4);

        if ($order->get_meta('_vertuka_custom_radio_field', true) == 'hoghooghi') {
            CRM_update_company_project_conversation($order_id, 4);
        }
    }
    if ($new_status == 'preparation') {
        CRM_update_conversation($order, $order->get_customer_id(), $ProjectId, 5);

        if ($order->get_meta('_vertuka_custom_radio_field', true) == 'hoghooghi') {
            CRM_update_company_project_conversation($order_id, 5);
        }
    }
    if ($new_status == 'delivery-carrier') {
        CRM_update_conversation($order, $order->get_customer_id(), $ProjectId, 6);

        if ($order->get_meta('_vertuka_custom_radio_field', true) == 'hoghooghi') {
            CRM_update_company_project_conversation($order_id, 6);
        }
    }
    if ($new_status == 'completed') {
        CRM_update_conversation($order, $order->get_customer_id(), $ProjectId, 7);

        if ($order->get_meta('_vertuka_custom_radio_field', true) == 'hoghooghi') {
            CRM_update_company_project_conversation($order_id, 7);
        }
    }
    if ($new_status == 'cancelled') {
        CRM_update_conversation($order, $order->get_customer_id(), $ProjectId, 8);

        if ($order->get_meta('_vertuka_custom_radio_field', true) == 'hoghooghi') {
            CRM_update_company_project_conversation($order_id, 8);
        }
    }
    if ($new_status == 'case1') {
        CRM_update_conversation($order, $order->get_customer_id(), $ProjectId, 9);

        if ($order->get_meta('_vertuka_custom_radio_field', true) == 'hoghooghi') {
            CRM_update_company_project_conversation($order_id, 9);
        }
    }
    if ($new_status == 'case2') {
        CRM_update_conversation($order, $order->get_customer_id(), $ProjectId, 10);

        if ($order->get_meta('_vertuka_custom_radio_field', true) == 'hoghooghi') {
            CRM_update_company_project_conversation($order_id, 10);
        }
    }
    if ($new_status == 'case3') {
        CRM_update_conversation($order, $order->get_customer_id(), $ProjectId, 11);

        if ($order->get_meta('_vertuka_custom_radio_field', true) == 'hoghooghi') {
            CRM_update_company_project_conversation($order_id, 11);
        }
    }
    if ($new_status == 'case31') {
        CRM_update_conversation($order, $order->get_customer_id(), $ProjectId, 12);

        if ($order->get_meta('_vertuka_custom_radio_field', true) == 'hoghooghi') {
            CRM_update_company_project_conversation($order_id, 12);
        }
    }
    if ($new_status == 'case32') {
        CRM_update_conversation($order, $order->get_customer_id(), $ProjectId, 13);

        if ($order->get_meta('_vertuka_custom_radio_field', true) == 'hoghooghi') {
            CRM_update_company_project_conversation($order_id, 13);
        }
    }
    if ($new_status == 'case33') {
        CRM_update_conversation($order, $order->get_customer_id(), $ProjectId, 14);

        if ($order->get_meta('_vertuka_custom_radio_field', true) == 'hoghooghi') {
            CRM_update_company_project_conversation($order_id, 14);
        }
    }
    if ($new_status == 'case34') {
        CRM_update_conversation($order, $order->get_customer_id(), $ProjectId, 15);

        if ($order->get_meta('_vertuka_custom_radio_field', true) == 'hoghooghi') {
            CRM_update_company_project_conversation($order_id, 15);
        }
    }
    if ($new_status == 'case35') {
        CRM_update_conversation($order, $order->get_customer_id(), $ProjectId, 16);

        if ($order->get_meta('_vertuka_custom_radio_field', true) == 'hoghooghi') {
            CRM_update_company_project_conversation($order_id, 16);
        }
    }
    if ($new_status == 'returned-sale') {
        CRM_update_conversation($order, $order->get_customer_id(), $ProjectId, 17);

        if ($order->get_meta('_vertuka_custom_radio_field', true) == 'hoghooghi') {
            CRM_update_company_project_conversation($order_id, 17);
        }
    }
}
add_action('woocommerce_order_status_changed', 'CRM_order_status_change', 11, 3);

function is_company_registered_on_CRM($NationalCode)
{
    $data_array = array(
        'UserName' => '',
        'Password' => '',
        'UserId' => '',
        'ApiVal' => $NationalCode,
        'ApiSearchType' => 1,
        'ApiSearchConditionMode' => 12,
        'LanguageId' => '',
    );
    $result = CRM_CALL('POST', '/Api/ApiCompany/MainSearch', $data_array);
    if (json_decode($result)->Data[0]->ApiCompanyID) {
        return true;
    }
    return false;
}
function get_company_info_CRM($NationalCode)
{
    $data_array = array(
        'UserName' => '',
        'Password' => '',
        'UserId' => '',
        'ApiVal' => $NationalCode,
        'ApiSearchType' => 1,
        'ApiSearchConditionMode' => 12,
        'LanguageId' => '',
    );
    $result = CRM_CALL('POST', '/Api/ApiCompany/MainSearch', $data_array);
    if (json_decode($result)->Data[0]->ApiCompanyID) {
        return json_decode($result);
    }
    return false;
}
function get_all_company_person_CRM($NationalCode)
{
    $data_array = array(
        'UserName' => '',
        'Password' => '',
        'UserId' => '',
        'ApiVal' => $NationalCode,
        'ApiSearchType' => 1,
        'ApiSearchConditionMode' => 12,
        'LanguageId' => '',
    );
    $result = CRM_CALL('POST', '/Api/ApiCompany/MainSearch', $data_array);
    return json_decode($result)->Data;
}
// add_action('MJ_CRM_TEST', 'is_company_registered_on_CRM', 10, 3);

///////////////////////////////////
function CRM_register_company($order_id)
{
    $company = get_post_meta($order_id, 'company', true);
    $economic_id = get_post_meta($order_id, 'economic_id', true);
    $company_national_code = get_post_meta($order_id, 'company_national_code', true);
    $registration_id = get_post_meta($order_id, 'registration_id', true);
    $company_address = get_post_meta($order_id, 'company_address', true);
    $data_array = array(
        'UserName' => '',
        'Password' => '',
        'UserId' => '',
        'ApiCmpNumber' => '',
        'ApiCmpName' => 'شرکت-' . $company,
        'ApiCmpNameEng' => '',
        'ApiCmpTitleId' => '',
        'ApiCmpFame' => '',
        'ApiCmpActivityType' => '',
        'ApiCmpGroupId' => '',
        'ApiCmpSubGroupId' => '',
        'ApiCmpGroupIdII' => '',
        'ApiCmpGroupIdIII' => '',
        'ApiCmpGroupIdIV' => '',
        'ApiCmpTypeId' => '',
        'ApiCmpPresentationId' => '',
        'ApiCmpPreTel' => '',
        'ApiCmpTel' => '',
        'ApiCmpTelUpTo' => '',
        'ApiCmpTelDesc' => '',
        'ApiCmpPreTelII' => '',
        'ApiCmpTelII' => '',
        'ApiCmpTelUpToII' => '',
        'ApiCmpTelIIDesc' => '',
        'ApiCmpMobile' => '',
        'ApiCmpFax' => '',
        'ApiCmpFaxDesc' => '',
        'ApiCmpCountryId' => '',
        'ApiCmpProvinceId' => '',
        'ApiCmpCityId' => '',
        'ApiCmpAddress' => $company_address,
        'ApiCmpAddressDesc' => '',
        'ApiCmpZipCode' => '',
        'ApiCmpPostBox' => '',
        'ApiCmpWebSite' => '',
        'ApiCmpEmail' => '',
        'ApiCmpInteresting' => '',
        'ApiCmpSpecialPoint' => '',
        'ApiCmpDescription' => '',
        'ApiCmpUserName' => '',
        'ApiCmpPassword' => '',
        'ApiCmpRegistrationNumber' => $registration_id,
        'ApiCmpEconomicCode' => $economic_id,
        'ApiCmpNationalCode' => $company_national_code,
        'ApiCmpBuyLimit' => '',
        'ApiCmpAccountNumber' => '',
        'ApiCmpAccInquiry' => '',
        'ApiCmpFreight' => '',
        'ApiCmpInquiry' => '',
        'ApiCmpReferUserId' => '',
        'ApiCmpSpecialWordForCI' => '',
        'ApiCmpCode' => '',
        'ApiCmpEffectiveDateTime' => '',
        'ApiCmpCoordinateLatitude' => '',
        'ApiCmpCoordinateLongitude' => '',
        'ApiCmpCoordinateLastDate' => '',
        'ApiCmpCoordinateZoomLevel' => '',
        'ApiCmpCoordinateLastUserId' => '',
        'ApiCmpFOAccessLinkedCompany' => '',
        'CmpCodeNotDup' => '',
        'CmpTelNotDup' => '',
        'CmpFaxNotDup' => '',
        'LanguageId' => '',
        'ApiCmpCampaignIds' => '',
    );
    $result = CRM_CALL('POST', '/Api/ApiCompany/Insert', $data_array);

    update_post_meta($order_id, 'CRM_company_id', sanitize_text_field(json_decode($result)->Data));
}
function CRM_register_person_company($order_id)
{
    $order = new WC_Order($order_id);
    $user_info = get_userdata($order->get_customer_id());
    $mobile = $user_info->user_login;
    if ($order_id) {
        $CompanyID = get_post_meta($order_id, 'CRM_company_id', true);
        $data_array = array(
            'UserName' => '',
            'Password' => '',
            'UserId' => '',
            'ApiCompanyId' => $CompanyID,
            'ApiCmpNumber' => '',
            'ApiCmpCode' => '',
            'ApiPrsLName' => $user_info->first_name,
            'ApiPrsFName' => $user_info->last_name,
            'ApiPrsTitleId' => '',
            'ApiPrsJobId' => '',
            'ApiPrsTypeId' => '',
            'ApiPrsGroupId' => '',
            'ApiPrsSexId' => '',
            'ApiPrsEducationId' => '',
            'ApiPrsPreTel' => '',
            'ApiPrsTel' => '',
            'ApiPrsTelUpTo' => '',
            'ApiPrsTelDesc' => '',
            'ApiPrsTelII' => '',
            'ApiPrsFax' => '',
            'ApiPrsFaxDesc' => '',
            'ApiPrsMobile' => $mobile,
            'ApiPrsWebSite' => '',
            'ApiPrsEmail' => '',
            'ApiPrsEmailII' => '',
            'ApiPrsCountryId' => '',
            'ApiPrsProvinceId' => '',
            'ApiPrsCityId' => '',
            'ApiPrsAddress' => '',
            'ApiPrsAddressDesc' => '',
            'ApiPrsZipCode' => '',
            'ApiPrsPostBox' => '',
            'ApiPrsNationalCode' => '',
            'ApiPrsIdentityNumber' => '',
            'ApiPrsFatherName' => '',
            'ApiPrsBirthDateTime' => '',
            'ApiPrsBirthPlace' => '',
            'ApiPrsIsMarried' => '',
            'ApiPrsMarriageDateTime' => '',
            'ApiPrsEducationField' => '',
            'ApiPrsSkill' => '',
            'ApiPrsStudyField' => '',
            'ApiPrsInteresting' => '',
            'ApiPrsSpecialPoint' => '',
            'ApiPrsDescription' => '',
            'ApiPrsDepartmentId' => '',
            'ApiPrsStopSendSms' => '',
            'ApiPrsOrderView' => '',
            'ApiPrsWorkingOut' => '',
            'ApiPrsTelegramId' => '',
            'PrsTelNotDup' => ' ',
            'PrsFaxNotDup' => '',
            'LanguageId' => '',
        );
        $result = CRM_CALL('POST', '/Api/ApiCompanyPerson/Insert', $data_array);
        update_post_meta($order_id, 'CRM_company_person_id', sanitize_text_field(json_decode($result)->Data));
    }
}
function CRM_register_project_company($order_id)
{
    $CompanyID = get_post_meta($order_id, 'CRM_company_id', true);
    $project_title = 'ورتوکا فروش آنلاین';
    $company_national_code = get_post_meta($order_id, 'company_national_code', true);
    $CRM_user_data = get_company_info_CRM($company_national_code);

    $CmpNumber = $CRM_user_data->Data[0]->ApiCmpNumber;
    $CmpCode = $CRM_user_data->Data[0]->ApiCmpCode;

    $data_array = array(
        'UserName' => '',
        'Password' => '',
        'UserId' => '',
        'ApiCompanyId' => $CompanyID,
        'ApiCmpNumber' => $CmpNumber,
        'ApiCmpCode' => $CmpCode,
        'ApiPrjTitle' => $project_title,
        'ApiPrjDesc' => '',
        'ApiPrjStartDateTime' => '',
        'ApiPrjStarterUserId' => '',
        'ApiPrjFinishedStatusId' => '',
        'ApiPrjIsFinished' => '',
        'ApiPrjFinishedDateTime' => '',
        'ApiPrjFinishedUserId' => '',
        'ApiPrjGradeId' => '',
        'ApiPrjPriorityId' => '',
        'ApiPrjGroupId' => '',
        'ApiPrjCnvsStatusGroupId' => 13, //bara inke on masyr ro shenasayy kone
        'ApiPrjOrderView' => '',
        'ApiPrjPostFix' => '',
        'ApiPrjRemindDateTime' => '',
        'ApiPrjFOCmpCanSee' => '',
        'ApiPrjIsTicket' => '',
        'ApiPrjUserDepartmentId' => '',
        'ApiPrjInsertCrmProjectForbiddenFUFDPActive' => '',
        'ApiPrjInsertProjectInformationsDefualtFieldActive' => '',
        'PrjPostFixNotDup' => '',
        'PrjDescNotDup' => '',
        'LanguageId' => '',
        'ApiPrjCmpPresentationId' => '',
        'ApiPrjCmpCampaignIds' => '',
    );
    $result = CRM_CALL('POST', '/Api/ApiProject/Insert', $data_array);
    // var_dump('MJ', $data_array, $result);die;
    update_post_meta($order_id, 'CRM_company_project_id', sanitize_text_field(json_decode($result)->Data));
}
function CRM_update_company_project_conversation($order_id, $status_code)
{
    $order = new WC_Order($order_id);
    $CompanyID = get_post_meta($order_id, 'CRM_company_id', true);
    $CRM_company_project_id = get_post_meta($order_id, 'CRM_company_project_id', true);
    $PersonId = get_post_meta($order_id, 'CRM_company_person_id', true);
    if (get_post_meta($order_id, 'CRM_company_conversation_id', true)) {
        $data_array = array(
            'UserName' => '',
            'Password' => '',
            'UserId' => '',
            'ApiCompanyId' => $CompanyID,
            'ApiPersonId' => $PersonId,
            'ApiProjectId' => $CRM_company_project_id,
            'ApiConversationId' => get_post_meta($order_id, 'CRM_company_conversation_id', true),
            'ApiCnvsDate' => '',
            'ApiCnvsDateTime' => '',
            'ApiCnvsTopicId' => '',
            'ApiCnvsSubject' => '',
            'ApiCnvsDesc' => CRM_conversation_text_update($order),
            'ApiCnvsUserId' => '',
            'ApiCnvsReferUserId' => '',
            'ApiCnvsReferDesc' => '',
            'ApiCnvsStatusId' => order_status_to_conversation_status($status_code),
            'ApiCnvsPriorityId' => '',
            'ApiCnvsRemindDate' => '',
            'ApiCnvsRemindDateTime' => '',
            'ApiCnvsRemindTime' => '',
            'ApiCnvsRemindOk' => '',
            'ApiCnvsIsBookMark' => '',
            'ApiCnvsRemindDateForAllarm' => '',
            'ApiCnvsRemindDateTimeForAllarm' => '',
            'ApiCnvsApiId' => '',
            'ApiCnvsFOCmpCanSee' => '',
            'ApiCnvsIsTicket' => '',
            'ApiCnvsCoordinateLatitude' => '',
            'ApiCnvsCoordinateLongitude' => '',
            'ApiCnvsCoordinateLastDatePersian' => '',
            'ApiCnvsCoordinateLastDate' => '',
            'ApiCnvsTicketIsRead' => '',
            'ApiCnvsDoingTimeStr' => '',
            'ApiCnvsDoingTime' => '',
            'ApiCnvsIsCopy' => '',
            'LanguageId' => '',
        );
        $result = CRM_CALL('POST', '/Api/ApiConversation/Update', $data_array);
    } else {
        $data_array = array(
            'UserName' => '',
            'Password' => '',
            'UserId' => '',
            'ApiCompanyId' => $CompanyID,
            'ApiCmpNumber' => '',
            'ApiCmpCode' => '',
            'ApiPersonId' => $PersonId,
            'ApiProjectId' => $CRM_company_project_id,
            'ApiPrjTitle' => 'تست',
            'ApiCnvsDateTime' => '',
            'ApiCnvsTopicId' => 16, // vertuka
            'ApiCnvsSubject' => '',
            'ApiCnvsDesc' => CRM_conversation_text_update($order),
            'ApiCnvsUserId' => '',
            'ApiCnvsReferUserId' => '',
            'ApiCnvsReferDesc' => '',
            'ApiCnvsStatusId' => order_status_to_conversation_status($status_code),
            'ApiCnvsPriorityId' => '',
            'ApiCnvsRemindDateTime' => '',
            'ApiCnvsRemindTime' => '',
            'ApiCnvsRemindOk' => '',
            'ApiCnvsIsBookMark' => '',
            'ApiCnvsRemindDateTimeForAllarm' => '',
            'ApiCnvsApiId' => '',
            'ApiCnvsFOCmpCanSee' => '',
            'ApiCnvsIsTicket' => '',
            'ApiCnvsCoordinateLatitude' => '',
            'ApiCnvsCoordinateLongitude' => '',
            'ApiCnvsCoordinateLastDate' => '',
            'ApiCnvsTicketIsRead' => '',
            'ApiCnvsDoingTime' => '',
            'ApiCnvsIsCopy' => '',
            'ApiCnvsReferToMultilUser' => '',
            'ApiCnvsEventPolicyNeedCheck' => '',
            'LanguageId' => '',
        );
        $result = CRM_CALL('POST', '/Api/ApiConversation/Insert', $data_array);
        update_post_meta($order_id, 'CRM_company_conversation_id', sanitize_text_field(json_decode($result)->Data));
    }
}

function CRM_update_project_of_user_and_company($order_id)
{
    // update user project title
    $order = new WC_Order($order_id);
    if ($order) {
        $ProjectId = get_post_meta($order_id, 'order_CRM_project_id', true);

        if ($order->get_meta('_vertuka_custom_radio_field', true) == 'hoghooghi') {
            $haghigh_hoghoghy = 'حقوقی';
        } else {
            $haghigh_hoghoghy = 'حقیقی';
        }

        if ($ProjectId) {
            // SELECT PROJECT
            $project_info = get_project_info($ProjectId);

            $data_array = array(
                'UserName' => '',
                'Password' => '',
                'UserId' => '',
                'ApiCompanyId' => $project_info->ApiPrjCompanyId,
                'ApiProjectId' => $ProjectId,
                'ApiPrjTitle' => 'ورتوکا فروش آنلاین',
                'ApiPrjDesc' => '#' . $order_id,
                // 'ApiPrjStartDate' => '',
                // 'ApiPrjStartDateTime' => '',
                // 'ApiPrjStarterUserId' => '',
                // 'ApiPrjFinishedStatusId' => '',
                // 'ApiPrjIsFinished' => '',
                // 'ApiPrjFinishedDate' => '',
                // 'ApiPrjFinishedDateTime' => '',
                // 'ApiPrjFinishedUserId' => '',
                // 'ApiPrjGradeId' => '',
                // 'ApiPrjPriorityId' => '',
                // 'ApiPrjGroupId' => '',
                // 'ApiPrjCnvsStatusGroupId' => '',
                // 'ApiPrjOrderView' => '',
                // 'ApiPrjPostFix' => '',
                // 'ApiPrjRemindDate' => '',
                // 'ApiPrjRemindDateTime' => '',
                // 'ApiPrjFOCmpCanSee' => '',
                // 'ApiPrjIsTicket' => '',
                // 'ApiPrjUserDepartmentId' => '',
                // 'ApiPrjSmsPrsIds' => '',
                // 'ApiPrjSmsText' => '',
                // 'ApiPrjSmsSendDatePersian' => '',
                // 'ApiPrjSmsSendDate' => '',
                // 'PrjPostFixNotDup' => '',
                // 'PrjDescNotDup' => '',
                // 'LanguageId' => '',
                // 'ApiPrjCmpPresentationId' => '',
                // 'ApiPrjCmpCampaignIds' => '',
            );

            $result = CRM_CALL('POST', '/Api/ApiProject/Update', $data_array);
        }

        // update company project title
        $CompanyID = get_post_meta($order_id, 'CRM_company_id', true);
        $CRM_company_project_id = get_post_meta($order_id, 'CRM_company_project_id', true);
        if ($CRM_company_project_id && $CompanyID) {
            $data_array = array(
                'UserName' => '',
                'Password' => '',
                'UserId' => '',
                'ApiCompanyId' => $CompanyID,
                'ApiProjectId' => $CRM_company_project_id,
                'ApiPrjTitle' => 'ورتوکا فروش آنلاین',
                'ApiPrjDesc' => '#' . $order_id,
                // 'ApiPrjStartDate' => '',
                // 'ApiPrjStartDateTime' => '',
                // 'ApiPrjStarterUserId' => '',
                // 'ApiPrjFinishedStatusId' => '',
                // 'ApiPrjIsFinished' => '',
                // 'ApiPrjFinishedDate' => '',
                // 'ApiPrjFinishedDateTime' => '',
                // 'ApiPrjFinishedUserId' => '',
                // 'ApiPrjGradeId' => '',
                // 'ApiPrjPriorityId' => '',
                // 'ApiPrjGroupId' => '',
                // 'ApiPrjCnvsStatusGroupId' => '',
                // 'ApiPrjOrderView' => '',
                // 'ApiPrjPostFix' => '',
                // 'ApiPrjRemindDate' => '',
                // 'ApiPrjRemindDateTime' => '',
                // 'ApiPrjFOCmpCanSee' => '',
                // 'ApiPrjIsTicket' => '',
                // 'ApiPrjUserDepartmentId' => '',
                // 'ApiPrjSmsPrsIds' => '',
                // 'ApiPrjSmsText' => '',
                // 'ApiPrjSmsSendDatePersian' => '',
                // 'ApiPrjSmsSendDate' => '',
                // 'PrjPostFixNotDup' => '',
                // 'PrjDescNotDup' => '',
                // 'LanguageId' => '',
                // 'ApiPrjCmpPresentationId' => '',
                // 'ApiPrjCmpCampaignIds' => '',
            );

            $result = CRM_CALL('POST', '/Api/ApiProject/Update', $data_array);
        }
    }
}

function just_for_test()
{
    if (!is_admin()) {
        echo '<pre>';
        var_dump(phpversion());
        die;
    }
}
// add_action('MJ_CRM_TEST', 'just_for_test', 10, 3);

function get_project_info($ProjectId)
{
    $data_array = array(
        'UserName' => '',
        'Password' => '',
        'ApiCompanyId' => '',
        'ApiProjectId' => $ProjectId,
        'LanguageId' => '',
    );

    $result = CRM_CALL('POST', '/Api/ApiProject/Select', $data_array);
    return json_decode($result)->Data[0];
}
