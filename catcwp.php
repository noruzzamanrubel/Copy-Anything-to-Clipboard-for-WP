<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://github.com/noruzzamanrubel
 * @since             1.0.0
 * @package           Catcwp
 *
 * @wordpress-plugin
 * Plugin Name:       Copy to Clipboard for WP
 * Plugin URI:        https://github.com/noruzzamanrubel/Copy-to-Clipboard-for-WP
 * Description:       Copy to Clipboard is a feature that allows users to copy content from a website and save it to their computer's clipboard.
 * Version:           1.0.0
 * Author:            Noruzzaman
 * Author URI:        https://https://github.com/noruzzamanrubel
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       catcwp
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
define( 'CATCWP_VERSION', '1.0.0' );
define( 'CATCWP_PATH', plugin_dir_path( __FILE__ ) );
define( 'CATCWP_URL', plugin_dir_url( __FILE__ ) );
define( 'CATCWP_NAME', 'catcwp' );
define( 'CATCWP_FULL_NAME', 'Copy Anything to Clipboard for WP' );
define( 'CATCWP_BASE_NAME', plugin_basename( __FILE__ ) );

require __DIR__ . '/vendor/autoload.php';
/**
 * Initialize the plugin tracker
 *
 * @return void
 */
function appsero_init_tracker_copy_to_clipboard_for_wp() {

    if ( ! class_exists( 'Appsero\Client' ) ) {
      require_once __DIR__ . '/appsero/src/Client.php';
    }

    $client = new Appsero\Client( 'ec4f0eda-958f-408c-b6a4-1c30d97663f4', 'Copy to Clipboard for WP', __FILE__ );

    // Active insights
    $client->insights()->init();

}

appsero_init_tracker_copy_to_clipboard_for_wp();

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-catcwp-activator.php
 */
function activate_catcwp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-catcwp-activator.php';
	Catcwp_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-catcwp-deactivator.php
 */
function deactivate_catcwp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-catcwp-deactivator.php';
	Catcwp_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_catcwp' );
register_deactivation_hook( __FILE__, 'deactivate_catcwp' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-catcwp.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_catcwp() {

	$plugin = new Catcwp();
	$plugin->run();

}
run_catcwp();

require_once plugin_dir_path( __FILE__ ) . 'widgets/catcwp-widget.php';
require_once plugin_dir_path( __FILE__ ) . 'functions.php';