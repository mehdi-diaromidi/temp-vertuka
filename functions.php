<?php

/**
 * vertuka functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package vertuka
 */

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
require get_template_directory() . '/inc/theme-support.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/enqueue.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions for jalali date .
 */
require get_template_directory() . '/inc/jdf.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (class_exists('WooCommerce')) {
    require get_template_directory() . '/inc/woocommerce-functions.php';
}
/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

// First, remove the role if it exists
remove_role('callcenter');
remove_role('vertuka_writer');
remove_role('vertuka_editor');

// Get the administrator role
$admin_role = get_role('administrator');
$admin_capabilities = $admin_role->capabilities;

$capabilities_to_remove = [
    'activate_plugins',
    'delete_plugins',
    'edit_plugins',
    'install_plugins',
    'update_plugins',
    'switch_themes',
    'edit_themes',
    'delete_themes',
    'install_themes',
    'update_themes',
    'update_core'
];

foreach ($capabilities_to_remove as $capability) {
    unset($admin_capabilities[$capability]);
}

$MJ_callcenter_capabilities = [
    "edit_posts" => true,
    "edit_others_posts" => false,
    "read" => true,
    "edit_shop_order" => true,
    "read_shop_order" => true,
    "delete_shop_order" => true,
    "edit_shop_orders" => true,
    "edit_others_shop_orders" => true,
    "publish_shop_orders" => true,
    "read_private_shop_orders" => true,
    "delete_shop_orders" => true,
    "delete_private_shop_orders" => true,
    "delete_published_shop_orders" => true,
    "delete_others_shop_orders" => true,
    "edit_private_shop_orders" => true,
    "edit_published_shop_orders" => true,
    "manage_shop_order_terms" => true,
    "delete_shop_order_terms" => true,
    "assign_shop_order_terms" => true,

];

$MJ_callcenter_capabilities_vertuka_writer = [
    "rank_math_edit_htaccess" => true,
    "rank_math_titles" => true,
    "rank_math_general" => true,
    "rank_math_sitemap" => true,
    "rank_math_404_monitor" => true,
    "rank_math_link_builder" => true,
    "rank_math_redirections" => true,
    "rank_math_role_manager" => true,
    "rank_math_analytics" => true,
    "rank_math_site_analysis" => true,
    "rank_math_onpage_analysis" => true,
    "rank_math_onpage_general" => true,
    "rank_math_onpage_advanced" => true,
    "rank_math_onpage_snippet" => true,
    "rank_math_onpage_social" => true,
    "rank_math_content_ai" => true,
    "rank_math_admin_bar" => true,
    "edit_others_pages" => true,
    "edit_published_pages" => true,
    "publish_pages" => true,
    "delete_pages" => true,
    "delete_others_pages" => true,
    "delete_published_pages" => true,
    "delete_private_pages" => true,
    "edit_private_pages" => true,
    "read_private_pages" => true,
    "edit_pages" => true,
    "edit_files" => true,
    "moderate_comments" => true,
    "manage_categories" => true,
    "manage_links" => true,
    "upload_files" => true,
    "edit_posts" => true,
    "edit_others_posts" => true,
    "edit_published_posts" => true,
    "publish_posts" => true,
    "read" => true,
    "level_10" => true,
    "level_9" => true,
    "level_8" => true,
    "level_7" => true,
    "level_6" => true,
    "level_5" => true,
    "level_4" => true,
    "level_3" => true,
    "level_2" => true,
    "level_1" => true,
    "level_0" => true,
    "delete_posts" => true,
    "delete_others_posts" => true,
    "delete_published_posts" => true,
    "delete_private_posts" => true,
    "edit_private_posts" => true,
    "read_private_posts" => true,
    "edit_product" => true,
    "read_product" => true,
    "delete_product" => true,
    "edit_products" => true,
    "edit_others_products" => true,
    "publish_products" => true,
    "read_private_products" => true,
    "delete_products" => true,
    "delete_private_products" => true,
    "delete_published_products" => true,
    "delete_others_products" => true,
    "edit_private_products" => true,
    "edit_published_products" => true,
    "manage_product_terms" => true,
    "edit_product_terms" => true,
    "delete_product_terms" => true,
    "assign_product_terms" => true,
];

