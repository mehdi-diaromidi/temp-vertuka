<?php

/**
 * The template to display the reviewers meta data (name, verified owner, review date)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review-meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

global $comment;
$verified = wc_review_is_from_verified_owner($comment->comment_ID);

if ('0' === $comment->comment_approved) { ?>

    <p class="meta">
        <em class="woocommerce-review__awaiting-approval">
            <?php esc_html_e('Your review is awaiting approval', 'woocommerce'); ?>
        </em>
    </p>

<?php } else { ?>
    <div class="d-flex me-2 pe-1">
        <div class="icon-box me-2"><i class="icon user muted"></i></div>

        <?php
        $comment = get_comment();
        $comment_author = get_comment_author($comment);

        if (is_numeric($comment_author)) {
            echo '<div class="author-name">کاربر</div>';
        } else {
            echo '<div class="author-name">' . $comment_author . '</div>';
        }
        ?>

    </div>

    <?php
    $timestamp = date_timestamp_get(date_create($comment->comment_date));
    ?>

    <div class="me-2 pe-1">
        <time class="woocommerce-review__published-date" datetime="<?php echo esc_attr(get_comment_date('c')); ?>"><?php echo esc_html(jdate('Y/m/d', $timestamp)); ?>
    </div>


<?php
}
