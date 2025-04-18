<?php
function vertuka_wc_archive_post_title_class()
{
    return 'temporary-product-title';
}
add_filter('woocommerce_product_loop_title_classes', 'vertuka_wc_archive_post_title_class');


function vertuka_wc_myacount_nav($items)
{
    unset($items['downloads']);
    unset($items["customer-logout"]);
    $items['vertuka-account-detail'] = 'اطلاعات کاربری';
    $items["customer-logout"] = 'خروج';
    return $items;
}
add_filter('woocommerce_account_menu_items', 'vertuka_wc_myacount_nav', 10, 1);


/**
 * Handle User Meta Data
 */

function vertuka_save_data_usermeta()
{
    // die('UNDER DEVELOPMENT');
    if (isset($_POST['vertuka_extra_usermeta']) && is_user_logged_in()) {

        if (!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['national_code'])  && !empty($_POST['birthday'])) {
            if (check_national_code(sanitize_text_field($_POST['national_code'])) && validateShamsiDate(sanitize_text_field($_POST['birthday']))) {

                $data = array(
                    'first_name'    => 'نام',
                    'last_name' => 'نام خانوادگی',
                    'national_code' => 'کد ملی',
                    'birthday' => 'تاریخ تولد',
                );

                $user_id = get_current_user_id(); // Get the current user's ID
                if ($user_id) {

                    foreach ($data as $field => $label) {
                        $custom_field_value = sanitize_text_field($_POST[$field]);
                        // Save the custom field value in usermeta
                        update_user_meta($user_id, $field, $custom_field_value);
                    }
                }
            }
        }

        if (!empty($_POST['bank_name']) && !empty($_POST['card_number']) && !empty($_POST['sheba_number'])) {
            $data = array();
            if (validateIranianBankSheba(null, sanitize_text_field($_POST['sheba_number']), null) && validateIranianBankCardNumber(null, sanitize_text_field($_POST['card_number']), null)) {
                $data = array(
                    'bank_name' => 'نام بانک',
                    'card_number' => 'شماره کارت',
                    'sheba_number' => 'شماره شبا',
                );
            } else {
                wc_add_notice('لطفا تمام بخش‌ها را بصورت کامل و صحیح پر کنید.', 'error');
                // die('نام بانک، شماره کارت و شماره شبا باید معتبر باشند.');
                $error_message = 'testing error';
            }


            $user_id = get_current_user_id(); // Get the current user's ID
            if ($user_id) {

                foreach ($data as $field => $label) {
                    $custom_field_value = sanitize_text_field($_POST[$field]);
                    // Save the custom field value in usermeta
                    update_user_meta($user_id, $field, $custom_field_value);
                }
            }

            wc_add_notice('اطلاعات با موفقیت ذخیره شد.', 'success');
        } else {
            wc_add_notice('لطفا تمام بخش‌ها را بصورت کامل و صحیح پر کنید.', 'error');
            // die('نام بانک، شماره کارت و شماره شبا باید معتبر باشند.');
            $error_message = 'testing error';
        }

        if (!empty($_POST['company']) && !empty($_POST['economic_id']) && !empty($_POST['company_national_code']) && !empty($_POST['registration_id']) && !empty($_POST['company_address'])) {
            $data = array(
                // 'gender'    => 'جنسیت',
                'company'   => 'نام سازمان',
                'economic_id'   => 'کد اقتصادی',
                'company_national_code' => 'شناسه ملی',
                'registration_id'   => 'شناسه ثبت',
                'company_address'   => 'آدرس',
            );

            $user_id = get_current_user_id(); // Get the current user's ID
            if ($user_id) {

                foreach ($data as $field => $label) {
                    $custom_field_value = sanitize_text_field($_POST[$field]);
                    // Save the custom field value in usermeta
                    update_user_meta($user_id, $field, $custom_field_value);
                }
            }
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
add_action('init', 'vertuka_save_data_usermeta');



// // MD automate cancel the order after 10 minutes ---------- Start ----------
// function schedule_order_check($order_id) // 2. Then this function will be fire - this function set a cronjob that fire after 10 min
// {
//     if (!$order_id) {
//         return;
//     }

//     // 3. Here we check if the order has a wp_schedule_single_event before or not
//     if (!wp_next_scheduled('check_pending_order_status', array($order_id))) {
//         wp_schedule_single_event(time() + 60, 'check_pending_order_status', array($order_id));
//     }
// }
// add_action('woocommerce_new_order', 'schedule_order_check');  // 1. When customer register an order this hook will be fire


// function check_and_cancel_order($order_id) //5. This function will be fire after the hook
// {
//     $order = wc_get_order($order_id);

//     if (!$order) {
//         return;
//     }
//     if ($order->get_status() === 'pending') {
//         $order->update_status('cancelled', __('سفارش به دلیل عدم پرداخت مشتری لغو شد.', 'vertuka'));
//     }
// }
// add_action('check_pending_order_status', 'check_and_cancel_order'); // 4. After 10 min, that cronjob will be fire on this hook
// // MD automate cancel the order after 10 minutes ---------- End ----------


// MJ order status change from pending to canceled send sms
add_action('woocommerce_order_status_changed', 'so_status_completed', 10, 3);

function so_status_completed($order_id, $old_status, $new_status)
{

    if ($old_status == 'pending' && $new_status == 'cancelled') {
        $order = wc_get_order($order_id);
        $user_info = get_userdata($order->get_customer_id());
        $user = $order->get_user();
        $msg = $user_info->first_name . " جان!
ما تا مدت کوتاهی سبد خرید شما را برایتان نگه خواهیم داشت و پس از آن، سفارش شما به ناچار لغو خواهد شد.
در این مدت می‌توانید از طریق لینک زیر سفارشتان را نهایی کنید.

vertuka.com/checkout
        ";
        $data = [
            'post_id' => '',
            'type'    => 0,
            'mobile'  => $user->user_login,
            'message' => $msg,
        ];
        PWooSMS()->SendSMS($data);
        // var_dump(PWooSMS()->SendSMS($data));
        // die;
    }
}

// MJ redirect user to login page if they visit checkout page without login
add_action('template_redirect', 'redirect_to_login_on_checkout_page_if_not_login');
function redirect_to_login_on_checkout_page_if_not_login()
{
    //variable for check user logged in
    $isUserLogged = false;

    //Checks if the current visitor is a logged in user.
    if (!function_exists('is_user_logged_in')) {

        $user = wp_get_current_user();

        if (!empty($user->ID)) {
            $isUserLogged = true;
        }
    } else {

        if (is_user_logged_in()) {
            $isUserLogged = true;
        }
    }

    if (is_page('checkout') && !$isUserLogged && !count(WC()->cart->get_cart())) {

        $cookie_name = 'MAIN_REFERER';
        $cookie_value = 'checkout';
        setcookie($cookie_name, $cookie_value, time() + (3600), "/"); // 3600 = 1 hour

        wp_redirect('https://vertuka.com/login', 301);
        exit;
    }
}
///////////////////////////////////////////////
// sort orders in admin page by ID
function action_parse_query($query)
{
    global $pagenow;

    // Initialize
    $query_vars = &$query->query_vars;

    // Only on WooCommerce admin order list
    if (is_admin() && $query->is_main_query() && $pagenow == 'edit.php' && $query_vars['post_type'] == 'shop_order') {
        // Set
        $query->set('orderby', 'ID');
        $query->set('order', 'desc');
    }
}
add_action('parse_query', 'action_parse_query', 10, 1);
///////////////////////////////////////////////


add_filter('woocommerce_package_rates', 'custom_shipping_cost_for_flat_rate_25', 10, 2);

function custom_shipping_cost_for_flat_rate_25($rates, $package)
{
    if (isset($rates['flat_rate:25'])) {
        $shipping_method = $rates['flat_rate:25'];
        $base_cost = isset($shipping_method->cost) ? floatval($shipping_method->cost) : 0;

        $weight = WC()->cart->get_cart_contents_weight() * 1000;

        if ($weight <= 500) {
            $shipping_cost = $base_cost;
        } elseif ($weight > 500 && $weight <= 1000) {
            $shipping_cost = $base_cost + (($weight - 500) * 18);
        } elseif ($weight > 1000 && $weight <= 2000) {
            $shipping_cost = $base_cost + 10000 + (($weight - 1000) * 10);
        } elseif ($weight > 2000) {
            $shipping_cost = $base_cost + 20000 + (($weight - 2000) * 8);
        }

        // محاسبه بیمه
        $insurance = (WC()->cart->get_cart_contents_total() * 2) / 1000;

        // اعمال ضریب 1.3 و گرد کردن قیمت
        $shipping_cost = ceil((($shipping_cost + $insurance + 3000) * 1.3) / 1000) * 1000;

        // به‌روزرسانی هزینه حمل و نقل
        $rates['flat_rate:25']->cost = $shipping_cost;
    }

    return $rates;
}


add_filter('woocommerce_package_rates', 'apply_free_shipping_for_high_cart_total', 10, 2);

function apply_free_shipping_for_high_cart_total($rates, $package)
{
    // بررسی مبلغ کل سبد خرید
    $cart_total = WC()->cart->get_cart_contents_total();

    // اگر مبلغ سبد خرید بیشتر از 10 میلیون تومان باشد
    if ($cart_total >= 10000000) {
        // لیست روش‌های حمل و نقل مورد نظر
        $target_shipping_methods = ['flat_rate:21', 'flat_rate:25', 'flat_rate:19'];

        // حلقه برای بررسی هر روش حمل و نقل
        foreach ($target_shipping_methods as $method_id) {
            if (isset($rates[$method_id])) {
                // تنظیم هزینه ارسال به صفر
                $rates[$method_id]->cost = 0;

                // اگر هزینه‌های اضافی وجود دارد، آن‌ها را نیز صفر کنید
                if (isset($rates[$method_id]->taxes)) {
                    $rates[$method_id]->taxes = array_fill_keys(array_keys($rates[$method_id]->taxes), 0);
                }
            }
        }
    }

    return $rates;
}
