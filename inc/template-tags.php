<?php



/**

 * Custom template tags for this theme

 *

 * Eventually, some of the functionality here could be replaced by core features.

 *

 * @package vertuka

 */



if (!function_exists('vertuka_posted_on')) :

	/**

	 * Prints HTML with meta information for the current post-date/time.

	 */

	function vertuka_posted_on()

	{

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if (get_the_time('U') !== get_the_modified_time('U')) {

			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}



		$time_string = sprintf(

			$time_string,

			esc_attr(get_the_date(DATE_W3C)),

			esc_html(get_the_date()),

			esc_attr(get_the_modified_date(DATE_W3C)),

			esc_html(get_the_modified_date())

		);



		$posted_on = sprintf(

			/* translators: %s: post date. */

			esc_html_x('%s', 'post date', 'vertuka'),

			'<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'

		);



		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped



	}

endif;



if (!function_exists('vertuka_posted_by')) :

	/**

	 * Prints HTML with meta information for the current author.

	 */

	function vertuka_posted_by()

	{

		$byline = sprintf(

			/* translators: %s: post author. */

			esc_html_x('%s', 'post author', 'vertuka'),

			'<span class="author vcard"><a class="url fn n" href="#">' . esc_html(get_the_author()) . '</a></span>'

		);



		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped



	}

endif;



if (!function_exists('vertuka_entry_footer')) :

	/**

	 * Prints HTML with meta information for the categories, tags and comments.

	 */

	function vertuka_entry_footer()

	{

		// Hide category and tag text for pages.

		if ('post' === get_post_type()) {

			/* translators: used between list items, there is a space after the comma */

			$categories_list = get_the_category_list(esc_html__(', ', 'vertuka'));

			if ($categories_list) {

				/* translators: 1: list of categories. */

				printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'vertuka') . '</span>', $categories_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			}



			/* translators: used between list items, there is a space after the comma */

			$tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'vertuka'));

			if ($tags_list) {

				/* translators: 1: list of tags. */

				printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'vertuka') . '</span>', $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			}
		}



		if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {

			echo '<span class="comments-link">';

			comments_popup_link(

				sprintf(

					wp_kses(

						/* translators: %s: post title */

						__('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'vertuka'),

						array(

							'span' => array(

								'class' => array(),

							),

						)

					),

					wp_kses_post(get_the_title())

				)

			);

			echo '</span>';
		}



		edit_post_link(

			sprintf(

				wp_kses(

					/* translators: %s: Name of current post. Only visible to screen readers */

					__('Edit <span class="screen-reader-text">%s</span>', 'vertuka'),

					array(

						'span' => array(

							'class' => array(),

						),

					)

				),

				wp_kses_post(get_the_title())

			),

			'<span class="edit-link">',

			'</span>'

		);
	}

endif;



if (!function_exists('vertuka_post_thumbnail')) :

	/**

	 * Displays an optional post thumbnail.

	 *

	 * Wraps the post thumbnail in an anchor element on index views, or a div

	 * element when on single views.

	 */

	function vertuka_post_thumbnail()

	{

		if (post_password_required() || is_attachment() || !has_post_thumbnail()) {

			return;
		}



		if (is_singular()) :

?>



			<div class="post-thumbnail">

				<?php the_post_thumbnail(); ?>

			</div><!-- .post-thumbnail -->



		<?php else : ?>



			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">

				<?php

				the_post_thumbnail(

					'post-thumbnail',

					array(

						'alt' => the_title_attribute(

							array(

								'echo' => false,

							)

						),

					)

				);

				?>

			</a>



		<?php

		endif; // End is_singular().

	}

endif;



if (!function_exists('wp_body_open')) :

	/**

	 * Shim for sites older than 5.2.

	 *

	 * @link https://core.trac.wordpress.org/ticket/12563

	 */

	function wp_body_open()

	{

		do_action('wp_body_open');
	}

endif;





