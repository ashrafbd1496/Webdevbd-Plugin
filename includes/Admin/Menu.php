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

        //as we will reuse these parameter so created these
        $parent_slug = 'webdevbd-options';
        $capability = 'manage_options';



        add_menu_page(__('Plugin Options', 'webdevbd'), __('Plugin Options', 'webdevbd'), $capability, $parent_slug, [$this, 'addressbook_page'], 'dashicons-welcome-learn-more', 2);

        add_submenu_page($parent_slug ,__('Address Book', 'webdevbd'),__('Address Book', 'webdevbd'), $capability, $parent_slug, [$this, 'addressbook_page']);

        add_submenu_page($parent_slug ,__('Settings', 'webdevbd'),__('Settings', 'webdevbd'), $capability, 'addressbook-setting', [$this, 'addressbook_setting']);
    }

 

    public function addressbook_page() {
       $addressbook = new Addressbook();
       $addressbook -> plugin_page();
    }

     public function addressbook_setting() {
        echo 'Hello from Addressbook Setting';
    }



}//end class