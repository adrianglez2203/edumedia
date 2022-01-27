<?php
/**
 * Class Cart_Lift_Ajax
 */
class Cart_Lift_Ajax
{

	public static function init()
	{

		$validations = array(
			'logged_in' => true,
			'user_can'  => 'manage_options',
		);

		wp_ajax_helper()->handle( 'toggle-email-template-status' )
		                ->with_callback( array( 'Cart_Lift_Ajax', 'toggle_email_template_status' ) )
		                ->with_validation( $validations );


		wp_ajax_helper()->handle( 'send-preview-email' )
		                ->with_callback( array( 'Cart_Lift_Ajax', 'send_preview_email' ) )
		                ->with_validation( $validations );

		wp_ajax_helper()->handle( 'get-analytics-data' )
		                ->with_callback( array( 'Cart_Lift_Ajax', 'get_analytics_data' ) )
		                ->with_validation( $validations );

		wp_ajax_helper()->handle( 'set-other-smtp-data' )
		                ->with_callback( array( 'Cart_Lift_Ajax', 'set_smtp_data' ) )
		                ->with_validation( $validations );

		wp_ajax_helper()->handle( 'test-smtp-data' )
		                ->with_callback( array( 'Cart_Lift_Ajax', 'test_smtp_data' ) )
		                ->with_validation( $validations );

		wp_ajax_helper()->handle( 'general-save-form' )
		                ->with_callback( array( 'Cart_Lift_Ajax', 'save_general_settings' ) )
		                ->with_validation( $validations );

		wp_ajax_helper()->handle( 'campaign-copy-setup' )
		                ->with_callback( array( 'Cart_Lift_Ajax', 'campaign_copy_setup' ) )
		                ->with_validation( $validations );

		wp_ajax_helper()->handle( 'enable-cl-smtp' )
		                ->with_callback( array( 'Cart_Lift_Ajax', 'enable_cl_smtp' ) )
		                ->with_validation( $validations );

		wp_ajax_helper()->handle( 'email-popup-submit' )
		                ->with_callback( array( 'Cart_Lift_Ajax', 'email_popup_submit' ) )
		                ->with_validation( $validations );

		wp_ajax_helper()->handle( 'hide-paddle-notice' )
		                ->with_callback( array( 'Cart_Lift_Ajax', 'hide_paddle_notice' ) )
		                ->with_validation( $validations );
	}


	/**
	 * Chart data
	 *
	 * @param $payload
	 * @return array
	 */
	public static function get_analytics_data( $payload )
	{
		$range      = $payload[ 'range' ];
		$date_start = $payload[ 'date_start' ];
		$date_end   = $payload[ 'date_end' ];

		$data = cl_get_analytics_data( $range, $date_start, $date_end );
		return array(
			'success' => true,
			'data'    => $data
		);
	}


	/**
	 * Toggle the template status
	 *
	 * @param $payload
	 * @return array
	 */
	public static function toggle_email_template_status( $payload )
	{
		global $wpdb;
		$cl_email_templates_table = $wpdb->prefix . CART_LIFT_EMAIL_TEMPLATE_TABLE;
		$status                   = $payload[ 'status' ] === 'on' ? 0 : 1;
		$message                  = $payload[ 'status' ] === 'on' ? __( 'Deactivated', 'cart-lift' ) : __( 'Activated', 'cart-lift' );
		$current_status           = $payload[ 'status' ] === 'on' ? 'off' : 'on';
		$wpdb->update(
			$cl_email_templates_table,
			array(
				'active' => $status
			),
			array(
				'id' => $payload[ 'id' ]
			)
		);

		return array(
			'message'        => $message,
			'current_status' => $current_status,
			'value'          => $status
		);
	}


	/**
	 * send test email
	 *
	 * @param $payload
	 * @return array
	 */
	public static function send_preview_email( $payload )
	{
		$payload[ 'email_subject' ]       = stripslashes( $payload[ 'email_subject' ] );
		$payload[ 'email_header_text' ]   = stripslashes( $payload[ 'email_header_text' ] );
		$payload[ 'email_checkout_text' ] = stripslashes( $payload[ 'email_checkout_text' ] );

		$sent_email = cl_send_email_templates( null, $payload, true );
		return $sent_email ? array( 'success' => true ) : array( 'success' => false );
	}

