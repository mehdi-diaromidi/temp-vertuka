<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

echo wc_get_stock_html( $product ); // WPCS: XSS ok.

if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<?php
		do_action( 'woocommerce_before_add_to_cart_quantity' );

		woocommerce_quantity_input(
			array(
				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
				'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
			)
		);

		do_action( 'woocommerce_after_add_to_cart_quantity' );
		?>


<?php 
$product_id = $product->get_id();
$esc_post_url = esc_url( get_the_permalink( $product_id ) );
$esc_title = esc_html( get_the_title( $product_id ) );
$esc_thumbnail_url = esc_url( get_the_post_thumbnail_url( $product_id, 'full' ) );
$esc_promotion_label = esc_html( get_post_meta( $product_id, 'adarayl_promotion_label', true ) );
$esc_add_to_cart_url = esc_url( wc_get_cart_url() ) . '?add-to-cart=' . $product_id;
// Get the regular price
$product = wc_get_product( $product_id );
$regular_price = $product->get_regular_price();
$sale_price = $product->get_sale_price();
//get category
$categories = get_the_terms($product_id, 'product_cat');

// get price of product
$product = wc_get_product($product_id);
if ($product->is_type('variable')) {
	if(method_exists($product,'get_available_variations')){
		$variations = $product->get_available_variations();
		$prices = array();
		foreach ($variations as $variation) {
			$variation_obj = new WC_Product_Variation($variation['variation_id']);
			$prices[] = $variation_obj->get_price();
		}
		// $lowest_price = min($prices);
		if(!empty($prices)) {
			$lowest_price = min($prices);
		} else {
			$lowest_price = false;
		} 
	}
} else {
	$lowest_price = $product->get_price();

}
$currency_symbol = get_woocommerce_currency_symbol();
$discount_percent = vertuka_diacount_calculator( $product_id, $lowest_price )
?>
<div class="price d-flex">
            <?php if ( $lowest_price != '0' && $discount_percent != 0 ){ ?>
                <div class="me-2">
                    <p class="number mj-orginal-price-discounted-product">
                        <del><?php echo vertuka_persian_number( vertuka_regular_price($product_id) ); ?></del>
                    </p>
                </div>
            <?php } ?>

            <div>
                <div class="mj-price-simple-product-page d-flex">
                    <p class="number me-2">
                        <?php echo vertuka_the_persian_number( number_format( $lowest_price ) ); ?>
                    </p>

                    <?php
                    if ( $lowest_price !== '' ){
                        ?>
                        <p class="currency">
                            <span><?php echo $currency_symbol; ?></span>
                        </p>
                        <?php
                    }
                    ?>
                </div>
            </div>

</div>






		<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
