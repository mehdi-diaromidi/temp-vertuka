<?php
/**
 * Show messages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/notices/success.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! $notices ) {
	return;
}

?>

<?php 
if ($_SERVER['REQUEST_URI'] != '/?wc-ajax=remove_coupon') {

    foreach ( $notices as $notice ) : ?>
        <div class="woocommerce-message "<?php echo wc_get_notice_data_attr( $notice ); ?> role="alert">
            <div class="row">
                <div class="col-xl-8 col-lg-7 col-md-12 col-12 product-image-gallery pe-4">
                    <?php
                    $msg = wc_kses_notice( $notice['notice'] );
                    $msg = str_replace('<a', '<a class="d-none"', $msg);
                    echo '<div class="d-block vertuka-msg me-2">'.$msg.'</div>';
                    ?>
                </div>

                <div class="col-xl-4 col-lg-5 col-md-12 col-12 ps-lg-34 ps-lg-4">
                    <?php
                    echo '<div class="d-block text-center"><a href="'.get_bloginfo( "url" ).'/cart" class="btn button wc-forward primary-5 w-100 text-white" >'.'مشاهده سبد خرید'.'</a></div>';
                    ?>
                </div>
            </div>
        </div>


    <?php endforeach;
}
?>