if (!function_exists('vertuka_main_navbar')) {

	function vertuka_main_navbar()

	{

		return '<ul class="main-menu"><li><a href="https://vertuka.com/">خانه<i class="icon left-arrow"></i></a></li><li><span href="#">گوشی موبایل<i class="icon left-arrow"></i></span><div class="submenu"><div class="vertuka-mega-menu-container"><ul class="vertuka-mega-menu column"><li><a href="https://vertuka.com/category/mobile/">گوشی موبایل  <span>(همه محصولات)</span><i class="icon left-arrow"></i></a></li><li><a href="https://vertuka.com/category/samsung-phone/">گوشی سامسونگ<i class="icon left-arrow"></i></a></li><li><a href="https://vertuka.com/category/xiaomi-phone/">گوشی شیائومی<i class="icon left-arrow"></i></a></li><li><a href="/category/poco-phone/">گوشی پوکو<i class="icon left-arrow"></i></a></li><li><a href="https://vertuka.com/category/iphone/">گوشی آیفون<i class="icon left-arrow"></i></a></li><li><a href="/category/nokia-phone/">گوشی نوکیا<i class="icon left-arrow"></i></a></li><li><a href="/category/vocal-phone/">گوشی وکال<i class="icon left-arrow"></i></a></li><li><a href="/category/honor-phone">گوشی آنر<i class="icon left-arrow"></i></a></li></ul><ul class="vertuka-mega-menu column"><li><a class="speacial-all-price-a-nav" href="#" style="font-size: 11px;">گوشی موبایل بر اساس قیمت :</a></li><li><a href="https://vertuka.com/category/mobile-phones-under-10mt/">گوشی موبایل تا ۱۰ میلیون<i class="icon left-arrow"></i></a></li><li><a href="/category/mobile-phones-under-15mt/">گوشی موبایل تا ۱۵ میلیون<i class="icon left-arrow"></i></a></li><li><a href="/category/mobile-phones-under-20mt/">گوشی موبایل تا ۲۰ میلیون<i class="icon left-arrow"></i></a></li><li><a href="/category/mobile-phones-under-40mt/">گوشی موبایل تا ۴۰ میلیون<i class="icon left-arrow"></i></a></li><li><a href="/category/mobile-phones-under-50mt/">گوشی موبایل تا ۵۰ میلیون<i class="icon left-arrow"></i></a><div class="menu-img-box specail-phone-nav"><div class="phone-cat-nav nav-photo"><div><div></div></div></div></div></li></ul></div></div></li><li><span href="#">تبلت<i class="icon left-arrow"></i></span><div class="submenu"><ul class="vertuka-mega-menu"><li><a href="/category/tablet/">تبلت  <span>(همه محصولات)</span><i class="icon left-arrow"></i></a></li><li><a href="/category/samsung-tablet/">تبلت سامسونگ<i class="icon left-arrow"></i></a><div class="menu-img-box"><div class="tablet-cat-nav nav-photo"></div></div></li></ul></div></li><li><span href="#">ساعت و بند هوشمند<i class="icon left-arrow"></i></span><div class="submenu"><ul class="vertuka-mega-menu"><li><a href="https://vertuka.com/category/watch/">ساعت هوشمند  <span>(همه محصولات)</span><i class="icon left-arrow"></i></a></li><li><a href="/category/samsung-watch">ساعت هوشمند سامسونگ<i class="icon left-arrow"></i></a></li><li><a href="https://vertuka.com/category/xiaomi-smartwatch/">ساعت هوشمند شیائومی<i class="icon left-arrow"></i></a></li><li><a href="/category/apple-watch/">ساعت هوشمند اپل<i class="icon left-arrow"></i></a></li><li><a href="https://vertuka.com/category/smartband/">مچ بند هوشمند<i class="icon left-arrow"></i></a></li><li><a href="https://vertuka.com/category/haylou-watch/">ساعت هوشمند هایلو<i class="icon left-arrow"></i></a><div class="menu-img-box"><div class="watch-cat-nav nav-photo"></div></div></li></ul></div></li><li><span href="#">هدفون و هندزفری<i class="icon left-arrow"></i></span><div class="submenu"><ul class="vertuka-mega-menu"><li><a href="https://vertuka.com/category/headphone/">هدفون و هندزفری  <span>(همه محصولات)</span><i class="icon left-arrow"></i></a></li><li><a href="/category/samsung-headphone/">هندزفری سامسونگ<i class="icon left-arrow"></i></a></li><li><a href="/category/qcy-headphones/">هندزفری QCY<i class="icon left-arrow"></i></a></li><li><a href="https://vertuka.com/category/airpods/">هندزفری اپل (ایرپاد)<i class="icon left-arrow"></i></a></li><li><a href="https://vertuka.com/category/xiaomi-headphone/">هندزفری شیائومی<i class="icon left-arrow"></i></a></li><li><a href="/category/anker-headphones/">هندزفری انکر<i class="icon left-arrow"></i></a></li><li><a href="/category/riversong-headphone/">هندزفری ریورسانگ<i class="icon left-arrow"></i></a></li><li><a href="/category/huawei-headphone/">هندزفری هوآوی<i class="icon left-arrow"></i></a><div class="menu-img-box"><div class="headphone-cat-nav nav-photo"></div></div></li></ul></div></li><li><span href="#">لوازم جانبی<i class="icon left-arrow"></i></span><div class="submenu"><ul class="vertuka-mega-menu"><li><a href="https://vertuka.com/category/accessories/">لوازم جانبی  <span>(همه محصولات)</span><i class="icon left-arrow"></i></a></li><li><a href="https://vertuka.com/category/charger/">شارژر و آداپتور<i class="icon left-arrow"></i></a></li><li><a href="/category/car-charger/">شارژر فندکی<i class="icon left-arrow"></i></a></li><li><a href="/category/cable/">کابل شارژ<i class="icon left-arrow"></i></a></li><li><a href="/category/powerbank/">پاوربانک<i class="icon left-arrow"></i></a><div class="menu-img-box"><div class="janebi-cat-nav nav-photo"></div></div></li></ul></div></li><li><a href="https://vertuka.com/category/offers" style="color:#1f9a17; font-weight:700;">تخفیکا %</a></li></ul>';


		$menu_name = 'main-menu';

		$locations = get_nav_menu_locations();

		$menu_id   = $locations[$menu_name];

		$nude_menu = wp_get_nav_menu_items($menu_id);



		// displaying menu

		$html_menu = '<ul class="main-menu">';

		foreach ($nude_menu as $menu_item) {



			if ($menu_item->menu_item_parent == 0) {

				$html_menu .= '<li>';



				//data

				$id = $menu_item->ID;

				$url = $menu_item->url;

				$label = $menu_item->title;



				if ($label == "خانه") {

					$html_menu .= '<a href="' . $url . '">';

					$html_menu .= $label;

					$html_menu .= '<i class="icon left-arrow"></i>';

					$html_menu .= '</a>';
				} elseif ($label == "تخفیکا") {

					$html_menu .= '<a href="' . $url . '" style="color:#1f9a17; font-weight:700;">';

					$html_menu .= $label . ' %';

					// $html_menu .= '<i class="icon left-arrow"></i>';

					$html_menu .= '</a>';
				} else {

					$html_menu .= '<span href="' . $url . '">';

					$html_menu .= $label;

					$html_menu .= '<i class="icon left-arrow"></i>';

					$html_menu .= '</span>';
				}





				$submenu_item_html = '';

				$has_submenu = false;



				foreach ($nude_menu as $submenu_item) {



					if ($submenu_item->menu_item_parent != 0 && $submenu_item->menu_item_parent == $id) {



						$url_sub = $submenu_item->url;

						$label_sub = $submenu_item->title;



						$submenu_item_html .= '<li>';

						$submenu_item_html .= '<a href="' . $url_sub . '">';



						if (count(explode("(همه محصولات)", $label_sub)) > 1) {

							$submenu_item_html .= str_replace("(همه محصولات)", " ", $label_sub) . "<span>(همه محصولات)</span>";
						} else {

							$submenu_item_html .= $label_sub;
						}







						$submenu_item_html .= '<i class="icon left-arrow"></i>';

						$submenu_item_html .= '</a>';





						$submenu_item_html .= '<div class="menu-img-box">';



						$term = get_term_by('name', $label_sub);

						if (isset($term->term_id)) {

							$category_id = $term->term_id;

							$image_id = get_term_meta($category_id, 'thumbnail_id', true);



							if ($image_id) {

								$image_url = wp_get_attachment_image_src($image_id, 'full');



								if ($image_url) {

									$submenu_item_html .= '<img src="' . $image_url[0] . '" alt="' . $label_sub . '">';
								}
							}
						}



						$submenu_item_html .= '<div class="circle"></div>';

						$submenu_item_html .= '</div>';



						$submenu_item_html .= '</li>';



						$has_submenu = true;
					}
				}



				if ($has_submenu) {

					$html_menu .= '<div class="submenu"><ul class="vertuka-mega-menu">' . $submenu_item_html . '</ul></div>';
				}



				$html_menu .= '</li>';
			}
		}

		$html_menu .= '</ul>';

		return $html_menu;
	}
}




