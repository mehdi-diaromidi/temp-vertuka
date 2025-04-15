<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package vertuka
 */

get_header();
$title = esc_html(get_the_title());
$url = esc_url(get_the_permalink());

?>
<main id="primary" class="site-main vertuka-archive">

	<div class="off-products-section">
		<div class="container-fluid">
			<div class="inner-box">
				<div class="row">
					<div class="col-12 col-lg-9">

						<!-- Archive page-heading [start] -->
						<div class="page-heading">
							<div class="d-flex">

								<div class="flex-grow-1 w-100 text-box">
									<div class="breadcrumb-box">
										<ul class="d-flex">
											<li><a href="<?php echo esc_url(get_bloginfo('url')); ?>">خانه</a></li>
											<li><a href="/blog">وبلاگ</a></li>
											<li><span><?php the_archive_title('', ''); ?></span></li>
										</ul>
										
									</div>
								</div>

							</div>
						</div>
						<h1 class="page-title"><?php the_archive_title('', ''); ?></h1>
						<!-- Archive page-heading [end] -->


						<div class="archive-blog-section mt-0 pt-0">
							<div class="row">
								<?php
								/* Start the Loop */
								while (have_posts()) :
									the_post();

									$post_id = get_the_ID();
									$esc_post_url = esc_url(get_the_permalink());
									$esc_post_id = esc_attr($post_id);
									$esc_date =  vertuka_the_persian_number(get_the_date('Y/m/d', $post_id));
									$esc_post_url = esc_url(get_the_permalink($post_id));
									$esc_title = esc_html(get_the_title($post_id));
									$esc_thumbnail_url = esc_url(get_the_post_thumbnail_url($post_id, 'full'));
									$post = get_post($post_id);
									$author_id = $post->post_author;
									$author_info = get_userdata($author_id);
									$author_nickname = $author_info->display_name;
								?>
									<div class="col-lg-4 col-md-6 col-12 item mb-3">
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
											<h3 class="post-title"><a class="text-black" href="<?php echo $esc_post_url; ?>"><?php echo $esc_title; ?></a>
											</h3>
											<div class="post-excerpt">
												<?php the_excerpt(); ?>
											</div>
										</div>
									</div>
								<?php


								endwhile;
								?>
							</div>
						</div>
					</div>

					<div class="col-12 col-lg-3 d-flex flex-wrap justify-content-center justify-content-lg-end align-items-lg-start h-25 mt-3 mt-lg-0">
						<div class="NewsLink col-12">
							<h5>مرتبط ترین لینک ها</h5>
							<ul>
								<?php
								// Get the current post's ID
								$current_post_id = get_the_ID();

								// Get the current post's categories and tags
								$post_categories = wp_get_post_categories($current_post_id);
								$post_tags = wp_get_post_tags($current_post_id);

								// If the post has categories or tags, fetch related posts
								if ($post_categories || $post_tags) {
									$args = array(
										'post__not_in' => array($current_post_id), // Exclude the current post
										'posts_per_page' => 4, // Number of related posts to display
										'orderby' => 'rand', // Order by random to mix up results
										'tax_query' => array(
											'relation' => 'OR', // Combine category and tag queries
											array(
												'taxonomy' => 'category',
												'field' => 'id',
												'terms' => $post_categories,
												'operator' => 'IN',
											),
											array(
												'taxonomy' => 'post_tag',
												'field' => 'id',
												'terms' => $post_tags,
												'operator' => 'IN',
											),
										),
									);

									$related_posts_query = new WP_Query($args);

									if ($related_posts_query->have_posts()) {
										echo '<ul>';

										while ($related_posts_query->have_posts()) {
											$related_posts_query->the_post();
											echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
										}

										echo '</ul>';
									}

									// Reset post data
									wp_reset_postdata();
								}
								?>
							</ul>
						</div>

						<?php
						// Get the current post's tags
						$post_tags = get_the_tags();

						if ($post_tags) {
						?>
							<div class="Label col-12">
								<h5>برچسب های مرتبط</h5>
								<?php
								echo '<ul class="post-tags">';
								foreach ($post_tags as $tag) {
									echo '<li><a class="text-black" href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></li>';
								}
								echo '</ul>';
								?>
							</div>
						<?php
						}
						?>


					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Feature of shopping from us [start] -->
	<?php echo do_shortcode('[vertuka-shopping-features]'); ?>
	<!-- Feature of shopping from us [End] -->

</main>
<?php
get_footer();
