<?php

use RankMath\Divi\Divi;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function vertuka_setup()
{
    /*
        * Make theme available for translation.
        * Translations can be filed in the /languages/ directory.
        * If you're building a theme based on vertuka, use a find and replace
        * to change 'vertuka' to the name of your theme in all the template files.
        */
    load_theme_textdomain('vertuka', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
        * Let WordPress manage the document title.
        * By adding theme support, we declare that this theme does not use a
        * hard-coded <title> tag in the document head, and expect WordPress to
        * provide it for us.
        */
    add_theme_support('title-tag');

    /*
        * Enable support for Post Thumbnails on posts and pages.
        *
        * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
        */
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'main-menu' => esc_html__('منو اصلی', 'vertuka'),
        )
    );

    /*
        * Switch default core markup for search form, comment form, and comments
        * to output valid HTML5.
        */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'vertuka_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );

    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'vertuka_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function vertuka_content_width()
{
    $GLOBALS['content_width'] = apply_filters('vertuka_content_width', 1140);
}
add_action('after_setup_theme', 'vertuka_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function vertuka_widgets_init()
{
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'vertuka'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'vertuka'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'vertuka_widgets_init');

/**
 * Add Cropping behavior for the image size is dependent on the value
 *
 * @link https://developer.wordpress.org/reference/functions/add_image_size/
 */
if (!function_exists('vertuka_add_image_size')) {
    add_action('after_setup_theme', 'vertuka_add_image_size');
    function vertuka_add_image_size()
    {
        //        add_image_size('pars-host-related-post', 420, 480, array( 'center', 'center'));
        //        add_image_size('pars-host-single-thumbnail', 1110, 445, array( 'center', 'center'));
        //        add_image_size('pars-host-home-slider', 440, 465, array( 'center', 'center'));
        //        add_image_size('pars-host-home-articles', 350, 400, array( 'center', 'center'));
        //        add_image_size('pars-host-home-author-suggestion', 760, 320, array( 'center', 'center'));
        //        add_image_size('pars-host-archive-first-post', 540, 450, array( 'center', 'center'));
    }
}


/**
 * if is not admin: remove admin bar!
 */
// if (!current_user_can('administrator')) {
//     add_filter('show_admin_bar', '__return_false');
// } else {
//     add_filter('show_admin_bar', '__return_true');
// }
// add_filter('show_admin_bar', '__return_true');
// first remove all the admin bar 


/**
 * @return false|string
 */
function vertuka_wpdiscuz_shortcode()
{
    $html = "";
    if (file_exists(ABSPATH . "wp-content/plugins/wpdiscuz/themes/default/comment-form.php")) {
        ob_start();
        include ABSPATH . "wp-content/plugins/wpdiscuz/themes/default/comment-form.php";
        $html = ob_get_clean();
    }
    return $html;
}
add_shortcode("wpdiscuz_comments", "vertuka_wpdiscuz_shortcode");



/**
 * Add "کد ملی" (National Code) field to user profile
 */
function add_national_code_field($user)
{
?>
    <h3><?php _e('کد ملی', 'vertuka'); ?></h3>

    <table class="form-table">
        <tr>
            <th><label for="national_code"><?php _e('کد ملی', 'vertuka'); ?></label></th>
            <td>
                <input type="text" name="national_code" id="national_code" value="<?php echo esc_attr(get_the_author_meta('national_code', $user->ID)); ?>" class="regular-text" /><br />
            </td>
        </tr>
    </table>
<?php
}

/**
 * Save the "کد ملی" (National Code) field when the user profile is updated
 *
 * @param int $user_id The ID of the user being updated.
 */
function save_national_code_field($user_id)
{
    if (current_user_can('edit_user', $user_id)) {
        update_user_meta($user_id, 'national_code', sanitize_text_field($_POST['national_code']));
    }
}

// Add the custom field to the user profile page
add_action('show_user_profile', 'add_national_code_field');
add_action('edit_user_profile', 'add_national_code_field');

// Save the custom field when the user profile is updated
add_action('personal_options_update', 'save_national_code_field');
add_action('edit_user_profile_update', 'save_national_code_field');


// Add this action to handle the AJAX request
add_action('wp_ajax_save_national_code', 'save_national_code_callback');


/**
 * Add ajax to registerpress
 *
 * @param $user_id
 * @return void
 */
function registerpress_login_ajaxy()
{

    $phone = sanitize_text_field($_POST['phone']);
    $athenticate_code = rand('10000', '99999');
    $page_id = 8;
    $form_id = 1112;
    $username = $phone;

    $registerpress = new med_registerpress();
    $result = $registerpress->authenticate_for_login($username, $athenticate_code, $form_id, $page_id, 'disable');

    if (is_wp_error($result)) {

        // Parse errors into a string and append as parameter to redirect
        $errors = join(',', $result->get_error_codes());
        //retrives https://domain.com/member-register/?register-errors=$errors
        $html = $result->get_error_codes();
    } else {

        $registerpress->sms_service_provider($username, $athenticate_code);

        // Success, redirect to login page.
        $html = '<form id="authenticateform" action="' . wp_registration_url() . '" method="post">';
        $html .= '<div class="form-row med-authenticate-box my-3">';
        $html .= '<div class="med-authenticate-gp">';
        $html .= '<input type="number" class="med-input" name="user_athenticate_code_1" id="user_athenticate_code_1" maxlength="1" minlength="1">';
        $html .= '<input type="number" class="med-input" name="user_athenticate_code_2" id="user_athenticate_code_2" maxlength="1" minlength="1" >';
        $html .= '<input type="number" class="med-input" name="user_athenticate_code_3" id="user_athenticate_code_3" maxlength="1" minlength="1" >';
        $html .= '<input type="number" class="med-input" name="user_athenticate_code_4" id="user_athenticate_code_4" maxlength="1" minlength="1" >';
        $html .= '<input type="number" class="med-input" name="user_athenticate_code_5" id="user_athenticate_code_5" maxlength="1" minlength="1" >';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="d-none"><input type="text" name="user_login" id="user_login" class="authenticate-field-username med-readonly-input" value="' . $phone . '" readonly></div>';
        $html .= '<div class="d-none"><input value="8" type="hidden" name="med-rp-form-id" id="med-rp-form-id" hidden="hidden"></div>';
        $html .= '<div class="d-none"><input value="1112" type="hidden" name="med-rp-page-id" id="med-rp-page-id" hidden="hidden"></div>';
        $html .= '<div><input id="med_registerpress_authenticate_button" type="submit" name="med_rp_login_submit" class="register-button" value="تایید"/></div>';
        $html .= '</form>';


        $html .= '<div class="d-block mt-3 counter-box-wraper justify-content-between">';
        $html .= '<div class="d-flex">';
        $html .= '<div>';
        $html .= '<span class="remain-time no-wrap">زمان باقی مانده تا ارسال مجدد رمز: </span>';
        $html .= '</div>';

        $html .= '<div class="mx-2">';
        $html .= '<div class="counter-box text-start m-0">';
        $html .= '<div class="med-rp-counter text-start">';
        $html .= '<div id="tiles" class="tiles"></div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="mt-3 mt-md-0">';
        $html .= '<form id="registerpress-form-id-1112-test">';
        $html .= '<p class="form-row form-group d-none">';
        $html .= '<input type="text" name="username" id="username" maxlength="11" minlength="11" value="' . esc_html($phone) . '" readonly>';
        $html .= '<input type="tel" name="med-rp-phone-number" id="med-rp-phone-number" maxlength="11" minlength="11" value="' . esc_html($phone) . '" readonly>';
        $html .= '<input value="8" type="hidden" name="med-rp-form-id" id="med-rp-form-id" hidden="hidden">';
        $html .= '<input value="1112" type="hidden" name="med-rp-page-id" id="med-rp-page-id" hidden="hidden">';
        $html .= '</p>';
        $html .= '<input type="submit" name="med_registerpress_login_button" id="resend-code" class="edit-button" value="ارسال مجدد کد">';
        $html .= '</form>';
        $html .= '</div>';
        $html .= '</div>';
    }

    $json = wp_json_encode($html);
    wp_send_json($json);
    exit();
}
add_action('wp_ajax_nopriv_registerpress_login_ajaxy', 'registerpress_login_ajaxy');


function registerpress_authenticate_ajaxy()
{
    $registerpress = new med_registerpress();

    $redirect_url = get_the_permalink(8);

    $username = sanitize_user($_POST['phone']);
    $form_id = registerpress_sanitize_id(1112);
    $page_id = registerpress_sanitize_id(8);
    $code = str_split($_POST['code']);

    //Query
    global $wpdb;
    $table = $wpdb->prefix . "med_registerpress_sms";
    $user_data_stored = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT * FROM {$table} WHERE phone = %s ORDER BY id DESC;",
            $username
        )
    );

    if ($user_data_stored != array() && is_object($user_data_stored[0])) {

        //get data from DB
        $user_stored_phone = $user_data_stored[0]->phone;
        $user_stored_date = $user_data_stored[0]->date;

        //get user data from stored $user_stored_data
        $user_stored_data = unserialize($user_data_stored[0]->data_user);
        $user_stored_athenticate_code = $user_stored_data->athenticate_code;
        $user_stored_username = $user_stored_data->username;
        $form_id_stored = $user_stored_data->form_id;
        $page_id_stored = $user_stored_data->page_id;
    } else {

        // access deinied: Parse errors into a string and append as parameter to redirect
        $html = 'access_denied';
    }

    //get code from authenticate form
    $cede_1 = med_rp_code_sanitize($code[0]);
    $cede_2 = med_rp_code_sanitize($code[1]);
    $cede_3 = med_rp_code_sanitize($code[2]);
    $cede_4 = med_rp_code_sanitize($code[3]);
    $cede_5 = med_rp_code_sanitize($code[4]);
    $code = $cede_1 . $cede_2 . $cede_3 . $cede_4 . $cede_5;

    //get time from authenticate form
    $d = new DateTime(wp_timezone_string());
    $d->setTimezone(new DateTimeZone(wp_timezone_string()));
    $date_now = $d->format('Y-m-d H:i:s');
    $time_send_athenticate = new DateTime($date_now);
    $time_send_register = new DateTime($user_stored_date);

    //check the times
    $diff = $time_send_register->diff($time_send_athenticate);
    $diff_time = ((($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h) * 60 + $diff->i) * 60 + $diff->s;
    $valid_time_diff = 120;

    if ($user_stored_phone == $username && $form_id == $form_id_stored) {
        if ($diff_time < $valid_time_diff) {
            if ($code == $user_stored_athenticate_code) {

                $data_current_user = get_user_by('login', $username);
                if ($data_current_user === false) {
                    $data_current_user = get_user_by('login', $user_stored_username);
                }
                //Check it again
                if (is_wp_error($data_current_user) || $data_current_user === false) {

                    // Parse errors into a string and append as parameter to redirect
                    $html = 'user_not_found';
                } else {

                    wp_clear_auth_cookie();
                    wp_set_current_user($data_current_user->ID);
                    wp_set_auth_cookie($data_current_user->ID);
                    $html = 'ok';
                }
            } else {

                // Wrong athenticate code: Parse errors into a string and append as parameter to redirect
                $html = 'Authenticate_not_ok';
            }
        } else {
            // Time is over!: Parse errors into a string and append as parameter to redirect
            $html = 'time_not_ok';
        }
    } else {
        // access deinied: Parse errors into a string and append as parameter to redirect
        $html = 'access_not_ok';
    }

    if (!isset($html)) {
        $html = 'nothing';
    }


    $json = wp_json_encode($html);
    wp_send_json($json);
    exit();
}
add_action('wp_ajax_nopriv_registerpress_authenticate_ajaxy', 'registerpress_authenticate_ajaxy');