$MJ_callcenter_capabilities_vertuka_editor = [
    // "switch_themes"=> true,
    // "edit_themes"=> true,
    // "activate_plugins"=> true,
    // "edit_plugins"=> true,
    // "edit_users"=> true,
    "edit_files" => true,
    // "manage_options"=> true,
    "moderate_comments" => true,
    "manage_categories" => true,
    "manage_links" => true,
    "upload_files" => true,
    // "import"=> true,
    // "unfiltered_html"=> true,
    "edit_posts" => true,
    "edit_others_posts" => true,
    "edit_published_posts" => true,
    "publish_posts" => true,
    "edit_pages" => true,
    "read" => true,
    "level_10" => true,
    "level_9" => true,
    "level_8" => true,
    "level_7" => true,
    "level_6" => true,
    "level_5" => true,
    "level_4" => true,
    "level_3" => true,
    "level_2" => true,
    "level_1" => true,
    "level_0" => true,
    // "edit_others_pages"=> true,
    // "edit_published_pages"=> true,
    // "publish_pages"=> true,
    // "delete_pages"=> true,
    // "delete_others_pages"=> true,
    // "delete_published_pages"=> true,
    "delete_posts" => true,
    "delete_others_posts" => true,
    "delete_published_posts" => true,
    "delete_private_posts" => true,
    "edit_private_posts" => true,
    "read_private_posts" => true,
    "edit_product" => true,
    "read_product" => true,
    "delete_product" => true,
    "edit_products" => true,
    "edit_others_products" => true,
    "publish_products" => true,
    "read_private_products" => true,
    "delete_products" => true,
    "delete_private_products" => true,
    "delete_published_products" => true,
    "delete_others_products" => true,
    "edit_private_products" => true,
    "edit_published_products" => true,
    "manage_product_terms" => true,
    "edit_product_terms" => true,
    "delete_product_terms" => true,
    "assign_product_terms" => true,
    // "edit_shop_order"=> true,
    // "read_shop_order"=> true,
    // "delete_shop_order"=> true,
    // "edit_shop_orders"=> true,
    // "edit_others_shop_orders"=> true,
    // "publish_shop_orders"=> true,
    // "read_private_shop_orders"=> true,
    // "delete_shop_orders"=> true,
    // "delete_private_shop_orders"=> true,
    // "delete_published_shop_orders"=> true,
    // "delete_others_shop_orders"=> true,
    // "edit_private_shop_orders"=> true,
    // "edit_published_shop_orders"=> true,
    // "manage_shop_order_terms"=> true,
    // "edit_shop_order_terms"=> true,
    // "delete_shop_order_terms"=> true,
    // "assign_shop_order_terms"=> true,
    // "edit_shop_coupon"=> true,
    // "read_shop_coupon"=> true,
    // "delete_shop_coupon"=> true,
    // "edit_shop_coupons"=> true,
    // "edit_others_shop_coupons"=> true,
    // "publish_shop_coupons"=> true,
    // "read_private_shop_coupons"=> true,
    // "delete_shop_coupons"=> true,
    // "delete_private_shop_coupons"=> true,
    // "delete_published_shop_coupons"=> true,
    // "delete_others_shop_coupons"=> true,
    // "edit_private_shop_coupons"=> true,
    // "edit_published_shop_coupons"=> true,
    // "manage_shop_coupon_terms"=> true,
    // "edit_shop_coupon_terms"=> true,
    // "delete_shop_coupon_terms"=> true,
    // "assign_shop_coupon_terms"=> true,
    // "rank_math_edit_htaccess"=> true,
    // "rank_math_titles"=> true,
    // "rank_math_general"=> true,
    // "rank_math_sitemap"=> true,
    // "rank_math_404_monitor"=> true,
    // "rank_math_link_builder"=> true,
    // "rank_math_redirections"=> true,
    // "rank_math_role_manager"=> true,
    // "rank_math_analytics"=> true,
    // "rank_math_site_analysis"=> true,
    // "rank_math_onpage_analysis"=> true,
    // "rank_math_onpage_general"=> true,
    // "rank_math_onpage_advanced"=> true,
    // "rank_math_onpage_snippet"=> true,
    // "rank_math_onpage_social"=> true,
    // "rank_math_content_ai"=> true,
    // "rank_math_admin_bar"=> true,
    // "read_wpdiscuz_form"=> true,
    // "read_wpdiscuz_forms"=> true,
    // "edit_wpdiscuz_form"=> true,
    // "edit_wpdiscuz_forms"=> true,
    // "edit_others_wpdiscuz_forms"=> true,
    // "edit_published_wpdiscuz_forms"=> true,
    // "publish_wpdiscuz_forms"=> true,
    // "delete_wpdiscuz_form"=> true,
    // "delete_wpdiscuz_forms"=> true,
    // "delete_others_wpdiscuz_forms"=> true,
    // "delete_private_wpdiscuz_forms"=> true,
    // "delete_published_wpdiscuz_forms"=> true,
    // "ppom_options_page"=> true,
];
// Add the Simple Admin role with the modified capabilities
add_role('callcenter', 'کال سنتر', $MJ_callcenter_capabilities);

