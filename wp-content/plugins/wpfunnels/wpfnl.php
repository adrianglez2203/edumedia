<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://getwpfunnels.com
 * @since             1.0.0
 * @package           Wpfnl
 *
 * @wordpress-plugin
 * Plugin Name:       WPFunnels
 * Plugin URI:        https://getwpfunnels.com
 * Description:       Drag & Drop Sales Funnel Builder for WordPress – WPFunnels
 * Version:           2.2.3
 * Author:            WPFunnels Team
 * Author URI:        https://getwpfunnels.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpfnl
 * Domain Path:       /languages
 */

use wPFunnels\Wpfnl;
// use WPFunnels\Wpfnl_functions;

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */

if ( ! defined( 'WPFNL_VERSION' ) ) {
	define('WPFNL_VERSION', '2.2.3');
}

if ( ! defined( 'WPFNL_FILE' ) ) {
	define('WPFNL_FILE', __FILE__);
}

if ( ! defined( 'WPFNL_BASE' ) ) {
	define('WPFNL_BASE', plugin_basename(WPFNL_FILE));
}

if ( ! defined( 'WPFNL_DIR' ) ) {
	define('WPFNL_DIR', plugin_dir_path(WPFNL_FILE));
}

if ( ! defined( 'WPFNL_URL' ) ) {
	define('WPFNL_URL', plugins_url('/', WPFNL_FILE));
}

if ( ! defined( 'WPFNL_DIR_URL' ) ) {
	define('WPFNL_DIR_URL', plugin_dir_url(WPFNL_FILE));
}


define('WPFNL_TEMPLATE_URL', '');
define('WPFNL_MAIN_PAGE_SLUG', 'wp_funnels');
define('WPFNL_SETTINGS_SLUG', 'wp_funnel_settings');
define('WPFNL_EDIT_FUNNEL_SLUG', 'edit_funnel');
define('WPFNL_FUNNELS_POST_TYPE', 'wpfunnels');
define('WPFNL_STEPS_POST_TYPE', 'wpfunnel_steps');
define('WPFNL_CREATE_FUNNEL_SLUG', 'create_funnel');
define('WPFNL_GLOBAL_SETTINGS_SLUG', 'wpfnl_settings');
define('WPFNL_FUNNEL_PER_PAGE', 5);
define('WPFNL_TEMPLATES_OPTION_KEY', 'wpfunnels_remote_templates');
define('WPFNL_TESTS', false);
define('WPFNL_DOCUMENTATION_LINK', 'https://getwpfunnels.com/docs/wpfunnels-wordpress-funnel-builder/');

define('WPFNL_ACTIVE_PLUGINS', apply_filters('active_plugins', get_option('active_plugins')));


define('WPFNL_TAXONOMY_TEMPLATES_BUILDER', 'template_builder' );
define('WPFNL_TAXONOMY_TEMPLATES_PROPERTY', 'template_type' );
define('WPFNL_TAXONOMY_TEMPLATES_INDUSTRIES', 'template_industries' );
define('WPFNL_TAXONOMY_STEP_TYPE', 'type' );
define('WPFNL_IS_REMOTE', false );
define('WPFNL_PRO', '/wpfunnels-pro/wpfnl-pro.php' );
define('WPFNL_PRO_REQUIRED_VERSION', '1.0.4' );
/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-wpfnl.php';


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wpfnl-activator.php
 */
function activate_wpfnl()
{
    require_once plugin_dir_path(__FILE__) . 'includes/utils/class-wpfnl-activator.php';
    Wpfnl_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wpfnl-deactivator.php
 */
function deactivate_wpfnl()
{
    require_once plugin_dir_path(__FILE__) . 'includes/utils/class-wpfnl-deactivator.php';
    Wpfnl_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_wpfnl');
register_deactivation_hook(__FILE__, 'deactivate_wpfnl');



function wpfnl() {
	return Wpfnl::get_instance();
}


/**
 * Gets plugin version
 *
 * @param $file
 * @return mixed|string
 */
function wpfnl_get_plugin_version( $file ) {
	$plugin_file = WP_PLUGIN_DIR . $file;

	if ( file_exists( $plugin_file ) && function_exists( 'get_file_data' ) ) {
		$plugin_data = get_file_data( $plugin_file, array('Version' => 'Version'), false );
		if ( $plugin_data && is_array( $plugin_data ) && isset( $plugin_data[ 'Version' ] ) ) {
			return $plugin_data[ 'Version' ];
		}
	}
	return false;
}



/**
 * Check if wpfnl Pro is compatible with new ui [version > 6.0.0]
 *
 * @return bool
 */
function wpfnl_free_compatibility() {
	if ( wpfnl_get_plugin_version( WPFNL_PRO ) ) {

		return ( version_compare(wpfnl_get_plugin_version( WPFNL_PRO ), WPFNL_PRO_REQUIRED_VERSION , ">=") );
	}
	return false;
}


/**
 * Run dependency check and abort if required.
 **/
function wpfnl_free_check_dependency(){
	if ( ! function_exists( 'is_plugin_active' ) ){
		require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
	}
	$is_plugin_list_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
    if ( ( is_plugin_active( 'wpfunnels-pro/wpfnl-pro.php' ) && ! wpfnl_free_compatibility() ) && ( $is_plugin_list_page == 'plugins.php' || (isset($_GET['page']) && $_GET['page'] == 'wp_funnels' ) ) ) {

	    add_action( 'admin_notices', 'wpfnl_free_update_notice' );
	    add_action( 'after_plugin_row_'. plugin_basename( __FILE__ ), 'wpfnl_free_update_notice_after_plugin_row' );
    }
}


/**
 * Prints a notice to update wpfnl Pro
 */
function wpfnl_free_update_notice() {
    $wpfnl_pro_abs = WP_PLUGIN_DIR . WPFNL_PRO;

    $wpfnl_pro = file_exists( $wpfnl_pro_abs ) && ! wpfnl_free_compatibility() ? '<strong>WPFunnels-Pro</strong>' : '';

    $message = __("It appears you have an older version of WPFunnels Pro. This may cause some issues with the plugin's functionality. Please update WPFunnels Pro to v". WPFNL_PRO_REQUIRED_VERSION ." and above. Update now.",'wpfnl');
	?>
	<div class="notice notice-error is-dismissible">
        <p>
            <?php echo $message;?>
        </p>
	</div>
	<?php
}


function wpfnl_get_pro_notice_message(){

	return __("It appears you have an older version of WPFunnels Pro. This may cause some issues with the plugin's functionality. Please update WPFunnels Pro to v". WPFNL_PRO_REQUIRED_VERSION ." and above.",'wpfnl');
}

function wpfnl_free_update_notice_after_plugin_row(){
	printf( '</tr><tr class="plugin-update-tr"><td colspan="5" class="plugin-update"><div class="update-message" style="background-color: #ffebe8;">%s</div></td>', wpfnl_get_pro_notice_message() );
}




/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wpfnl()
{
	wpfnl()->run();
	wpfnl_free_check_dependency();
}
run_wpfnl();



/**
 * Initialize the plugin tracker
 *
 * @return void
 */
function appsero_init_tracker_wpfunnels() {
    $client = new Appsero\Client( '6fb1e340-8276-4337-bca6-28a7cd186f06', 'WPFunnels', __FILE__ );
    $client->insights()->init();
}
appsero_init_tracker_wpfunnels();



add_filter('et_builder_third_party_post_types', 'wpfnl_third_party_post_type', 10, 1);
function wpfnl_third_party_post_type($post_types) {
	$post_types[] = WPFNL_STEPS_POST_TYPE;
	return $post_types;
}
