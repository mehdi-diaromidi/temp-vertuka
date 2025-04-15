<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="express-cart-price <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

	<div class="inner-box">
		<div>
			<h3 class="title">جزئیات سفارش</h3>
			<div class="d-flex justify-content-between mb-3">
				<div><p class="m-0 whole-item">تعداد محصولات</p></div>
				<div>
					<p class="m-0 whole-item-count">
						<?php
							$cart_count = WC()->cart->get_cart_contents_count();
							echo vertuka_the_persian_number( $cart_count );
						?>
					</p>
				</div>
			</div>

			<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
				<div class="d-flex justify-content-between mb-3">
					<div class="text-left"><p class="m-0 off-item"><?php wc_cart_totals_coupon_label( $coupon ); ?></p></div>
					<div class="text-left"><p class="m-0 off-item-price" data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>"><?php wc_cart_totals_coupon_html( $coupon ); ?></p></div>
				</div>
			<?php endforeach; ?>




<!--			--><?php //if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
<!--			<div class="d-flex justify-content-between mb-3">-->
<!--				--><?php //do_action( 'woocommerce_cart_totals_before_shipping' ); ?>
<!--				<div>-->
<!--					<p class="m-0 price-to-pay-title">-->
<!--						--><?php //wc_cart_totals_shipping_html(); ?>
<!--					</p>-->
<!--				</div>-->
<!--				--><?php //do_action( 'woocommerce_cart_totals_after_shipping' ); ?>
<!--			</div>-->
<!--			--><?php //elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>
<!--			<div class="d-flex justify-content-between mb-3">-->
<!--				<div><p class="m-0 whole-item">--><?php //esc_html_e( 'Shipping', 'woocommerce' ); ?><!--</p></div>-->
<!--				<div><p class="m-0 whole-item-count" data-title="--><?php //esc_attr_e( 'Shipping', 'woocommerce' ); ?><!--">--><?php //woocommerce_shipping_calculator(); ?><!--</p></div>-->
<!--			</div>-->
<!--			--><?php //endif; ?>
<!---->
<!--			--><?php //foreach ( WC()->cart->get_fees() as $fee ) : ?>
<!--				<div class="d-flex justify-content-between mb-3">-->
<!--					<div><p class="m-0 whole-item">--><?php //echo esc_html( $fee->name ); ?><!--</p></div>-->
<!--					<div><p class="m-0 whole-item-count" data-title="--><?php //echo esc_attr( $fee->name ); ?><!--">--><?php //wc_cart_totals_fee_html( $fee ); ?><!--</p></div>-->
<!--				</div>-->
<!--			--><?php //endforeach; ?>

			<?php
			if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
				$taxable_address = WC()->customer->get_taxable_address();
				$estimated_text  = '';

				if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
					/* translators: %s location. */
					$estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
				}

				if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
					foreach ( WC()->cart->get_tax_totals() as $code => $tax ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
						?>
						<div class="d-flex justify-content-between mb-3">
							<div><p class="m-0 whole-item"><?php echo esc_html( $tax->label ) . $estimated_text; ?></p></div>
							<div><p class="m-0 whole-item-count" data-title="<?php echo esc_attr( $tax->label ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></p></div>
						</div>
						<?php
					}
				} else {
					?>

					<div class="d-flex justify-content-between mb-3">
						<div><p class="m-0 whole-item"><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text;?></p></div>
						<div><p class="m-0 whole-item-count" data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>"><?php wc_cart_totals_taxes_total_html(); ?></p></div>
					</div>
					<?php
				}
			}
			?>
		</div>

		<div>
			<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

			<div>

				<?php if ( vertuka_orginal_product_price() ){ ?>
					<div class="mb-1">
						<div class="d-flex justify-content-between">
							<div class="title text-black">قیمت کل <?php if( vertuka_discount_amount_product_price() != 0 )  echo '<br><span class="no-discount-text">(بدون تخفیف)</span>';  ?></div>
							<div class="text-end"><p class="mb-1 text-end orginal-price-discounted-product-2"><?php echo wc_price( vertuka_orginal_product_price() ); ?></p></div>
						</div>
					</div>
				<?php } ?>


				<?php if ( vertuka_discount_amount_product_price() != 0 ){ ?>
					<div id="vertuka-all-discounted" class="pb-1">
						<div class="d-flex justify-content-between">
							<div class="title text-black">تخفیف</div>
							<div class="price text-primary-5"><?php  echo wc_price(vertuka_discount_amount_product_price()); ?></div>
						</div>
					</div>
				<?php } ?>

				<div class="d-flex justify-content-between">
					<div><p class="m-0 price-to-pay-title">قابل پرداخت</p></div>
					<div>
						<!-- <div class="text-end"><p class="m-0 price-to-pay"><?php wc_cart_totals_order_total_html(); ?></p></div> -->
						<div class="text-end"><p class="m-0 price-to-pay"><?php wc_cart_totals_subtotal_html(); ?></p></div>
					</div>
				</div>


			</div>

			<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>
		</div>

		<div class="wc-proceed-to-checkout">
			<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
		</div>
	</div>
	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>

