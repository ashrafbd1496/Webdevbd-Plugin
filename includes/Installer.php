<?php

namespace Ashraf\Webdevbd;

/**
 * Installer class
 */

class Installer
{

    /**
     * Run the installer
     *
     * @return void
     */

    function run()
    {

        $this->add_version();
        $this->create_tables();

    }

    public function add_version()
    {

        $installed = get_option('webdevbd_installed');

        if (!$installed) {
            update_option('webdevbd_installed', time());
        }

        update_option('webdevbd_version', WEBDEVBD_VERSION);
    }

/**
 * Create accessory database table
 */
    public function create_tables()
    {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $schema = "CREATE TABLE IF NOT EXISTS `test`.`{$wpdb->prefix}_webdevbd_addresses` ( `id` INT(11) UNSIGNED NOT NULL , `name` VARCHAR(100) NOT NULL , `address` VARCHAR(255) NULL , `phone` VARCHAR(30) NULL , `created_by` BIGINT(20) UNSIGNED NOT NULL , `created_at` DATETIME NOT NULL ) $charset_collate";

        if (!function_exists('dbDelta')) {
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        }
        dbDelta($schema);
    }

} //end class
