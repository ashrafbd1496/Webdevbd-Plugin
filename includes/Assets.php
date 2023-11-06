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
        add_action('wp_enqueue_scripts', [$this, 'webdevbd_enqueue_assets']);

        //to add script at backend
        add_action('admin_enqueue_scripts', [$this, 'webdevbd_enqueue_assets']);
    }

    public function get_scripts()
    {
        return [
            'webdevbd-script' => [
                'src' => WEBDEVBD_ASSETS . '/js/front-end.js',
                'version' => filemtime(WEBDEVBD_PATH . '/assets/js/front-end.js'),

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

        ];
    }

    function webdevbd_enqueue_assets()
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

    }

} //end class
