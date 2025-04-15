<?php

/**
 * Template Name: Image SRC Dumper
 *
 * A custom page template to extract and display the single h1, single p, and all image src attributes from the current page.
 *
 * @package YourThemeName
 */
get_header(); // Include the header

// Function to extract all image src attributes from the content
function get_image_srcs_from_content($content)
{
    // Use a regular expression to find all <img> tags and their src attributes
    preg_match_all('/<img[^>]+src="([^"]*)"/i', $content, $matches);
    return isset($matches[1]) ? $matches[1] : [];
}

// Function to extract the single h1 tag value from the content
function get_single_h1_value_from_content($content)
{
    // Use a regular expression to find the first <h1> tag and its text content
    if (preg_match('/<h1[^>]*>(.*?)<\/h1>/is', $content, $match)) {
        return strip_tags($match[1]);
    }
    return null; // Return null if no <h1> tag is found
}

// Function to extract the single p tag value from the content
function get_single_p_value_from_content($content)
{
    // Use a regular expression to find the first <p> tag and its text content
    if (preg_match('/<h6[^>]*>(.*?)<\/h6>/is', $content, $match)) {
        return strip_tags($match[1]);
    }
    return null; // Return null if no <p> tag is found
}
?>

<div id="wall-primary">
    <main id="wall-main">
        <?php
        while (have_posts()) :
            the_post();

            // Get the post content
            $content = apply_filters('the_content', get_the_content());

            // Extract all image src attributes
            $image_srcs = get_image_srcs_from_content($content);

            // Extract the single h1 tag value
            $h1_value = get_single_h1_value_from_content($content);

            // Extract the single p tag value
            $h6_value = get_single_p_value_from_content($content);

            // Display the extracted h1 value
            if (!empty($h1_value)) {
                echo '<h1>' . esc_html($h1_value) . '</h1>';
            } else {
                echo '<h1>No H1 tag found in this page</h1>';
            }
            // Display the extracted p value
            if (!empty($h6_value)) {
                echo '<p>' . esc_html($h6_value) . '</p>';
            } else {
                echo '<p>No P tag found in this page.</p>';
            }




            // Check if any image srcs were found
            if (!empty($image_srcs)) {
                // Start the container for the images
                echo '<div class="wallpaper-page-wraper">';
                echo '<div class="wall-image-grid">';

                // Loop through each image src and create an <img> tag with a download button
                foreach ($image_srcs as $src) {
                    echo '<div class="wall-image-item">';
                    echo '<img src="' . esc_url($src) . '" alt="Image from content">';
                    // Add the download button with the correct download attribute
                    echo '<a href="' . esc_url($src) . '" download class="wall-download-button">دانلود تصویر</a>';
                    echo '</div>';
                }

                // Close the container
                echo '</div></div>';
            } else {
                echo '<p>والپیپری در حال حاضر در این صفحه وجود ندارد!</p>';
            }

        endwhile; // End of the loop.
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer(); // Include the footer
?>