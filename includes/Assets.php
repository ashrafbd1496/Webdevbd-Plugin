<?php

namespace Ashraf\Webdevbd;

/**
 * Assets handle class
 */

class Assets
{
    function __construct()
    {
        //to add script at frontend
        add_action('wp_enqueue_scripts', [$this, 'webdevbd_register_assets']);

        //to add script at backend
        add_action('admin_enqueue_scripts', [$this, 'webdevbd_register_assets']);
    }

    public function get_scripts()
    {
        return [
            'webdevbd-script' => [
                'src' => WEBDEVBD_ASSETS . '/js/front-end.js',
                'version' => filemtime(WEBDEVBD_PATH . '/assets/js/front-end.js'),
                'deps' => ['jquery'],

            ],
            'webdevbd-enquiry-script' => [
                'src' => WEBDEVBD_ASSETS . '/js/enquiry.js',
                'version' => filemtime(WEBDEVBD_PATH . '/assets/js/enquiry.js'),
                'deps' => ['jquery'],

            ],
            'webdevbd-admin-script' => [
                'src' => WEBDEVBD_ASSETS . '/js/admin.js',
                'version' => filemtime(WEBDEVBD_PATH . '/assets/js/admin.js'),
                'deps' => ['jquery', 'wp-util'],

            ],
        ];
    }

    public function get_styles()
    {
        return [
            'webdevbd-style' => [
                'src' => WEBDEVBD_ASSETS . '/css/front-end.css',
                'version' => filemtime(WEBDEVBD_PATH . '/assets/css/front-end.css'),

            ],

            'webdevbd-admin-style' => [
                'src' => WEBDEVBD_ASSETS . '/css/admin.css',
                'version' => filemtime(WEBDEVBD_PATH . '/assets/css/admin.css'),

            ],
            'webdevbd-enquiry-style' => [
                'src' => WEBDEVBD_ASSETS . '/css/enquiry.css',
                'version' => filemtime(WEBDEVBD_PATH . '/assets/css/enquiry.css'),

            ],

        ];
    }

    function webdevbd_register_assets()
    {
        //styles
        $styles = $this->get_styles();

        foreach ($styles as $handle => $style) {

            $deps = isset($style['deps']) ? $style['deps'] : false;

            wp_register_style($handle, $style['src'], $deps, $style['version']);
        }

        //scripts

        $scripts = $this->get_scripts();

        foreach ($scripts as $handle => $script) {

            $deps = isset($script['deps']) ? $script['deps'] : false;

            wp_register_script($handle, $script['src'], $deps, $script['version'], true);
        }

        wp_localize_script('webdevbd-enquiry-script', 'WebDevBdAjx', [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'error' => __('Something went wrong', 'webdevbd'),

        ]);

        wp_localize_script('webdevbd-admin-script', 'WebDevBdAjx', [
            'nonce' => wp_create_nonce('webdevbd-admin-nonce'),
            'confirm' => __('Are you sure ?', 'webdevbd'),
            'error' => __('Admin nonce went wrong', 'webdevbd'),

        ]);

    } //end asset function

} //end class
