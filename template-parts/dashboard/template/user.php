<main class="rounded-3">

    <div class="my-3">
        <a class="d-flex justify-content-between page-title-dashboard-box d-lg-none" id="sidebar-mobile-menu">
            <div class="d-flex">
                <div class="me-2"><img class="icon" src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/User.svg')); ?>" alt="icon"></div>
                <div><h1 class="page-title-dashboard mb-0">اطلاعات کاربری</h1></div>
            </div>
            <div><img class="icon" src="<?php echo esc_url(get_theme_file_uri('template-parts/dashboard/img/Expand_left.svg')); ?>" alt="icon"></div>
        </a>
    </div>

    <div class="row">

        <div class="col-lg-8 col-12">
            <?php the_content(); ?>
        </div>
    </div>
</main>