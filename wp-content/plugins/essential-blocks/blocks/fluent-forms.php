<?php

/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package essential-blocks
 */

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * @see https://wordpress.org/gutenberg/handbook/designers-developers/developers/tutorials/block-tutorial/applying-styles-with-stylesheets/
 */
function fluent_form_block_init()
{
    // Skip block registration if Gutenberg is not enabled/merged.
    if (!function_exists('register_block_type')) {
        return;
    }
    $dir = dirname(__FILE__);

    $fluent_form_version = defined('FLUENTFORM_VERSION') ? FLUENTFORM_VERSION : ESSENTIAL_BLOCKS_VERSION;

    wp_register_style(
        'fluent-form-styles',
        get_site_url(null, '/wp-content/plugins/', '') . 'fluentform/public/css/fluent-forms-public.css',
        array(),
        $fluent_form_version,
        'all'
    );

    wp_register_style(
        'fluentform-public-default',
        get_site_url(null, '/wp-content/plugins/', '') . 'fluentform/public/css/fluentform-public-default.css',
        array('fluent-form-styles'),
        $fluent_form_version,
        'all'
    );

    register_block_type(
        $dir . "/fluent-forms",
        array(
            'editor_script' => 'essential-blocks-editor-script',
            'editor_style' => 'fluentform-public-default',
            'render_callback' => 'essential_blocks_fluent_form_render_callback',
            'attributes' => array(
                'blockId' => array(
                    'type' => "string",
                ),
                'formId' => array(
                    'type' => 'string',
                ),
            ),
        )
    );
}
add_action('init', 'fluent_form_block_init');

// render callback function 
function essential_blocks_fluent_form_render_callback($attributes)
{
    if (!defined('FLUENTFORM')) return;
    if (!is_admin()) {

        $blockId = isset($attributes['blockId']) ? $attributes['blockId'] : '';
        $formId = isset($attributes['formId']) ? $attributes['formId'] : '';
        $customCheckboxStyle = isset($attributes['customCheckboxStyle']) ? $attributes['customCheckboxStyle'] : false;
        $formAlignment = isset($attributes['formAlignment']) ? $attributes['formAlignment'] : 'none';
        $showLabels = isset($attributes['showLabels']) ? $attributes['showLabels'] : true;
        $showPlaceholder = isset($attributes['showPlaceholder']) ? $attributes['showPlaceholder'] : true;
        $showErrorMessage = isset($attributes['showErrorMessage']) ? $attributes['showErrorMessage'] : true;
        $wrapperClasses = array('eb-fluent-form-wrapper');

        if ($customCheckboxStyle) {
            array_push($wrapperClasses, 'eb-fluent-custom-radio-checkbox');
        }

        $alignment = array('left' => 'eb-fluentform-alignment-left', 'center' => 'eb-fluentform-alignment-center', 'right' => 'eb-fluentform-alignment-right');

        if (array_key_exists($formAlignment, $alignment)) {
            array_push($wrapperClasses, $alignment[$formAlignment]);
        }

        if (!$showLabels) {
            array_push($wrapperClasses, 'eb-fluentform-hide-labels');
        }

        if (!$showPlaceholder) {
            array_push($wrapperClasses, 'eb-fluentform-hide-placeholder');
        }

        if (!$showErrorMessage) {
            array_push($wrapperClasses, 'eb-fluentform-hide-errormessage');
        }

        if (\FluentForm\App\Helpers\Helper::getFormMeta($formId, 'template_name') === 'inline_subscription') {
            array_push($wrapperClasses, 'eb-fluentform-default-subscription');
        }

        $wrapper_attributes = get_block_wrapper_attributes();

        $html = '';
        $html .= '<div ' . $wrapper_attributes . '/>';
        $html .= '<div class="' . $blockId . " " . implode(" ", $wrapperClasses) . '">';
        $shortcode = sprintf('[fluentform id="' . $formId . '"]');
        $html .= do_shortcode(shortcode_unautop($shortcode));
        $html .= '</div></div>';

        return $html;
    }
}
