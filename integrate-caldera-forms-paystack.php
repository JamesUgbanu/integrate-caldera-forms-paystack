<?php
/**
 * Plugin Name: Integration of Caldera Forms and Paystack
 * Plugin URI:  https://crystalwebpro.com
 * Description: The integration of Caldera Forms and Paystack plugin lets you add a new payment option Processor to Caldera form. It automatically send data from your Caldera form to your Paystack when the form is submitted.
 * Version:     1.0.0
 * Author:      James Ugbanu
 * Author URI:  https://crystalwebpro.com/open-source/
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: integrate-caldera-forms-paystack
 * Domain Path: /
 * Tested up to: 5.6.2
 *
 * @package ICFP
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! defined( 'ICFP_PLUGIN_FILE' ) ) {
	define( 'ICFP_PLUGIN_FILE', __FILE__ );
}

if ( ! defined( 'ICFP_ROOT' ) ) {
	define( 'ICFP_ROOT', dirname( plugin_basename( ICFP_PLUGIN_FILE ) ) );
}


// Define plugin version
define( 'ICFP_PLUGIN_VERSION', '1.0.0' );
define( 'WPCFPS_PLUGIN_PATH', dirname(__FILE__) );


if ( ! version_compare( PHP_VERSION, '5.6', '>=' ) ) {
	add_action( 'admin_notices', 'icfp_fail_php_version' );
} else {
	// Include the ICFS class.
	require_once dirname( __FILE__ ) . '/inc/class-icfp.php';
}


/**
 * Admin notice for minimum PHP version.
 *
 * Warning when the site doesn't have the minimum required PHP version.
 *
 * @return void
 */
function icfp_fail_php_version() {

	if ( isset( $_GET['activate'] ) ) {
		unset( $_GET['activate'] );
	}

	/* translators: %s: PHP version */
	$message      = sprintf( esc_html__( 'Caldera Forms Paystack Integration requires PHP version %s+, plugin is currently NOT RUNNING.', 'integrate-caldera-forms-paystack' ), '5.6' );
	$html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
	echo wp_kses_post( $html_message );
}