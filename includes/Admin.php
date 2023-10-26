<?php

namespace Ashraf\Webdevbd;

/**
 * admin class
 */

class Admin
{
    /**
     * initialize the class
     *
     */

    function __construct()
    {
        $addressbook = new Admin\Addressbook();
        $this->dispatch_actions($addressbook);

        new Admin\Menu($addressbook);
    }

    public function dispatch_actions($addressbook)
    {

        add_action('admin_init', [$addressbook, 'form_handler']);
        add_action('webdevbd-delete-address', [$addressbook, 'webdevbd_delete_address']);
    }

} //end class
