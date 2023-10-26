<?php
/**
 * Insert a new address
 *
 * @param array $args
 * @return int/WP_Error
 */
function webdevbd_insert_address($args = [])
{
    global $wpdb;

    if (empty($args['name'])) {
        return new \WP_Error('missing_name', __('You must need to insert a name', 'webdevbd'));
    }

    //it use for if we did not fill every fielinput field of the form
    $defaults = [
        'name' => '',
        'address' => '',
        'phone' => '',
        'created_by' => get_current_user_id(),
        'created_at' => current_time('mysql'),
    ];
    //wp_parse_args will merge with default data with user input data
    $data = wp_parse_args($args, $defaults);

    if (isset($data['id'])) {

        $id = $data['id'];

        unset($data['id']);

        $updated = $wpdb->update(
            $wpdb->prefix . 'webdevbd_addresses',
            $data,
            ['id' => $id],
            [
                '%s',
                '%s',
                '%s',
                '%d',
                '%s',
            ],
            ['%d']

        );
        return $updated;

    } else {

        $inserted = $wpdb->insert(
            $wpdb->prefix . 'webdevbd_addresses',
            $data,
            [
                '%s',
                '%s',
                '%s',
                '%d',
                '%s',
            ]

        );
        if (!$inserted) {
            return new \WP_Error('insert_failed', __('Data did not get inserted', 'webdevbd'));

        }
        return $wpdb->insert_id;

    }
} //end wp_webdevbd_address functon

/**
 * Fetch addresses
 *
 * @param array $args
 * @return void
 */
function webdevbd_get_addresses($args = [])
{
    global $wpdb;

    $defaults = [
        'orderby' => 'id',
        'order' => 'ASC',
        'offset' => 0,
        'number' => 20,

    ];

    $args = wp_parse_args($args, $defaults);

    $sql = $wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}webdevbd_addresses ORDER BY {$args['orderby']} {$args['order']} LIMIT %d, %d",
        $args['offset'],
        $args['number'],
    );

    $items = $wpdb->get_results($sql);
    return $items;
}

/**
 * Get the count of total address
 */

function webdevbd_address_count()
{
    global $wpdb;

    return (int) $wpdb->get_var("SELECT count(id) FROM {$wpdb->prefix}webdevbd_addresses");
}

/**
 * Fetch a single contact from DB
 *
 * @param array int $id
 * @return object
 */

function webdevbd_get_single_address($id)
{
    global $wpdb;
    return $wpdb->get_row(
        $wpdb->prepare("SELECT * FROM {$wpdb->prefix}webdevbd_addresses WHERE id = %d", $id)
    );
}

/**
 * Delete an address
 *
 * @param array int $id
 * @return inte|boolean
 */

function webdevbd_delete_address($id)
{
    global $wpdb;

    return $wpdb->delete(
        $wpdb->prefix . 'webdevbd_addresses',
        ['id' => $id],
        ['%d']
    );

}
