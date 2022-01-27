<?php

class Cart_Lift_EDD_Actions extends Cart_Lift_Cart_Actions
{


    /**
     * EDD after product added to cart
     * action
     * @param $download_id
     * @param $options
     * @param $items
     * @since 1.0.0
     */
    function add_to_cart_action( $download_id, $options, $items )
    {

        // TODO: Implement add_to_cart_action() method.
	    $user_email = '';
	    if( is_user_logged_in() ) {
		    $user_id    = get_current_user_id();
		    $user_info  = get_userdata( $user_id );
		    $user_email = $user_info->user_email;
	    } else {
		    $user_email = isset( $_COOKIE[ 'cart_lift_user_email' ] ) ? $_COOKIE[ 'cart_lift_user_email' ] : '';
	    }
	    $this->save_cart_infos( $user_email, $this->provider );
    }


    /**
     * delete cart data if user
     * remove cart
     * @param $key
     * @param $item_id
     * @since 1.0.0
     */
    function delete_cart_action( $key, $item_id )
    {

        // TODO: Implement delete_to_cart_action() method.
        $user_email = '';
        if( is_user_logged_in() ) {
            $user_id    = get_current_user_id();
            $user_info  = get_userdata( $user_id );
            $user_email = $user_info->user_email;
        } else {
            $user_email = isset( $_COOKIE[ 'cart_lift_user_email' ] ) ? $_COOKIE[ 'cart_lift_user_email' ] : '';
        }
        $this->save_cart_infos( $user_email, $this->provider );
    }


    /**
     * manipulating item options before
     * adding to cart
     *
     * @param $item
     * @return mixed
     * @since 1.0.0
     */
    public function add_to_cart_item( $item )
    {
        $session_id = EDD()->session->get( 'cl_edd_session_id' );
        if( !$session_id ) {
            $session_id = md5( uniqid( wp_rand(), true ) );
            EDD()->session->set( 'cl_edd_session_id', $session_id );
        }
        if( isset( $item[ 'id' ] ) ) {
            $item[ 'options' ][ 'cl_edd_session_id' ] = $session_id;
        }
        return $item;
    }


    /**
     * EDD pre purchase
     * hook
     *
     * @param $payment_id
     * @since 1.0.0
     */
    public function edd_pre_complete_purchase( $payment_id )
    {
        if( isset( EDD()->session ) ) {
            $session_id = EDD()->session->get( 'cl_edd_session_id' );
            if( isset( $session_id ) && !empty( $session_id ) ) {
                update_post_meta( $payment_id, 'cl_edd_session_id', $session_id );
            }
        }
    }


    /**
     * EDD when purchase is marked
     * completed
     *
     * @param $payment_id
     * @param $payment
     * @param $customer
     * @since 1.0.0
     */
    public function update_cart_status_edd( $payment_id, $payment_object )
    {
        $payment      = $payment_object;
        $payment_meta = $payment->get_meta( '_edd_payment_meta' );
        $downloads    = $payment_meta[ 'downloads' ];
        if( count( $downloads ) ) {
            $session_id = $downloads[ 0 ][ 'options' ][ 'cl_edd_session_id' ];
            if( isset( $session_id ) && !empty( $session_id ) ) {
                $cart_details = $this->get_cart_details( $session_id );
                $this->reinitialize_cart_data( $session_id, $payment_id, $cart_details, $this->provider );
            }
        }
    }


    /**
     * save custom meta for
     * payment
     *
     * @param $instance
     * @param $key
     * @since 1.0.0
     */
    public function action_payment_save( $instance, $key )
    {
        $session_id = EDD()->session->get( 'cl_edd_session_id' );
        update_post_meta( $instance->ID, 'cl_edd_session_id', $session_id );
        if( isset( $_COOKIE[ 'cart_lift_recovered_cart' ] ) ) {
            $is_recovered_cart = $_COOKIE[ 'cart_lift_recovered_cart' ];
            if( $is_recovered_cart == 'true' ) {
                update_post_meta( $instance->ID, 'cl_recovered_cart', 'yes' );
            } else {
                update_post_meta( $instance->ID, 'cl_recovered_cart', 'no' );
            }
        }
    }


    /**
     * show gdpr message after
     * the email form
     *
     * @since 1.0.0
     */
    public function purchase_form_after_email()
    {
        $general_settings = cl_get_general_settings();
        $gdpr_enabled     = 0;
        if( $general_settings[ 'enable_gdpr' ] ) {
            if( isset( $_COOKIE[ 'cart_lift_skip_tracking_data' ] ) ) {
                if( $_COOKIE[ 'cart_lift_skip_tracking_data' ] ) {
                    $gdpr_enabled = 0;
                } else {
                    $gdpr_enabled = 1;
                }
            } else {
                $gdpr_enabled = 1;
            }
        }
        if( $gdpr_enabled ) {
            echo "<span id='cl_gdpr_message'><span>" . $general_settings[ 'gdpr_text' ] . "<a style='cursor: pointer' id='cl_gdpr_no_thanks'>No thanks</a></span></span>";
        }

    }

}