<?php
get_header();
?>
<div class="container-fluid">
    <div class="d-flex justify-content-between">

        <div class="breadcrumb-box mj-horizontal-scroll">
            <ul>
                <?php
                // Check if it's a product page
                if (is_singular('product')) {
                    $categories3 = wp_get_post_terms($post->ID, 'product_cat', array('orderby' => 'parent', 'order' => 'ASC'));
                    echo '<li><a href="/">محصولات</a></li>';
                    foreach ($categories3 as $term) {
                        if ($term->slug != 'offers') {
                            echo '<li><a href="/category/' . $term->slug . '/" rel="tag">' . $term->name . '</a></li>';
                        }
                    }
                } else {
                    // Display other breadcrumbs for non-product pages
                    echo '<li><a href="' . esc_url(home_url('/')) . '">صفحه اصلی</a></li>';
                    if (function_exists('woocommerce_breadcrumb')) {
                        woocommerce_breadcrumb();
                    }
                }
                ?>
                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            </ul>
        </div>

        <div class="action-buttons d-none d-lg-block">
            <ul>
                <li data-toggle="tooltip" data-placement="top" title="افزودن به مقایسه"><a href="<?php echo esc_url(get_bloginfo('url') . '/compare?item=' . get_the_ID()); ?>" target="_blank"><i class="icon exposure"></i></a></li>
                <li data-toggle="tooltip" data-placement="top" title="اشتراک گذاری" class="position-relative">
                    <a class="vertuka-copy-mode" data-copy-mode="<?php the_permalink(); ?>">
                        <i class="icon share"></i>
                    </a>
                    <div class="tooltip-copy ">لینک صفحه کپی شد!</div>
                </li>
            </ul>
        </div>
    </div>
    <?php while (have_posts()) : ?>
        <?php the_post(); ?>

        <?php get_template_part('template-parts/content-product'); ?>

    <?php endwhile; ?>
</div>


<?php
/**
 * woocommerce_after_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');
?>
<div class="my-4">
    <div class="col-12 related-products px-0 py-5">
        <div class="off-products-section">
            <div class="container-fluid">

                <div class="title-box mb-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h3 class="title">محصولات مرتبط</h3>
                        </div>
                    </div>
                </div>

                <div class="inner-box">
                    <div class="owl-carousel owl-theme">
                        <?php
// $product_id = get_the_ID(); // جایگزین کنید با ID محصول مورد نظر

// $product_cats = wp_get_post_terms($product_id, 'product_cat');

// // فیلتر فقط زیر دسته‌بندی‌ها (یعنی آنهایی که والد دارند)
// $child_cats = array_filter($product_cats, function ($term) {
//     return $term->parent != 0;
// });

// // اگر فقط یک زیر دسته‌بندی داریم
// if (count($child_cats) === 1) {
//     $child_cat = array_values($child_cats)[0];
//     // echo 'زیر دسته بندی: ' . $child_cat->name;
//     vertuka_debug_popup($child_cat->term_id);
//     // یا برای گرفتن ID: $child_cat->term_id
// }

// // WP_Query arguments
// $args = array(
//     'post_type'      => 'product',
//     'posts_per_page' => 10,
//     'tax_query'      => array(
//         array(
//             'taxonomy' => 'product_cat',
//             'field'    => 'id',
//             'terms'    => $child_cat->term_id,
//             'operator' => 'IN',
//         ),
//     ),
//     'meta_query'     => array(
//         // شرط اول: وضعیت موجودی باید "instock" باشد
//         array(
//             'key'     => '_stock_status',
//             'value'   => 'instock',
//             'compare' => '='
//         ),
//         // شرط دوم: موجودی واقعی بیشتر از 0 باشد
//         array(
//             'key'     => '_stock',
//             'value'   => 0,
//             'compare' => '>',
//             'type'    => 'NUMERIC' // برای مقایسه عددی
//         )
//     )
// );
                        // WP_Query arguments
                        $args = array(
                            'post_type' => array('product'),
                            'posts_per_page' => '10',
                            'order' => 'DESC',
                            'orderby' => 'date',
                            'post__not_in' => array(953),
                        );

                        // The Query
                        $product_query = new WP_Query($args);

                        // The Loop
                        if ($product_query->have_posts()) {
                            while ($product_query->have_posts()) {
                                $product_query->the_post();

                                $product_id = get_the_ID();
                                // $product_status = wc_get_product($product_id);
                                // echo $product_id;
                                $MJ_price_new = mj_same_price_everywhere($product_id);
                                // if ($MJ_price_new['text'] == "<p class='stock out-of-stock'>ناموجود</p>") {
                                //     continue;
                                // }  
                                $esc_post_url = esc_url(get_the_permalink());
                                $esc_title = esc_html(get_the_title());
                                $esc_thumbnail_url = esc_url(get_the_post_thumbnail_url($product_id, 'full'));
                        ?>
                                <div class="item" id="produc-<?php echo esc_html($product_id); ?>">
                                    <div class="img-box">
                                        <a href="<?php echo $esc_post_url; ?>" target="_blank">
                                            <img class="no-lazy pic" src="<?php echo $esc_thumbnail_url; ?>" alt="<?php echo $esc_title; ?>">
                                        </a>

                                        <?php
                                        echo $MJ_price_new['custom_shape'];
                                        ?>

                                        <div class="available-color"><?php echo vertuka_display_available_colors($product_id) ?></div>

                                    </div>
                                    <?php vertuka_get_category_html($product_id); ?>
                                    <div class="title">
                                        <h3><a href="<?php echo $esc_post_url; ?>" target="_blank"><?php echo $esc_title; ?></a>
                                        </h3>
                                    </div>
                                    <?php
                                    echo $MJ_price_new['text'];
                                    ?>
                                    <?php
                                    echo $MJ_price_new['discount_percent'];
                                    ?>
                                </div>

                        <?php
                            }
                        } else {
                            echo 'محصولی برای نمایش وجود ندارد!';
                        }

                        // Restore original Post Data
                        wp_reset_postdata();
                        ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php
get_footer();
