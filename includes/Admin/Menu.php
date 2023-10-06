<?php

namespace Ashraf\Webdevbd\Admin;

/**
 * Menu handler class
 */
class Menu
{

    function __construct()
    {
        add_action('admin_menu', [$this, 'admin_menu']);
    }

    public function admin_menu()
    {
        //add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position)

        add_menu_page(__('Plugin Options', 'webdevbd'), __('Plugin Options', 'webdevbd'), 'manage_options', 'webdevbd-options', [$this, 'plugin_page'], 'dashicons-welcome-learn-more', 2);
    }

    public function plugin_page()
    {
        echo 'Hello from plugin';
    }
}//end class