if (!function_exists('vertuka_mobile_navbar')) {
	function vertuka_mobile_navbar()
	{
		// getting menu in array
		$menu_name = 'main-menu';
		$locations = get_nav_menu_locations();
		$menu_id   = $locations[$menu_name];
		$nude_menu = wp_get_nav_menu_items($menu_id);

		// displaying menu
		$html_menu = '<ul class="navbar-nav me-auto mb-2 mb-lg-0 pt-2">';
		foreach ($nude_menu as $menu_item) {

			if ($menu_item->menu_item_parent == 0) {
				$html_menu .= '<li class="nav-item mb-1">';

				//data
				$id = $menu_item->ID;
				$url = $menu_item->url;
				$label = $menu_item->title;


				if ($label == 'تخفیکا') {
					$label = $label . ' %';
				}


				$submenu_item_html = '';
				$has_submenu = false;

				foreach ($nude_menu as $submenu_item) {

					if ($submenu_item->menu_item_parent != 0 && $submenu_item->menu_item_parent == $id) {

						$url_sub = $submenu_item->url;
						$label_sub = $submenu_item->title;

						$submenu_item_html .= '<li class="ps-0 mb-1">';
						$submenu_item_html .= '<a class="vertuka-mobile-submenu-item" href="' . $url_sub . '">';
						$submenu_item_html .= $label_sub;
						$submenu_item_html .= '</a>';


						$submenu_item_html .= '</li>';

						$has_submenu = true;
					}
				}

				if ($has_submenu) {
					$html_menu .= '<a class="nav-link vertuka-mobile-item" href="' . $url . '" id="navbarDropdown' . $id . '" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
					$html_menu .= $label;
					$html_menu .= '<i class="icon left-arrow"></i>';
					$html_menu .= '</a>';

					$html_menu .= '<ul class="dropdown-menu mb-0 mt-2 mx-0 p-0 border-0" aria-labelledby="navbarDropdown' . $id . '">' . $submenu_item_html . '</ul>';
				} else {
					$html_menu .= '<a class="nav-link vertuka-mobile-item" href="' . $url . '" id="navbarDropdown' . $id . '" >';
					$html_menu .= $label;
					$html_menu .= '<i class="icon left-arrow"></i>';
					$html_menu .= '</a>';
				}

				$html_menu .= '</li>';
			}
		}

		// MJ static for speed
		// $html_menu = '<ul class="navbar-nav me-auto mb-2 mb-lg-0 pt-2"><li class="nav-item mb-1"><a class="nav-link vertuka-mobile-item" href="https://vertuka.com/" id="navbarDropdown60">خانه<i class="icon left-arrow"></i></a></li><li class="nav-item mb-1"><a class="nav-link vertuka-mobile-item" href="#" id="navbarDropdown1783" role="button" data-bs-toggle="dropdown" aria-expanded="false">گوشی موبایل<i class="icon left-arrow"></i></a><ul class="dropdown-menu mb-0 mt-2 mx-0 p-0 border-0" aria-labelledby="navbarDropdown1783"><li class="ps-0 mb-1"><a class="vertuka-mobile-submenu-item" href="https://vertuka.com/category/mobile/">گوشی موبایل (همه محصولات)</a></li><li class="ps-0 mb-1"><a class="vertuka-mobile-submenu-item" href="https://vertuka.com/category/samsung-phone/">گوشی سامسونگ</a></li><li class="ps-0 mb-1"><a class="vertuka-mobile-submenu-item" href="https://vertuka.com/category/xiaomi-phone/">گوشی شیائومی</a></li><li class="ps-0 mb-1"><a class="vertuka-mobile-submenu-item" href="https://vertuka.com/category/iphone/">گوشی آیفون</a></li></ul></li><li class="nav-item mb-1"><a class="nav-link vertuka-mobile-item" href="#" id="navbarDropdown1784" role="button" data-bs-toggle="dropdown" aria-expanded="false">ساعت و بند هوشمند<i class="icon left-arrow"></i></a><ul class="dropdown-menu mb-0 mt-2 mx-0 p-0 border-0" aria-labelledby="navbarDropdown1784"><li class="ps-0 mb-1"><a class="vertuka-mobile-submenu-item" href="https://vertuka.com/category/watch/">ساعت هوشمند (همه محصولات)</a></li><li class="ps-0 mb-1"><a class="vertuka-mobile-submenu-item" href="/category/samsung-watch">ساعت هوشمند سامسونگ</a></li><li class="ps-0 mb-1"><a class="vertuka-mobile-submenu-item" href="https://vertuka.com/category/xiaomi-smartwatch/">ساعت هوشمند شیائومی</a></li><li class="ps-0 mb-1"><a class="vertuka-mobile-submenu-item" href="/category/apple-watch/">ساعت هوشمند اپل</a></li><li class="ps-0 mb-1"><a class="vertuka-mobile-submenu-item" href="https://vertuka.com/category/smartband/">مچ بند هوشمند</a></li></ul></li><li class="nav-item mb-1"><a class="nav-link vertuka-mobile-item" href="#" id="navbarDropdown1785" role="button" data-bs-toggle="dropdown" aria-expanded="false">هدفون و هندزفری<i class="icon left-arrow"></i></a><ul class="dropdown-menu mb-0 mt-2 mx-0 p-0 border-0" aria-labelledby="navbarDropdown1785"><li class="ps-0 mb-1"><a class="vertuka-mobile-submenu-item" href="https://vertuka.com/category/headphone/">هدفون و هندزفری (همه محصولات)</a></li><li class="ps-0 mb-1"><a class="vertuka-mobile-submenu-item" href="/category/samsung-headphone/">هندزفری سامسونگ</a></li><li class="ps-0 mb-1"><a class="vertuka-mobile-submenu-item" href="/category/qcy-headphones/">هندزفری QCY</a></li><li class="ps-0 mb-1"><a class="vertuka-mobile-submenu-item" href="https://vertuka.com/category/airpods/">هندزفری اپل (ایرپاد)</a></li><li class="ps-0 mb-1"><a class="vertuka-mobile-submenu-item" href="https://vertuka.com/category/xiaomi-headphone/">هندزفری شیائومی</a></li><li class="ps-0 mb-1"><a class="vertuka-mobile-submenu-item" href="/category/anker-headphones/">هندزفری انکر</a></li></ul></li><li class="nav-item mb-1"><a class="nav-link vertuka-mobile-item" href="#" id="navbarDropdown1786" role="button" data-bs-toggle="dropdown" aria-expanded="false">لوازم جانبی<i class="icon left-arrow"></i></a><ul class="dropdown-menu mb-0 mt-2 mx-0 p-0 border-0" aria-labelledby="navbarDropdown1786"><li class="ps-0 mb-1"><a class="vertuka-mobile-submenu-item" href="https://vertuka.com/category/accessories/">لوازم جانبی (همه محصولات)</a></li><li class="ps-0 mb-1"><a class="vertuka-mobile-submenu-item" href="https://vertuka.com/category/charger/">شارژر و آداپتور</a></li></ul></li><li class="nav-item mb-1"><a class="nav-link vertuka-mobile-item" href="https://vertuka.com/category/offers" id="navbarDropdown2278">تخفیکا<i class="icon left-arrow"></i></a></li>';
		// MJ static for speed
		////////////////////////////////////////////////////

		$html_menu .= '<li class="nav-item mb-1">';
		$html_menu .= '<a class="cart-counter w-100" href="' . avertuka_url_getter('cart') . '">';
		$html_menu .= '<div><i class="icon natural-5 cart"></i></div>';
		if (class_exists('WooCommerce')) {
			// Get the cart object
			$cart = WC()->cart;
			// Get the total number of items in the cart
			$cart_item_count = $cart->get_cart_contents_count();

			// Display the cart item count
			if ($cart_item_count > 0) {
				$html_menu .= '<div class="count"><span>' . vertuka_the_persian_number($cart_item_count) . '</span></div>';
			} else {
				$html_menu .= '<div class="count"><span>' . vertuka_the_persian_number(0) . '</span></div>';
			}
		}
		$html_menu .= '</a>';
		$html_menu .= '</li>';
		$html_menu .= '</ul>';
		return $html_menu;
	}
}


