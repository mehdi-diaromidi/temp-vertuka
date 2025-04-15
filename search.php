<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package vertuka
 */

get_header();
?>

<main id="primary" class="site-main vertuka-archive search-page-wrapper">

	<?php if (have_posts()) : ?>

		<!-- Archive page-heading [start] -->
		<div class="page-heading">
			<div class="d-flex">
				<div class="right-circle">
					<div class="shape"></div>
				</div>

				<div class="flex-grow-1 w-100 text-box">
					<div class="breadcrumb-box">
						<ul class="d-flex">
							<li><a href="<?php echo esc_url(get_bloginfo('url') . '/shop'); ?>">فروشگاه</a></li>
							<li><span><?php printf(esc_html__('نتایج جستجو برای: %s', 'vertuka'), '<span>' . get_search_query() . '</span>'); ?></li>
						</ul>
						<h1 class="page-title">
							<?php printf(esc_html__('نتایج جستجو برای: %s', 'vertuka'), '<span>' . get_search_query() . '</span>'); ?>
						</h1>
					</div>
				</div>

				<div class="left-circle">
					<div class="shape"></div>
				</div>
			</div>
		</div>
		<!-- Archive page-heading [end] -->


		<div class="off-products-section my-5">
			<div class="container-fluid">
				<div class="inner-box">
					<div class="row">
						<?php
						$product_s = array();
						$post_s = array();
						/* Start the Loop */
						while (have_posts()) :
							the_post();

							$product_id = get_the_ID();
							if (get_post_type() == 'post') {

								$post_s[] = $product_id;
							} elseif (get_post_type() == 'product' && get_post_status() == 'publish') {
								$product_s[] = $product_id;
							}



							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
						//get_template_part( 'template-parts/content', 'search' );

						endwhile;
						?>


						<?php if (count($product_s) > 0) { ?>
							<div class="w-100">
								<div class="row">
									<?php
									if (count($product_s) > 0) {
										echo '<div>';
										echo '<h3 class="searched-match-item">';
										echo vertuka_the_persian_number(count($product_s)) . ' محصول یافت شد';
										echo '<h3>';
										echo '</div>';
									}
									?>

									<?php
									foreach ($product_s as $product_id) {
										$MJ_price_new = mj_same_price_everywhere($product_id);
										$esc_post_url = esc_url(get_the_permalink($product_id));
										$esc_title = esc_html(get_the_title($product_id));
										$esc_thumbnail_url = esc_url(get_the_post_thumbnail_url($product_id, 'post-thumbnail'));
										// Get the regular price
										$product = wc_get_product($product_id);
										//get category
										$categories = get_the_terms($product_id, 'product_cat');

									?>





										<div class="col-lg-3 col-md-6 col-12 item item-desktop mb-4 d-none d-md-block">

											<div class="img-box">
												<a href="<?php echo $esc_post_url; ?>">
													<img class="pic" src="<?php echo $esc_thumbnail_url; ?>" alt="<?php echo $esc_title; ?>">
												</a>
												<?php
												echo $MJ_price_new['custom_shape'];
												?>

												<div class="available-color"><?php echo vertuka_display_available_colors($product_id) ?></div>

											</div>

											<?php
											if ($categories && !is_wp_error($categories)) {
												// Sort the categories by term ID in descending order
												usort($categories, function ($a, $b) {
													return $b->term_id - $a->term_id;
												});

												// Get the first category (which is now the latest one)
												if ($categories[0]->slug == 'offers') {
													$last_category = $categories[1];
												} else {
													$last_category = $categories[0];
												}
												$category_url = get_term_link($last_category);

												// Output the category name
												echo '<div class="category"><p class="m-0"><a href="' . $category_url . '">' . $last_category->name . '</a></p></div>';
											}
											?>
											<div class="title">
												<h3>
													<a href="<?php echo $esc_post_url; ?>"><?php echo $esc_title; ?></a>
												</h3>
											</div>

											<?php
											echo $MJ_price_new['text'];
											?>
											<?php
											echo $MJ_price_new['discount_percent'];
											?>





										</div>

										<div class="col-12 item p-2 d-block d-md-none mobile-item mb-2">
											<div class="d-flex">
												<div>
													<?php
													echo $MJ_price_new['custom_shape'];
													?>
													<div class="thumbnail-box position-relative">
														<a href="<?php echo $esc_post_url; ?>" class="d-block">
															<img class="pic" src="<?php echo $esc_thumbnail_url; ?>" alt="<?php echo $esc_title; ?>">
														</a>
														<div class="available-color"><?php echo vertuka_display_available_colors($product_id) ?></div>
													</div>
												</div>
												<div class="py-2 category-product-details-text w-75">
													<?php
													if ($categories && !is_wp_error($categories)) {
														// Sort the categories by term ID in descending order
														usort($categories, function ($a, $b) {
															return $b->term_id - $a->term_id;
														});

														// Get the first category (which is now the latest one)
														if ($categories[0]->slug == 'offers') {
															$last_category = $categories[1];
														} else {
															$last_category = $categories[0];
														}
														$category_url = get_term_link($last_category);

														// Output the category name
														echo '<div class="category"><p class="m-0"><a href="' . $category_url . '">' . $last_category->name . '</a></p></div>';
													}
													?>
													<div class="title mb-0">
														<h3>
															<a href="<?php echo $esc_post_url; ?>"><?php echo $esc_title; ?></a>
														</h3>
													</div>

													<?php
													echo $MJ_price_new['text'];
													?>


												</div>
											</div>
										</div>


									<?php
									}
									?>
								</div>
							</div>
						<?php } ?>


						<?php if (count($product_s) > 0) { ?>
							<div class="w-100 archive-blog-section">
								<div class="row">
									<?php
									if (count($post_s) > 0) {
										echo '<div>';
										echo '<h3 class="searched-match-item">';
										echo vertuka_the_persian_number(count($post_s)) . ' نوشته یافت شد';
										echo '<h3>';
										echo '</div>';
									}
									?>
									<?php
									foreach ($post_s as $post_id) {
										$esc_post_id = esc_attr($post_id);
										$esc_date =  vertuka_the_persian_number(get_the_date('Y/m/d', $post_id));
										$esc_post_url = esc_url(get_the_permalink($post_id));
										$esc_title = esc_html(get_the_title($post_id));
										$esc_thumbnail_url = esc_url(get_the_post_thumbnail_url($post_id, 'full'));

										$post = get_post($post_id);
										$author_id = $post->post_author;
										$author_info = get_userdata($author_id);
										$author_nickname = $author_info->display_name;

										$cat = get_the_category($esc_post_id);
										$esc_comment = esc_html(intval(get_comments_number($esc_post_id)));
									?>

										<div class="col-xl-3 col-lg-4 col-md-6 col-12 item">
											<a class="d-block w-100" href="<?php echo $esc_post_url; ?>">
												<img class="post-thumbnail" src="<?php echo $esc_thumbnail_url; ?>" alt="<?php echo $esc_title; ?>">
											</a>

											<div class="post-information d-flex">
												<div class="me-3">
													<svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none">
														<path d="M19.7274 20.4471C19.2716 19.1713 18.2672 18.0439 16.8701 17.2399C15.4729 16.4358 13.7611 16 12 16C10.2389 16 8.52706 16.4358 7.12991 17.2399C5.73276 18.0439 4.72839 19.1713 4.27259 20.4471" stroke="#6A6A6A" stroke-width="2" stroke-linecap="round" />
														<circle cx="12" cy="8" r="4" stroke="#6A6A6A" stroke-width="2" stroke-linecap="round" />
													</svg>
													<span class="author"><?php echo $author_nickname; ?></span>
												</div>


												<div>
													<svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none" class="ms-3">
														<circle cx="12" cy="12" r="9" stroke="#6A6A6A" stroke-width="2" />
														<path d="M16.5 12H12.25C12.1119 12 12 11.8881 12 11.75V8.5" stroke="#6A6A6A" stroke-width="2" stroke-linecap="round" />
													</svg>
													<span class="date"><?php echo $esc_date; ?></span>
												</div>
											</div>

											<div class="content">
												<h3 class="post-title"><a class="text-black" href="<?php echo $esc_post_url; ?>"><?php echo $esc_title; ?></a></h3>
												<div class="post-excerpt">
													<?php the_excerpt(); ?>
												</div>
											</div>
										</div>

									<?php
									}
									?>
								</div>
							</div>
						<?php
						}

						// the_posts_navigation();
						?>
					</div>
				</div>
			</div>
		</div>
	<?php
	else :
		get_template_part('template-parts/content', 'none');
	endif;
	?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