/**
 * AJAX handler for saving the national_code field
 */
function save_national_code_callback()
{
    // Get the national_code value from the AJAX request
    $national_code = sanitize_text_field($_POST['national_code']);
    $name = sanitize_text_field($_POST['name']);
    $family = sanitize_text_field($_POST['family']);


    // Assuming the user is logged in, you can update the user meta
    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        if (!empty($national_code) && !empty($name) && !empty($family)) {
            if (national_code_validation_API($national_code, $user_id)) {
                update_user_meta($user_id, 'national_code', $national_code);
                update_user_meta($user_id, 'first_name ', $name);
                update_user_meta($user_id, 'last_name', $family);
                echo 'National code saved successfully!';
            } else {
                echo 'National code is not valid!';
                header('HTTP/1.1 500 Internal Server Booboo');
                header('Content-Type: application/json; charset=UTF-8');
                die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
            }
        } else {
            echo 'Form is NOT complete!';
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
        }
    } else {
        echo 'User not logged in.';
    }

    // Always die in functions echoing AJAX content
    die();
}

/**
 * AJAX handler for saving the national_code field
 */
function save_national_code_callback2()
{
    $national_code = sanitize_text_field($_POST['national_code'] ?? '');
    $name = sanitize_text_field($_POST['name'] ?? '');
    $family = sanitize_text_field($_POST['family'] ?? '');
    $user_id = get_current_user_id();

    if (!national_code_validation_API($national_code, $user_id)) {
        wp_send_json([
            'status' => 'error',
            'message' => 'کد ملی معتبر نیست!',
            'code' => 422
        ], 422);
    }

    update_user_meta($user_id, 'national_code', $national_code);
    update_user_meta($user_id, 'first_name', $name);
    update_user_meta($user_id, 'last_name', $family);

    wp_send_json([
        'status' => 'success',
        'message' => 'کد ملی با موفقیت ذخیره شد.',
        'code' => 200
    ], 200);
}


