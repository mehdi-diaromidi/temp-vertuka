<?php /* Template Name: صفحه وبلاگ  */ ?>



<?php
get_header();



$title = esc_html( get_the_title() );
$url = esc_url( get_the_permalink() );

?>
    <main id="primary" class="site-main vertuka-archive">

        <div class="slider-blog-wrapper mt-4">
            <div class="container-fluid">
                <div class="row">
                    <?php
                    // WP_Query arguments
                    $args = array(
                        'post_type'              => array( 'post' ),
                        'posts_per_page'         => 1,
                        'posts_per_archive_page' => 1,
                        'ignore_sticky_posts'    => true,
                        'order'                  => 'DESC',
                        'orderby'                => 'date',
                    );

                    // The Query
                    $vlog_slider = new WP_Query( $args );

                    // The Loop
                    if ( $vlog_slider->have_posts() ) {
                        while ( $vlog_slider->have_posts() ) {
                            $vlog_slider->the_post();
                            // do something
                            $post_id = get_the_ID();
                            $esc_post_url = esc_url( get_the_permalink() );
                            $esc_post_id = esc_attr( $post_id );
                            $esc_date =  vertuka_the_persian_number( get_the_date( 'Y/m/d', $post_id ) );
                            $esc_post_url = esc_url( get_the_permalink( $post_id ) );
                            $esc_title = esc_html( get_the_title( $post_id ) );
                            $esc_thumbnail_url = esc_url( get_the_post_thumbnail_url( $post_id, 'full' ) );
                            $post = get_post( $post_id );
                            $author_id = $post->post_author;
                            $author_info = get_userdata($author_id);
                            $author_nickname = $author_info->display_name;


                            ?>
                            <div class="col-12 col-md-12 col-lg-6 mb-4 mb-lg-0">
                                <a href="<?php echo $esc_post_url; ?>" class="img-box d-block"><img src="<?php echo esc_url( $esc_thumbnail_url ); ?>" alt="<?php echo $esc_title; ?>"></a>
                            </div>
                            <div class="col-12 col-md-12 col-lg-6">
                                <div class="text-box">
                                    <div class="author-box mb-1">
                                        <div class="d-flex">
                                            <div class="pe-2 mb-1">
                                                <?php
                                                $author_avatar = get_avatar(
                                                    $author_info->user_email,
                                                    '60',
                                                    '',
                                                    $author_nickname,
                                                    array( 'class'         => 'vertuka-author-avatar' )
                                                );
                                                echo $author_avatar;
                                                ?>
                                            </div>
                                            <div>
                                                <h6 class="name"><?php echo $author_nickname; ?></h6>
                                                <div class="d-flex">
                                                    <p class="m-0 gray-details"><?php echo $esc_date; ?></p>
                                                    <p class="my-0 mx-2 gray-details">-</p>
                                                    <p class="m-0 gray-details">زمان مطالعه: <?php echo vertuka_the_persian_number(6);?> دقیقه</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="category-box">
                                        <?php
                                        $categories = get_the_terms($post_id, 'category');
                                        if ($categories && !is_wp_error($categories)) {
                                            // Sort the categories by term ID in descending order
                                            usort($categories, function($a, $b) {
                                                return $b->term_id - $a->term_id;
                                            });

                                            // Get the first category (which is now the latest one)
                                            $last_category = $categories[0];
                                            $category_url = get_term_link($last_category);

                                            // Output the category name
                                            echo '<div class="category"><p class="m-0"><a href="'.$category_url.'">'.$last_category->name.'</a></p></div>';
                                        }
                                        ?>
                                    </div>

                                    <div class="title-box"><h2 class="title"><a class="title-link" href="<?php echo $esc_post_url; ?>"><?php echo $esc_title; ?></a></h2></div>

                                    <div class="excerpt-box">
                                        <?php the_excerpt(); ?>
                                    </div>

                                    <div class="read-more-box">
                                        <a class="d-flex">
                                            <a href="<?php the_permalink(); ?>" class="read-more">ادامه مطلب</a>
                                            <!-- <div class="icon-box"><i class="icon blue chevron-left"></i></div> -->
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }

                    // Restore original Post Data
                    wp_reset_postdata();
                    ?>

                </div>
            </div>
        </div>

<div class="off-products-section my-2">
    <div class="container-fluid">
        <div class="inner-box">
            <div class="row">
                <hr class="my-2">
                <div class="col-12">
                    <div class="d-block d-lg-flex justify-content-between mt-1">
                        <div class="d-flex mj-horizontal-scroll blog-mini-nav">
                            <!-- === icon item === -->
                            <div class="p-1">
                                <a class="blog-cat-link-header active" href="https://vertuka.com/blog/">بلاگ</a>
                            </div>
                            <?php
                            $categories = get_terms(array(
                                'taxonomy' => 'category',
                                'hide_empty' => false,
                            ));
                            foreach ($categories as $category) {
                                $category_link = get_term_link($category); // Get the category link
                                $category_name = $category->name; // Get the category name
                                $category_id = $category->term_id;
                                if ($category_id != 1) {
                            ?>
                                    <!-- === icon item === -->
                                    <div class="p-1">
                                        <a class="blog-cat-link-header" href="<?php echo esc_url($category_link); ?>">
                                            <?php echo esc_html($category_name); ?>
                                        </a>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="archive-blog-section mt-0 pt-0">
                        <div class="row">
                            <?php
                            // WP_Query arguments
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            $args = array(
                                'post_type' => array('post'),
                                'order' => 'DESC',
                                'posts_per_page' => 12, // تعداد پست در هر صفحه
                                'paged' => $paged,
                            );

                            // The Query
                            $query_blog = new WP_Query($args);

                            // The Loop
                            if ($query_blog->have_posts()) {
                                while ($query_blog->have_posts()) {
                                    $query_blog->the_post();
                                    $post_id = get_the_ID();
                                    $esc_post_url = esc_url(get_the_permalink());
                                    $esc_date = vertuka_the_persian_number(get_the_date('Y/m/d', $post_id));
                                    $esc_title = esc_html(get_the_title($post_id));
                                    $esc_thumbnail_url = esc_url(get_the_post_thumbnail_url($post_id, 'full'));
                                    $post = get_post($post_id);
                                    $author_id = $post->post_author;
                                    $author_info = get_userdata($author_id);
                                    $author_nickname = $author_info->display_name;
                            ?>
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-12 item mb-4">
                                        <a class="d-block w-100" href="<?php echo $esc_post_url; ?>">
                                            <img class="post-thumbnail" src="<?php echo $esc_thumbnail_url; ?>" alt="<?php echo $esc_title; ?>">
                                        </a>
                                        <div class="post-information d-flex">
                                            <div class="me-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path d="M19.7274 20.4471C19.2716 19.1713 18.2672 18.0439 16.8701 17.2399C15.4729 16.4358 13.7611 16 12 16C10.2389 16 8.52706 16.4358 7.12991 17.2399C5.73276 18.0439 4.72839 19.1713 4.27259 20.4471"
                                                        stroke="#6A6A6A" stroke-width="2" stroke-linecap="round" />
                                                    <circle cx="12" cy="8" r="4" stroke="#6A6A6A" stroke-width="2"
                                                        stroke-linecap="round" />
                                                </svg>
                                                <span class="author"><?php echo $author_nickname; ?></span>
                                            </div>
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px"
                                                    viewBox="0 0 24 24" fill="none" class="ms-3">
                                                    <circle cx="12" cy="12" r="9" stroke="#6A6A6A" stroke-width="2" />
                                                    <path d="M16.5 12H12.25C12.1119 12 12 11.8881 12 11.75V8.5"
                                                        stroke="#6A6A6A" stroke-width="2" stroke-linecap="round" />
                                                </svg>
                                                <span class="date"><?php echo $esc_date; ?></span>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <h3 class="post-title">
                                                <a class="text-black" href="<?php echo $esc_post_url; ?>"><?php echo $esc_title; ?></a>
                                            </h3>
                                            <div class="post-excerpt">
                                                <?php the_excerpt(); ?>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                                // صفحه‌بندی
                                echo '<div class="pagination">';
                                echo paginate_links(array(
                                    'total' => $query_blog->max_num_pages,
                                    'current' => $paged,
                                    'type' => 'list',
                                    'prev_text' => '&laquo; قبلی',
                                    'next_text' => 'بعدی &raquo;',
                                ));

                                // اضافه کردن rel="prev" و rel="next"
                                if ($paged > 1) {
                                    $prev_url = get_previous_posts_page_link();
                                    if ($prev_url) {
                                        echo '<link rel="prev" href="' . esc_url($prev_url) . '" />' . "\n";
                                    }
                                }

                                $next_url = get_next_posts_page_link();
                                if ($next_url) {
                                        echo '<link rel="next" href="' . esc_url($next_url) . '" />' . "\n";
                                }

                                echo '</div>';
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
</div>

</div>

    </main>
<?php

get_footer();
