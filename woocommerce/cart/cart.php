<?php

/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); ?>

<form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
	<?php do_action('woocommerce_before_cart_table'); ?>

	<?php do_action('woocommerce_before_cart_contents'); ?>

	<?php
	foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
		$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
		$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
		/**
		 * Filter the product name.
		 *
		 * @since 2.1.0
		 * @param string $product_name Name of the product in the cart.
		 * @param array $cart_item The product in the cart.
		 * @param string $cart_item_key Key for the product in the cart.
		 */
		$product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);

		$product_category = vertuka_get_category_array($product_id);
		if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
			$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);

	?>
			<div class="item-box">
				<div class="d-flex justify-content-between mt-4 cart-product-item">
					<div class="d-flex">
						<div>
							<div class="img-box">
								<?php
								$thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

								if (!$product_permalink) {
									echo $thumbnail; // PHPCS: XSS ok.
								} else {
									printf('<a class="d-block" href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
								}
								?>
							</div>
						</div>

						<div class="ms-2 ms-md-3 pb-1 pb-md-3 pt-0 pt-md-3 pe-4 pe-md-5">
							<div class="mb-2 d-none d-md-block"><a class="cart-product-category" href="<?= $product_category['url'] ?>"><?= $product_category['name'] ?></a></div>
							<div class="mb-2">
								<?php
								if (!$product_permalink) {
									echo wp_kses_post($product_name . '&nbsp;');
								} else {
									/**
									 * This filter is documented above.
									 *
									 * @since 2.1.0
									 */
									echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a class="cart-product-title" href="%s"><h2>%s</h2></a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
								}

								do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

								// Meta data.
								//echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

								// Backorder notification.
								if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
									echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
								}
								?>
							</div>

							<div class="mb-2">
								<div class="d-flex">

									<?php

									if ($_product->price < $_product->regular_price) {
									?>
										<div>
											<div class="me-2">
												<p class="number orginal-price-discounted-product mt-1 mb-0">
													<del><?php echo vertuka_persian_number(number_format((int)$_product->regular_price)); ?></del>
												</p>
											</div>
										</div>
									<?php
									}
									?>




									<div class="discounted-price">
										<?php
										echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
										?>
									</div>
								</div>



							</div>


							<?php
							if ($_product->is_sold_individually()) {
								$min_quantity = 1;
								$max_quantity = 1;
							} else {
								$min_quantity = 1;
								if ($_product->get_max_purchase_quantity() == -1) {
									$max_quantity = 999;
								} else {
									$max_quantity = $_product->get_max_purchase_quantity();
								}
							}

							$product_quantity = woocommerce_quantity_input(
								array(
									'input_name'   => "cart[{$cart_item_key}][qty]",
									'input_value'  => $cart_item['quantity'],
									'max_value'    => $max_quantity,
									'min_value'    => $min_quantity,
									'product_name' => $product_name,
								),
								$_product,
								false
							);

							echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
							?>
							<div class="quantity d-none d-md-block">
								<div class="d-flex">
									<div class="me-3 pt-3">
										<p class="m-0 title">تعداد:</p>
									</div>

									<div>
										<div class="vertuka-q-input">
											<div class="increase">+</div>
											<div class="numb"><?php echo $cart_item['quantity'] ?></div>
											<div class="decrease">-</div>
										</div>
										<input class="d-none" id="<?php echo "cart[{$cart_item_key}][qty]" ?>" name="quantity" type="number" min="<?php //echo $min_quantity; 
																																					?>" max="<?php echo $max_quantity; ?>" value="<?php echo $cart_item['quantity'] ?>">
									</div>
								</div>
							</div>

							<div class="d-none">
								<button type="submit" class="vertuka-update-button button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>"><?php esc_html_e('Update cart', 'woocommerce'); ?></button>

								<?php do_action('woocommerce_cart_actions'); ?>

								<?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
							</div>
							<?php do_action('woocommerce_after_cart_contents');  ?>
						</div>
					</div>
					<div class="position-relative">
						<?php
						echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							'woocommerce_cart_item_remove_link',
							sprintf(
								'<a href="%s" class="remove remove-item" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="icon close"></i></a>',
								esc_url(wc_get_cart_remove_url($cart_item_key)),
								/* translators: %s is the product name */
								esc_attr(sprintf(__('Remove %s from cart', 'woocommerce'), wp_strip_all_tags($product_name))),
								esc_attr($product_id),
								esc_attr($_product->get_sku())
							),
							$cart_item_key
						);
						?>
					</div>
				</div>
				<div class="quantity d-block d-md-none">
					<div class="d-flex">
						<div class="me-3 pt-3">
							<p class="m-0 title">تعداد:</p>
						</div>

						<div>
							<div class="vertuka-q-input mobile-qty">
								<div class="increase">+</div>
								<div class="numb"><?php echo $cart_item['quantity'] ?></div>
								<div class="decrease">-</div>
							</div>
							<input class="d-none" id="<?php echo "cart[{$cart_item_key}][qty]" ?>" name="quantity" type="number" min="<?php echo $min_quantity; ?>" max="<?php echo $max_quantity; ?>" value="<?php echo $cart_item['quantity'] ?>">
						</div>
					</div>
				</div>
			</div>
			<!-- MJ add popup -->
			<!-- The Modal -->
			<div id="mjModal" class="modal">
				<!-- Modal content -->

				<div class="modal-content d-flex">
					<p>در حال بروزرسانی ...</p>
				</div>
			</div>

			<div id="mjModalOnlyOne" class="modal mjModal">
				<!-- Modal content -->

				<div class="modal-content d-flex">
					<div class="div-close">
						<i class="icon close"></i>
					</div>
					<p>امکان خرید بیش از یک عدد از این محصول وجود ندارد.</p>
				</div>
			</div>
			<!-- MJ end popup -->
	<?php
		}
	}
	?>

	<?php do_action('woocommerce_cart_contents'); ?>

	<?php do_action('woocommerce_after_cart_contents'); ?>

	<?php do_action('woocommerce_after_cart_table'); ?>
</form>

<?php do_action('woocommerce_before_cart_collaterals'); ?>


<?php do_action('woocommerce_after_cart'); ?>
<style>
	.woocommerce-Price-currencySymbol {
		margin-right: 5px;
	}
</style>