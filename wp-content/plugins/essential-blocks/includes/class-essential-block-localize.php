<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class EssentialAdminBlocksLocalize
{
    private $plugin_name;

    public function __construct($name)
    {
        $this->plugin_name = $name;
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
    }

    public function enqueue_scripts()
    {
        wp_enqueue_script(
            $this->plugin_name . '-blocks-localize',
            ESSENTIAL_BLOCKS_ADMIN_URL . 'assets/js/eb-blocks-localize.js',
            array(),
            ESSENTIAL_BLOCKS_VERSION,
            false
        );

        wp_localize_script($this->plugin_name . '-blocks-localize', 'EssentialBlocksLocalize', array(
            'eb_plugins_url' => ESSENTIAL_BLOCKS_URL,
            'eb_wp_version' => ESSENTIAL_BLOCKS_WP_VERSION,
            'rest_rootURL' => get_rest_url(),
            'enabled_blocks' => (new EssentialAdmin($this->plugin_name, ESSENTIAL_BLOCKS_VERSION))->get_blocks(),
            'is_fluent_form_active' => defined('FLUENTFORM') ? true : false,
            'fluent_form_lists' => json_encode(self::get_fluent_forms_list())
        ));
    }

    /**
     * Get FluentForms List
     *
     * @return array
     */
    public static function get_fluent_forms_list()
    {

        $options = array();

        if (defined('FLUENTFORM')) {
            global $wpdb;
            $options[0]['value'] = '';
            $options[0]['label'] = __('Select a form', 'essential-blocks');
            $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}fluentform_forms");
            if ($result) {
                foreach ($result as $key => $form) {
                    $options[$key + 1]['value'] = $form->id;
                    $options[$key + 1]['label'] = $form->title;
                    $options[$key + 1]['attr'] = self::get_form_attr($form->id);
                }
            }
        }
        return $options;
    }

    /**
     * Get Form Attribute
     */
    public static function get_form_attr($form_id)
    {
        return  \FluentForm\App\Helpers\Helper::getFormMeta($form_id, 'template_name');
    }
}
