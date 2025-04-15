<?php

get_header();



$wcmca_html_helper = new WCMCA_Html();
$wcmca_html_helper->render_admin_user_addresses_edit_page( get_current_user_id() );

get_footer();