<?php

namespace Ashraf\Webdevbd\Frontend;

/**
 * shortcode handler class
 */


 class Shortcode{

    function __construct(){

        add_shortcode('webdevbd-shortcode', [$this, 'render_shortcode']);

    }

    public function render_shortcode($atts, $content){
        
        return 'hello from shortcode';
    }






 }//end shortcode class