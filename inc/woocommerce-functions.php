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

// MD automate cancel the order after 10 minutes ---------- Start ----------
function schedule_order_check($order_id) // 2. Then this function will be fired - this function sets a cron job that fires after 10 minutes
{
    if (!$order_id) {
        return;
    }

    // 3. Here we check if the order has a wp_schedule_single_event before or not
    if (!wp_next_scheduled('check_pending_order_status', array($order_id))) {
        wp_schedule_single_event(time() + 600, 'check_pending_order_status', array($order_id)); // Changed from 60 to 600 seconds
    }
}
add_action('woocommerce_new_order', 'schedule_order_check');  // 1. When a customer registers an order, this hook will be fired

function check_and_cancel_order($order_id) //5. This function will be fired after the hook
{
    $order = wc_get_order($order_id);

    if (!$order) {
        return;
    }
    if ($order->get_status() === 'pending') {
        $order->update_status('cancelled', __('سفارش به دلیل عدم پرداخت مشتری لغو شد.', 'vertuka'));
    }
}
add_action('check_pending_order_status', 'check_and_cancel_order'); // 4. After 10 minutes, that cron job will fire on this hook
// MD automate cancel the order after 10 minutes ---------- End ----------


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