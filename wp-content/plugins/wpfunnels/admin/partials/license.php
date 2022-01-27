<?php
if(is_multisite()) {
	$license 		= get_option( 'wpfunnels_pro_license_key' );
	$status  		= get_option( 'wpfunnels_pro_license_status' );
	$status_data  	= get_option( 'wpfunnels_pro_licence_data' );
} else {
	$license 		= get_option( 'wpfunnels_pro_license_key' );
	$status  		= get_option( 'wpfunnels_pro_license_status' );
	$status_data  	= get_option( 'wpfunnels_pro_licence_data' );
}


?>
<div class="wpfnl">
    <form name="wpfnl-license" id="wpfnl-license" action="options.php" method="post">
        <div class="wpfnl-license-wrapper">
            <div class="wpfnl-license-filed">
                <div class="field-area">
                    <div class="promo-text-area">
                        <div class="single-area">
                            <span class="icon">
                                <svg width="14px" height="18px" viewBox="0 0 14 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                        <g id="Report--Copy" transform="translate(-1012.000000, -30.000000)" stroke="#6e41d3" stroke-width="1.5">
                                            <g id="Group-6" transform="translate(279.000000, 31.000000)">
                                                <g id="1-copy-6" transform="translate(535.000000, 0.000000)">
                                                    <g id="Group-9" transform="translate(199.000000, 0.000000)">
                                                        <polyline id="Stroke-1" points="9 6 12 3 9 0"></polyline>
                                                        <path d="M0,9 L0,5.4725824 C0,4.10699022 1.04467307,3 2.3333903,3 L12,3" id="Stroke-3"></path>
                                                        <polyline id="Stroke-5" points="3 10 0 13.0002224 3 16"></polyline>
                                                        <path d="M12,7 L12,10.5274176 C12,11.8930098 10.9553269,13 9.66701986,13 L0,13" id="Stroke-7"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </span>
                            <h4><?php echo __('Stay Updated', 'wpfnl'); ?></h4>
                            <p><?php echo __('Update the plugin right from your WordPress Dashboard.', 'wpfnl'); ?></p>
                        </div>
                        <div class="single-area">
                            <span class="icon">
                                <svg width="18px" height="17px" viewBox="0 0 18 17" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                        <g id="Report--Copy" transform="translate(-972.000000, -31.000000)" stroke="#6e41d3" stroke-width="1.5">
                                            <g id="Group-6" transform="translate(279.000000, 31.000000)">
                                                <g id="1-copy-6" transform="translate(535.000000, 0.000000)">
                                                    <polygon id="Stroke-1" points="167 13.1256696 171.635405 15.688 170.75 10.2610156 174.5 6.41730801 169.317703 5.62566961 167 0.688 164.682297 5.62566961 159.5 6.41730801 163.25 10.2610156 162.364595 15.688"></polygon>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </span>
                            <h4><?php echo __('Premium Support', 'wpfnl'); ?></h4>
                            <p><?php echo __('Supported by professional and courteous staff.', 'wpfnl'); ?></p>
                        </div>
                    </div>
                    <!-- /promo-text-area -->

                    <div class="input-field-area">
                        <div class="input-field">
                            <?php if( $status !== false && $status == 'active' ) { ?>
                                <input id="wpfunnels_license_key" type="text" placeholder="Enter your license code" value="<?php echo __( '********************','wpfnl' ); ?>"/>
                                <input id="wpfunnels_license_key" name="wpfunnels_license_key" type="hidden" placeholder="Enter your license code" value="<?php esc_attr_e( $license ); ?>"/>
                            <?php } else { ?>
                                <input id="wpfunnels_license_key" name="wpfunnels_license_key" type="text" placeholder="Enter your license code" value="<?php esc_attr_e( $license ); ?>"/>
                            <?php } ?>
                        </div>

                        <div class="btn-area">
                            <?php if( $status !== false && $status == 'active' ) { ?>
                                <?php wp_nonce_field( 'wpfunnels_pro_licensing_nonce', 'wpfunnels_pro_licensing_nonce' ); ?>
                                <input type="submit" class="btn-default" name="wpfunnels_pro_license_deactivate" value="<?php _e('Deactivate License', 'wpfnl'); ?>" required/>
                            <?php } else {
                                wp_nonce_field( 'wpfunnels_pro_licensing_nonce', 'wpfunnels_pro_licensing_nonce' ); ?>
                                <input type="submit" class="btn-default" name="wpfunnels_pro_license_activate" value="<?php _e('Activate License', 'wpfnl'); ?>"/>
                            <?php } ?>
                        </div>
						<div class="license-status">
							<span>
								<?php
									if( 'active' === $status ) {
										$start_date = isset($status_data['start_date']) ? $status_data['start_date'] : '';
										$end_date 	= isset($status_data['end_date']) ? $status_data['end_date'] : '';
										if ( $end_date ) {
											echo sprintf( '%s %s', __('Your license key will be expired on ', 'wpfnl'), $end_date );
										}
									}
								?>
							</span>
						</div>
                    </div>
                </div>

                <div class="logo-area">
                    <div class="wpfnl-logo">
                    <svg width="38" height="28" viewBox="0 0 38 28" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.01532 18H31.9847L34 11H5L7.01532 18Z" fill="#EE8134"></path> <path d="M11.9621 27.2975C12.0923 27.7154 12.4792 28 12.9169 28H26.0831C26.5208 28 26.9077 27.7154 27.0379 27.2975L29 21H10L11.9621 27.2975Z" fill="#6E42D3"></path> <path d="M37.8161 0.65986C37.61 0.247888 37.2609 0 36.8867 0H1.11326C0.739128 0 0.390003 0.247888 0.183972 0.65986C-0.0220592 1.07193 -0.0573873 1.59277 0.0898627 2.04655L1.69781 7H36.3022L37.9102 2.04655C38.0574 1.59287 38.022 1.07193 37.8161 0.65986Z" fill="#6E42D3"></path></svg>
                    </div>
                    <a href="https://useraccount.getwpfunnels.com/orders/" target="_blank" class="btn-default manage-license"><?php echo __('manage license', 'wpfnl'); ?></a>
                </div>
            </div>
        </div>
    </form>

    <div class="cl-doc-row">
        <div class="single-col">
            <span class="icon">
                <svg width="15px" height="18px" viewBox="0 0 15 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                        <g id="Report--Copy" transform="translate(-1012.000000, -30.000000)" stroke="#6E41D3" stroke-width="1.5">
                            <g id="Group-6" transform="translate(279.000000, 31.000000)">
                                <g id="1-copy-6" transform="translate(535.000000, 0.000000)">
                                    <g id="Group-11" transform="translate(199.000000, 0.000000)">
                                        <polygon id="Stroke-1" points="8.10769503 0 13 4.54311111 13 16 0 16 0 0"></polygon>
                                        <polyline id="Stroke-3" points="8 0 8 5 13 5"></polyline>
                                        <path d="M2,12 L10,12" id="Stroke-5"></path>
                                        <path d="M2,8 L10,8" id="Stroke-7"></path>
                                        <path d="M3,4 L5,4" id="Stroke-9"></path>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
            </span>
            <h4 class="title"><?php echo __('Documentation', 'wpfnl'); ?></h4>
            <p><?php echo __('Get detailed guide and documentation on WP Funnels and create highly converting sales funnels easily.', 'wpfnl'); ?></p>
            <a href="https://getwpfunnels.com/docs/" class="btn-default" target="_blank"><?php echo __('Documentation', 'wpfnl'); ?></a>
        </div>

        <div class="single-col">
            <span class="icon">
                <svg width="20px" height="18px" viewBox="0 0 20 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                        <g id="Report--Copy" transform="translate(-979.000000, -30.000000)" stroke="#6E41D3" stroke-width="1.5">
                            <g id="Group-6" transform="translate(279.000000, 30.000000)">
                                <g id="1-copy-6" transform="translate(535.000000, 0.000000)">
                                    <g id="Group-9" transform="translate(166.000000, 0.500000)">
                                        <path d="M3.768,0.5 L2,0.5 C0.8955,0.5 0,1.43683798 0,2.59232379 L0,11.2330979 C0,12.3885838 0.8955,13.3254217 2,13.3254217 L5.1365,13.3254217 C5.667,13.3254217 6.1755,13.5456388 6.5505,13.9379495 L9,16.5 L11.4485,13.9379495 C11.8235,13.5456388 12.3325,13.3254217 12.8625,13.3254217 L16,13.3254217 C17.1045,13.3254217 18,12.3885838 18,11.2330979 L18,2.59232379 C18,1.43683798 17.1045,0.5 16,0.5 L6.2095,0.5" id="Stroke-1"></path>
                                        <g id="Group-4" transform="translate(5.000000, 7.000000)">
                                            <path d="M8.9355,0.5 C8.9355,0.75 8.7405,0.954 8.4995,0.954 C8.2595,0.954 8.0645,0.75 8.0645,0.5 C8.0645,0.25 8.2595,0.046 8.4995,0.046 C8.7405,0.046 8.9355,0.25 8.9355,0.5 Z" id="Stroke-3"></path>
                                            <path d="M0.935,0.5 C0.935,0.75 0.741,0.954 0.5,0.954 C0.259,0.954 0.065,0.75 0.065,0.5 C0.065,0.25 0.259,0.046 0.5,0.046 C0.741,0.046 0.935,0.25 0.935,0.5 Z" id="Stroke-5"></path>
                                            <path d="M4.935,0.5 C4.935,0.75 4.741,0.954 4.5,0.954 C4.26,0.954 4.065,0.75 4.065,0.5 C4.065,0.25 4.26,0.046 4.5,0.046 C4.741,0.046 4.935,0.25 4.935,0.5 Z" id="Stroke-7"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
            </span>
            <h4 class="title"><?php echo __('Support', 'wpfnl'); ?></h4>
            <p><?php echo __('Can’t find solution with our documentation? Just post a ticket. Our professional team is here to solve your problems.', 'wpfnl'); ?></p>
            <a href="https://wordpress.org/support/plugin/wpfunnels/" target="_blank" class="btn-default"><?php echo __('Post A Ticket', 'wpfnl'); ?></a>
        </div>

        <div class="single-col">
            <span class="icon">
                <svg width="20px" height="19px" viewBox="0 0 20 19" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                        <g id="Report--Copy" transform="translate(-1041.000000, -29.000000)" stroke="#6E41D3" stroke-width="1.5">
                            <g id="Group-6" transform="translate(279.000000, 30.000000)">
                                <g id="1-copy-6" transform="translate(535.000000, 0.000000)">
                                    <path d="M236.985196,3.42441231 C234.47921,-1.16158153 228.754244,0.0378401827 228.072248,4.2433029 C227.328252,8.83239469 232.480722,13.7426403 236.985196,16.4941333 C241.489669,13.7426403 246.804638,8.85356399 245.898143,4.2433029 C245.077148,0.0646890545 239.491181,-1.16158153 236.985196,3.42441231" id="Stroke-1"></path>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
            </span>
            <h4 class="title"><?php echo __('Show Your Love', 'wpfnl'); ?></h4>
            <p><?php echo __('We love to have you in WPFunnels family. Take your 2 minutes to review  and speed the love to encourage us to keep it going.', 'wpfnl'); ?></p>
            <a href="https://wordpress.org/plugins/wpfunnels/#reviews" class="btn-default"  target="_blank"><?php echo __('Leave a Review', 'wpfnl'); ?></a>
        </div>
    </div>
</div>
