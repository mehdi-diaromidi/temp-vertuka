<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

defined( 'ABSPATH' ) || exit;

$order = wc_get_order( $order_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

if ( ! $order ) {
	return;
}

$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();

if ( $show_downloads ) {
	wc_get_template(
		'order/order-downloads.php',
		array(
			'downloads'  => $downloads,
			'show_title' => true,
		)
	);
}
?>
	<div class="woocommerce-order-details vertuka-order-details">
		<div class="row">
			<div class="col-xl-6 col-lg-7 col-md-12 col-12 mx-auto">
				<?php do_action( 'woocommerce_order_details_before_order_table', $order ); ?>
				<div class="cart-box">
					<?php
					foreach ( $order_items as $item_id => $item ) {
						$product = $item->get_product();
						?>
						<div class="item">
							<div class="d-flex">
								<div class="thumbnail-box"></div>
								<div class="content-box">
									<div class="cat-box"><a href="#"></a></div>
									<div class="title-box"><h3></h3></div>
									<div class="price-box"></div>

								</div>
							</div>
							<?php //var_dump($product); ?>
						</div>
						<?php
					}
					?>

					<div class="cart-box d-none">
						<section class="woocommerce-order-details">
							<table class="woocommerce-table woocommerce-table--order-details shop_table order_details">
								<tfoot>
								<?php
								foreach ( $order->get_order_item_totals() as $key => $total ) {
									?>
									<tr>
										<th scope="row"><?php echo esc_html( $total['label'] ); ?></th>
										<td><?php echo wp_kses_post( $total['value'] ); ?></td>
									</tr>
									<?php
								}
								?>
								<?php if ( $order->get_customer_note() ) : ?>
									<tr>
										<th><?php esc_html_e( 'Note:', 'woocommerce' ); ?></th>
										<td><?php echo wp_kses_post( nl2br( wptexturize( $order->get_customer_note() ) ) ); ?></td>
									</tr>
								<?php endif; ?>
								</tfoot>
							</table>
						</section>
					</div>
				</div>
				<?php do_action( 'woocommerce_order_details_after_order_table_items', $order ); ?>
			</div>
		</div>


	</div>


<?php
/**
 * Action hook fired after the order details.
 *
 * @since 4.4.0
 * @param WC_Order $order Order data.
 */
do_action( 'woocommerce_after_order_details', $order );

if ( $show_customer_details ) {
	wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) );
}
