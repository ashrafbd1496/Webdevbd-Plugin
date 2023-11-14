<?php

namespace Ashraf\Webdevbd;

/**
 * Ajax handle class
 */

class Ajax
{
    function __construct()
    {
        add_action('wp_ajax_webdevbd_enquiry', [$this, 'submit_enquiry']);

        //for none loged user
        add_action('wp_ajax_nopriv_webdevbd_enquiry', [$this, 'submit_enquiry']);

        add_action('wp_ajax_webdevbd-delete-contact', [$this, 'delete_contact']);
    }

    public function submit_enquiry()
    {
        //check_ajax_referer('webdevbd-enquiry-form');

        if (!wp_verify_nonce($_REQUEST['_wpnonce'], 'webdevbd-enquiry-formd')) {
            wp_send_json_error([
                'message' => 'Nonce verification failed',
            ]);
        }

        wp_send_json_success([
            'message' => 'Enquiry has been sent successfully',
        ]);

    }

    public function delete_contact()
    {
        wp_send_json_success();
    }

} //end class
