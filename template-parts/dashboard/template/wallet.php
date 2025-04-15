<main class="rounded-3">

    <div class="my-3">
        <a class="d-flex justify-content-between page-title-dashboard-box d-lg-none" id="sidebar-mobile-menu">
            <div class="d-flex">
                <div class="me-2"><img class="icon" src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/credit card.svg')); ?>" alt="icon"></div>
                <div><h1 class="page-title-dashboard mb-0">کیف پول</h1></div>
            </div>
            <div><img class="icon" src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/Expand_left.svg')); ?>" alt="icon"></div>
        </a>
    </div>
    
    <div class="d-lg-flex align-items-center my-3">
        <a href="<?php echo esc_url(get_bloginfo('url')); ?>/my-account/" class="btn return-to-orders d-flex justify-content-center align-content-center my-2 py-1 py-lg-2 px-lg-2">
            <img src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/right arrow.svg' ) ); ?>" alt="icon">
            <span>بازگشت به حساب کاربری</span>
        </a>

    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12 col-12 wallet-item">
            <span class="font-smaller mt-lg-1">موجودی کیف پول شما</span>
            <p class="fs-5 my-lg-2">
                <span class="fw-bold"><?php echo do_shortcode( '[fsww_balance]');?></span>
            </p>
            <div><?php the_content(); ?> </div>
        </div>

    </div>
</main>