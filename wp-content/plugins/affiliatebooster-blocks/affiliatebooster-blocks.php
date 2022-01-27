<?php
/**
 * Plugin Name: Affiliate Booster - Pros & Cons, Notice, and CTA Blocks for Affiliates
 * Plugin URI: https://wordpress.org/plugins/affiliatebooster-plugin/
 * Description: #1 affiliate plugin to increase your sales.
 * Version: 2.0.3
 * Author: Kulwant Nagi
 * Contributors: Affiliate Booster
 * Author URI: https://www.affiliatebooster.com/
 * License: GPL2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * Text Domain: affiliatebooster-blocks
 */

/**
 * Exit if accessed directly
 */
if (!defined('ABSPATH')) {
    exit;
}

define('AFB_DOMAIN', 'affiliate-booster');
define('AFB_DIR', plugin_dir_path(__FILE__));
define('AFB_URL', plugins_url('/', __FILE__));

/**
 * Initialize the blocks
 */
function affiliate_booster_gutenberg_loader() {
    /**
     * Load the blocks functionality
     */
    require_once ( AFB_DIR . 'dist/init.php');
    require_once ( AFB_DIR . 'disableblocks/class-abdisable-gutenberg-blocks.php');

    include_once ABSPATH . 'wp-admin/includes/plugin.php';

    if ( is_plugin_active( 'gutenberg/gutenberg.php' ) || version_compare( get_bloginfo( 'version' ), '4.9.9', '>' ) ) {
        ABDisable_Gutenberg_Blocks::instance();
    }
}

add_action('plugins_loaded', 'affiliate_booster_gutenberg_loader');

/**
 * Load the plugin text-domain
 */
function affiliate_booster_gutenberg_init() {
    load_plugin_textdomain('affiliate-booster', false, basename(dirname(__FILE__)) . '/languages');
}

add_action('init', 'affiliate_booster_gutenberg_init');


/**
 * Load the plugin welcome page css
 */
function affiliate_booster_load_admin_scripts( $hook ) {
	wp_register_style( 'affiliatebooster-welcome', AFB_URL.'/assets/css/affiliatebooster-welcome.css', false, '' );
	wp_enqueue_style( 'affiliatebooster-welcome' );
}
add_action( 'admin_enqueue_scripts', 'affiliate_booster_load_admin_scripts' );


/**
 * Add a check for our plugin before redirecting
 */
function affiliate_booster_gutenberg_activate() {
    add_option('affiliate_booster_gutenberg_do_activation_redirect', true);
}

register_activation_hook(__FILE__, 'affiliate_booster_gutenberg_activate');

/**
 * Redirect to the affiliate booster page on single plugin activation
 */
function affiliate_booster_gutenberg_redirect() {
    if ( get_option( 'affiliate_booster_gutenberg_do_activation_redirect', false ) ) {
        delete_option( 'affiliate_booster_gutenberg_do_activation_redirect' );
        if( !isset( $_GET['activate-multi'] ) ) {
            wp_redirect( "admin.php?page=affiliate_booster" );
        }
    }
}
add_action( 'admin_init', 'affiliate_booster_gutenberg_redirect' );

/**
 * Adds a menu item for the affiliatebooster-blocks page.
 *
 * since 1.0.0
 */
function affiliate_booster_getting_started_menu() {

	add_menu_page(
		__( 'Affiliate Booster', 'affiliatebooster-blocks' ),
		__( 'Affiliate Booster', 'affiliatebooster-blocks' ),
		'manage_options',
		'affiliate_booster',
		'affiliate_booster_welcome_page',
		AFB_URL.'/assets/images/icon.png'
	);

}
add_action( 'admin_menu', 'affiliate_booster_getting_started_menu' );


/**
 * Outputs the markup used on the affiliatebooster-blocks
 *
 * since 1.0.0
 */
function affiliate_booster_welcome_page() {
	require_once plugin_dir_path( __FILE__ ) . 'src/welcome_page.php';
}

/**
 * Create Affiliate Booster Categories
 */
add_filter( 'block_categories_all', function( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'affiliate-booster',
				'title' => __( 'Affiliate Booster', 'affiliate-booster' ),
			),
		)
	);
}, 10, 2 );