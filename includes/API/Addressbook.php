<?php
namespace Ashraf\Webdevbd\API;

use WP_REST_Controller;
use WP_REST_Server;

/**
 * Addressbook class
 */
class Addressbook extends WP_REST_Controller
{
    public function __construct()
    {
        $this->namespace = 'webdevbd/v1';
        $this->rest_base = 'contacts';
    }

    public function register_routes()
    {
        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base,
            [
                [
                    'methods' => WP_REST_Server::READABLE,
                    'callback' => [$this, 'get_items'],
                    'permission_callback' => [$this, 'get_items_permissions_check'],
                    'args' => $this->get_collection_params(),
                ],
                'schema' => [$this, 'get_item_schema'],
            ]
        );
    }

    /**
     * Check if a given request has access to read contacts
     * @param  \WP_REST_Request $request
     * return boolean
     */
    public function get_items_permissions_check($request)
    {
        if (current_user_can('manage_options')) {
            return true;
        }
        return false;
    }

    /**
     * Retrive a list of address items
     * @param  $item
     */

    public function get_items($request)
    {
        $args = [];
        $params = $this->get_collection_params();

        $contacts = webdevbd_get_addresses($args);

        foreach ($params as $key => $value) {
            if (isset($request[$key])) {
                $args[$key] = $request[$key];
            }
        }
        //change 'per_page' to 'number'
        $args['number'] = $args['per_page'];
        $args['offset'] = $args['number'] * ($args['page'] - 1);

        //unset others
        unset($args['per_page']);
        unset($args['page']);

        $contacts = webdevbd_get_addresses($args);

        foreach ($contacts as $contact) {
            $response = $this->prepare_item_for_response($contact, $request);
        }
        return $contacts;

    }

    public function get_item_schema()
    {
        if ($this->schema) {
            return $this->add_additional_fields_schema($this->schema);
        }
        $schema = [
            '$schema' => '#',
            'title' => 'contact',
            'type' => 'object',
            'properties' => [
                'id' => [
                    'description' => __('unique identifier for the object'),
                    'type' => 'integer',
                    'context' => ['view', 'edit'],
                    'readonly' => true,

                ],

                'name' => [
                    'type' => 'string',
                    'description' => __('The name of the contact'),
                    'context' => ['view', 'edit'],
                    'required' => true,
                    'arg_options' => [
                        'sanitize_callback' => 'sanitize_text_field'],
                ],

                'address' => [
                    'type' => 'string',
                    'description' => __('Address of  the contact'),
                    'context' => ['view', 'edit'],
                    'required' => true,
                    'arg_options' => [
                        'sanitize_callback' => 'sanitize_textarea_field',
                    ],
                ],

                'phone' => [
                    'type' => 'string',
                    'description' => __('Phone number of the contact'),
                    'context' => ['view', 'edit'],
                    'required' => true,
                    'arg_options' => [
                        'sanitize_callback' => 'sanitize_text_field',
                    ],
                ],

                'date' => [
                    'type' => 'string',
                    'description' => __('The name of the contact'),
                    'format' => 'date-time',
                    'context' => ['view'],
                    'readonly' => true,
                ],

            ],
        ];

        $this->schema = $schema;
        return $this->add_additional_fields_schema($this->schema);
    }

    /**
     * Retrives the query for collections
     * @return array
     */

    public function get_collection_params()
    {
        $params = parent::get_collection_params();

        unset($params['search']);
        return $params;
    }

}
