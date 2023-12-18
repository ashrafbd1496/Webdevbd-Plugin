<?php
namespace Ashraf\Webdevbd;

/**
 * API class
 */

class API
{
    function __construct()
    {
        add_action('rest_api_init', [$this, 'register_api']);
    }

    function register_api(){

        $addressbook = new API\Addressbook();
        
        $addressbook->register_routes();

    }
}
