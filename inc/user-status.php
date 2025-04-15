<?php
// user-status.php

if (is_user_logged_in()) {
    wp_send_json([
        'success' => true,
        'user_login' => true
    ], 200);
} else {
    wp_send_json([
        'success' => true,
        'user_login' => false
    ], 200);
}
?>