add_role('vertuka_writer', 'نویسنده ورتوکا', $MJ_callcenter_capabilities_vertuka_writer);
add_role('vertuka_editor', 'ویرایشگر ورتوکا', $MJ_callcenter_capabilities_vertuka_editor);
////////////////////////////////////////////////////////////////////////

// disable updates	
add_filter('auto_update_plugin', '__return_false');

add_filter('auto_update_theme', '__return_false');

// Fix variation same price not showing 
add_filter('woocommerce_show_variation_price', '__return_true');

//////////////////////////////////////////
function woocommerce_disable_shop_page()
{
    global $post;
    if (is_shop()) :
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
    endif;
}
add_action('wp', 'woocommerce_disable_shop_page');
////////////////////////////////////////////
add_filter('loop_shop_per_page', 'new_loop_shop_per_page', 20);

function new_loop_shop_per_page($cols)
{
    // $cols contains the current number of products per page based on the value stored on Options -> Reading
    // Return the number of products you wanna show per page.
    $cols = 20;
    return $cols;
}
///////////////////////////////////////////
remove_filter('the_title', 'wptexturize');
remove_filter('the_content', 'wptexturize');
remove_filter('the_excerpt', 'wptexturize');

///////////////////////////////////////////

function add_pagination_rel_links_blog_page()
{
    if (is_page('blog')) {
        global $wp_query;
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;

        $total_posts = wp_count_posts()->publish;

        $posts_per_page = 12;
        $total_pages = ceil($total_posts / $posts_per_page);

        $current_url = get_permalink();
        echo "\n" . '<link rel="canonical" href="' . esc_url($current_url) . '" />';

        if ($paged > 1) {
            $prev_url = get_previous_posts_page_link();
            if ($prev_url) {
                echo "\n" . '<link rel="prev" href="' . esc_url($prev_url) . '" />';
            }
        }

        if ($paged < $total_pages) {
            $next_url = get_next_posts_page_link();
            if ($next_url) {
                echo  "\n" . '<link rel="next" href="' . esc_url($next_url) . '" />' . "\n";
            }
        }
    }
}
add_action('wp_head', 'add_pagination_rel_links_blog_page');