function vertuka_delivery_method()
{

	global $wcmca_customer_model, $wcmca_option_model;
	$disable_last_used_address = $wcmca_option_model->disable_last_used_address();
	$addresses = $wcmca_customer_model->get_addresses(get_current_user_id());
	$type = 'shipping';

	if (empty($addresses)) : ?>
		<p>آدرسی هنوز ثبت نشده است</p>
		<?php endif;

	$i = 1;
	foreach ($addresses as $address_id => $address) {
		if (isset($address['address_internal_name']) && $address['type'] == $type) {
		?>

			<div class="position-relative">
				<div id="vertuka_<?php echo esc_attr($address_id); ?>" class="method <?php if ($i == 1) {
																							echo 'active';
																						} ?>">
					<div class="d-flex justify-content-between">
						<div>
							<h4>آدرس تحویل سفارش</h4>
							<address>
								<?php echo esc_html($address['shipping_city']); ?>,
								<?php echo esc_html($address['shipping_address_1']); ?>
								<?php echo esc_html($address['shipping_address_2']); ?>
							</address>
							<p class="m-0">
								-<?php echo esc_html($address['address_internal_name']); ?>
							</p>
						</div>

					</div>
				</div>
				<div class="edit-address">
					<a href="https://vertuka.com/my-account/addresses/">
						<span>ویرایش</span>
						<i class="icon left-arrow primary-4"></i>
					</a>
				</div>
			</div>
	<?php
			$i++;
		}
	}
}


