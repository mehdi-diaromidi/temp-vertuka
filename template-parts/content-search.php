<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package vertuka
 */

$product_id = get_the_ID();
$esc_post_url = esc_url( get_the_permalink() );
$esc_title = esc_html( get_the_title() );
$esc_thumbnail_url = esc_url( get_the_post_thumbnail_url( $product_id, 'post-thumbnail' ) );
// Get the regular price
$product = wc_get_product( get_the_ID() );
$categories = get_the_terms($product_id, 'product_cat');
?>

<div class="col-lg-3">
	<div class="item" id="produc-<?php echo esc_html($product_id); ?>">
		<div class="img-box">
			<a href="<?php echo $esc_post_url; ?>">
				<img class="pic" src="<?php echo $esc_thumbnail_url; ?>" alt="<?php echo $esc_title; ?>">
			</a>
		</div>
		<div class="category"><p class="m-0"><a href="#">شیائومی</a></p></div>
		<div class="title"><h3><a href="<?php echo $esc_post_url; ?>"><?php echo $esc_title; ?></a></h3></div>
		<div class="price">
			<p class="number me-2">
				<?php
				$product = wc_get_product($product_id);

				if ($product->is_type('variable')) {

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
					

				} else {
					$lowest_price = $product->get_price();

				}

				$currency_symbol = get_woocommerce_currency_symbol();
				echo vertuka_the_persian_number( number_format( $lowest_price ) );

				?>
			</p>

			<p class="currency">
				<span><?php echo $currency_symbol; ?></span>
			</p>
		</div>
		<div><a href="<?php echo $esc_post_url; ?>" class="button read-more d-block w-100 secondary">خرید محصول</a></div>
	</div>
</div>