function enqueue_custom_styles()
{
    wp_enqueue_style('custom-styles', get_template_directory_uri() . '/css/new-styles.css');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');


function custom_order_woocommerce_products($query)
{
    if (! is_admin() && $query->is_main_query() && ($query->is_post_type_archive('product') || $query->is_tax('product_cat'))) {

        // اضافه کردن متا کوئری برای نمایش محصولات دارای موجودی در اولویت
        $query->set('meta_query', array(
            'relation' => 'OR',
            array(
                'key'     => '_stock',
                'value'   => 0,
                'compare' => '>',
                'type'    => 'NUMERIC',
            ),
            array(
                'key'     => '_stock',
                'value'   => 0,
                'compare' => '<=',
                'type'    => 'NUMERIC',
            ),
        ));

        // تنظیم ترتیب نمایش: ابتدا محصولات دارای موجودی، سپس محصولات بدون موجودی
        $query->set('orderby', array(
            'meta_value_num' => 'DESC', // ابتدا محصولات دارای موجودی
            'date'           => 'DESC'  // سپس بر اساس تاریخ انتشار مرتب‌سازی شود
        ));
    }
}
add_action('pre_get_posts', 'custom_order_woocommerce_products');


// M.Mehdi - WallPaper
function enqueue_image_dumper_template_styles()
{
    // Check if the current page is using the "Image SRC Dumper" template
    if (is_page_template('page-themplate/wall-paper.php')) {
        wp_enqueue_style(
            'wall-paper-page-style',
            get_template_directory_uri() . '/css/wall-paper-page.css',
            array(),
            '1.0.0',
            'all' 
        );
    }
}

// Hook the function to the 'wp_enqueue_scripts' action
add_action('wp_enqueue_scripts', 'enqueue_image_dumper_template_styles');


// M.Mehdi - Test
// include_once get_template_directory() . 'page-themplate/mehdi-test.php';


// M.Mehdi - User-Status
// include_once get_template_directory() . 'inc/user-status.php';

// if (is_user_logged_in()) {
//     echo ('hi');
// } else {
//     echo ('low');
// }

// function us_register_assets()
// {


//     // Localize script
//     wp_localize_script('us-ajax-js', 'us_ajax', [
//         'us_ajaxurl' => admin_url('admin-ajax.php'),
//         '_us_nonce' => wp_create_nonce('user_status_nonce'),
//     ]);
// }

// add_action('wp_enqueue_scripts', 'us_register_assets');
// function user_status_set()
// {
//     // if (!isset($_POST['_nonce']) || !wp_verify_nonce($_POST['_nonce'], 'wc_live_search_nonce')) {
//     //     // wp_send_json(['success' => false, 'message' => 'Access denied'], 403);
//     // }
//     if (is_user_logged_in()) {
//         wp_send_json([
//             'success' => true,
//             'user_login' => true
//         ], 200);
//     } else {
//         wp_send_json([
//             'success' => true,
//             'user_login' => false
//         ], 200);
//     }
// }
// add_action('wp_ajax_user_status_set', 'user_status_set');
// add_action('wp_ajax_nopriv_user_status_set', 'user_status_set');


// function enqueue_user_status_script()
// {
//     // مسیر فایل جاوااسکریپت
//     $script_url = get_template_directory_uri() . '/js/user-status.js'; // مسیر فایل را به درستی تنظیم کنید

//     // انکیو کردن اسکریپت
//     wp_enqueue_script(
//         'user-status-js', // Handle (شناسه منحصر به فرد)
//         $script_url,      // URL فایل جاوااسکریپت
//         array('jquery'),  // وابستگی‌ها (در اینجا jQuery)
//         1.2.0,          // ورژن فایل
//         true              // بارگذاری در Footer (true = در انتهای صفحه)
//     );
// }
// add_action('wp_enqueue_scripts', 'enqueue_user_status_script');

// function wc_ls_add_ajax_url_and_nonce_to_header()
// {
//     // تولید URL AJAX
//     $ajax_url = admin_url('admin-ajax.php');

//     // تولید نانس
//     $nonce = wp_create_nonce('wc_live_search_nonce');

//     // اضافه کردن به بخش <head> صفحه
//     echo '<script type="text/javascript">';
//     echo '/* <![CDATA[ */';
//     echo 'var wc_ls_ajax = {';
//     echo '"wc_ls_ajaxurl": "' . esc_js($ajax_url) . '",'; // URL AJAX
//     echo '"_wc_ls_nonce": "' . esc_js($nonce) . '"'; // نانس
//     echo '};';
//     echo '/* ]]> */';
//     echo '</script>';
// }
// add_action('wp_head', 'wc_ls_add_ajax_url_and_nonce_to_header', 0);


// در فایل functions.php افزودن کد زیر:
function secure_htaccess_rules($rules)
{
    $custom_rules = "
    <IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
    RewriteBase /
    RewriteRule ^index\.php$ - [L]
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule . /index.php [L]
    </IfModule>
    ";
    return $custom_rules . $rules; // کدهای شما + کدهای پیشفرض وردپرس
}
add_filter('mod_rewrite_rules', 'secure_htaccess_rules');

function vertuka_debug_popup($data)
{
    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        if ($current_user->user_email === '09336315689@vertuka.com') {
            $output = '<pre>' . var_export($data, true) . '</pre>';
            $escaped_output = htmlspecialchars($output, ENT_QUOTES, 'UTF-8');

            echo "<script>
                alert(`{$escaped_output}`);
            </script>";
        }
    }
}


