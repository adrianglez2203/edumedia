<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://rextheme.com/
 * @since      1.0.0
 *
 * @package    Cart_Lift
 * @subpackage Cart_Lift/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cart_Lift
 * @subpackage Cart_Lift/admin
 * @author     RexTheme <info@rextheme.com>
 */
class Cart_Lift_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles($hook) {

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


        if( ($hook !== 'toplevel_page_cart_lift' ) ){
            return;
        }
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style( 'cart-lift-chart', plugin_dir_url( __FILE__ ) . 'css/chart.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'jquery-ui', plugin_dir_url( __FILE__ ) . 'css/jquery-ui.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'nice-select', plugin_dir_url( __FILE__ ) . 'css/nice-select.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-style', plugin_dir_url( __FILE__ ) . 'css/main.css', array(), $this->version, 'all' );
        // wp_style_add_data( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rtl.css', 'replace' );
        // wp_style_add_data( $this->plugin_name, 'rtl', 'replace' ); 

        if (is_rtl()){
            wp_dequeue_style( $this->plugin_name.'-style');
            wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rtl.css', array(), $this->version, 'all' );
        }

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts($hook) {

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

        wp_enqueue_script( $this->plugin_name.'_global', plugin_dir_url( __FILE__ ) . 'js/cart-lift-global.js', array( 'jquery' ), $this->version, true );


        if( ($hook !== 'toplevel_page_cart_lift' ) ){
            return;
        }

        wp_enqueue_script( 'jquery-ui-datepicker' );
        wp_enqueue_script( 'jquery-ui-tabs' );
		wp_enqueue_script( 'cart-lift-chart-js', plugin_dir_url( __FILE__ ) . 'js/chart.min.js', array(), true );
		wp_enqueue_script( 'nice-select-js', plugin_dir_url( __FILE__ ) . 'js/jquery.nice-select.min.js', array('jquery'), true );
		wp_enqueue_script( $this->plugin_name.'-mce', plugin_dir_url( __FILE__ ) . 'js/cart-lift-mce.js', array('jquery'), true );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cart-lift-admin.js', array( 'jquery', 'wp-color-picker' ), $this->version, true );
	}


    /**
     * returns output buffer
     */
    public function cl_plugin_output_buffer() {
        ob_start();
    }


    public function cl_mce_button_filter($buttons) {
        $buttons[] = 'cl_mce_button';
        return $buttons;
    }


    public function cl_mce_plugin_filter($plugins) {
        $plugins['cl_mce_button'] = CART_LIFT_URL . 'admin/js/cart-lift-mce.js';
        return $plugins;
    }


    /**
     * admin title for cl menus
     *
     * @param $admin_title
     * @param $title
     * @return string
     * @since 1.0.0
     */
    public function cl_admin_title($admin_title, $title) {
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
        $sub_action = filter_input(INPUT_GET, 'sub_action', FILTER_SANITIZE_STRING);
        if($sub_action) {
            if($sub_action === 'edit_email_template') {
                return str_replace('Dashboard', __('Edit Campaign', 'cart-lift'), $admin_title);
            }
        }else {
            if($action === 'carts') {
                return str_replace('Dashboard', __('Carts', 'cart-lift'), $admin_title);
            }elseif ($action === 'email_templates') {
                return str_replace('Dashboard', __('Campaigns', 'cart-lift'), $admin_title);
            }elseif ($action === 'settings') {
                return str_replace('Dashboard', __('Settings', 'cart-lift'), $admin_title);
            }elseif ($action === 'compare') {
                return str_replace('Dashboard', __('Free vs Pro', 'cart-lift'), $admin_title);
            }elseif ($action === 'license') {
                return str_replace('Dashboard', __('Manage License', 'cart-lift'), $admin_title);
            }
        }
        return $admin_title;
    }


    /**
     * active class for menu sub-item
     *
     * @param $parent_file
     * @return string
     * @since 1.0.0
     */
    public function cl_highlight_admin_menu($parent_file) {
        global $submenu_file;
        $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
        if($page === 'cart_lift') {
            if(isset($action) && $action !== 'dashboard') {
                $submenu_file = 'admin.php?page=cart_lift&action='.$action;
            }
        }
        return $parent_file;
    }



    public function cl_highlight_admin_submenu($parent_file, $submenu_file) {
        $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
        if($page === 'cart_lift') {
            if(isset($action) && $action !== 'dashboard') {
                $submenu_file = 'admin.php?page=cart_lift&action='.$action;
            }
        }
        return $submenu_file;
    }

    /**
     * Add plugin menu page
     *
     * @since 1.0.0
     */
    public function cart_lift_menu() {
        add_menu_page(
            __('Dashboard', 'cart-lift'),
            __('Cart Lift', 'cart-lift'),
            'manage_options',
            'cart_lift',
            array( $this, 'cart_lift_menu_page' ),
            CART_LIFT_URL.'/admin/images/cart-lift-icon.png',
            20
        );

        add_submenu_page(
            'cart_lift',
            __('Dashboard', 'cart-lift'),
            __('Dashboard', 'cart-lift'),
            'manage_options',
            'cart_lift'
        );


        add_submenu_page(
            'cart_lift',
            __('All Carts', 'cart-lift'),
            __('All Carts', 'cart-lift'),
            'manage_options',
            'admin.php?page=cart_lift&action=carts'
        );


        add_submenu_page(
            'cart_lift',
            __('Campaigns', 'cart-lift'),
            __('Campaigns', 'cart-lift'),
            'manage_options',
            'admin.php?page=cart_lift&action=email_templates'
        );


        add_submenu_page(
            'cart_lift',
            __('Settings', 'cart-lift'),
            __('Settings', 'cart-lift'),
            'manage_options',
            'admin.php?page=cart_lift&action=settings'
        );

        if(!apply_filters('is_cl_pro_active', false))  {
            add_submenu_page(
                'cart_lift',
                '',
                '<span class="dashicons dashicons-star-filled" style="font-size: 17px; color: #6e41d3;"></span> ' . __( 'Go Pro', 'cart-lift' ),
                'manage_options', 'go_cl_pro',
                array($this, 'cl_redirect_to_pro')
            );
        }

        do_action('cl_pro_sub_menu_items');
    }


