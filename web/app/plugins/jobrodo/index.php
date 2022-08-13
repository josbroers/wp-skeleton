<?php
/*
Plugin Name:        Jobrodo
Description:        Base functionality for Jobrodo
Version:            1.0.0
Author:             Jos Broers
Author URI:         https://www.jobrodo.nl
Text Domain:        jobrodo-plugin
License:            MIT License
License URI:        http://opensource.org/licenses/MIT
*/

use Jobrodo\Plugin;

if ( ! defined( 'JOBRODO_PLUGIN_DIR' ) ) {
	define( 'JOBRODO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'JOBRODO_PLUGIN_FILEDIR' ) ) {
	define( 'JOBRODO_PLUGIN_FILEDIR', dirname( __DIR__, 4 ) . '/file/' );
}

if ( ! defined( 'JOBRODO_PLUGIN_LOGDIR' ) ) {
	define( 'JOBRODO_PLUGIN_LOGDIR', JOBRODO_PLUGIN_FILEDIR . 'logs/' );
}

/**
 * Fires once activated plugins have loaded.
 */
add_action( 'plugins_loaded', function () {
	return Plugin\Jobrodo::get();
} );
