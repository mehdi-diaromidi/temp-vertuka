<?php

/**
 *
 * Enqueue scripts and styles to appear on the front end.
 * include Custom CSS, JS For Web
 *
 */

if (!class_exists('Vertuka_Enqueue')) {
    class Vertuka_Enqueue
    {

        const VERSION = '1.0.0';

        public function __construct()
        {
            add_action('wp_enqueue_scripts', [$this, 'enqueue_css'], 99);
            add_action('wp_enqueue_scripts', [$this, 'enqueue_js'], 10);
            // add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_css'], 99);
            // add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_js'], 10);
        }


        /**
         * Enqueue Cascading Style Sheets
         */


        public function enqueue_css()
        {
            // Home Styles - Start
            wp_enqueue_style(
                'home-styles',
                get_template_directory_uri() . '/css/home/home-styles.css',
                array(),
                '1.0.01'
            );


            // for prevent cash
            $randomNumber = '2.2.38';

            // Enqueue Bootstrap CSS from CDN

            wp_enqueue_style(
                'bootstrap',
                $this->asset_css('bootstrap.rtl.min.css'),
                array(),
                '5.2.3'
            );

            wp_enqueue_style(
                'owl-carousel',
                $this->asset_css('owl.carousel.min.css'),
                array(),
                '2.3.4'
            );

            wp_enqueue_style(
                'owl-carousel-default',
                $this->asset_css('owl.theme.default.min.css'),
                array(),
                '2.3.4'
            );


            wp_enqueue_style(
                'yekan-bakh',
                esc_url(get_theme_file_uri('assets/fonts/yekan-bakh/font.css')),
                array(),
                '1.0'
            );
            wp_enqueue_style(
                'iranyekan',
                esc_url(get_theme_file_uri('assets/fonts/iranyekan/font.css')),
                array(),
                '1.0.0'
            );
            if (is_page_template('page-themplate/wall-paper.php')) {
                wp_enqueue_style(
                    'wall-paper-page-style',
                    get_template_directory_uri() . '/css/wall-paper-page.css',
                    array(),
                    '1.0.1',
                    'all'
                );
            }

            // JUst for dashboard
            if (is_page_template('page_dashboard.php')) {
                wp_enqueue_style(
                    'vertuka-dashboard-style',
                    esc_url(get_theme_file_uri('/template-parts/dashboard/css/style.css')),
                    array('bootstrap', 'owl-carousel', 'owl-carousel-default'),
                    $randomNumber
                );

                wp_enqueue_style(
                    'vertuka-dashboard',
                    esc_url(get_theme_file_uri('/template-parts/dashboard/css/dashboard.css')),
                    array('bootstrap', 'owl-carousel', 'owl-carousel-default'),
                    $randomNumber
                );

                wp_enqueue_style(
                    'vertuka-dashboard-date',
                    esc_url(get_theme_file_uri('/css/persian-datepicker.css')),
                    array('bootstrap', 'owl-carousel', 'owl-carousel-default'),
                    $randomNumber
                );
            } else {
                wp_enqueue_style(
                    'vertuka-style',
                    $this->asset_css('style.css'),
                    array('bootstrap', 'owl-carousel', 'owl-carousel-default', 'yekan-bakh', 'iranyekan'),
                    $randomNumber
                );

                wp_enqueue_style(
                    'vertuka-responsive',
                    $this->asset_css('responsive.css'),
                    array('vertuka-style'),
                    $randomNumber
                );

                //If you change "style.css" you must change version of this file to ignore caching
                wp_enqueue_style(
                    'vertuka-custom-style',
                    esc_url(get_theme_file_uri('/style.css')),
                    array('bootstrap', 'owl-carousel', 'owl-carousel-default', 'vertuka-style', 'vertuka-responsive'),
                    $randomNumber
                );
            }
            // if (is_checkout()) {
            //     wp_enqueue_style(
            //         'notify-toast',
            //         $this->asset_css('jquery.toast.css'),
            //         array(),
            //         '1.0.1',
            //         'all'
            //     );
            // }
        }

        /**
         * Enqueue JavaScript files
         */
        public function enqueue_js()
        {

            // for prevent cash
            $randomNumber = '2.2.24';

            wp_enqueue_script(
                'bootstrap',
                $this->asset_js('bootstrap.bundle.min.js'),
                array('jquery'),
                '5.2.3',
                true
            );

            wp_enqueue_script(
                'owl-carousel',
                $this->asset_js('owl.carousel.min.js'),
                array('jquery'),
                '2.3.4',
                true
            );

            wp_enqueue_script(
                'vertuka-scripts',
                $this->asset_js('scripts.js'),
                array('jquery', 'bootstrap', 'owl-carousel', 'jquery-datatable', 'datatable-bootstrap'),
                $randomNumber,
                true
            );

            wp_enqueue_script(
                'jquery-datatable',
                $this->asset_js('jquery.datatables.min.js'),
                array('jquery', 'bootstrap'),
                $randomNumber,
                true
            );

            wp_enqueue_script(
                'datatable-bootstrap',
                $this->asset_js('datatables.bootstrap4.min.js'),
                array('jquery', 'bootstrap'),
                $randomNumber,
                true
            );
            wp_enqueue_script(
                'neshan-script',
                $this->asset_js('neshan.js'),
                array(),
                '1.0.0',
                true
            );

            wp_enqueue_script(
                'home-slider-scripts',
                $this->asset_js('home-slider-script.js'),
                array(),
                $randomNumber,
                false
            );

            if (is_page_template('page_dashboard.php')) {
                wp_enqueue_script(
                    'vertuka-dashboard-date-js',
                    $this->asset_js('persian-datepicker.min.js'),
                    array('jquery'),
                    $randomNumber,
                    true
                );
            }

            // add_action('wp_enqueue_scripts', 'enqueue_validate_national_code_script');

            // function enqueue_validate_national_code_script() {
            //     wp_localize_script('validate-national-code-script', 'validate_national_code_obj', [
            //         'ajaxurl' => admin_url('admin-ajax.php'),
            //         'nonce'   => wp_create_nonce('validate_national_code_nonce')
            //     ]);
            // }
            // if (is_checkout()) {
            //     wp_enqueue_script(
            //         'notify-toast',
            //         $this->asset_js('jquery.toast.js'),
            //         array(),
            //         '1.0.1',
            //         'all'
            //     );
            // }
            // wp_enqueue_script(
            //     'user-status-js',
            //     $this->asset_js('user-status.js'),
            //     array('jquery'),
            //     '1.0.0',
            //     false
            // );
        }

        /**
         * @return string
         */
        private function asset_css($file): string
        {
            return esc_url(get_theme_file_uri('css/' . $file));
        }

        /**
         * @return string
         */
        private function asset_js($file): string
        {
            return esc_url(get_theme_file_uri('js/' . $file));
        }
    }

    new Vertuka_Enqueue();
}
