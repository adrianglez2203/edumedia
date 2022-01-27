<?php

/**
 * Fired during plugin activation
 *
 * @link       http://rextheme.com/
 * @since      1.0.0
 *
 * @package    Cart_Lift
 * @subpackage Cart_Lift/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Cart_Lift
 * @subpackage Cart_Lift/includes
 * @author     RexTheme <info@rextheme.com>
 */
class Cart_Lift_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
        $db = Cart_Lift_DB::get_instance();
        $db->create_tables();

        if (! wp_next_scheduled ( 'cart_lift_process_scheduled_email_hook' )) {
            wp_schedule_event( time(), 'cl_fifteen_minutes', 'cart_lift_process_scheduled_email_hook');
        }

        if (! wp_next_scheduled ( 'wp_cl_x_day_cart_remove' )) {
            wp_schedule_event( time(), 'weekly', 'cart_lift_x_days_cart_remove');
        }

        // set plugin security key
        $security_key = get_option('cart_lift_security_key', '');
        if(!isset($security_key)) update_option( 'cart_lift_security_key', md5( uniqid( wp_rand(), true ) ) );


        // default settings
        $current_user     = wp_get_current_user();
        $email_from       = ( isset( $current_user->user_firstname ) && ! empty( $current_user->user_firstname ) ) ? $current_user->user_firstname . ' ' . $current_user->user_lastname : 'Admin';
        $settings = array(
            'cl_db_version' => '4.0',
            'cl_general_settings' => array(
                'cart_tracking' => 1,
                'remove_carts_for_guest' => 1,
                'notify_abandon_cart' => 0,
                'notify_recovered_cart' => 0,
                'enable_smtp' => 0,
                'enable_webhook' => 0,
                'cart_webhook' => '',
                'enable_gdpr' => 1,
                'gdpr_text' => __('Your email address will help us support your shopping experience throughout the site. Please check our Privacy Policy to see how we use your personal data.', 'cart-lift'),
                'disable_branding' => 0,
                'cart_expiration_time' => 30,
                'cart_abandonment_time' => 15,
            )
        );
        foreach ( $settings as $key => $setting ) {
            if (!get_option($key)) {
                update_option($key, $setting);
            }
        }
	}

}
