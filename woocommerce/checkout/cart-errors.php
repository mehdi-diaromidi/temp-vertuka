<?php

/**
 * Cart errors page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/cart-errors.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined('ABSPATH') || exit;

// MJ remove reserved product by others from cart
// WC()->cart->empty_cart();
$error                    = new WP_Error();
$product_qty_in_cart      = WC()->cart->get_cart_item_quantities();
$current_session_order_id = isset(WC()->session->order_awaiting_payment) ? absint(WC()->session->order_awaiting_payment) : 0;

foreach (WC()->cart->get_cart() as $cart_item_key => $values) {
    $product = $values['data'];

    // Check stock based on stock-status.
    // if ( ! $product->is_in_stock() ) {
    //     /* translators: %s: product name */
    //     $error->add( 'out-of-stock', sprintf( __( 'Sorry, "%s" is not in stock. Please edit your cart and try again. We apologize for any inconvenience caused.', 'woocommerce' ), $product->get_name() ) );
    //     return $error;
    // }

    // We only need to check products managing stock, with a limited stock qty.
    if (!$product->managing_stock() || $product->backorders_allowed()) {
        continue;
    }

    // Check stock based on all items in the cart and consider any held stock within pending orders.
    $held_stock     = wc_get_held_stock_quantity($product, $current_session_order_id);
    $required_stock = $product_qty_in_cart[$product->get_stock_managed_by_id()];

    if ($product->get_stock_quantity() < ($held_stock + $required_stock)) {

        if (!is_array($product->get_id()) && ($product->get_id() == $values['product_id'] || $product->get_id() == $values['variation_id'])) {
            WC()->cart->remove_cart_item($cart_item_key);
            wp_safe_redirect('https://vertuka.com/cart/');
            exit;
        }
    }
}
?>

<p><?php esc_html_e('برخی اقلام سبد خرید شما ناموجود شده است.', 'woocommerce'); ?></p>

<?php do_action('woocommerce_cart_has_errors'); ?>

<p><a class="button wc-backward" href="<?php echo esc_url(wc_get_cart_url()); ?>"><?php esc_html_e('Return to cart', 'woocommerce'); ?></a></p>