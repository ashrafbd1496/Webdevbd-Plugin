<?php

namespace Ashraf\Webdevbd\Frontend;

/**
 * Enquiry handler class
 */

class Enquiry
{

    function __construct()
    {

        add_shortcode('webdevbd-enquiry', [$this, 'render_shortcode']);

    }

    public function render_shortcode($atts, $content = '')
    {
        //Enqueue Scripts
        wp_enqueue_script('webdevbd-enquiry-script');
        wp_enqueue_style('webdevbd-enquiry-style');

        ob_start();

        include __DIR__ . '/views/enquiry.php';

        return ob_get_clean();
    }

} //end shortcode class
