<?php

namespace Ashraf\Webdevbd\Admin;

/**
 * Addressbook handle classs
 */
class Addressbook
{

    public $errors = [];

    public function plugin_page()
    {
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

    public function form_handler()
    {

        // check our this form has submitted
        if (!isset($_POST['submit_address'])) {
            return;
        }

        // check nonce is valid
        if (!wp_verify_nonce($_POST['_wpnonce'], 'new-address')) {
            wp_die('I know you are cheating, man!');
        }

        //check user capability to submit form
        if (!current_user_can('manage_options')) {
            wp_die('I know you are cheating, man!');
        }

        $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
        $address = isset($_POST['address']) ? sanitize_textarea_field($_POST['address']) : '';
        $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';

        if (empty($name)) {
            $this->errors['name'] = __('Please provide a name', 'webdevbd');
        }

        if (empty($phone)) {
            $this->errors['phone'] = __('Please provide a phone number', 'webdevbd');
        }

        if (!empty($this->errors)) {
            return;
        }

        $insert_id = wp_webdevbd_address([
            'name' => $name,
            'address' => $address,
            'phone' => $phone,
        ]);

        if (is_wp_error($insert_id)) {
            wp_die($insert_id->get_error_message());
        }

        $redirected_to = admin_url('admin.php?page=webdevbd-options&inserted=ture');
        wp_redirect($redirected_to);

        exit;

    } //end from handler function

    /**
     * Error handler function
     */
    function has_error($key)
    {
        return isset($this->errors[$key]) ? true : false;

    }

    function get_error($key)
    {
        if (isset($this->errors[$key])) {
            return $this->errors[$key];
        }
        return false;

    }

} //end class
