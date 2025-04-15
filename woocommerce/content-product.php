<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;
$product_id = get_the_ID();
$MJ_price_new = mj_same_price_everywhere($product_id);

// Ensure visibility.
// if (empty($product) || !$product->is_visible() $MJ_price_new['text'] == "<p class='stock out-of-stock'>ناموجود</p>") {
if (empty($product) || !$product->is_visible()) {
    return;
}
?>

<?php

$product_id = get_the_ID();
$MJ_price_new = mj_same_price_everywhere($product_id);
$esc_post_url = esc_url(get_the_permalink());
$esc_title = esc_html(get_the_title());

// Get the regular price
// $product = wc_get_product(get_the_ID());

$categories = get_the_terms($product_id, 'product_cat');

$available_colors_html = vertuka_display_available_colors($product_id);
$esc_thumbnail_url = esc_url(get_the_post_thumbnail_url($product_id, 'post-thumbnail'));
/**
 * Hook: woocommerce_before_shop_loop_item.
 *
 * @hooked woocommerce_template_loop_product_link_open - 10
 */
//do_action('woocommerce_before_shop_loop_item');
?>
<div class="col-lg-3 col-md-6 col-12 item item-desktop mb-4 d-none d-md-block mj-five-in-a-row">

    <div class="img-box">
        <a href="<?php echo $esc_post_url; ?>" target="_blank">
            <img class="pic" src="<?php echo $esc_thumbnail_url; ?>" alt="<?php echo $esc_title; ?>">
        </a>

        <?php
        echo $MJ_price_new['custom_shape'];
        ?>


        <div class="available-color"><?php echo $available_colors_html; ?></div>

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
            <a href="<?php echo $esc_post_url; ?>" target="_blank" class="temporary-product-title">
                <?php echo $esc_title ?>
            </a>
        </h3>
    </div>

    <?php
    // if ($MJ_price_new['text'] == "<p class='stock out-of-stock'>ناموجود</p>") {
    //     echo "none";
    // } else {
    //     echo $MJ_price_new['text'];
    // }
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
                <a href="<?php echo $esc_post_url; ?>" class="d-block" target="_blank">
                    <img class="pic" src="<?php echo $esc_thumbnail_url; ?>" alt="<?php echo $esc_title; ?>">
                </a>
                <div class="available-color"><?php echo $available_colors_html; ?></div>
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
                    <a href="<?php echo $esc_post_url; ?>" target="_blank" class="temporary-product-title">
                        <?php echo $esc_title ?>
                    </a>
                </h3>
            </div>

            <?php
            echo $MJ_price_new['text'];
            ?>
            <?php
            echo $MJ_price_new['discount_percent'];
            ?>

        </div>
    </div>
</div>
<?php
/**
 * Hook: woocommerce_after_shop_loop_item.
 *
 * @hooked woocommerce_template_loop_product_link_close - 5
 * @hooked woocommerce_template_loop_add_to_cart - 10
 */
//do_action('woocommerce_after_shop_loop_item');