	/**
	 * save smtp data
	 *
	 * @param $payload
	 * @return array
	 */
	public static function set_smtp_data( $payload )
	{
		$extract = base64_decode( $payload[ 'data' ] );
		$modify  = str_replace( "%40", "@", $extract );

		$data    = explode( '&', $modify );
		$options = array();
		foreach ( $data as $dtvalue ) {
			$data_explode    = explode( '=', $dtvalue );
			$key             = $data_explode[ 0 ];
			$val             = $data_explode[ 1 ];
			$options[ $key ] = $val;
		}

		$mailer   = new Cart_Lift_Mailer();
		$response = $mailer->cart_lift_submit_form( $options );
		wp_send_json( $response );
	}


	/**
	 * test smtp data
	 *
	 * @param $payload
	 * @return array
	 */
	public static function test_smtp_data( $payload )
	{
		$test_email = $payload[ 'data' ];
		$mailer     = new Cart_Lift_Mailer();
		$response   = $mailer->cart_lift_mail_test( $test_email );
		wp_send_json( $response );
	}


	/**
	 * save general data
	 *
	 * @param $payload
	 * @return array
	 * @since 1.0.0
	 */
	public static function save_general_settings( $payload )
	{
		global $wp_roles;
		$all_roles = $wp_roles->roles;
		parse_str( $payload[ 'data' ], $params );
		$default_options = apply_filters(
			'cl_default_general_settings', array(
				'cart_tracking'          => 1,
				'remove_carts_for_guest' => 0,
				'disable_purchased_products_campaign' => 0,
				'notify_abandon_cart'    => 0,
				'notify_recovered_cart'  => 0,
				'enable_smtp'            => 0,
				'enable_webhook'         => 0,
				'cart_webhook'           => '',
				'enable_gdpr'            => 1,
				'gdpr_text'              => __( 'Your email address will help us support your shopping experience throughout the site. Please check our Privacy Policy to see how we use your personal data.', 'cart-lift' ),
				'cart_expiration_time'   => 30,
				'cart_abandonment_time'  => 15,
				'disable_branding'       => 0,
			)
		);

		foreach ( $all_roles as $role_key => $role_value ) {
			$default_options[ $role_key ] = 0;
		}

		$options = array();
		foreach ( $default_options as $key => $value ) {
			$options[ $key ] = isset( $params[ $key ] ) ? $params[ $key ] : 0;
		}

		update_option( 'cl_general_settings', $options );
		return array(
			'status'  => 'success',
			'message' => 'Successfully saved',
		);
	}


	/**
	 * Campaign copy setup
	 *
	 * @param $payload
	 * @return array
	 * @since 1.0.0
	 */
	public static function campaign_copy_setup( $payload )
	{

		global $wpdb;
		$cl_email_table = $wpdb->prefix . CART_LIFT_EMAIL_TEMPLATE_TABLE;
		$id             = $payload[ 'data' ];
		$result         = $wpdb->get_results( "INSERT INTO $cl_email_table (template_name, email_subject, email_body, frequency, unit, active, email_meta, created_at) SELECT template_name, email_subject, email_body, frequency, unit, active, email_meta, created_at FROM $cl_email_table WHERE id = $id" );

		return array(
			'status'  => 'success',
			'message' => 'Successfully saved',
		);
	}

	/**
	 * SMTP Switcher
	 *
	 * @param $payload
	 * @return array
	 * @since 1.0.0
	 */
	public static function enable_cl_smtp( $payload )
	{

		$data = $payload[ 'data' ];
		update_option( 'enable_cl_smtp', $data );

		return array(
			'data'    => $data,
			'message' => 'Successfully saved',
		);
	}

	/**
	 * Popup submit
	 *
	 * @param $payload
	 * @return array
	 * @since 1.0.0
	 */
	public static function email_popup_submit( $payload )
	{
		$payload[ 'enabler' ] = $payload[ 'enabler' ] ? 1 : 0;
		update_option( 'cl_popup_settings', $payload );
		return array(
			'success' => true,
			'message' => 'Successfully saved',
		);
	}

	/**
	 * hide the paddle notice
	 *
	 * @param $payload
	 * @return array
	 */
	public static function hide_paddle_notice( $payload )
	{
		update_option(
			'cl_paddle_notice', array(
				'show' => false,
				'time' => current_time( CART_LIFT_DATETIME_FORMAT )
			)
		);
		return array(
			'success' => true,
		);
	}
}