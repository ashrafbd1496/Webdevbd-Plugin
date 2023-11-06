<?php

/**
 * webdevbd
 *
 * @package           webdevbd
 * @author            Ashraf Uddin
 * @copyright         2023 Webdevbd
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       webdevbd
 * Plugin URI:        https://github.com/webdevbd-plugin
 * Description:       Pluign development practice followig tareq hasan vidoe tutorial.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Ashraf uddin
 * Author URI:        https://ashrafdbd.com
 * Text Domain:       webdevbd
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://github.com/webdevbd-plugin/
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main plugin class
 */
final class Webdevbd
{
    /**
     * plugin version constant
     */
    const version = '1.0';
    /**
     * class constructor
     */
    private function __construct()
    {
        $this->define_constants();

        register_activation_hook(__FILE__, [$this, 'activate']);

        add_action('plugins_loaded', [$this, 'init_plugin']);
    }

    /**
     * initializes a singleton instance
     *
     * @return \Webdevbd
     */
    public static function init()
    {

        static $instance = false;

        if (!$instance) {
            $instance = new self();
        }
        return $instance;
    }

    /**
     * defined the required plugin constant
     *
     * @return void
     */
    public function define_constants()
    {
        define('WEBDEVBD_VERSION', self::version);
        define('WEBDEVBD_FILE', __FILE__);
        define('WEBDEVBD_PATH', __DIR__);
        define('WEBDEVBD_URL', plugins_url('', WEBDEVBD_FILE));
        define('WEBDEVBD_ASSETS', WEBDEVBD_URL . '/assets');
    }
    /**
     * initialize the plugin
     */
    public function init_plugin()
    {
        new Ashraf\Webdevbd\Assets();
        //admin/menu class willl load when we are in backend
        if (is_admin()) {
            new Ashraf\Webdevbd\Admin();
        } else {
            new Ashraf\Webdevbd\Frontend();
        }
    }

    /**
     * do stuff upon activation
     */

    public function activate()
    {

        $installer = new Ashraf\Webdevbd\Installer();

        $installer->run();
    }
}

/**
 * Initializes the main plugin
 *
 * @return \Webdevbd
 */
function webdevbd()
{
    return Webdevbd::init();
}

//kicked off the plugin

webdevbd();
