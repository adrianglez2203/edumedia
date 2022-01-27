<?php

/**
 * Class Cart Lift Cron
 */
class Cart_Lift_Cron
{

	/**
	 * email list scheduler
	 *
	 * @internal
	 */
	public function cart_lift_process_scheduled_email_hook()
	{
		global $wpdb;
		$cl_cart_table             = $wpdb->prefix . CART_LIFT_CART_TABLE;
		$cl_email_table            = $wpdb->prefix . CART_LIFT_EMAIL_TEMPLATE_TABLE;
		$cl_campaign_history_table = $wpdb->prefix . CART_LIFT_CAMPAIGN_HISTORY_TABLE;
		$current_time              = current_time( CART_LIFT_DATETIME_FORMAT );

		$general = cl_get_general_settings();
		if ( isset( $general[ 'cart_abandonment_time' ] ) ) {
			$abandoned_time = $general[ 'cart_abandonment_time' ];
		}
		else {
			$abandoned_time = 15;
		}

		/**
		 * send emails to abandoned cart emails
		 * check if there are any scheduled email on the email history table
		 * that are not sent yet. if there are any scheduled email and the
		 * current time exceeds the schedule time then send the emails to that user.
		 * if any email can not be sent due to any error or system fail,
		 * it will try to send it to the next schedule run
		 *
		 */
		$scheduled_email_query = "SELECT h.id, h.campaign_id, h.session_id, h.email_sent, e.email_subject, e.email_body, e.email_meta, c.email, c.status, c.cart_contents, c.cart_total, c.cart_meta, c.provider, c.time, c.id as cart_id from $cl_campaign_history_table as h
            INNER JOIN $cl_email_table as e ON h.campaign_id = e.id
            INNER JOIN $cl_cart_table as c ON h.session_id = c.session_id
            WHERE h.email_sent = 0 AND c.unsubscribed = 0 AND h.schedule_time <= %s AND c.status = %s";

        $schedule_emails = array();

        try {
            $schedule_emails = $wpdb->get_results( $wpdb->prepare( $scheduled_email_query, $current_time, 'abandoned' ) );
            if ( function_exists( 'wc_get_logger' ) ) {
                $log = wc_get_logger();
                $log->info( print_r($schedule_emails, 1), array( 'source' => 'cart-lift-scheduled-email' ) );
            }
        }
        catch ( Exception $e ) {
            if ( function_exists( 'wc_get_logger' ) ) {
                $log = wc_get_logger();
                $log->critical( $e->getMessage(),array( 'source' => 'cart-lift-scheduled-email-error' )  );
            }
        }

		$count          = 0;
		$batch_size     = 20;

        try {
            foreach ( $schedule_emails as $schedule ) {
                $email_data    = cl_get_scheduled_log_data( $schedule );
                $track_purchased_product_status = cl_get_general_settings_data( 'disable_purchased_products_campaign' );

                if ( $track_purchased_product_status ) {
                    $orders = cl_get_orders_by_email( $email_data->email, $email_data->provider, $email_data->time );
                    $is_product_ordered = cl_check_if_product_is_ordered( $orders, $email_data->cart_contents, $email_data->provider );
                }
                else {
                    $is_product_ordered = false;
                }

                if ( $is_product_ordered ) {
                    $unsubscribe = $wpdb->update(
                        $cl_campaign_history_table,
                        array(
                            'email_sent' => -1,
                        ),
                        array(
                            'id' => $schedule->id
                        )
                    );
                    if ( $unsubscribe && function_exists( 'wc_get_logger' ) ) {
                        $log = wc_get_logger();
                        $log->info( 'Already purchased product(s) (Schedule ID: '.$schedule->id.') Status Updated', array( 'source' => 'cart-lift-scheduled-email' ) );
                    }
                    $status = $wpdb->update(
                        $cl_cart_table,
                        array(
                            'status' => 'discard',
                        ),
                        array(
                            'session_id' => $email_data->session_id
                        )
                    );
                    if ( $status && function_exists( 'wc_get_logger' ) ) {
                        $log = wc_get_logger();
                        $log->info( 'Item(s) already purchased ('.$schedule->campaign_id.') Status Updated', array( 'source' => 'cart-lift-scheduled-email' ) );
                    }
                    $is_email_sent = false;
                }
                else {
                    $is_email_sent = cl_send_email_templates( $email_data );

                    if ( $is_email_sent ) {
                        $email_sent = $wpdb->update(
                            $cl_campaign_history_table,
                            array(
                                'email_sent' => 1,
                            ),
                            array(
                                'id' => $schedule->id
                            )
                        );
                        if ( $email_sent && function_exists( 'wc_get_logger' ) ) {
                            $log = wc_get_logger();
                            $log->info( 'Email Sent (Schedule ID: '.$schedule->id.') Status Updated', array( 'source' => 'cart-lift-scheduled-email' ) );
                        }
                        $last_sent_email = $wpdb->update(
                            $cl_cart_table,
                            array(
                                'last_sent_email' => $schedule->campaign_id,
                            ),
                            array(
                                'session_id' => $email_data->session_id
                            )
                        );
                        if ( $last_sent_email && function_exists( 'wc_get_logger' ) ) {
                            $log = wc_get_logger();
                            $log->info( 'Last Email Sent ('.$schedule->campaign_id.') Status Updated', array( 'source' => 'cart-lift-scheduled-email' ) );
                        }
                    }
                    $count++;
                }
            }
        }
        catch ( Exception $e ) {
            if ( function_exists( 'wc_get_logger' ) ) {
                $log = wc_get_logger();
                $log->critical( $e->getMessage(),array( 'source' => 'cart-lift-scheduled-email-error' )  );
            }
        }

		do_action( 'cl_after_email_sent' );


		/**
		 * update cart status & schedule email list for that cart
		 * update the cart status if the current time is greater than the cut-off time
		 * default cut-off time is 15 minutes. and then schedule the upcoming email list
		 * for that user
		 *
		 */
		$cart_session_ids = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT * from $cl_cart_table WHERE status = 'processing' and ADDDATE(`time`, INTERVAL %d MINUTE)<=%s",
				$abandoned_time,
				$current_time
			)
		);

		$all_active_templates = $wpdb->get_results( "SELECT * FROM $cl_email_table WHERE active=1" );
		foreach ( $cart_session_ids as $item ) {
			if ( isset( $item->session_id ) ) {

				$notify_abandon_cart = $general[ 'notify_abandon_cart' ];
				if ( $notify_abandon_cart ) {
					if ( $item->provider === 'wc' ) {
						$mailer = WC()->mailer();
						do_action( 'cl_trigger_abandon_cart_email', $item );
					}
					if ( $item->provider === 'edd' ) {
						do_action( 'cl_trigger_abandon_cart_email_edd', $item );
					}
				}

				$webhook = cl_get_general_settings_data( 'enable_webhook' );
				if ( $webhook ) {
					$webhook_data = array(
						'email'         => $item->email,
						'status'        => 'abandoned',
						'cart_totall'   => $item->cart_total,
						'provider'      => $item->provider,
						'product_table' => cl_get_email_product_table( $item->cart_contents, $item->cart_total, $item->provider, false, false ),
					);
					cl_trigger_webhook( $webhook_data );
				}


				$wpdb->update(
					$cl_cart_table,
					array(
						'status' => 'abandoned',
					),
					array(
						'session_id' => $item->session_id
					)
				);

				// remove guest carts
				$remove_guest_carts = $general[ 'remove_carts_for_guest' ];
				if ( $remove_guest_carts ) {
					if ( !$item->email ) {
						$wpdb->delete(
							$cl_cart_table,
							array(
								'session_id' => $item->session_id
							)
						);
					}
				}


				/**
				 * schedule email list for
				 * abandoned carts
				 *
				 */
				foreach ( $all_active_templates as $template ) {
					$schedule_campaigns = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM  $cl_email_table as e INNER JOIN $cl_campaign_history_table as h ON e.id = h.campaign_id WHERE h.session_id = %s", sanitize_text_field( $item->session_id ) ) );
					$schedule_column    = array_column( $schedule_campaigns, 'campaign_id' );
					if ( !in_array( $template->id, $schedule_column ) ) {
						$schedule_time = '+' . $template->frequency . ' ' . ucfirst( $template->unit ) . 'S';
						$schedule_time = gmdate( CART_LIFT_DATETIME_FORMAT, strtotime( $current_time . $schedule_time ) );

						if ( $item->email ) {
							$wpdb->replace(
								$cl_campaign_history_table,
								array(
									'campaign_id'   => $template->id,
									'session_id'    => $item->session_id,
									'schedule_time' => $schedule_time,
								)
							);
						}

					}
				}
			}
		}
	}


	/**
	 * Delete data after x days
	 *
	 */
	public function cart_lift_x_days_cart_remove()
	{
		$general              = get_option( 'cl_general_settings' );
		$cart_expiration_time = '';
		if ( isset( $general[ 'cart_expiration_time' ] ) ) {
			$cart_expiration_time = $general[ 'cart_expiration_time' ];
			global $wpdb;
			$cl_cart_table = $wpdb->prefix . CART_LIFT_CART_TABLE;

			$current_time     = current_time( 'mysql', false );
			$get_settings_day = (int) $cart_expiration_time;
			$day_in_seconds   = $get_settings_day * 86400;
			$results          = $wpdb->get_results( 'SELECT * FROM ' . $cl_cart_table . ' WHERE status in ("recovered", "completed")' );

			foreach ( $results as $data_value ) {
				$saved_time = $data_value->time;
				$X_time     = date( 'Y-m-d H:i:s', strtotime( $saved_time ) + $day_in_seconds );
				if ( $X_time <= $current_time ) {
					$wpdb->delete( $cl_cart_table, array( 'id' => $data_value->id ) );
				}
			}
		}
	}


}
