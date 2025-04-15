<?php
get_header();
do_action('pars-host/home/before/page-header');

// if (is_user_logged_in()) {
// $transient_key = 'md_full_page_cache';

// $cached_data = get_transient($transient_key);

// if (false === $cached_data) {
//     ob_start();
// }
// }

get_template_part('template-parts/home');
// // if (is_user_logged_in()) {
// if (false === $cached_data) {
//     $cached_data = ob_get_clean();
//     set_transient($transient_key, $cached_data, HOUR_IN_SECONDS);
//     echo '<p>cache</p>';
//     echo $cached_data;
// }
do_action('pars-host/home/after/page-header');

// // }
get_footer();
