<?php
/**
 * Insert a new address
 *
 * @param array $args
 * @return int/WP_Error
 */
function wp_webdevbd_address($args = [])
{
    global $wpdb;

    //it use for if we did not fill every fielinput field of the form
    $defaults = [
        'name' => '',
        'address' => '',
        'phone' => '',
        'created_by' => get_current_user(),
        'created_at' => current_time('mysql'),
    ];

    if (empty($args['name'])) {
        return new \WP_Error('missing_name', __('You must need to insert a name', 'webdevbd'));
    }
    //wp_parse_args will merge with default data with user input data
    $data = wp_parse_args($args, $defaults);

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

    } else {
        echo __('Data inserted successfuly', 'webdevbd');
        return $wpdb->insert_id;
    }

}
