<?php
/**
 * Plugin Name: Store Finder
 * Description: It will find Your Store Globally.
 * Version: 1.0.0
 * Author: indione 
 * Author URI: https://profiles.wordpress.org/indionetech/
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain: store-finder
 */

// ABS PATH
if (!defined('ABSPATH'))
{
    exit;
}

// Constant
define('STOREFIND_VERSION', isset($_SERVER['HTTP_HOST']) && 'localhost' === $_SERVER['HTTP_HOST'] ? time() : '1.0.0');
define('STOREFIND_DIR_URL', plugin_dir_url(__FILE__));
define('STOREFIND_DIR_PATH', plugin_dir_path(__FILE__));

require_once STOREFIND_DIR_PATH . 'inc/block.php';
require_once STOREFIND_DIR_PATH . 'inc/store-finder-menu-page.php';
require_once STOREFIND_DIR_PATH . 'inc/class-store-finder-activation.php';
require_once STOREFIND_DIR_PATH . 'inc/class-store-finder-deactivation.php';
require_once STOREFIND_DIR_PATH . 'inc/class-store-finder-shortcode.php';

register_activation_hook(__FILE__, "strfn_activate_function_callback");
register_deactivation_hook(__FILE__, 'strfn_deactivation_function_callback');

function strfn_activate_function_callback()
{
    new Store_Finder_Activation();
}

function strfn_deactivation_function_callback()
{
    new Store_Finder_Deactivation();
}