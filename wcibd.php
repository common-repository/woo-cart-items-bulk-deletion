<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wordpress.org/plugins/woo-cart-items-bulk-deletion/
 * @since             1.0.0
 * @package           Wcibd
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce Cart Items Bulk Deletion
 * Plugin URI:        https://wordpress.org/plugins/woo-cart-items-bulk-deletion/
 * Description:       This plugin makes it very easy to delete cart items. Using it, you can delete all cart items at once or just the selected ones! One click, done! simple, easy!
 * Version:           1.2.0
 * Author:            Yannick ZOHOU
 * Author URI:        https://www.linkedin.com/in/yannickzohou/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wcibd
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WCIBD_VERSION', '1.2.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wcibd-activator.php
 */
function activate_wcibd() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wcibd-activator.php';
	Wcibd_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wcibd-deactivator.php
 */
function deactivate_wcibd() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wcibd-deactivator.php';
	Wcibd_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wcibd' );
register_deactivation_hook( __FILE__, 'deactivate_wcibd' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wcibd.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wcibd() {

	$plugin = new Wcibd();
	$plugin->run();

}
run_wcibd();