add_filter('woocommerce_form_field', 'replace_shipping_city_select_with_input', 10, 4);
function replace_shipping_city_select_with_input($field, $key, $args, $value)
{
    if ($key === 'shipping_city') {
        $args['type'] = 'text';
        $args['class'] = array('form-row-wide');
        $args['label'] = __('شهر', 'woocommerce');
        $args['placeholder'] = __('نام شهر را وارد کنید...', 'woocommerce');

        $field = '<p class="form-row ' . esc_attr(implode(' ', $args['class'])) . '" id="' . esc_attr($args['id']) . '_field" data-priority="' . esc_attr($args['priority']) . '">';
        $field .= '<label for="' . esc_attr($args['id']) . '" class="' . ($args['required'] ? 'required' : '') . '">' . $args['label'] . '</label>';
        $field .= '<input type="' . esc_attr($args['type']) . '" class="input-text" name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" placeholder="' . esc_attr($args['placeholder']) . '" value="' . esc_attr($value) . '" />';
        $field .= '</p>';
    }

    return $field;
}

function sync_shipping_with_billing_address($order_id)
{
    // Get the order object
    $order = wc_get_order($order_id);

    if (!$order) {
        return;
    }

    // Get shipping and shipping addresses
    $shipping_address = array(
        'first_name' => $order->get_shipping_first_name(),
        'last_name'  => $order->get_shipping_last_name(),
        'company'    => $order->get_shipping_company(),
        'address_1'  => $order->get_shipping_address_1(),
        'address_2'  => $order->get_shipping_address_2(),
        'city'       => $order->get_shipping_city(),
        'state'      => $order->get_shipping_state(),
        'postcode'   => $order->get_shipping_postcode(),
        'country'    => $order->get_shipping_country(),
        'phone'      => $order->get_shipping_phone(),
    );

    // Update billing address with billing address data
    $order->set_billing_first_name($shipping_address['first_name']);
    $order->set_billing_last_name($shipping_address['last_name']);
    $order->set_billing_company($shipping_address['company']);
    $order->set_billing_address_1($shipping_address['address_1']);
    $order->set_billing_address_2($shipping_address['address_2']);
    $order->set_billing_city($shipping_address['city']);
    $order->set_billing_state($shipping_address['state']);
    $order->set_billing_postcode($shipping_address['postcode']);
    $order->set_billing_country($shipping_address['country']);

    // Save the updated order data
    $order->save();
}
/**
 * Set shipping address equal to billing address after order creation.
 */
add_action('woocommerce_checkout_update_order_meta', 'sync_shipping_with_billing_address');




// function empty_minicart_nonce()
// {
//     if (!check_ajax_referer('empty_minicart_nonce', 'security', false)) {
//         wp_send_json_error('خطا: نانس نامعتبر!');
//     }

//     if (WC()->cart) {
//         WC()->cart->empty_cart();
//         wp_send_json_success(array('message' => 'سبد خرید با موفقیت خالی شد.'));
//     } else {
//         wp_send_json_error(array('message' => 'خطا: سبد خرید در دسترس نیست.'));
//     }
// }
// add_action('wp_ajax_empty_cart', 'empty_minicart_nonce');
// add_action('wp_ajax_nopriv_empty_cart', 'empty_minicart_nonce');



// function empty_cart_single_ajax()
// {
//     // check_ajax_referer('empty_cart_single_nonce', 'security');
//     if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'empty_cart_nonce')) {
//         wp_send_json_error('Nonce verification failed');
//     }

//     $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;

//     if (!$product_id) {
//         wp_send_json_error('Invalid product ID');
//     }

//     // حذف محصول از سبد خرید
//     foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
//         if ($cart_item['product_id'] == $product_id) {
//             WC()->cart->remove_cart_item($cart_item_key);
//             wp_send_json_success('Product removed successfully');
//         }
//     }

