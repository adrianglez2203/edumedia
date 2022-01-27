<?php

    //===General Data===//
    $general_data = $settings['general_settings'];

    $cart_tracking_status = 'no';
    $cart_tracking = $general_data['cart_tracking'];
    if($cart_tracking) {
        $cart_tracking_status = 'yes';
    }

    $remove_carts_for_guest_status = 'yes';
    $remove_carts_for_guest ='';
    if ( isset( $general_data['remove_carts_for_guest'] ) ){ 
        $remove_carts_for_guest = $general_data['remove_carts_for_guest'];
    }
    if($remove_carts_for_guest) {
        $remove_carts_for_guest_status = 'yes';
    }

    $disable_purchased_products_campaign_status = 'no';
    $disable_purchased_products_campaign ='';
    if ( isset( $general_data['disable_purchased_products_campaign'] ) ){
        $disable_purchased_products_campaign = $general_data['disable_purchased_products_campaign'];
    }
    if($disable_purchased_products_campaign) {
        $disable_purchased_products_campaign_status = 'yes';
    }

    $notify_abandon_cart_status = 'no';
    $notify_abandon_cart = $general_data['notify_abandon_cart'];
    if($notify_abandon_cart) {
        $notify_abandon_cart_status = 'yes';
    }

    $notify_recovered_cart_status = 'no';
    $notify_recovered_cart = $general_data['notify_recovered_cart'];
    if($notify_recovered_cart) {
        $notify_recovered_cart_status = 'yes';
    }

    $enable_smtp_status = 'no';
    $enable_smtp = $general_data['enable_smtp'];
    if($enable_smtp) {
        $enable_smtp_status = 'yes';
    }

    $enable_webhook_status = 'no';
    $enable_webhook = $general_data['enable_webhook'];
    if($enable_webhook) {
        $enable_webhook_status = 'yes';
    }

    $enable_gdpr_status = 'no';
    $enable_gdpr = '';
    if( isset( $general_data['enable_gdpr'] ) ){
        $enable_gdpr = $general_data['enable_gdpr'];
    }
    
    if($enable_gdpr) {
        $enable_gdpr_status = 'yes';
    }

    $disable_branding_status = '';
    $disable_branding = $general_data['disable_branding'];
    if($disable_branding) {
        $disable_branding_status = 'checked';
    }

?>


