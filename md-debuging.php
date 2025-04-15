<?php

/**
 * Enhanced debugging function which formats debug info and allows for a label.
 *
 * @param mixed $data The data to dump.
 * @param string $label A label to apply before the data.
 * @return mixed The dump and the label if present.
 */
function wp_var_dump($data, $label = '')
{
    // Check if the current user is an administrator
    if (current_user_can('administrator')) {
        echo '<div style="background-color: #f2f2f2; padding: 12px;">';

        /* check whether we have been provided with a label */
        if (!empty($label)) {
            /* output our label as a heading */
            echo "<h2>" . $label . "</h2>";
        }

        /* output the normal var_dump wrapped in <pre> for formatting */
        echo '<pre>';
        var_dump($data);
        echo '</pre></div>';
    } else {
        // If the user is not an administrator, return without displaying anything
        return;
    }
}

/**
 * Write errors to a log file named debug.log in wp-content/debug.log
 *
 * @param mixed $log The thing you want to log.
 */
function hd_write_log($log)
{
    if (true == WP_DEBUG) {
        if (is_array($log) || is_object($log)) {
            error_log(print_r($log, true));
        } else {
            error_log($log);
        }
    }
}
