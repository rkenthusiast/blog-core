<?php
/**
 * Plugin Name:       Blog Core
 * Description:       Enhance your blog theme with powerful Gutenberg blocks for creating engaging content.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Rk Enthusiast
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       blog-core
 *
 * @package           blog-core
 */


// If this file is called firectly, abort!!!
defined( 'ABSPATH' ) or die( 'No Access!' );

// Require once the Composer Autoload.
if ( file_exists( __DIR__ . '/lib/autoload.php' ) ) {
	require_once __DIR__ . '/lib/autoload.php';
}

define('PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 *
 * @return void
 */
function activate_blog_core_plugin() {
	App\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_blog_core_plugin' );

/**
 * The code that runs during plugin deactivation.
 *
 * @return void
 */
function deactivate_blog_core_plugin() {
	App\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_blog_core_plugin' );

/**
 * Initialize all the core classes of the plugin.
 */
if ( class_exists( 'App\\Init' ) ) {
	App\Init::register_services();
}