<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://rextheme.com/
 * @since      1.0.0
 *
 * @package    Cart_Lift
 * @subpackage Cart_Lift/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Cart_Lift
 * @subpackage Cart_Lift/public
 * @author     RexTheme <info@rextheme.com>
 */
class Cart_Lift_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cart_Lift_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cart_Lift_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cart-lift-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cart_Lift_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cart_Lift_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

        $general_settings = cl_get_general_settings();

        $current_user = wp_get_current_user();
        $roles  = $current_user->roles;

        $role   = array_shift( $roles );
        if (array_key_exists($role, $general_settings)) {
            if ($general_settings[$role] == 1) {
                return;
            }
        }

        $gdpr_enabled = 0;
        if($general_settings['enable_gdpr']) {
            if(isset( $_COOKIE['cart_lift_skip_tracking_data'])) {
                if($_COOKIE['cart_lift_skip_tracking_data']) {
                    $gdpr_enabled = 0;
                }else {
                    $gdpr_enabled = 1;
                }
            }else {
                $gdpr_enabled = 1;
            }
        }
        
        wp_enqueue_script( $this->plugin_name. 'cookie', plugin_dir_url( __FILE__ ) . 'js/js.cookie.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cart-lift-public.js', array( 'jquery' ), $this->version, true );
        wp_localize_script($this->plugin_name, 'cl_localized_vars', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'security' => wp_create_nonce('cart-lift'),
            'gdpr_nonce' => wp_create_nonce( 'cart-lift-disable-gdpr' ),
            'gdpr' => $gdpr_enabled,
            'gdpr_messages' => $general_settings['gdpr_text'],
        ));
	}


}