function vertuka_shipping_method()
{

	$formatted_destination = isset($formatted_destination) ? $formatted_destination : WC()->countries->get_formatted_address($package['destination'], ', ');
	$has_calculated_shipping = !empty($has_calculated_shipping);
	$show_shipping_calculator = !empty($show_shipping_calculator);
	$calculator_text = '';
	?>
	<?php foreach ($available_methods as $method) : ?>
		<li>
			<?php
			if (1 < count($available_methods)) {
				printf('<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" %4$s />', $index, esc_attr(sanitize_title($method->id)), esc_attr($method->id), checked($method->id, $chosen_method, false)); // WPCS: XSS ok.
			} else {
				printf('<input type="hidden" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" />', $index, esc_attr(sanitize_title($method->id)), esc_attr($method->id)); // WPCS: XSS ok.
			}
			printf('<label for="shipping_method_%1$s_%2$s">%3$s</label>', $index, esc_attr(sanitize_title($method->id)), wc_cart_totals_shipping_method_label($method)); // WPCS: XSS ok.
			do_action('woocommerce_after_shipping_rate', $method, $index);
			?>
		</li>
	<?php endforeach; ?>


	<?php
}


// Function to get post count for archive page.
function vertuka_get_archive_post_count()
{
	global $wp_query;

	// Count the total number of posts in the query.
	$post_count = $wp_query->found_posts;

	return $post_count;
}


