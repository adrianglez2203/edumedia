<?php

namespace WPFunnels\Widgets\Elementor;
use WPFunnels\Widgets\Elementor\Controls\Optin_Styles;
use WPFunnels\Widgets\Elementor\Controls\Product_Control;
use WPFunnels\Wpfnl_functions;


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Main Elementor Test Extension Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class Manager
{

    /**
     * Plugin Version
     *
     * @since 1.0.0
     *
     * @var string The plugin version.
     */
    const VERSION = WPFNL_VERSION;

    /**
     * Minimum Elementor Version
     *
     * @since 1.0.0
     *
     * @var string Minimum Elementor version required to run the plugin.
     */
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

    /**
     * Minimum PHP Version
     *
     * @since 1.0.0
     *
     * @var string Minimum PHP version required to run the plugin.
     */
    const MINIMUM_PHP_VERSION = '7.0';

    /**
     * Instance
     *
     * @since 1.0.0
     *
     * @access private
     * @static
     *
     * @var Elementor_Test_Extension The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @return Elementor_Test_Extension An instance of the class.
     * @since 1.0.0
     *
     * @access public
     * @static
     *
     */
    public static function instance()
    {

        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }

    /**
     * Constructor
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function __construct()
    {
        add_action( 'plugins_loaded', [$this, 'on_plugins_loaded'] );
//        add_action( 'elementor/editor/after_save', [$this, 'elementor_save_camps'], 10, 2);
		add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'enqueue_elementor_custom_style' ) );
		add_filter( 'wpfunnels/page_template', array( $this, 'get_page_template' ) );

		$ajax_handler = new Ajax_Handler();
	}


    /**
     * On Plugins Loaded
     *
     * Checks if Elementor has loaded, and performs some compatibility checks.
     * If All checks pass, inits the plugin.
     *
     * Fired by `plugins_loaded` action hook.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function on_plugins_loaded()
    {

        if ($this->is_compatible()) {
            add_action('elementor/init', [$this, 'init']);
        }

    }


    /**
     * Add css file on  Elementor admin
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function enqueue_elementor_custom_style()
    {
        wp_enqueue_style('elementor-icon', WPFNL_URL. 'includes/core/widgets/elementor/assets/css/elemetor-icon-style.css');
    }

    /**
     * Compatibility Checks
     *
     * Checks if the installed version of Elementor meets the plugin's minimum requirement.
     * Checks if the installed PHP version meets the plugin's minimum requirement.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function is_compatible()
    {

        // Check if Elementor installed and activated
        if (!did_action('elementor/loaded')) {
            // add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
            return false;
        }

        // Check for required Elementor version
        if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
//            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
            return false;
        }

        // Check for required PHP version
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
//            add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
            return false;
        }

        return true;

    }

    /**
     * Initialize the plugin
     *
     * Load the plugin only after Elementor (and other plugins) are loaded.
     * Load the files required to run the plugin.
     *
     * Fired by `plugins_loaded` action hook.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function init()
    {
        
        // add_action('elementor/elements/categories_registered', [$this, 'add_elementor_widget_categories']);
        add_action('elementor/init', [$this, 'add_elementor_widget_categories'],9999);

        add_action('elementor/widgets/widgets_registered', [$this, 'init_widgets']);
        add_action('elementor/controls/controls_registered', [$this, 'init_controls']);

        // remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
        // add_action( 'wpfnl_woocommerce_checkout_coupon_form', 'woocommerce_checkout_coupon_form', 10 );
    }


    /**
     * Register Category
     *
     * @since 1.0.0
     *
     * @access private
     */
    public function add_elementor_widget_categories()
    {

        $elementsManager = \Elementor\Plugin::instance()->elements_manager;
        // $elementsManager->add_category(
        //     'wp-funnel',
        //     [
        //         'title' => __('WPFunnels', 'wpfnl'),
        //         'icon' => 'fa fa-plug',
        //     ]
        // );

        $elementsManager->add_category(
            'wp-funnel',
            [
                'title' => __('WPFunnels', 'wpfnl'),
                'icon' => 'fa fa-plug',
            ]
        );
    }

    /**
     * Init Widgets
     *
     * Include widgets files and register them
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function init_widgets()
    {
		if( wp_doing_ajax() ) {
			$step_id = isset($_POST['step_id']) ? $_POST['step_id'] : (isset($_POST['editor_post_id']) ? $_POST['editor_post_id'] : '');
		} else {
			$step_id = get_the_ID();
		}


		if($step_id) {
			$step = $this->widget_registration_manager($step_id);

			if ( $step ) {
				$editor_compatibility = new Wpfnl_Elementor_Editor();

				$step_type = get_post_meta($step_id, '_step_type', true);
				if($step_type == 'landing') {
                    
					\Elementor\Plugin::instance()->widgets_manager->register(new Step_Pointer());
					\Elementor\Plugin::instance()->widgets_manager->register(new OptinForm());
				}
				if (Wpfnl_functions::is_plugin_activated('woocommerce/woocommerce.php')) {
					if($step_type == 'checkout') {
						\Elementor\Plugin::instance()->widgets_manager->register(new Checkout_Form());
					}

					if($step_type == 'thankyou') {
						\Elementor\Plugin::instance()->widgets_manager->register(new Order_Details());
					}
				}
			}
		}

    }


    /**
     * Init Controls
     *
     * Include controls files and register them
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function init_controls()
    {
        \Elementor\Plugin::$instance->controls_manager->register_control(\WPFunnels\Widgets\Elementor\Controls\Product_Control::ProductSelector, new Product_Control());
        \Elementor\Plugin::$instance->controls_manager->register_control('optin_styles', new Optin_Styles());
    }


    /**
     * Admin notice
     *
     * Warning when the site doesn't have Elementor installed or activated.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function admin_notice_missing_main_plugin()
    {

        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
        /* translators: 1: Plugin name 2: Elementor */
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'wpfnl'),
            '<strong>' . esc_html__('Elementor Test Extension', 'wpfnl') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'wpfnl') . '</strong>'
        );

        $settings = get_option('_wpfunnels_general_settings');

        if (isset($settings['builder']) && $settings['builder'] == 'elementor') {
            printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
        }

    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required Elementor version.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function admin_notice_minimum_elementor_version()
    {

        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
        /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'wpfnl'),
            '<strong>' . esc_html__('Elementor Test Extension', 'wpfnl') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'wpfnl') . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);

    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required PHP version.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function admin_notice_minimum_php_version()
    {

        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
        /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'wpfnl'),
            '<strong>' . esc_html__('Elementor Test Extension', 'wpfnl') . '</strong>',
            '<strong>' . esc_html__('PHP', 'wpfnl') . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);

    }


    /**
     * Widget Registration manager
     *
     * @since 1.0.0
     *
     * @access private
     */
    public function widget_registration_manager($page_id)
    {
        return get_post_meta($page_id, '_step_type', true);
    }

    public function elementor_save_camps($post_id, $editor_data)
    {
        $products = array();
        $product = array();
        foreach ($editor_data as $data) {
            foreach ($data['elements'] as $data) {
                foreach ($data['elements'] as $data) {
                    if(isset($data['widgetType'])) {
                        if ($data['widgetType'] == 'wpfnl-sell-accept') {
                            $product = $data['settings']['product'];
                        }
                        elseif ($data['widgetType'] == 'wpfnl-next-step') {
                            if (isset($data['settings']['checkout_product_selector'])) {
                                $product = $data['settings']['checkout_product_selector'];
                                update_post_meta($post_id, 'checkout_product_selector', array($product));
                            }
                            if (isset($data['settings']['fluent_form_next_step'])) {
                                update_post_meta($post_id, 'fluent_form_redirect_link', $data['settings']['fluent_form_next_step']);
                            }
                        }
                        elseif ($data['widgetType'] == 'wpfnl-order-detail') {
                            if (isset($data['settings']['enable_order_review'])) {
                                update_post_meta($post_id, '_wpfnl_thankyou_order_overview', 'off');
                            } else {
                                update_post_meta($post_id, '_wpfnl_thankyou_order_overview', 'on');
                            }

                            if (isset($data['settings']['enable_order_details'])) {
                                update_post_meta($post_id, '_wpfnl_thankyou_order_details', 'off');
                            } else {
                                update_post_meta($post_id, '_wpfnl_thankyou_order_details', 'on');
                            }

                            if (isset($data['settings']['enable_billing_details'])) {
                                update_post_meta($post_id, '_wpfnl_thankyou_billing_details', 'off');
                            } else {
                                update_post_meta($post_id, '_wpfnl_thankyou_billing_details', 'on');
                            }

                            if (isset($data['settings']['enable_shipping_details'])) {
                                update_post_meta($post_id, '_wpfnl_thankyou_shipping_details', 'off');
                            } else {
                                update_post_meta($post_id, '_wpfnl_thankyou_shipping_details', 'on');
                            }
                        }
                        elseif ($data['widgetType'] == 'wpfnl-upsell-downsell') {
                            if (isset($data['settings']['upsell_downsell_selector']) && $data['settings']['upsell_downsell_selector'] == 'upsell') {
                                $organizer = $this->reorganize_funnel_order($post_id, $data['settings']['upsell_downsell_selector']);
                                update_post_meta($post_id, '_step_type', $data['settings']['upsell_downsell_selector']);
                                if (isset($data['settings']['upsell_accept_reject_selector']) && $data['settings']['upsell_accept_reject_selector'] == 'accept') {
                                    if (isset($data['settings']['upsell_product_selector'])) {
                                        $product = $data['settings']['upsell_product_selector'];
                                    }
                                    if (isset($data['settings']['upsell_accept_next_step_selector'])) {
                                        update_post_meta($post_id, '_wpfnl_upsell_next_step_yes', $data['settings']['upsell_accept_next_step_selector']);
                                    }
                                } else {
                                    if (isset($data['settings']['upsell_reject_next_step_selector'])) {
                                        update_post_meta($post_id, '_wpfnl_upsell_next_step_no', $data['settings']['upsell_reject_next_step_selector']);
                                    }
                                }
                            } elseif (isset($data['settings']['upsell_downsell_selector']) && $data['settings']['upsell_downsell_selector'] == 'downsell') {
                                $organizer = $this->reorganize_funnel_order($post_id, $data['settings']['upsell_downsell_selector']);
                                update_post_meta($post_id, '_step_type', $data['settings']['upsell_downsell_selector']);
                                if (isset($data['settings']['downsell_accept_reject_selector']) && $data['settings']['downsell_accept_reject_selector'] == 'accept') {
                                    if (isset($data['settings']['downsell_product_selector'])) {
                                        $product = $data['settings']['downsell_product_selector'];
                                    }
                                    if (isset($data['settings']['downsell_accept_next_step_selector'])) {
                                        update_post_meta($post_id, '_wpfnl_downsell_next_step_yes', $data['settings']['downsell_accept_next_step_selector']);
                                    }
                                } else {
                                    if (isset($data['settings']['downsell_reject_next_step_selector'])) {
                                        update_post_meta($post_id, '_wpfnl_downsell_next_step_no', $data['settings']['downsell_reject_next_step_selector']);
                                    }
                                }
                            }
                        }
                    }

                }
            }
        }
        if ($product) {
            $products[] = $product = array(
                'id' => $product,
                'quantity' => '1',
            );
            $get_type = get_post_meta($post_id, '_step_type', true);
            if ($get_type == 'upsell') {
                update_post_meta($post_id, '_wpfnl_upsell_product', $products);
            } elseif ($get_type == 'downsell') {
                update_post_meta($post_id, '_wpfnl_downsell_product', $products);
            }
        }
    }

    public function reorganize_funnel_order($step_id, $step_type)
    {
        $funnel_id = get_post_meta($step_id, '_funnel_id', true);
        $funnel_order = get_post_meta($funnel_id, '_steps_order', true);
        foreach ($funnel_order as $key => $data) {
            if ($data['id'] == $step_id) {
                $funnel_order[$key]['type'] = $step_type;
            }
        }
        update_post_meta($funnel_id, '_steps_order', $funnel_order);

        return true;
    }


	/**
	 * get page templates
	 *
	 * @param $template
	 * @return mixed
	 *
	 * @since 2.0.5
	 */
    public function get_page_template( $template ) {

		if ( Wpfnl_functions::is_elementor_active() && is_singular() ) {
			$is_preview_mode = \Elementor\Plugin::$instance->preview->is_preview_mode();
			if($is_preview_mode) {
				$document = \Elementor\Plugin::$instance->documents->get_doc_for_frontend( get_the_ID() );
				if ( $document ) {
					$template = $document->get_meta( '_wp_page_template' );
				}
			}

		}
		return $template;
	}
}

Manager::instance();
