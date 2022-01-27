<?php
	$offer_settings = \WPFunnels\Wpfnl_functions::get_offer_settings();
?>

<div class="wpfnl-box">
    <div class="wpfnl-field-wrapper">
        <label class="has-tooltip">
            <?php echo __('Create a new child order', 'wpfnl'); ?>
            <span class="wpfnl-tooltip">
                <?php require WPFNL_DIR . '/admin/partials/icons/question-tooltip-icon.php'; ?>
                <p><?php echo __('Enabling this will create separate orders for every post-purchase offers you make.', 'wpfnl'); ?></p>
            </span>
        </label>
        <div class="wpfnl-fields">
            <div class="wpfnl-radiobtn no-title">
                <input type="radio" name="offer-orders" id="wpfunnels-offer-child-order" value="child-order" <?php checked( $offer_settings['offer_orders'], 'child-order' ) ?>/>
                <label for="wpfunnels-offer-child-order"></label>
            </div>
        </div>
    </div>
    <!-- /field-wrapper -->

    <div class="wpfnl-field-wrapper">
        <label class="has-tooltip">
            <?php echo __('Add to main order', 'wpfnl'); ?>
            <span class="wpfnl-tooltip">
                <?php require WPFNL_DIR . '/admin/partials/icons/question-tooltip-icon.php'; ?>
                <p><?php echo __('All purchases including main product, order bump, upsell(s), and downsell(s), will be included as part of a single order in WooCommerce.', 'wpfnl'); ?></p>
            </span>
        </label>
        <div class="wpfnl-fields">
            <div class="wpfnl-radiobtn no-title">
                <input type="radio" name="offer-orders" id="wpfunnels-offer-main-order" value="main-order" <?php checked( $offer_settings['offer_orders'], 'main-order' ) ?>/>
                <label for="wpfunnels-offer-main-order"></label>
            </div>
        </div>
    </div>
    <!-- /field-wrapper -->
</div>
<!-- /settings-box -->