/**
 * Shortcode for display shopping features
 */
if (!function_exists('vertuka_shopping_features_fb')) {
	function vertuka_shopping_features_fb()
	{
	?>
		<div class="shop-features">
			<div class="container-fluid">
				<div class="inner-box">
					<div class="row">
						<div class="col-lg-3 mb-4 mb-lg-0">
							<div class="d-flex">
								<div class="icon-box"><img src="<?php vertuka_show_image('assets/images/headphone.svg'); ?>" alt="icon"></div>
								<div class="text-box">
									<h3>پشتیبانی تلفنی</h3>
									<div class="d-flex">
										<span>
											تماس با:
										</span>
										<div class="d-flex ms-2">
											<div class="me-1"><span><?php echo vertuka_the_persian_number('0003'); ?></span></div>
											<div class="me-1"><span><?php echo vertuka_the_persian_number('9109'); ?></span></div>
											<div class="me-1">-</div>
											<div><span><?php echo vertuka_the_persian_number('021'); ?></span></div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-3 mb-4 mb-lg-0">
							<div class="d-flex">
								<div class="icon-box"><img src="<?php vertuka_show_image('assets/images/7-day.svg'); ?>" alt="icon"></div>
								<div class="text-box">
									<h3>فرصت <?php echo vertuka_the_persian_number('7'); ?> روزه بازگشت کالا</h3>
									<p>ضمانت بازگشت کالا تا <?php echo vertuka_the_persian_number('7'); ?> روز</p>
								</div>
							</div>
						</div>

						<div class="col-lg-3 mb-4 mb-lg-0">
							<div class="d-flex">
								<div class="icon-box"><img src="<?php vertuka_show_image('assets/images/Approve.svg'); ?>" alt="icon"></div>
								<div class="text-box">
									<h3>تضمین کیفیت کالا</h3>
									<p>خرید بهترین کالای موجود</p>
								</div>
							</div>
						</div>

						<div class="col-lg-3 mb-4 mb-lg-0">
							<div class="d-flex">
								<div class="icon-box"><img src="<?php vertuka_show_image('assets/images/credit-card.svg'); ?>" alt="icon"></div>
								<div class="text-box">
									<h3>پرداخت امن از درگاه بانکی</h3>
									<p>امنیت در خریدهای آنلاین</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
	}

	add_shortcode('vertuka-shopping-features', 'vertuka_shopping_features_fb');
}


// Display custom data on the order page
add_action('woocommerce_admin_order_data_after_billing_address', 'display_custom_order_data');