    public static function cl_redirect_to_pro() {
        $pro_url = add_query_arg( 'cl-dashboard', '1', 'https://rextheme.com/cart-lift' );
        wp_redirect($pro_url);
        exit();
    }


    /**
     * render menu page contents
     *
     * @since 1.0.0
     */
    public function cart_lift_menu_page() {
        $tab_view = new Cart_Lift_Tab_View();
        require_once CART_LIFT_DIR . '/admin/partials/cart-lift-tabs-display.php';
    }


    /**
     * Get the action links
     *
     * @param $actions
     * @param $plugin_file
     * @param $plugin_data
     * @param $context
     * @return array
     */
    public function cart_lift_action_links($actions, $plugin_file, $plugin_data, $context) {
        $actions['dashboard'] = sprintf(
            '<a href="%s">%s</a>',
            esc_url( admin_url( 'admin.php?page=cart_lift' ) ),
            esc_html__( 'Dashboard', 'cart-lift' )
        );
        $actions['documentation'] = sprintf(
            '<a href="%s" target="_blank">%s</a>',
            esc_url( 'https://rextheme.com/docs/cart-lift?cl-dashboard=1' ),
            esc_html__( 'Documentation', 'cart-lift' )
        );

        if(!apply_filters('is_cl_pro_active', false))  {
            $actions['go-pro'] = sprintf(
                '<a href="%s" target="_blank"  style="color: #6e42d3; font-weight: bold;">%s</a>',
                esc_url( 'https://rextheme.com/cart-lift?cl-dashboard=1' ),
                esc_html__( 'Go Pro', 'cart-lift' )
            );
        }
        return $actions;
    }


    /**
     * Set the cart status to abandoned and
     * send abandoned cart emails
     *
     * Ran every 15 minutes
     *
     * @internal
     */
    public function cl_add_action_scheduler() {

        if ( false === as_next_scheduled_action( 'cart_lift_process_scheduled_email_hook' ) ) {
            $schedule_time = apply_filters( 'cart_lift_cron_schedule', '*/10 * * * *' );
            wp_clear_scheduled_hook( 'cart_lift_process_scheduled_email_hook' );
            as_schedule_cron_action( time(), $schedule_time, 'cart_lift_process_scheduled_email_hook' );
        }

        if ( false === as_next_scheduled_action( 'cart_lift_x_days_cart_remove' ) ) {
            wp_clear_scheduled_hook( 'cart_lift_x_days_cart_remove' );
            as_schedule_cron_action( time(), '0 0 * * 0', 'cart_lift_x_days_cart_remove' );
        }
    }


    /**
     * 15 min cron schedule
     *
     * @param $schedules
     * @return mixed
     */
     public function cl_custom_schedules() {
         $cron_time = apply_filters( 'cart_lift_cron_interval', 15 );
         $schedules['cl_fifteen_minutes'] = array(
             'interval'  => $cron_time * 60,
             'display'   => sprintf(__( 'Every %d Minutes', 'cart-lift' ), $cron_time),
         );
         return $schedules;
     }


    /**
     * @param $email_classes
     * @return array
     * @since 1.0.0
     */
     public function cl_wc_admin_email_template($email_classes) {
         require_once CART_LIFT_DIR.'/includes/wc-email/class-cart-lift-abandoned-email-template.php';
         $email_classes['Cart_Lift_Admin_Abandoned_Email_Template'] = new Cart_Lift_Admin_Abandoned_Email_Template();
         return $email_classes;
     }


    /**
     * @param $actions
     * @return array
     * @since 1.0.0
     */
     public function cl_wc_admin_email_actions($actions) {
         $actions[] = 'cl_trigger_abandon_cart_email';
         return $actions;
     }



    /**
     * show notice for paddle
     * payment gateway
     *
     * @internal
     */
     public function show_paddle_notice() {
         $notice_meta = get_option('cl_paddle_notice', false);
         $start_date = new DateTime(current_time(CART_LIFT_DATETIME_FORMAT));
         if($notice_meta) {
             $since_start = $start_date->diff(new DateTime($notice_meta['time']));
             if($since_start->m >= 1) {
                 ?>
                 <div class="notice notice-success cl-paddle-notice is-dismissible">
                     <p><?php _e( 'If you are using Paddle Payment Gateway, please ensure that you have disabled Abandoned Cart Recovery from there.', 'cart-lift' ); ?></p>
                 </div>
                 <?php
             }
         }else {
             ?>
             <div class="notice notice-success cl-paddle-notice is-dismissible">
                 <p><?php _e( 'If you are using Paddle Payment Gateway, please ensure that you have disabled Abandoned Cart Recovery from there.', 'cart-lift' ); ?></p>
             </div>
             <?php
         }
     }
}