<h4 class="settings-tab-heading"><?php echo __( 'General', 'cart-lift' ); ?></h4>
<form action="" id="general-settings-form">
    <div class="inner-wrapper">
        <div class="cl-form-group">
            <span class="title"><?php echo __( 'Enable abandoned cart tracking:', 'cart-lift' ); ?></span>
            <span class="cl-switcher">
                <input class="cl-toggle-option" type="checkbox" id="cart_tracking" name="cart_tracking" data-status="<?php echo $cart_tracking_status; ?>" value="<?php echo $cart_tracking; ?>" <?php checked( '1', $cart_tracking ); ?>/>
                <label for="cart_tracking"></label>
            </span>
            <div class="tooltip">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 19" width="18" height="19">
                        <defs>
                            <clipPath clipPathUnits="userSpaceOnUse" id="cp1">
                                <path d="M-941 -385L379 -385L379 866L-941 866Z" />
                            </clipPath>
                        </defs>
                        <style>
                            tspan { white-space:pre }
                            .shp0 { fill: #6e42d3 }
                        </style>
                        <g id="Final Create New Abandoned Cart Campaign " clip-path="url(#cp1)">
                            <g id="name">
                                <g id="question">
                                    <path id="Shape" fill-rule="evenodd" class="shp0" d="M18 10C18 14.97 13.97 19 9 19C4.03 19 0 14.97 0 10C0 5.03 4.03 1 9 1C13.97 1 18 5.03 18 10ZM16.8 10C16.8 5.7 13.3 2.2 9 2.2C4.7 2.2 1.2 5.7 1.2 10C1.2 14.3 4.7 17.8 9 17.8C13.3 17.8 16.8 14.3 16.8 10Z" />
                                    <path id="Path" class="shp0" d="M8.71 11.69C8.25 11.69 7.87 12.07 7.87 12.53C7.87 12.98 8.24 13.37 8.71 13.37C9.19 13.37 9.56 12.98 9.56 12.53C9.56 12.07 9.18 11.69 8.71 11.69Z" />
                                    <path id="Path" class="shp0" d="M8.64 6.06C7.35 6.06 6.75 6.85 6.75 7.38C6.75 7.77 7.07 7.94 7.33 7.94C7.84 7.94 7.63 7.19 8.61 7.19C9.09 7.19 9.48 7.4 9.48 7.86C9.48 8.39 8.94 8.69 8.62 8.97C8.34 9.21 7.98 9.62 7.98 10.47C7.98 10.98 8.11 11.12 8.51 11.12C8.98 11.12 9.07 10.91 9.07 10.72C9.07 10.21 9.08 9.91 9.61 9.49C9.87 9.28 10.69 8.61 10.69 7.69C10.69 6.76 9.87 6.06 8.64 6.06Z" />
                                </g>
                            </g>
                        </g>
                    </svg>
                </span>
                <p><?php echo __( 'Allow Cart Lift to track abandoned carts.', 'cart-lift' ); ?></p>
            </div>
        </div>

        <div class="cl-form-group">
            <span class="title"><?php echo __( 'Remove non-actionable carts:', 'cart-lift' ); ?></span>
            <span class="cl-switcher">
                <input class="cl-toggle-option" type="checkbox" id="remove_carts_for_guest" name="remove_carts_for_guest" data-status="<?php echo $remove_carts_for_guest_status; ?>" value="<?php echo $remove_carts_for_guest; ?>" <?php checked( '1', $remove_carts_for_guest ); ?>/>
                <label for="remove_carts_for_guest"></label>
            </span>
            <div class="tooltip">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 19" width="18" height="19">
                        <defs>
                            <clipPath clipPathUnits="userSpaceOnUse" id="cp1">
                                <path d="M-941 -385L379 -385L379 866L-941 866Z" />
                            </clipPath>
                        </defs>
                        <style>
                            tspan { white-space:pre }
                            .shp0 { fill: #6e42d3 }
                        </style>
                        <g id="Final Create New Abandoned Cart Campaign " clip-path="url(#cp1)">
                            <g id="name">
                                <g id="question">
                                    <path id="Shape" fill-rule="evenodd" class="shp0" d="M18 10C18 14.97 13.97 19 9 19C4.03 19 0 14.97 0 10C0 5.03 4.03 1 9 1C13.97 1 18 5.03 18 10ZM16.8 10C16.8 5.7 13.3 2.2 9 2.2C4.7 2.2 1.2 5.7 1.2 10C1.2 14.3 4.7 17.8 9 17.8C13.3 17.8 16.8 14.3 16.8 10Z" />
                                    <path id="Path" class="shp0" d="M8.71 11.69C8.25 11.69 7.87 12.07 7.87 12.53C7.87 12.98 8.24 13.37 8.71 13.37C9.19 13.37 9.56 12.98 9.56 12.53C9.56 12.07 9.18 11.69 8.71 11.69Z" />
                                    <path id="Path" class="shp0" d="M8.64 6.06C7.35 6.06 6.75 6.85 6.75 7.38C6.75 7.77 7.07 7.94 7.33 7.94C7.84 7.94 7.63 7.19 8.61 7.19C9.09 7.19 9.48 7.4 9.48 7.86C9.48 8.39 8.94 8.69 8.62 8.97C8.34 9.21 7.98 9.62 7.98 10.47C7.98 10.98 8.11 11.12 8.51 11.12C8.98 11.12 9.07 10.91 9.07 10.72C9.07 10.21 9.08 9.91 9.61 9.49C9.87 9.28 10.69 8.61 10.69 7.69C10.69 6.76 9.87 6.06 8.64 6.06Z" />
                                </g>
                            </g>
                        </g>
                    </svg>
                </span>
                <p><?php echo __( 'Remove abandoned cart information if no email is captured.', 'cart-lift' ); ?></p>
            </div>
        </div>

        <div class="cl-form-group">
            <span class="title"><?php echo __( 'Disable campaign emails for purchased products:', 'cart-lift' ); ?></span>
            <span class="cl-switcher">
                <input class="cl-toggle-option" type="checkbox" id="disable_purchased_products_campaign" name="disable_purchased_products_campaign" data-status="<?php echo $disable_purchased_products_campaign_status; ?>" value="<?php echo $disable_purchased_products_campaign; ?>" <?php checked( '1', $disable_purchased_products_campaign ); ?>/>
                <label for="disable_purchased_products_campaign"></label>
            </span>
            <div class="tooltip">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 19" width="18" height="19">
                        <defs>
                            <clipPath clipPathUnits="userSpaceOnUse" id="cp1">
                                <path d="M-941 -385L379 -385L379 866L-941 866Z" />
                            </clipPath>
                        </defs>
                        <style>
                            tspan { white-space:pre }
                            .shp0 { fill: #6e42d3 }
                        </style>
                        <g id="Final Create New Abandoned Cart Campaign " clip-path="url(#cp1)">
                            <g id="name">
                                <g id="question">
                                    <path id="Shape" fill-rule="evenodd" class="shp0" d="M18 10C18 14.97 13.97 19 9 19C4.03 19 0 14.97 0 10C0 5.03 4.03 1 9 1C13.97 1 18 5.03 18 10ZM16.8 10C16.8 5.7 13.3 2.2 9 2.2C4.7 2.2 1.2 5.7 1.2 10C1.2 14.3 4.7 17.8 9 17.8C13.3 17.8 16.8 14.3 16.8 10Z" />
                                    <path id="Path" class="shp0" d="M8.71 11.69C8.25 11.69 7.87 12.07 7.87 12.53C7.87 12.98 8.24 13.37 8.71 13.37C9.19 13.37 9.56 12.98 9.56 12.53C9.56 12.07 9.18 11.69 8.71 11.69Z" />
                                    <path id="Path" class="shp0" d="M8.64 6.06C7.35 6.06 6.75 6.85 6.75 7.38C6.75 7.77 7.07 7.94 7.33 7.94C7.84 7.94 7.63 7.19 8.61 7.19C9.09 7.19 9.48 7.4 9.48 7.86C9.48 8.39 8.94 8.69 8.62 8.97C8.34 9.21 7.98 9.62 7.98 10.47C7.98 10.98 8.11 11.12 8.51 11.12C8.98 11.12 9.07 10.91 9.07 10.72C9.07 10.21 9.08 9.91 9.61 9.49C9.87 9.28 10.69 8.61 10.69 7.69C10.69 6.76 9.87 6.06 8.64 6.06Z" />
                                </g>
                            </g>
                        </g>
                    </svg>
                </span>
                <p><?php echo __( 'Disable campaign emails if the abandoned product is already purchased by the user.', 'cart-lift' ); ?></p>
            </div>
        </div>

        <div class="cl-form-group">
            <span class="title"><?php echo __( 'Notify admin for abandoned cart:', 'cart-lift' ); ?></span>
            <span class="cl-switcher">
                <input class="cl-toggle-option" type="checkbox" id="notify_abandon_cart" name="notify_abandon_cart" data-status="<?php echo $notify_abandon_cart_status; ?>" value="<?php echo $notify_abandon_cart; ?>" <?php checked( '1', $notify_abandon_cart ); ?> />
                <label for="notify_abandon_cart"></label>
            </span>
            <div class="tooltip">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 19" width="18" height="19">
                        <defs>
                            <clipPath clipPathUnits="userSpaceOnUse" id="cp1">
                                <path d="M-941 -385L379 -385L379 866L-941 866Z" />
                            </clipPath>
                        </defs>
                        <style>
                            tspan { white-space:pre }
                            .shp0 { fill: #6e42d3 }
                        </style>
                        <g id="Final Create New Abandoned Cart Campaign " clip-path="url(#cp1)">
                            <g id="name">
                                <g id="question">
                                    <path id="Shape" fill-rule="evenodd" class="shp0" d="M18 10C18 14.97 13.97 19 9 19C4.03 19 0 14.97 0 10C0 5.03 4.03 1 9 1C13.97 1 18 5.03 18 10ZM16.8 10C16.8 5.7 13.3 2.2 9 2.2C4.7 2.2 1.2 5.7 1.2 10C1.2 14.3 4.7 17.8 9 17.8C13.3 17.8 16.8 14.3 16.8 10Z" />
                                    <path id="Path" class="shp0" d="M8.71 11.69C8.25 11.69 7.87 12.07 7.87 12.53C7.87 12.98 8.24 13.37 8.71 13.37C9.19 13.37 9.56 12.98 9.56 12.53C9.56 12.07 9.18 11.69 8.71 11.69Z" />
                                    <path id="Path" class="shp0" d="M8.64 6.06C7.35 6.06 6.75 6.85 6.75 7.38C6.75 7.77 7.07 7.94 7.33 7.94C7.84 7.94 7.63 7.19 8.61 7.19C9.09 7.19 9.48 7.4 9.48 7.86C9.48 8.39 8.94 8.69 8.62 8.97C8.34 9.21 7.98 9.62 7.98 10.47C7.98 10.98 8.11 11.12 8.51 11.12C8.98 11.12 9.07 10.91 9.07 10.72C9.07 10.21 9.08 9.91 9.61 9.49C9.87 9.28 10.69 8.61 10.69 7.69C10.69 6.76 9.87 6.06 8.64 6.06Z" />
                                </g>
                            </g>
                        </g>
                    </svg>
                </span>
                <p><?php echo __( 'Admin will get an email notification when cart is abandoned.', 'cart-lift' ); ?></p>
            </div>
        </div>

        <div class="cl-form-group <?php if ($cl_pro_tag) echo 'cl-pro'?>">
            <span class="title"><?php echo __( 'Notify admin for recovered cart:', 'cart-lift' ); ?></span>
            <span class="cl-switcher">
                <?php
                    $pro_url = add_query_arg( 'cl-dashboard', '1', 'https://rextheme.com/cart-lift' );
                ?>
                <?php
                    if ($cl_pro_tag) {
                    $notify_recovered_cart = 0;
                ?>
                    <a href="<?php echo $pro_url; ?>" target="_blank" title="<?php _e( 'Click to Upgrade Pro', 'cart-lift' ); ?>" class="pro-tag"><?php echo __( 'pro', 'cart-lift' ); ?></a>
                <?php } ?>
                <input class="cl-toggle-option" type="checkbox" id="notify_recovered_cart" name="notify_recovered_cart" data-status="<?php echo $notify_recovered_cart_status; ?>" value="<?php echo $notify_recovered_cart; ?>" <?php checked( '1', $notify_recovered_cart ); ?> <?php if ($cl_pro_tag) echo 'disabled'?>/>
                <label for="notify_recovered_cart"></label>
            </span>
            <div class="tooltip">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 19" width="18" height="19">
                        <defs>
                            <clipPath clipPathUnits="userSpaceOnUse" id="cp1">
                                <path d="M-941 -385L379 -385L379 866L-941 866Z" />
                            </clipPath>
                        </defs>
                        <style>
                            tspan { white-space:pre }
                            .shp0 { fill: #6e42d3 }
                        </style>
                        <g id="Final Create New Abandoned Cart Campaign " clip-path="url(#cp1)">
                            <g id="name">
                                <g id="question">
                                    <path id="Shape" fill-rule="evenodd" class="shp0" d="M18 10C18 14.97 13.97 19 9 19C4.03 19 0 14.97 0 10C0 5.03 4.03 1 9 1C13.97 1 18 5.03 18 10ZM16.8 10C16.8 5.7 13.3 2.2 9 2.2C4.7 2.2 1.2 5.7 1.2 10C1.2 14.3 4.7 17.8 9 17.8C13.3 17.8 16.8 14.3 16.8 10Z" />
                                    <path id="Path" class="shp0" d="M8.71 11.69C8.25 11.69 7.87 12.07 7.87 12.53C7.87 12.98 8.24 13.37 8.71 13.37C9.19 13.37 9.56 12.98 9.56 12.53C9.56 12.07 9.18 11.69 8.71 11.69Z" />
                                    <path id="Path" class="shp0" d="M8.64 6.06C7.35 6.06 6.75 6.85 6.75 7.38C6.75 7.77 7.07 7.94 7.33 7.94C7.84 7.94 7.63 7.19 8.61 7.19C9.09 7.19 9.48 7.4 9.48 7.86C9.48 8.39 8.94 8.69 8.62 8.97C8.34 9.21 7.98 9.62 7.98 10.47C7.98 10.98 8.11 11.12 8.51 11.12C8.98 11.12 9.07 10.91 9.07 10.72C9.07 10.21 9.08 9.91 9.61 9.49C9.87 9.28 10.69 8.61 10.69 7.69C10.69 6.76 9.87 6.06 8.64 6.06Z" />
                                </g>
                            </g>
                        </g>
                    </svg>
                </span>
                <p><?php echo __( 'Admin will get an email notification when cart is recovered.', 'cart-lift' ); ?></p>
            </div>
        </div>

        <div class="cl-form-group <?php if ($cl_pro_tag) echo 'cl-pro'?>">
            <span class="title"><?php echo __( 'Disable branding:', 'cart-lift' ); ?></span>
            <span class="cl-switcher">
                <?php
                    $pro_url = add_query_arg( 'cl-dashboard', '1', 'https://rextheme.com/cart-lift' );
                ?>
                <?php
                    if ($cl_pro_tag) {
                    $disable_branding_status = '';
                ?>
                    <a href="<?php echo $pro_url; ?>" target="_blank" title="<?php _e( 'Click to Upgrade Pro', 'cart-lift' ); ?>" class="pro-tag"><?php echo __( 'pro', 'cart-lift' ); ?></a>
                <?php } ?>
                <input class="cl-toggle-option" type="checkbox" id="disable_branding" name="disable_branding" data-status="" value="" <?php if ($cl_pro_tag) echo 'disabled'?> <?php echo $disable_branding_status; ?> />
                <label for="disable_branding"></label>
            </span>
            <div class="tooltip">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 19" width="18" height="19">
                        <defs>
                            <clipPath clipPathUnits="userSpaceOnUse" id="cp1">
                                <path d="M-941 -385L379 -385L379 866L-941 866Z" />
                            </clipPath>
                        </defs>
                        <style>
                            tspan { white-space:pre }
                            .shp0 { fill: #6e42d3 }
                        </style>
                        <g id="Final Create New Abandoned Cart Campaign " clip-path="url(#cp1)">
                            <g id="name">
                                <g id="question">
                                    <path id="Shape" fill-rule="evenodd" class="shp0" d="M18 10C18 14.97 13.97 19 9 19C4.03 19 0 14.97 0 10C0 5.03 4.03 1 9 1C13.97 1 18 5.03 18 10ZM16.8 10C16.8 5.7 13.3 2.2 9 2.2C4.7 2.2 1.2 5.7 1.2 10C1.2 14.3 4.7 17.8 9 17.8C13.3 17.8 16.8 14.3 16.8 10Z" />
                                    <path id="Path" class="shp0" d="M8.71 11.69C8.25 11.69 7.87 12.07 7.87 12.53C7.87 12.98 8.24 13.37 8.71 13.37C9.19 13.37 9.56 12.98 9.56 12.53C9.56 12.07 9.18 11.69 8.71 11.69Z" />
                                    <path id="Path" class="shp0" d="M8.64 6.06C7.35 6.06 6.75 6.85 6.75 7.38C6.75 7.77 7.07 7.94 7.33 7.94C7.84 7.94 7.63 7.19 8.61 7.19C9.09 7.19 9.48 7.4 9.48 7.86C9.48 8.39 8.94 8.69 8.62 8.97C8.34 9.21 7.98 9.62 7.98 10.47C7.98 10.98 8.11 11.12 8.51 11.12C8.98 11.12 9.07 10.91 9.07 10.72C9.07 10.21 9.08 9.91 9.61 9.49C9.87 9.28 10.69 8.61 10.69 7.69C10.69 6.76 9.87 6.06 8.64 6.06Z" />
                                </g>
                            </g>
                        </g>
                    </svg>
                </span>
                <p><?php echo __( 'Remove Cart Lift branding from footer.', 'cart-lift' ); ?></p>
            </div>
        </div>

        <div class="cl-form-group">
            <span class="title"><?php echo __( 'Enable external webhook:', 'cart-lift' ); ?></span>
            <span class="cl-switcher">
                <input class="cl-toggle-option" type="checkbox" id="enable_cl_webhook" name="enable_webhook" data-status="<?php echo $enable_webhook_status; ?>" value="<?php echo $enable_webhook; ?>" <?php checked( '1', $enable_webhook ); ?> />
                <label for="enable_cl_webhook"></label>
            </span>
            <div class="tooltip">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 19" width="18" height="19">
                        <defs>
                            <clipPath clipPathUnits="userSpaceOnUse" id="cp1">
                                <path d="M-941 -385L379 -385L379 866L-941 866Z" />
                            </clipPath>
                        </defs>
                        <style>
                            tspan { white-space:pre }
                            .shp0 { fill: #6e42d3 }
                        </style>
                        <g id="Final Create New Abandoned Cart Campaign " clip-path="url(#cp1)">
                            <g id="name">
                                <g id="question">
                                    <path id="Shape" fill-rule="evenodd" class="shp0" d="M18 10C18 14.97 13.97 19 9 19C4.03 19 0 14.97 0 10C0 5.03 4.03 1 9 1C13.97 1 18 5.03 18 10ZM16.8 10C16.8 5.7 13.3 2.2 9 2.2C4.7 2.2 1.2 5.7 1.2 10C1.2 14.3 4.7 17.8 9 17.8C13.3 17.8 16.8 14.3 16.8 10Z" />
                                    <path id="Path" class="shp0" d="M8.71 11.69C8.25 11.69 7.87 12.07 7.87 12.53C7.87 12.98 8.24 13.37 8.71 13.37C9.19 13.37 9.56 12.98 9.56 12.53C9.56 12.07 9.18 11.69 8.71 11.69Z" />
                                    <path id="Path" class="shp0" d="M8.64 6.06C7.35 6.06 6.75 6.85 6.75 7.38C6.75 7.77 7.07 7.94 7.33 7.94C7.84 7.94 7.63 7.19 8.61 7.19C9.09 7.19 9.48 7.4 9.48 7.86C9.48 8.39 8.94 8.69 8.62 8.97C8.34 9.21 7.98 9.62 7.98 10.47C7.98 10.98 8.11 11.12 8.51 11.12C8.98 11.12 9.07 10.91 9.07 10.72C9.07 10.21 9.08 9.91 9.61 9.49C9.87 9.28 10.69 8.61 10.69 7.69C10.69 6.76 9.87 6.06 8.64 6.06Z" />
                                </g>
                            </g>
                        </g>
                    </svg>
                </span>
                <p><?php echo __( 'Allows to connect with 3rd-party services.', 'cart-lift' ); ?></p>
            </div>
        </div>

        <?php
            if($enable_webhook_status == 'yes') {
                ?>
                <div class="cl-form-group" id="cart_webhook" >
                    <span class="title"><?php echo __( 'Webhook URL:', 'cart-lift' ); ?></span>
                    <input class="cart_webhook" type="text" name="cart_webhook" id="webhook_url" value="<?php echo $general_data['cart_webhook']; ?>">
                    <button style="margin-left:5px;" type="button" class="cl-btn" id="trigger_webhook" name="trigger_webhook">Test</button>
                    <div class="tooltip">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 19" width="18" height="19">
                                <defs>
                                    <clipPath clipPathUnits="userSpaceOnUse" id="cp1">
                                        <path d="M-941 -385L379 -385L379 866L-941 866Z" />
                                    </clipPath>
                                </defs>
                                <style>
                                    tspan { white-space:pre }
                                    .shp0 { fill: #6e42d3 }
                                </style>
                                <g id="Final Create New Abandoned Cart Campaign " clip-path="url(#cp1)">
                                    <g id="name">
                                        <g id="question">
                                            <path id="Shape" fill-rule="evenodd" class="shp0" d="M18 10C18 14.97 13.97 19 9 19C4.03 19 0 14.97 0 10C0 5.03 4.03 1 9 1C13.97 1 18 5.03 18 10ZM16.8 10C16.8 5.7 13.3 2.2 9 2.2C4.7 2.2 1.2 5.7 1.2 10C1.2 14.3 4.7 17.8 9 17.8C13.3 17.8 16.8 14.3 16.8 10Z" />
                                            <path id="Path" class="shp0" d="M8.71 11.69C8.25 11.69 7.87 12.07 7.87 12.53C7.87 12.98 8.24 13.37 8.71 13.37C9.19 13.37 9.56 12.98 9.56 12.53C9.56 12.07 9.18 11.69 8.71 11.69Z" />
                                            <path id="Path" class="shp0" d="M8.64 6.06C7.35 6.06 6.75 6.85 6.75 7.38C6.75 7.77 7.07 7.94 7.33 7.94C7.84 7.94 7.63 7.19 8.61 7.19C9.09 7.19 9.48 7.4 9.48 7.86C9.48 8.39 8.94 8.69 8.62 8.97C8.34 9.21 7.98 9.62 7.98 10.47C7.98 10.98 8.11 11.12 8.51 11.12C8.98 11.12 9.07 10.91 9.07 10.72C9.07 10.21 9.08 9.91 9.61 9.49C9.87 9.28 10.69 8.61 10.69 7.69C10.69 6.76 9.87 6.06 8.64 6.06Z" />
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </span>
                        <p><?php echo __( 'Enter url here.', 'cart-lift' ); ?></p>
                    </div>
                    <p id="webhook-notice" class="cl-notice" style="margin-left:5px; display:none;"></p>
                </div>
                <?php
            }
            else {
                ?>
                <div class="cl-form-group" id="cart_webhook" style="display:none;" >
                    <span class="title"><?php echo __( 'Webhook URL:', 'cart-lift' ); ?></span>
                    <input class="cart_webhook" type="text" name="cart_webhook" id="webhook_url" value="<?php echo $general_data['cart_webhook']; ?>">
                    <button style="margin-left:5px;" type="button" class="cl-btn" id="trigger_webhook" name="trigger_webhook">Test</button>
                    <div class="tooltip">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 19" width="18" height="19">
                                <defs>
                                    <clipPath clipPathUnits="userSpaceOnUse" id="cp1">
                                        <path d="M-941 -385L379 -385L379 866L-941 866Z" />
                                    </clipPath>
                                </defs>
                                <style>
                                    tspan { white-space:pre }
                                    .shp0 { fill: #6e42d3 }
                                </style>
                                <g id="Final Create New Abandoned Cart Campaign " clip-path="url(#cp1)">
                                    <g id="name">
                                        <g id="question">
                                            <path id="Shape" fill-rule="evenodd" class="shp0" d="M18 10C18 14.97 13.97 19 9 19C4.03 19 0 14.97 0 10C0 5.03 4.03 1 9 1C13.97 1 18 5.03 18 10ZM16.8 10C16.8 5.7 13.3 2.2 9 2.2C4.7 2.2 1.2 5.7 1.2 10C1.2 14.3 4.7 17.8 9 17.8C13.3 17.8 16.8 14.3 16.8 10Z" />
                                            <path id="Path" class="shp0" d="M8.71 11.69C8.25 11.69 7.87 12.07 7.87 12.53C7.87 12.98 8.24 13.37 8.71 13.37C9.19 13.37 9.56 12.98 9.56 12.53C9.56 12.07 9.18 11.69 8.71 11.69Z" />
                                            <path id="Path" class="shp0" d="M8.64 6.06C7.35 6.06 6.75 6.85 6.75 7.38C6.75 7.77 7.07 7.94 7.33 7.94C7.84 7.94 7.63 7.19 8.61 7.19C9.09 7.19 9.48 7.4 9.48 7.86C9.48 8.39 8.94 8.69 8.62 8.97C8.34 9.21 7.98 9.62 7.98 10.47C7.98 10.98 8.11 11.12 8.51 11.12C8.98 11.12 9.07 10.91 9.07 10.72C9.07 10.21 9.08 9.91 9.61 9.49C9.87 9.28 10.69 8.61 10.69 7.69C10.69 6.76 9.87 6.06 8.64 6.06Z" />
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </span>
                        <p><?php echo __( 'Enter url here.', 'cart-lift' ); ?></p>
                    </div>
                    <p id="webhook-notice" class="cl-notice" style="margin-left:5px; display:none;"></p>
                </div>
                <?php
            }
        ?>


        <div class="cl-form-group">
            <span class="title"><?php echo __( 'Enable GDPR integration:', 'cart-lift' ); ?></span>
            <span class="cl-switcher">
                <input class="cl-toggle-option" type="checkbox" id="cl_enable_gdpr" name="enable_gdpr" data-status="<?php echo $enable_gdpr_status; ?>" value="<?php echo $enable_gdpr; ?>" <?php checked( '1', $enable_gdpr ); ?> />
                <label for="cl_enable_gdpr"></label>
            </span>
            <div class="tooltip">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 19" width="18" height="19">
                        <defs>
                            <clipPath clipPathUnits="userSpaceOnUse" id="cp1">
                                <path d="M-941 -385L379 -385L379 866L-941 866Z" />
                            </clipPath>
                        </defs>
                        <style>
                            tspan { white-space:pre }
                            .shp0 { fill: #6e42d3 }
                        </style>
                        <g id="Final Create New Abandoned Cart Campaign " clip-path="url(#cp1)">
                            <g id="name">
                                <g id="question">
                                    <path id="Shape" fill-rule="evenodd" class="shp0" d="M18 10C18 14.97 13.97 19 9 19C4.03 19 0 14.97 0 10C0 5.03 4.03 1 9 1C13.97 1 18 5.03 18 10ZM16.8 10C16.8 5.7 13.3 2.2 9 2.2C4.7 2.2 1.2 5.7 1.2 10C1.2 14.3 4.7 17.8 9 17.8C13.3 17.8 16.8 14.3 16.8 10Z" />
                                    <path id="Path" class="shp0" d="M8.71 11.69C8.25 11.69 7.87 12.07 7.87 12.53C7.87 12.98 8.24 13.37 8.71 13.37C9.19 13.37 9.56 12.98 9.56 12.53C9.56 12.07 9.18 11.69 8.71 11.69Z" />
                                    <path id="Path" class="shp0" d="M8.64 6.06C7.35 6.06 6.75 6.85 6.75 7.38C6.75 7.77 7.07 7.94 7.33 7.94C7.84 7.94 7.63 7.19 8.61 7.19C9.09 7.19 9.48 7.4 9.48 7.86C9.48 8.39 8.94 8.69 8.62 8.97C8.34 9.21 7.98 9.62 7.98 10.47C7.98 10.98 8.11 11.12 8.51 11.12C8.98 11.12 9.07 10.91 9.07 10.72C9.07 10.21 9.08 9.91 9.61 9.49C9.87 9.28 10.69 8.61 10.69 7.69C10.69 6.76 9.87 6.06 8.64 6.06Z" />
                                </g>
                            </g>
                        </g>
                    </svg>
                </span>
                <p><?php echo __( 'Ask confirmation from the user/customer before tracking data.', 'cart-lift' ); ?></p>
            </div>
        </div>

        <div class="cl-form-group" id="cl-gdpr-message" style="display: <?php echo $enable_gdpr ? 'flex' : 'none'; ?>">
            <span class="title"><?php echo __( 'GDPR message:', 'cart-lift' ); ?></span>
            <div>
                <textarea role="1" class="cl-gdpr-message" type="text" name="gdpr_text" id="cl_gdpr_message"><?php echo isset( $general_data['gdpr_text'] ) ? $general_data['gdpr_text'] : ''; ?></textarea>
                <span class="hints"><?php echo __('Note: This confirmation message will show below the email field on checkout page.', 'cart-lift'); ?></span>
                <?php
//                if( isset( $general_data['gdpr_text'] ) ){
//                    echo $general_data['gdpr_text'];
//                }
                ?>
            </div>
        </div>


        <div class="cl-form-group">
            <span class="title"><?php echo __( 'Cart Expiration Time:', 'cart-lift' ); ?></span>
            <input class="cart_expiration_time" type="number" name="cart_expiration_time" id="cl-expiration-time"  value="<?php echo (int)$general_data['cart_expiration_time']; ?>">

            <span class="hits"><?php echo __( 'Days', 'cart-lift' ); ?></span>

            <div class="tooltip">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 19" width="18" height="19">
                        <defs>
                            <clipPath clipPathUnits="userSpaceOnUse" id="cp1">
                                <path d="M-941 -385L379 -385L379 866L-941 866Z" />
                            </clipPath>
                        </defs>
                        <style>
                            tspan { white-space:pre }
                            .shp0 { fill: #6e42d3 }
                        </style>
                        <g id="Final Create New Abandoned Cart Campaign " clip-path="url(#cp1)">
                            <g id="name">
                                <g id="question">
                                    <path id="Shape" fill-rule="evenodd" class="shp0" d="M18 10C18 14.97 13.97 19 9 19C4.03 19 0 14.97 0 10C0 5.03 4.03 1 9 1C13.97 1 18 5.03 18 10ZM16.8 10C16.8 5.7 13.3 2.2 9 2.2C4.7 2.2 1.2 5.7 1.2 10C1.2 14.3 4.7 17.8 9 17.8C13.3 17.8 16.8 14.3 16.8 10Z" />
                                    <path id="Path" class="shp0" d="M8.71 11.69C8.25 11.69 7.87 12.07 7.87 12.53C7.87 12.98 8.24 13.37 8.71 13.37C9.19 13.37 9.56 12.98 9.56 12.53C9.56 12.07 9.18 11.69 8.71 11.69Z" />
                                    <path id="Path" class="shp0" d="M8.64 6.06C7.35 6.06 6.75 6.85 6.75 7.38C6.75 7.77 7.07 7.94 7.33 7.94C7.84 7.94 7.63 7.19 8.61 7.19C9.09 7.19 9.48 7.4 9.48 7.86C9.48 8.39 8.94 8.69 8.62 8.97C8.34 9.21 7.98 9.62 7.98 10.47C7.98 10.98 8.11 11.12 8.51 11.12C8.98 11.12 9.07 10.91 9.07 10.72C9.07 10.21 9.08 9.91 9.61 9.49C9.87 9.28 10.69 8.61 10.69 7.69C10.69 6.76 9.87 6.06 8.64 6.06Z" />
                                </g>
                            </g>
                        </g>
                    </svg>
                </span>
                <p><?php echo __( 'Abandoned orders will be deleted. Minimum time limit 7 Days.', 'cart-lift' ); ?></p>
            </div>
        </div>

        <div class="cl-form-group">
            <span class="title"><?php echo __( 'Cart abandoned cut-off time:', 'cart-lift' ); ?></span>
            <input class="cart_expiration_time" type="number" name="cart_abandonment_time" id="cl-abandonment-time" value="<?php echo (int)$general_data['cart_abandonment_time']; ?>">
            <span class="hits"><?php echo __( 'Minutes', 'cart-lift' ); ?></span>

            <div class="tooltip">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 19" width="18" height="19">
                        <defs>
                            <clipPath clipPathUnits="userSpaceOnUse" id="cp1">
                                <path d="M-941 -385L379 -385L379 866L-941 866Z" />
                            </clipPath>
                        </defs>
                        <style>
                            tspan { white-space:pre }
                            .shp0 { fill: #6e42d3 }
                        </style>
                        <g id="Final Create New Abandoned Cart Campaign " clip-path="url(#cp1)">
                            <g id="name">
                                <g id="question">
                                    <path id="Shape" fill-rule="evenodd" class="shp0" d="M18 10C18 14.97 13.97 19 9 19C4.03 19 0 14.97 0 10C0 5.03 4.03 1 9 1C13.97 1 18 5.03 18 10ZM16.8 10C16.8 5.7 13.3 2.2 9 2.2C4.7 2.2 1.2 5.7 1.2 10C1.2 14.3 4.7 17.8 9 17.8C13.3 17.8 16.8 14.3 16.8 10Z" />
                                    <path id="Path" class="shp0" d="M8.71 11.69C8.25 11.69 7.87 12.07 7.87 12.53C7.87 12.98 8.24 13.37 8.71 13.37C9.19 13.37 9.56 12.98 9.56 12.53C9.56 12.07 9.18 11.69 8.71 11.69Z" />
                                    <path id="Path" class="shp0" d="M8.64 6.06C7.35 6.06 6.75 6.85 6.75 7.38C6.75 7.77 7.07 7.94 7.33 7.94C7.84 7.94 7.63 7.19 8.61 7.19C9.09 7.19 9.48 7.4 9.48 7.86C9.48 8.39 8.94 8.69 8.62 8.97C8.34 9.21 7.98 9.62 7.98 10.47C7.98 10.98 8.11 11.12 8.51 11.12C8.98 11.12 9.07 10.91 9.07 10.72C9.07 10.21 9.08 9.91 9.61 9.49C9.87 9.28 10.69 8.61 10.69 7.69C10.69 6.76 9.87 6.06 8.64 6.06Z" />
                                </g>
                            </g>
                        </g>
                    </svg>
                </span>
                <p><?php echo __( 'Minimum time to consider a cart as abandoned. Minimum time limit 15 minutes.', 'cart-lift' ); ?></p>
            </div>
        </div>

        <div class="cl-form-group tracking">
            <span class="title"><?php echo __( 'Disable Tracking For:', 'cart-lift' ); ?></span>
            <ul>
                <?php

                    foreach ($all_roles as $role_key => $role_value) {
                    if (isset($general_data[$role_key])) {
                        if ($general_data[$role_key]== 1) {
                        ?>
                        <li class="cl-checkbox">
                            <input type="checkbox" class="cl-toggle-option" id="<?php echo $role_key; ?>" name="<?php echo $role_key; ?>" data-status="" value="1" checked />
                            <label for="<?php echo $role_key; ?>"><?php echo __( $role_value['name'], 'cart-lift' ); ?></label>
                        </li>
                        <?php
                        }
                        else {
                        ?>
                        <li class="cl-checkbox">
                            <input type="checkbox" class="cl-toggle-option" id="<?php echo $role_key; ?>" name="<?php echo $role_key; ?>" data-status="" value="" />
                            <label for="<?php echo $role_key; ?>"><?php echo __( $role_value['name'], 'cart-lift' ); ?></label>
                        </li>
                        <?php
                        }
                    }
                    else {
                        ?>
                        <li class="cl-checkbox">
                            <input type="checkbox" class="cl-toggle-option" id="<?php echo $role_key; ?>" name="<?php echo $role_key; ?>" data-status="" value="" />
                            <label for="<?php echo $role_key; ?>"><?php echo __( $role_value['name'], 'cart-lift' ); ?></label>
                        </li>
                        <?php
                    }
                    }
                ?>
                <span class="hints"><?php echo __( '<b>Hints:</b> It will ignore selected user roles from abandonment process when they logged in, so they will not receive mail for cart abandonment.', 'cart-lift' ); ?></span>
            </ul>
        </div>

    </div>

    <div class="btn-area">
        <button class="cl-btn" id="cl-general-info-save"><?php echo __( 'save change', 'cart-lift' ); ?></button>
        <p id="general_settings_notice" class="cl-notice" style="display:none"></p>
    </div>
</form>