function display_custom_order_data($order)
{

	$customer_id = $order->get_customer_id();

	echo '<p><strong>' . __('زمان دریافت') . ':</strong> ' . $order->get_meta('_vertuka_custom_text_field', true) . '</p>';
	if (convert2english($order->get_meta('_vertuka_custom_text_field', true)) != 'پست' && convert2english($order->get_meta('_vertuka_custom_text_field', true)) != 'پیک-توربو') {
		$shipping_type = explode(" ", $order->get_meta('_vertuka_custom_text_field', true));


		echo '<input type="hidden" id="_vertuka_custom_text_field" name="_vertuka_custom_text_field" value="' . convert2english($order->get_meta('_vertuka_custom_text_field', true)) . '">';
		echo '<select name="day_shift" class="day_shift">
			  	<option value="14-8"';
		if (explode("-", $shipping_type[1])[1] == 8) {
			echo 'selected';
		}
		echo '>8-14</option>
			  	<option value="20-14"';
		if (explode("-", $shipping_type[1])[1] == 14) {
			echo 'selected';
		}
		echo '>14-20</option>
			  </select>';
		$temp_data = convert2english(str_replace("/", "-", explode("-", $shipping_type[1])[2]));
		//   var_dump(explode("-", $temp_data));die;
		if (strlen((string)explode("-", $temp_data)[0]) == 2) {
			$temp_data = '14' . $temp_data;
		}
		echo '<input type="text" class="date-picker hasDatepicker day_date" name="day_date" maxlength="10" value="' . $temp_data . '" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])">';
		echo '<script type="text/javascript">
			jQuery(".day_shift").change(function(){
				jQuery("#_vertuka_custom_text_field").val("ساعت " + jQuery(".day_shift").val() +"-" +jQuery(".day_date").val().replace(/\-/g, "/"));
			});
			jQuery(".day_date").change(function(){
				jQuery("#_vertuka_custom_text_field").val("ساعت " + jQuery(".day_shift").val() +"-" +jQuery(".day_date").val().replace(/\-/g, "/"));
			});
		</script>';
	} else {
		echo '<input type="hidden" id="_vertuka_custom_text_field" name="_vertuka_custom_text_field" value="' . convert2english($order->get_meta('_vertuka_custom_text_field', true)) . '">';
	}



	echo '<p><strong>' . __('لوکیشن') . ':</strong> ' . $order->get_meta('_shipping_coordinates', true) . '</p>';
	// echo '<p><strong>' . __('temp') . ':</strong> ' . $order->get_meta('_return_request', true) . '</p>';

	echo '<p><strong>' . __('نوع سفارش') . ':</strong> ';

	if ($order->get_meta('_vertuka_custom_radio_field', true) == 'hoghooghi') {
		echo 'حقوقی' . '<br>';
		echo 'نام سازمان: ' . get_user_meta($customer_id, 'company', true) . '<br>';
		echo 'کد اقتصادی: ' . get_user_meta($customer_id, 'economic_id', true) . '<br>';
		echo 'شناسه ملی: ' . get_user_meta($customer_id, 'company_national_code', true) . '<br>';
		echo 'شناسه ثبت: ' . get_user_meta($customer_id, 'registration_id', true) . '<br>';
		echo 'آدرس و کد پستی: ' . get_user_meta($customer_id, 'company_address', true);
	} elseif ($order->get_meta('_vertuka_custom_radio_field', true) == 'haghighi') {
		echo 'حقیقی';
	} else {
		echo 'حقیقی';
	}

	echo '</p>';



	$national_code = get_user_meta($customer_id, 'national_code', true);

	echo '<p><strong>' . __('کد ملی') . ':</strong> ' . $national_code . '</p>';

	echo '<p><strong>' . __('نام بانک') . ':</strong> ' . get_user_meta($customer_id, 'bank_name', true) . '</p>';
	echo '<p><strong>' . __('شماره کارت') . ':</strong> ' . get_user_meta($customer_id, 'card_number', true) . '</p>';
	echo '<p><strong>' . __('شماره شبا') . ':</strong> ' . get_user_meta($customer_id, 'sheba_number', true) . '</p>';
}


// add_action('woocommerce_process_shop_order_meta', 'MJ_admin_update_vertuka_custom_text_field', 10, 3);
// function MJ_admin_update_vertuka_custom_text_field($order_id = null, $post = null, $update = null)
// {
// 	// Orders in backend only
// 	if (!is_admin()) return;
// 	if (isset($_POST["_vertuka_custom_text_field"]) && $_POST["_vertuka_custom_text_field"] != '') {
// 		// echo '<pre>';var_dump($order_id);die;
// 		// Get an instance of the WC_Order object (in a plugin)
// 		$order = new WC_Order($order_id);
// 		if ($_POST["_vertuka_custom_text_field"] != $order->get_meta('_vertuka_custom_text_field', true)) {
// 			$note = "زمان دریافت از " . $order->get_meta('_vertuka_custom_text_field', true) . " به " . esc_attr($_POST["_vertuka_custom_text_field"]) . " تغییر کرد";
// 			$order->add_order_note($note, 0, true);
// 			// Save
// 			$order->save();
// 			update_post_meta($order_id, '_vertuka_custom_text_field', esc_attr($_POST["_vertuka_custom_text_field"]));
// 		}
// 	}
// }

/// function jadyd ghably ro ham anjam myde

// Log any changes on admin order edit
add_action('woocommerce_process_shop_order_meta', 'MJ_admin_update_order_filds', 10, 3);
function MJ_admin_update_order_filds($order_id = null, $post = null, $update = null)
{
	// Orders in backend only
	if (!is_admin()) return;
	$allowed = [
		"_billing_first_name",
		"_billing_last_name",
		"_billing_company",
		"_billing_address_1",
		"_billing_address_2",
		"_billing_city",
		"_billing_postcode",
		"_billing_country",
		"_billing_state",
		"_billing_email",
		"_billing_phone",
		"_payment_method",
		"_transaction_id",
		"_vertuka_custom_text_field",
		"_shipping_first_name",
		"_shipping_last_name",
		"_shipping_company",
		"_shipping_address_1",
		"_shipping_address_2",
		"_shipping_city",
		"_shipping_postcode",
		"_shipping_country",
		"_shipping_state",
		"_shipping_phone",
	];
	$mj_meta_filtered_parameters = array_intersect_key($_POST, array_flip($allowed));

	foreach ($mj_meta_filtered_parameters as $key => $value) {
		if (isset($_POST[$key]) && $_POST[$key] != '') {
			// Get an instance of the WC_Order object (in a plugin)
			$order = new WC_Order($order_id);
			if ($_POST[$key] != $order->get_meta($key, true)) {
				$note = $key . " از \"" . $order->get_meta($key, true) . "\" به \"" . sanitize_text_field($_POST[$key]) . "\" تغییر کرد";
				$order->add_order_note($note, 0, true);
				$order->save();
				update_post_meta($order_id, $key, sanitize_text_field($_POST[$key]));
				// $order->update_meta_data( $key, sanitize_text_field($_POST[$key]) );
				// $order->save();
			}
		}
	}
}