// Hook the AJAX callback to WordPress
add_action('wp_ajax_save_national_code', 'save_national_code_callback');

// MD - develop national_code_validation_API function - Start 

// voroodi national_code and phone - khorooji true or false
function national_code_validation_API($national_code, $user_id)
{

    // get user phone number from usermeta table and with "phone_number" key



    return true;
}


function national_code_validation_API2($national_code, $user_id)
{

    // 1. دریافت شماره موبایل کاربر از جدول usermeta
    
}

function simulate_api_response($request_body)
{
    $x = 1;
    $mobile = isset($request_body['mobile']) ? $request_body['mobile'] : null;
    $national_code = isset($request_body['national_code']) ? $request_body['national_code'] : null;
    $is_valid = 4;
    $is_valid_message = '';
    if ($mobile === '09336315689' && $national_code === '1111111111') {
        $is_valid = 1;
        $is_valid_message = 'موفق';
    } elseif ($x == 2) {
        $is_valid = 2;
        $is_valid_message = 'توکن غیر فعال شده است';
    } elseif ($x == 3) {
        $is_valid = 3;
        $is_valid_message = 'سرویس در دسترسی نمی‌باشد.';
    } elseif ($x == 4) {
        $is_valid = 4;
        $is_valid_message = 'فراخوانی وب‌سرویس با پارامتر‌های ورودی صحیح نمی‌باشد.';
    }

    $response = [
        'result' => $is_valid,
        'response_body' => [
            'data' => [
                'matched' => $is_valid
            ],
            'message' => $is_valid_message,
            'error_code' => null
        ]
    ];

    return json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}


