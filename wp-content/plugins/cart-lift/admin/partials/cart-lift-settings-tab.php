<div id="cl-loader" class="cl-loader">
    <div class="ring"></div>
</div>

<?php
global $wp_roles;
$all_roles = $wp_roles->roles;
?>



<div id="cl-settings" class="cl-settings">
    <div id="cl-settings-tabs" class="cl-settings-tabs">
        <ul class="settings-tab-header">
            <li><a href="#general"><?php echo __( 'General', 'cart-lift' ); ?></a></li>
            <li><a href="#email-popup"><?php echo __( 'Popup Editor', 'cart-lift' ); ?></a></li>
            <li><a href="#twilio-sms"><?php echo __( 'SMS', 'cart-lift' ); ?></a></li>
        </ul>

        <div class="settings-tab-content-wrapper">
            <!-- general tab -->
            <div id="general" class="settings-tab-content general">
				<?php require_once CART_LIFT_DIR . 'admin/partials/settings-component/general-tab.php'; ?>
            </div>

            <!-- email-popup tab -->
            <div id="email-popup" class="settings-tab-content email-popup">
				<?php require_once CART_LIFT_DIR . 'admin/partials/settings-component/email-popup.php'; ?>
            </div>
            <!-- /email-popup tab -->

            <!-- twilio-sms tab -->
            <div id="twilio-sms" class="settings-tab-content email-popup">
				<?php require_once CART_LIFT_DIR . 'admin/partials/settings-component/twilio-sms.php'; ?>
            </div>
            <!-- twilio-sms tab -->

        </div>
    </div>
</div>