// test
// Add custom field to WooCommerce checkout page
function add_custom_checkout_field()
{
	echo '<div id="custom_checkout_field" class="d-none"><h3>' . __('Custom Field') . '</h3>';


	woocommerce_form_field('vertuka_custom_text_field', array(
		'type' => 'text',
		'class' => array('form-row-wide'),
		'label' => __('زمان ارسال سفارش'),
		'required' => false,
		'placeholder' => __('Enter custom text'),
	), WC()->checkout->get_value('vertuka_custom_text_field'));

	// Radio Button
	woocommerce_form_field('vertuka_custom_radio_field', array(
		'type' => 'radio',
		'class' => array('input-radio'),
		'label' => __('نوع خرید'),
		'required' => false,
		'options' => array(
			'hoghooghi' => 'حقوقی',
			'haghighi' => 'حقیقی',
		),
		'default'           => 'haghighi',
	), WC()->checkout->get_value('vertuka_custom_radio_field'));
	echo '</div>';
}

add_action('woocommerce_checkout_before_customer_details', 'add_custom_checkout_field');
// Save custom field value to order meta
function save_custom_checkout_field_value($order_id)
{

	if ($_POST['vertuka_custom_text_field']) {
		update_post_meta($order_id, '_vertuka_custom_text_field', sanitize_text_field($_POST['vertuka_custom_text_field']));
	}

	if ($_POST['vertuka_custom_radio_field']) {
		update_post_meta($order_id, '_vertuka_custom_radio_field', sanitize_text_field($_POST['vertuka_custom_radio_field']));
	}

	if ($_POST['shipping_phone']) {
		update_post_meta($order_id, '_shipping_phone', sanitize_text_field($_POST['shipping_phone']));
	}

	if ($_POST['shipping_coordinates']) {
		update_post_meta($order_id, '_shipping_coordinates', sanitize_text_field($_POST['shipping_coordinates']));
	}
}
add_action('woocommerce_checkout_update_order_meta', 'save_custom_checkout_field_value');



// MJ
function mj_validate_checkout($posted)
{
	if ($_POST['shipping_last_name'] == '') {
		return wc_add_notice(__("لطفا آدرس و شیوه ارسال2 را انتخاب کنید.", 'mj_validate_checkout_error'), 'error');
	}
	if ($_POST['shipping_address_1'] == '') {
		return wc_add_notice(__("لطفا آدرس و شیوه ارسال3 را انتخاب کنید.", 'mj_validate_checkout_error'), 'error');
	}
	if ($_POST['shipping_city'] == '') {
		return wc_add_notice(__("لطفا آدرس و شیوه ارسال4 را انتخاب کنید.", 'mj_validate_checkout_error'), 'error');
	}
	if ($_POST['shipping_state'] == '') {
		return wc_add_notice(__("لطفا آدرس و شیوه ارسال5 را انتخاب کنید.", 'mj_validate_checkout_error'), 'error');
	}
	if ($_POST['shipping_postcode'] == '') {
		return wc_add_notice(__("لطفا آدرس و شیوه ارسال6 را انتخاب کنید.", 'mj_validate_checkout_error'), 'error');
	}
	if ($_POST['shipping_coordinates'] == '') {
		return wc_add_notice(__("لطفا آدرس و شیوه ارسال7 را انتخاب کنید.", 'mj_validate_checkout_error'), 'error');
	}
	if ($_POST['shipping_phone'] == '') {
		return wc_add_notice(__("لطفا آدرس و شیوه ارسال8 را انتخاب کنید.", 'mj_validate_checkout_error'), 'error');
	}

	if ($_POST['vertuka_custom_text_field'] == '') {
		return wc_add_notice(__("لطفا زمان تحویل سفارش خود را انتخاب کنید.", 'mj_validate_checkout_error'), 'error');
	}

	if ($_POST['vertuka_custom_text_field'] == 'پیک-رایگان') {
		return wc_add_notice(__("لطفا زمان دریافت10 را انتخاب کنید.", 'mj_validate_checkout_error'), 'error');
	}
}

add_action('woocommerce_checkout_process', 'mj_validate_checkout');