//     wp_send_json_error('Product not found in cart');
// }
// add_action('wp_ajax_empty_cart_single_ajax', 'empty_cart_single_ajax');
// add_action('wp_ajax_nopriv_empty_cart_single_ajax', 'empty_cart_single_ajax');


// // mini
// function enqueue_custom_ajax_mini_script()
// {

//     wp_localize_script(
//         'custom-mini-ajax-script',
//         'customAjax',
//         array(
//             'ajaxurl' => admin_url('admin-ajax.php'),
//             'nonce'   => wp_create_nonce('empty_minicart_nonce')
//         )
//     );
// }
// add_action('wp_enqueue_scripts', 'enqueue_custom_ajax_mini_script');
// // تعریف عملکرد AJAX برای کاربران لاگین‌شده
// add_action('wp_ajax_my_custom_ajax_action', 'handle_custom_ajax_request');

// // تعریف عملکرد AJAX برای کاربران غیرلاگین
// add_action('wp_ajax_nopriv_my_custom_ajax_action', 'handle_custom_ajax_request');

// function handle_custom_ajax_request()
// {
//     if (WC()->cart) {
//         WC()->cart->empty_cart();
//         wp_send_json_success(array('message' => 'سبد خرید با موفقیت خالی شد.'));
//     } else {
//         wp_send_json_error(array('message' => 'خطا: سبد خرید در دسترس نیست.'));
//     }
// }
// mini



