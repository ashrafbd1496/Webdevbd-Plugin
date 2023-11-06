<?php

namespace Ashraf\Webdevbd\Frontend;

/**
 * shortcode handler class
 */

class Shortcode
{

    function __construct()
    {

        add_shortcode('webdevbd-shortcode', [$this, 'render_shortcode']);

    }

    public function render_shortcode($atts, $content)
    {
        //Enqueue Scripts
        wp_enqueue_script('webdevbd-script');
        wp_enqueue_style('webdevbd-style');

        return '<div class = "webdevbd-shortcode"> hello from shortcode</div>';
    }

} //end shortcode class
