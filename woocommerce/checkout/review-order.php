<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="express-cart-price shop_table woocommerce-checkout-review-order-table position-relative">
	<div class="inner-box">
		<div>
			<h3 class="title">جزئیات سفارش</h3>
			<div class="d-flex justify-content-between">
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
		</div>

		<div>
			<div class="d-flex justify-content-between">
				<div><p class="m-0 price-to-pay-title">قیمت کل <?php if( vertuka_discount_amount_product_price() != 0 )  echo '<span class="no-discount-text">(بدون تخفیف)</span>';  ?></p></div>
				<div>
					<div class="text-end"><p class="m-0 cart-subtotal price-to-pay-title"><?php echo wc_price( vertuka_orginal_product_price() ); ?></p></div>
				</div>
			</div>
		</div>



		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

		<div class="d-none">
			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
		</div>


		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<tr class="fee">
				<th><?php echo esc_html( $fee->name ); ?></th>
				<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
			<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
					<tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
						<th><?php echo esc_html( $tax->label ); ?></th>
						<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr class="tax-total">
					<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
					<td><?php wc_cart_totals_taxes_total_html(); ?></td>
				</tr>
			<?php endif; ?>
		<?php endif; ?>



		<div>

			<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

            <div id="vertuka-shipping-method-price">
                <div><p>هزینه‌ی ارسال سفارش</p></div>
                <div class="d-flex justify-content-between mb-3">
                    <div class="title"></div>
                    <div class="price"></div>
                </div>
            </div>

			<div>
				<?php if ( vertuka_orginal_product_price() ){ ?>
					<!-- <div class="mb-4">
						<div class="d-flex justify-content-between">
							<div class="title text-black">قیمت محصولات</div>
							<div class="text-end"><p class="mb-1 text-end orginal-price-discounted-product-2"><?php echo wc_price( vertuka_orginal_product_price() ); ?></p></div>
						</div>
					</div> -->
				<?php } ?>


				<?php if ( vertuka_discount_amount_product_price() != 0 ){ ?>
					<div id="vertuka-all-discounted">
						<div class="d-flex justify-content-between">
							<div class="title text-black">تخفیف</div>
							<div class="price text-primary-5"><?php  echo wc_price(vertuka_discount_amount_product_price()); ?></div>
						</div>
					</div>
				<?php } ?>

				<div class="mj-applied-coupon-block d-flex justify-content-between">
					<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
						<div>
							<p class="m-0 price-to-pay-title">کد تخفیف</p>
						</div>
						
						<div class="text-end"><p class="m-0 cart-subtotal price-to-pay-title"><span><?php wc_cart_totals_coupon_html( $coupon ); ?></span></p></div>
					<?php endforeach; ?>
				</div>

				<div class="d-flex justify-content-between">
					<div><p class="m-0 price-to-pay-title">قابل پرداخت</p></div>
					<div>
						<div class="text-end"><p class="m-0 price-to-pay"><?php wc_cart_totals_order_total_html(); ?></p></div>
					</div>
				</div>
			</div>

			<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
		</div>

	</div>
</div>