function enqueue_custom_scripts()
{
    wp_enqueue_script('emty-cart-ajax-script', get_template_directory_uri() . '/js/cart-ajax-managmet.js', array('jquery'), null, true);
    wp_localize_script('emty-cart-ajax-script', 'wc_empty_cart_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('empty_cart_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');


function empty_cart_ajax()
{
    // check_ajax_referer('empty_cart_nonce', 'security');
    // wp_send_json_success($_POST['_nonce']);

    if (WC()->cart) {
        WC()->cart->empty_cart();
        wp_send_json_success(array('message' => 'سبد خرید با موفقیت خالی شد.'));
    } else {
        wp_send_json_error(array('message' => 'خطا: سبد خرید در دسترس نیست.'));
    }
}
add_action('wp_ajax_empty_cart', 'empty_cart_ajax');
add_action('wp_ajax_nopriv_empty_cart', 'empty_cart_ajax');


add_action('wp_ajax_verify_national_id', 'verify_national_id_callback');
add_action('wp_ajax_nopriv_verify_national_id', 'verify_national_id_callback');

function verify_national_id_callback()
{
    // Verify nonce
    check_ajax_referer('verify_national_id_nonce', 'security');

    // Get current user ID
    $user_id = get_current_user_id();
    if (!$user_id) {
        wp_send_json_error(['type' => 'server-error', 'message' => 'User not logged in']);
    }

    // Get user's phone number
    $phone_number = get_user_meta($user_id, 'phone_number', true);
    if (!$phone_number) {
        wp_send_json_error(['type' => 'server-error', 'message' => 'Phone number not found']);
    }

    // Get national code from request
    $national_code = sanitize_text_field($_POST['national_code']);
    $name = sanitize_text_field($_POST['name']);
    $family = sanitize_text_field($_POST['family']);
    
    $attempts_key = 'verification_attempts_' . $phone_number;
    $attempts = get_option($attempts_key, []);
    if (count($attempts) >= 3) {
        wp_send_json_error(['type' => 'too-much-error', 'message' => 'Too many attempts']);
    }

    // Check internal cache
    $cache_key = 'verification_attempts_cache_' . $phone_number;
    $cached_code = get_option($cache_key);
    if ($cached_code && $cached_code === $national_code) {
        $attempts_key = 'verification_attempts_' . $phone_number;
        $attempts = get_option($attempts_key, []);
        $current_time = time();
        $attempts = array_filter($attempts, function ($timestamp) use ($current_time) {
            return ($current_time - $timestamp) < 180; // 3 minutes
        });
        wp_send_json_error(['type' => 'error', 'message' => 'National ID does not match', 'api_response' => 'Cached response']);
    }

    // Check anti-spam mechanism
    $attempts_key = 'verification_attempts_' . $phone_number;
    $attempts = get_option($attempts_key, []);
    $current_time = time();
    $attempts = array_filter($attempts, function ($timestamp) use ($current_time) {
        return ($current_time - $timestamp) < 180; // 3 minutes
    });

    

    // Call Shahkar API
    $response = wp_remote_post('https://service.zohal.io/api/v0/services/inquiry/shahkar', [
        'headers' => [
            'Authorization' => 'Bearer 3fee0bf14ed4fe060ce4a403ff556e259417db98',
            'Content-Type' => 'application/json',
        ],
        'body' => json_encode([
            'mobile' => $phone_number,
            'national_code' => $national_code,
        ]),
    ]);

    $counter = get_option('national_id_counter', 0);
    update_option('national_id_counter', $counter - 1);

    if (is_wp_error($response)) {
        wp_send_json_error(['type' => 'server-error', 'message' => 'API request failed', 'api_response' => $response->get_error_message()]);
    }

    $body = json_decode(wp_remote_retrieve_body($response), true);

    if ($body['result'] === 1 && $body['response_body']['data']['matched'] === true) {
        // Increment request counter for admin
        update_user_meta($user_id, 'national_code', $national_code);
        update_user_meta($user_id, 'first_name ', $name);
        update_user_meta($user_id, 'last_name', $family);
        wp_send_json_success(['api_response' => $body]);
    } else {
        $attempts[] = $current_time;
        update_option($attempts_key, $attempts);

        // Cache the failed attempt
        update_option($cache_key, $national_code, false, 180); // Cache for 3 minutes

        if ($body['result'] === 4 || $body['result'] === 5) {
            wp_send_json_error(['type' => 'server-error', 'message' => 'API error', 'api_response' => $body]);
        }elseif($body['result'] === 6){
            wp_send_json_error(['type' => 'error', 'message' => 'National ID does not match', 'api_response' => $body]);
        }else {
            wp_send_json_error(['type' => 'error', 'message' => 'National ID does not match', 'api_response' => $body]);
        }
    }
    
}

// Add admin menu for managing national ID requests
add_action('admin_menu', 'add_national_id_status_menu');
function add_national_id_status_menu() {
    add_submenu_page(
        'options-general.php',
        'وضعیت استعلام کد ملی',
        'وضعیت استعلام کد ملی',
        'manage_options',
        'national-id-status',
        'render_national_id_status_page'
    );
}

function render_national_id_status_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    if (isset($_POST['add_balance'])) {
        $additional_balance = intval($_POST['additional_balance']);
        $counter = get_option('national_id_counter', 0);
        update_option('national_id_counter', $counter + $additional_balance);
    }

    $counter = get_option('national_id_counter', 0);
    ?>
    <div class="wrap">
        <h1>وضعیت استعلام کد ملی</h1>
        <form method="post">
            <table class="form-table">
                <tr>
                    <th scope="row">مانده درخواست‌ها</th>
                    <td><input type="text" value="<?php echo esc_attr($counter); ?>" readonly /></td>
                </tr>
                <tr>
                    <th scope="row">اضافه کردن موجودی</th>
                    <td><input type="number" name="additional_balance" value="0" /></td>
                </tr>
            </table>
            <p class="submit">
                <input type="submit" name="add_balance" class="button button-primary" value="Add Balance" />
            </p>
        </form>
    </div>
    <?php
}

// Add admin bar node
add_action('admin_bar_menu', 'add_national_id_status_to_admin_bar', 100);
function add_national_id_status_to_admin_bar($wp_admin_bar) {
    if (!current_user_can('manage_options')) {
        return;
    }

    $counter = get_option('national_id_counter', 0);
    $color = 'red';
    if ($counter > 50) {
        $color = 'green';
    } elseif ($counter > 10) {
        $color = 'orange';
    }

    $args = array(
        'id'    => 'national_id_status',
        'title' => '<span style="color: ' . $color . ';">وضعیت موجودی کد ملی: ' . $counter . '</span>',
        'href'  => admin_url('options-general.php?page=national-id-status'),
        'meta'  => array('class' => 'national-id-status'),
    );
    $wp_admin_bar->add_node($args);
}

