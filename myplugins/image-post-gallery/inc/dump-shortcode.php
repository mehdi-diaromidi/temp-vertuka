<?php
function enqueue_custom_assets()
{
wp_enqueue_script('scripts-js',  'https://vertuka.com/wp-content/themes/vertuka/js/scripts.js?ver=2.1.327', array('jquery'), true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_assets');

// Shortcode to display image gallery layout
function ipg_gallery_layout()
{

    global $post;

    // Retrieve image IDs from meta field
    $image_ids = get_post_meta($post->ID, '_custom_image_ids', true);
    $single_image_id = get_post_meta($post->ID, '_custom_single_image_id', true); // دریافت ID تصویر تکی

    if ($image_ids) {
        $image_ids = explode(',', $image_ids); // Convert image IDs to an array
    }

    $single_image_url = $single_image_id ? wp_get_attachment_url($single_image_id) : '';
    $single_image_alt = $single_image_id ? get_post_meta($single_image_id, '_wp_attachment_image_alt', true) : '';
    ob_start();
?>

        <div class="wrapper product-page">
                <div class="page-content">
                    <div class="container-fluid">
                        <div class="mt-3">
                            <div class="row">
                                <div class="col-xl-8 col-lg-7 col-md-12 product-image-gallery pe-lg-3">
                                    <div class="row mb-4">
                                        <div>
                                            <div class="image-box bg-white position-relative">
                                                <div id="vertuka-main-product-image" class="product-image p-3">
                                                    <?php if ($single_image_url): ?>
                                                        <img src="<?php echo esc_url($single_image_url); ?>" alt="<?php echo esc_attr($single_image_alt); ?>">
                                                    <?php else: ?>
                                                        <img src="default-image-url-here.jpg" alt="Default Image">
                                                    <?php endif; ?>
                                                    <div class="next-button"><i class="icon left-arrow-3 mx-auto mt-1"></i></div>
                                                    <div class="prev-button"><i class="icon right-arrow mx-auto mt-1"></i></div>
                                                </div>
                                                <div class="gallery d-flex justify-content-between flex-row-reverse" style="background:rgba(234, 234, 234,0.8)!important;">
                                                    <div style="width: 85%;">
                                                        <div class="owl-theme owl-carousel pt-1">
                                                            <?php if ($image_ids): ?>
                                                                <?php foreach ($image_ids as $index => $image_id):
                                                                    $image_url = wp_get_attachment_url($image_id);
                                                                    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true); // دریافت متن alt تصویر
                                                                    if ($image_url):
                                                                ?>
                                                                        <div class="item" id="item-<?php echo $index + 1; ?>">
                                                                            <a class="vertuka-product-thumbnail-gallery">
                                                                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                                                            </a>
                                                                        </div>
                                                                <?php
                                                                    endif;
                                                                endforeach; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>

                                                    <div class="full-screen">
                                                        <a id="MJ-pro-vertuka-expand" href="#MJ-pro-vertuka-image-modal">
                                                            <i class="icon fullscreen"></i>
                                                        </a>
                                                        <div id="MJ-pro-vertuka-image-modal"
                                                            class="MJ-pro-vertuka-image-modal">
                                                            <div class="MJ-next-button">
                                                                <i class="icon left-arrow-3 mx-auto mt-1"
                                                                    id="MJ-next-button-left"></i>
                                                            </div>

                                                            <span class="close">&times;</span>
                                                            <img class="modal-content" id="img01">
                                                            <div class="caption" id="modal-caption"></div>

                                                            <div class="MJ-prev-button">
                                                                <i class="icon right-arrow mx-auto mt-1"
                                                                    id="MJ-prev-button-right"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        

    <?php
    return ob_get_clean();
}
add_shortcode('image-post-gallery', 'ipg_gallery_layout');
