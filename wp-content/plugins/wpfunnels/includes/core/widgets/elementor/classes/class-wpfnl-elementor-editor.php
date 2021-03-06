<?php

namespace WPFunnels\Widgets\Elementor;

use WPFunnels\Meta\Wpfnl_Default_Meta;
use WPFunnels\Traits\SingletonTrait;
use WPFunnels\Wpfnl;
use WPFunnels\Wpfnl_functions;

class Wpfnl_Elementor_Editor {

	use SingletonTrait;

	public function __construct() {
		$this->elementor_compatibility();
	}


	/**
	 * Elementor compatibility
	 *
	 * @since 2.0.4
	 */
	private function elementor_compatibility() {

		$current_post_id = 0;

		$elementor_preview_active = \Elementor\Plugin::$instance->preview->is_preview_mode();

		if( $elementor_preview_active ) {
			add_filter( 'wpfunnels/show_dummy_order_details', '__return_true' );
		}

		if ( is_admin() && wp_doing_ajax() && isset($_REQUEST['action']) && 'elementor_ajax' === $_REQUEST['action'] ) {
			add_filter( 'wpfunnels/show_dummy_order_details', '__return_true' );
			if(isset( $_REQUEST['editor_post_id'] ) && ! empty( $_REQUEST['editor_post_id'] )) {
				$current_post_id = absint( $_REQUEST['editor_post_id'] );
			}
		} else {
			$current_post_id = get_the_ID();
		}

		if ( $current_post_id ) { //phpcs:ignore

			$current_post_type = get_post_type( $current_post_id );

			if ( $current_post_type === WPFNL_STEPS_POST_TYPE ) {

				$frontend = Wpfnl::get_instance()->frontend;
				add_filter('woocommerce_locate_template', array( $frontend, 'wpfunnels_woocommerce_locate_template' ), 20, 3);
			}
		}

		if ( Wpfnl_functions::is_funnel_step_page() ) {
			add_action('elementor/widget/before_render_content', function ( $widget ) use ( $current_post_id ) {
				$widget_type 		= $widget->get_name();
				$widget_settings 	= $widget->get_settings();
				if( 'wpfnl-checkout' === $widget_type ) {
					$ob_settings = $this->get_order_bump_settings_for_preview( $current_post_id, $widget_settings );
					do_action('wpfunnels/elementor_render_order_bump', $current_post_id, $ob_settings );
				}
			});
		}

		if(Wpfnl_functions::check_if_this_is_step_type('checkout')) {
			$show_coupon = Wpfnl::get_instance()->meta->get_checkout_meta_value( $current_post_id, '_wpfnl_checkout_coupon' );
			if( 'no' === $show_coupon ) {
				remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form' );
			}
		}


	}


	/**
	 * get order bump settings for preview
	 *
	 * @param $post_id
	 * @param $widget_settings
	 * @return mixed
	 *
	 * @since 2.0.4
	 */
	private function get_order_bump_settings_for_preview( $post_id, $widget_settings ) {
		$order_bump_settings 	= get_post_meta( $post_id, 'order-bump-settings', true );
		if( $order_bump_settings ) {
			$settings = $this->replace_ob_settings_with_widget_data( $order_bump_settings, $widget_settings );
		} else {
			$default_settings	= Wpfnl_Default_Meta::get_default_order_bump_meta();
			$settings = $this->replace_ob_settings_with_widget_data( $default_settings, $widget_settings );
		}
		return $settings;
	}


	/**
	 * replace ob settings with widget data
	 *
	 * @param $order_bump_settings
	 * @param $widget_settings
	 * @return mixed
	 *
	 * @since 2.0.4
	 */
	private function replace_ob_settings_with_widget_data( $order_bump_settings, $widget_settings ) {
		$order_bump_settings['checkBoxLabel'] 			= isset( $widget_settings['order_bump_checkbox_label'] ) ? $widget_settings['order_bump_checkbox_label'] : $order_bump_settings['checkBoxLabel'];
		$order_bump_settings['highLightText'] 			= isset( $widget_settings['order_bump_product_detail_header'] ) ? $widget_settings['order_bump_product_detail_header'] : $order_bump_settings['highLightText'];
		$order_bump_settings['productDescriptionText'] 	= isset( $widget_settings['order_bump_product_detail'] ) ? $widget_settings['order_bump_product_detail'] : $order_bump_settings['productDescriptionText'];
		$order_bump_settings['position'] 				= isset( $widget_settings['order_bump_position'] ) ? $widget_settings['order_bump_position'] : $order_bump_settings['position'];
		$order_bump_settings['selectedStyle'] 			= isset( $widget_settings['order_bump_layout'] ) ? $widget_settings['order_bump_layout'] : $order_bump_settings['selectedStyle'];
		$order_bump_settings['productImage'] 			= isset( $widget_settings['order_bump_image'] ) ? $widget_settings['order_bump_image'] : $order_bump_settings['productImage'];
		$order_bump_settings['isEnabled'] 				= isset( $widget_settings['order_bump'] ) ? $widget_settings['order_bump'] : $order_bump_settings['isEnabled'];
		return $order_bump_settings;

	}

}