// MD - develop national_code_validation_API function - End

// function check_national_code($code)
// {
//     if (!preg_match('/^[0-9]{10}$/', $code))
//         return false;
//     for ($i = 0; $i < 10; $i++)
//         if (preg_match('/^' . $i . '{10}$/', $code))
//             return false;
//     for ($i = 0, $sum = 0; $i < 9; $i++)
//         $sum += ((10 - $i) * intval(substr($code, $i, 1)));
//     $ret = $sum % 11;
//     $parity = intval(substr($code, 9, 1));
//     if (($ret < 2 && $ret == $parity) || ($ret >= 2 && $ret == 11 - $parity))
//         return true;
//     return false;
// }
///////////////////////////////////////////////////////
/**
 * Validate iranian bank sheba number (IBAN).
 *
 * @param $attribute
 * @param $value
 * @param $parameters
 * @return bool
 */
function validateIranianBankSheba($attribute, $value, $parameters)
{
    $value = preg_replace('/[\W_]+/', '', strtoupper($value));

    if (!preg_match('/^[A-Z]{2}\d{2}[A-Z0-9]{0,30}$/', $value)) {
        return false;
    }

    $ibanReplaceValues = array_combine(range('A', 'Z'), range(10, 35));
    $tmpIBAN = substr($value, 4) . substr($value, 0, 4);
    $tmpIBAN = strtr($tmpIBAN, $ibanReplaceValues);

    $tmpValue = 0;
    foreach (str_split($tmpIBAN) as $char) {
        $tmpValue = ($tmpValue * 10 + (int)$char) % 97;
    }

    return $tmpValue == 1;
}
///////////////////////////////////////////////////////
/**
 * Validate iranian bank payment card number validation.
 * depending on 'http://www.aliarash.com/article/creditcart/credit-debit-cart.htm' article.
 *
 * @param $attribute
 * @param $value
 * @param $parameters
 * @return bool
 */
