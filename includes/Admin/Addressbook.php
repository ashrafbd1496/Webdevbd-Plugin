<?php

namespace Ashraf\Webdevbd\Admin;

use Ashraf\Webdevbd\Traits\Form_Error;

/**
 * Addressbook handle classs
 */
class Addressbook
{
    use Form_Error;

    public function plugin_page()
    {
        $action = isset($_GET['action']) ? $_GET['action'] : 'list';

        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        switch ($action) {
            case 'new':
                $template = __DIR__ . '/views/address-new.php';
                break;

            case 'edit':
                $address = webdevbd_get_single_address($id);
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

        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

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

        $args = [
            'name' => $name,
            'address' => $address,
            'phone' => $phone,
        ];
        if ($id) {
            $args['id'] = $id;
        }

        $insert_id = webdevbd_insert_address($args);

        if (is_wp_error($insert_id)) {
            wp_die($insert_id->get_error_message());
        }
        if ($id) {
            $redirected_to = admin_url('admin.php?page=webdevbd-options&action=edit&address-updated=true&id=' . $id);
        } else {
            $redirected_to = admin_url('admin.php?page=webdevbd-options&inserted=ture');
        }
        wp_redirect($redirected_to);

        exit;

    } //end from handler function

} //end class
