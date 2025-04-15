<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');
$category_id = is_tax() ? get_queried_object()->term_id : '';
// $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : '';

// $total_pages = wc_get_loop_prop('total_pages');
// $pagination = $total_pages > 1 ? get_query_var('paged') : 1;

// if ($total_pages > 1) {
// 	$transient_key = 'md_category_page_cache_' . $category_id . '_page_' . $pagination . '_orderby_' . $orderby;
// } else {
// 	$transient_key = 'md_category_page_cache_' . $category_id . '_orderby_' . $orderby;
// }

// $cached_data = get_transient($transient_key);

// if (false === $cached_data) {
// 	echo 'cah';
// 	ob_start();
?>
<script>
	jQuery(document).ready(function($) {
		if ($(window).width() <= 768) {
			$('.woocommerce-pagination .page-numbers').each(function() {
				const $pages = $(this).find('li:not(:first-child):not(:last-child)');
				if ($pages.length > 3) {
					$pages.slice(2, -1).hide();
					$('<li class="dots" style="padding: 0px 2px;"> ... </li>').insertBefore($pages.last()).show();
				}
			});
		}
	});
</script>

<main class="archive-page-box vertuka-archive">
	<!-- Archive page-heading [start] -->
	<div class="container-fluid">
		<div class="d-flex">
			<!-- <div class="right-circle">
				<div class="shape"></div>
			</div> -->

			<div class="flex-grow-1 w-100 text-box">
				<div class="breadcrumb-box">
					<ul class="d-flex">
						<li><a href="<?php get_bloginfo('url') . '/shop'; ?>">ورتوکا</a></li>
						<li><span><?php woocommerce_page_title(); ?></span></li>
					</ul>
				</div>
			</div>

			<!-- <div class="left-circle">
				<div class="shape"></div>
			</div> -->
		</div>
	</div>
	<!-- Archive page-heading [end] -->


	<!-- Content [start] -->
	<div class="products-wrapper">
		<div class="container-fluid">
			<div class="off-products-section">
				<div class="inner-box">
					<div class="row">
						<div class="col-lg-2 col-12">
							<div class="filteration-box">
								<?php
								$category_mobile = '16';
								$category_smartwatch = '235';
								$category_headphone = '239';

								$term = get_queried_object();
								$category_id = $term->term_id;

								// Get the term object for term_1.
								$term_1_object = get_term($category_mobile);
								$term_1_object_1 = get_term($category_smartwatch);
								$term_1_object_2 = get_term($category_headphone);

								// Get the term object for term_2.
								$term_2_object = get_term($category_id);

								// Get the ancestors of term_2.
								$ancestors = get_ancestors($term_2_object->term_id, 'product_cat');

								if ($category_id == $category_mobile) {
									echo do_shortcode('[yith_wcan_filters slug="main-2"]');
								} elseif ($category_id == $category_smartwatch) {
									echo do_shortcode('[yith_wcan_filters slug="main-2-2"]');
								} elseif ($category_id == $category_headphone) {
									echo do_shortcode('[yith_wcan_filters slug="main-2-3"]');
								} elseif (in_array($term_1_object_1->term_id, $ancestors)) {
									// Check if term_1 is in the list of ancestors.
									$is_parent = in_array($term_1_object_1->term_id, $ancestors);

									if ($is_parent) {
										// term_1 is a parent of term_2.
										echo do_shortcode('[yith_wcan_filters slug="main-2-2"]');
									} else {
										echo do_shortcode('[yith_wcan_filters slug="main-3"]');
									}
								} elseif (in_array($term_1_object_2->term_id, $ancestors)) {
									// Check if term_1 is in the list of ancestors.
									$is_parent = in_array($term_1_object_2->term_id, $ancestors);

									if ($is_parent) {
										// term_1 is a parent of term_2.
										echo do_shortcode('[yith_wcan_filters slug="main-2-3"]');
									} else {
										echo do_shortcode('[yith_wcan_filters slug="main-3"]');
									}
								} elseif ($term_1_object && $term_2_object) {
									// Get the ancestors of term_2.
									$ancestors = get_ancestors($term_2_object->term_id, 'product_cat');

									// Check if term_1 is in the list of ancestors.
									$is_parent = in_array($term_1_object->term_id, $ancestors);

									if ($is_parent) {
										// term_1 is a parent of term_2.
										echo do_shortcode('[yith_wcan_filters slug="main-2"]');
									} else {
										if ($category_id == 2308) {
											echo '<img style="border-radius: 16px;" class="torbo-message" src="' . get_stylesheet_directory_uri() . '/assets/images/Torbo-Delivery.webp" alt="پیام توربو" width="100%" height="auto">';
											echo '
											<style>
											@media (min-width: 769px) {
												.off-products-section .col-lg-10 {
    												width: 78%;
 												}
												.off-products-section .col-lg-2 {
    												width: 22%;
 												}
												.filteration-box {
  													box-shadow: none !important;
													padding: 10px;
												}
											}
											.yith-wcan-filters-opener {
  												display: none !important;
											}
											@media (max-width: 769px) {
												.torbo-message {
												display: none;
												}
											}
											
											</style>
											';
										} else {
											echo do_shortcode('[yith_wcan_filters slug="main-3"]');
										}
									}
								}
								?>
							</div>
						</div>

						<div class="col-lg-10 col-12">
							<div class="row">

								<?php
								if (woocommerce_product_loop()) {

									/**
									 * Hook: woocommerce_before_shop_loop.
									 *
									 * @hooked woocommerce_output_all_notices - 10
									 * @hooked woocommerce_result_count - 20
									 * @hooked woocommerce_catalog_ordering - 30
									 */
									do_action('woocommerce_before_shop_loop');

								?>
									<div class="col-12 sort-product-by-box">
										<div class="d-block d-sm-flex justify-content-between">
											<div class="mb-3 mb-md-0">
												<p class="sort-text">
													مرتب&zwnj;سازی بر اساس:
												</p>
											</div>
											<div id="sort-product-by" class="d-flex flex-row-reverse flex-wrap justify-content-between justify-content-md-end">
												<?php $active = $_GET['orderby']; ?>
												<div class="me-0 me-md-1 mb-2 mb-sm-0 <?php if ($active == 'popularity') {
																							echo 'active';
																						} ?>">
													<a id="popularity">پرفروش&zwnj;ترین</a>
												</div>
												<div class="me-0 me-md-1 mb-2 mb-sm-0 <?php if ($active == 'price-desc') {
																							echo 'active';
																						} ?>">
													<a id="price-desc">گران&zwnj;ترین</a>
												</div>
												<div class="me-0 me-md-1 mb-2 mb-sm-0 <?php if ($active == 'price') {
																							echo 'active';
																						} ?>">
													<a id="price">ارزان&zwnj;ترین</a>
												</div>
												<div class="me-0 me-md-1 mb-2 mb-sm-0 <?php if ($active == 'date' || $active == '') {
																							echo 'active';
																						} ?>">
													<a id="date">جدید&zwnj;ترین</a>
												</div>
											</div>

										</div>
									</div>
									<h1 class="h4 pb-3">
										<?php woocommerce_page_title(); ?>
									</h1>
								<?php

									woocommerce_product_loop_start();

									if (wc_get_loop_prop('total')) {
										while (have_posts()) {
											the_post();
											do_action('woocommerce_shop_loop');

											wc_get_template_part('content', 'product');

											/**
											 * Hook: woocommerce_shop_loop.
											 */
										}
									}




									woocommerce_product_loop_end();


									/**
									 * Hook: woocommerce_after_shop_loop.
									 *
									 * @hooked woocommerce_pagination - 10
									 */
									do_action('woocommerce_after_shop_loop');
								} else {
									/**
									 * Hook: woocommerce_no_products_found.
									 *
									 * @hooked wc_no_products_found - 10
									 */
									do_action('woocommerce_no_products_found');
								}
								// echo '<button id="ajax-button" class="button">Click Me</button>
								// <div id="ajax-response"></div>
								// ';



								/**
								 * Hook: woocommerce_after_main_content.
								 *
								 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
								 */
								//do_action( 'woocommerce_after_main_content' );
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Content [End] -->

	<?php

	if (is_tax()) {
	?>
		<!-- Description [start] -->
		<div class="taxonomy-description about-shop-section">
			<div class="container-fluid">
				<?php
				// Check if we're on a product category or tag archive
				if (is_product_category() || is_product_tag()) {
					$term = get_queried_object(); // Get the current category or tag object
					if ($term) {
						$term_description = $term->description; // Get the description
						if (!empty($term_description)) {
							echo '<div id="about-shop-section-text" class="h-125px">' . wp_kses_post($term_description) . '</div>';
							echo '
								<div class="text-center pt-3">
									<a id="vertuka-show-more" class="button bg-success text-white">
										<span>ادامه مطلب</span>
									</a>
								</div>
							';
						}
					}
				}
				?>

			</div>
		</div>
		<!-- Description [End] -->
	<?php
	}
	?>
</main>
<?php
// 	$cached_data = ob_get_clean();
// 	set_transient($transient_key, $cached_data, 5 * MINUTE_IN_SECONDS);
// }

// echo $cached_data;
get_footer('shop');
