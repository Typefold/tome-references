<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Tome_References
 *
 * @wordpress-plugin
 * Plugin Name:       Tome - References
 * Plugin URI:        http://example.com/tome-references-uri/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Jakub Kohout
 * Author URI:        Tome.press
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tome-references
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tome-references-activator.php
 */
function activate_tome_references() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tome-references-activator.php';
	Tome_References_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tome-references-deactivator.php
 */
function deactivate_tome_references() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tome-references-deactivator.php';
	Tome_References_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tome_references' );
register_deactivation_hook( __FILE__, 'deactivate_tome_references' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tome-references.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tome_references() {

	$plugin = new Tome_References();
	$plugin->run();

}
run_tome_references();
