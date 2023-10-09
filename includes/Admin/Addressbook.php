<?php

namespace Ashraf\Webdevbd\Admin; 

/**
 * Addressbook handle classs
 */
class Addressbook{

    public function plugin_page (){
        $action = isset($_GET['action']) ? $_GET['action'] : 'list';

    switch ($action) {
        case 'new':
        $template = __DIR__ . '/views/address-new.php';
        break;
    
        case 'edit':
            $template = __DIR__ . '/views/address-edit.php';
            break;

        case 'view':
            $template = __DIR__ . '/views/address-view.php';
            break;

        default:
            $template = __DIR__ . '/views/address-list.php';
            break;
    }

    if (file_exists($template)) {
       include $template;
        
    }
}

    /**
     * handle the form
     *
     * @return void
     */

    public function form_handler(){
        
        // check our this form has submitted
        if (! isset($_POST['submit_address'])) {
           return;
        }

        // check nonce is valid
        if (! wp_verify_nonce($_POST['_wpnonce'], 'new-address')) {
            wp_die('Are you cheating?');
        }

        //check user capability to submit form
        if (! current_user_can('manage_options')) {
            wp_die('Are you checting?');
        }

    
       echo '<pre>';
       var_dump($_POST );
       echo '</pre>';
       exit;
    
    }



}//end class