function validateIranianBankCardNumber($attribute, $value, $parameters)
{
    if (isset($parameters[0]) && $parameters[0] == 'seprate') {
        if (!preg_match('/^\d{4}-\d{4}-\d{4}-\d{4}$/', $value)) {
            return false;
        }
        $value = str_replace('-', '', $value);
    }

    if (isset($parameters[0]) && $parameters[0] == 'space') {
        if (!preg_match('/^\d{4}\s\d{4}\s\d{4}\s\d{4}$/', $value)) {
            return false;
        }
        $value = str_replace(' ', '', $value);
    }

    if (!preg_match('/^\d{16}$/', $value)) {
        return false;
    }

    $sum = 0;

    for ($position = 1; $position <= 16; $position++) {
        $temp = $value[$position - 1];
        $temp = $position % 2 === 0 ? $temp : $temp * 2;
        $temp = $temp > 9 ? $temp - 9 : $temp;

        $sum += $temp;
    }

    return ($sum % 10 === 0);
}
///////////////////////////////////////////////////////
///////////////////////////////////////////////////////
function validateShamsiDate($value)
{
    $value = convert2english($value);


    $jdate = preg_split('/(\-|\/)/', $value);
    return (count($jdate) === 3 && isValidjDate($jdate[0], $jdate[1], $jdate[2]));
}
function isValidjDate($year, $month, $day)
{
    if ($year < 0 || $year > 32766) {
        return false;
    }
    if ($month < 1 || $month > 12) {
        return false;
    }

    $daysMonthJalali = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29];
    $dayLastMonthJalali = in_array(($year % 33), [1, 5, 9, 13, 17, 22, 26, 30]) && ($month == 12) ? 30 : $daysMonthJalali[intval($month) - 1];
    if ($day < 1 || $day > $dayLastMonthJalali) {
        return false;
    }

    return true;
}
///////////////////////////////////////////////////////

// Add this action to handle the AJAX request
add_action('wp_ajax_save_return_request', 'save_return_request');
// add_action('wp_ajax_nopriv_save_return_request', 'save_return_request');
function save_return_request()
{
    parse_str($_POST['data'], $data);
    $order_id = sanitize_text_field($data['order_id']);
    $order = wc_get_order($order_id);
    $user = wp_get_current_user();

    // one week return time 604800
    if ($order->get_meta('order_completed_time', true) + 604800 < time()) {
        // Your response in array
        $array_result = array(
            'message' => 'ثبت نشد. زمان مرجوعی به پایان رسیده.'
        );
        // Make your array as json
        wp_send_json($array_result);
        // Don't forget to stop execution afterward.
        wp_die();
    }

    if ($user->ID == $order->get_user_id()) {
        if ($order->get_meta('_return_request', true) != '') {
            $array_result = array(
                'message' => 'درخواست قبلا ثبت شده است.'
            );
        } else {
            $order_status = $order->get_status();
            if ($order_status == 'completed') {
                $order->add_order_note("کابر درخواست مرجوعی دارد." . "\n" . "متن درخواست کاربر:" . "\n" . sanitize_text_field($data['request_text']), 0, true);
                $order->update_status("case2", '', true);
                update_post_meta($order_id, '_return_request', sanitize_text_field($_POST["request_text"]));
                // Your response in array
                $array_result = array(
                    'message' => 'درخواست شما ثبت شد. منتظر تماس کارشناسان ما باشید.'
                );
            } else {
                $array_result = array(
                    'message' => 'امکان مرجوع در این مرحله وجود ندارد.'
                );
            }
        }
    } else {
        // Your response in array
        $array_result = array(
            'message' => 'ثبت نشد.'
        );
    }
    // Make your array as json
    wp_send_json($array_result);
    // Don't forget to stop execution afterward.
    wp_die();
}

// Add this action to handle the AJAX request
add_action('wp_ajax_save_return_request_cancel', 'save_return_request_cancel');
function save_return_request_cancel()
{
    parse_str($_POST['data'], $data);
    $order_id = sanitize_text_field($data['order_id']);
    $order = wc_get_order($order_id);
    $user = wp_get_current_user();
    if ($user->ID == $order->get_user_id()) {
        if ($order->get_meta('_return_request_cancel', true) != '') {
            $array_result = array(
                'message' => 'درخواست قبلا ثبت شده است.'
            );
        } else {
            $order_status = $order->get_status();
            if ($order_status == 'processing' || $order_status == 'accepted' || $order_status == 'receive-warehouse' || $order_status == 'preparation') {
                $order->add_order_note("کابر درخواست لغو دارد.", 0, true);
                $order->update_status("case1", '', true);
                update_post_meta($order_id, '_return_request_cancel', 1);
                // Your response in array
                $array_result = array(
                    'message' => 'درخواست شما ثبت شد. منتظر تماس کارشناسان ما باشید.'
                );
            } else {
                $array_result = array(
                    'message' => 'امکان لغو در این مرحله وجود ندارد'
                );
            }
        }
    } else {
        // Your response in array
        $array_result = array(
            'message' => 'ثبت نشد.'
        );
    }
    // Make your array as json
    wp_send_json($array_result);
    // Don't forget to stop execution afterward.
    wp_die();
}
