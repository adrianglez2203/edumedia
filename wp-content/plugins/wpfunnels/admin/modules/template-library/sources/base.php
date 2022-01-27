<?php

namespace WPFunnels\TemplateLibrary;

use WPFunnels\Wpfnl;

abstract class Wpfnl_Source_Base
{
    abstract public function get_source();

    abstract public function get_funnels($arg = []);

    abstract public function get_funnel($template_id);

    abstract public function get_data(array $args);

    abstract public function import_funnel($args = []);

    abstract public function import_step($args = []);


    /**
     * after funnel import
     * redirect to new funnel edit url
     *
     * @param $payload
     * @return array
     * @since 1.0.0
     */
    public function after_funnel_creation($payload)
    {
        $funnel = Wpfnl::$instance->funnel_store;
        $funnel->set_id($payload['funnelID']);
        $funnel->set_steps_order();
        $funnel->set_fisrt_step_info();
        $redirect_link = add_query_arg(
            [
                'page'      => WPFNL_EDIT_FUNNEL_SLUG,
                'id'        => $payload['funnelID'],
                'step_id'   => $funnel->get_first_step_id(),
            ],
            admin_url('admin.php')
        );
        return [
            'success'       => true,
            'redirectLink'  => $redirect_link,
        ];
    }

    /**
     * after funnel import
     * redirect to new funnel edit url
     *
     * @param $payload
     * @return array
     * @since 1.0.0
     */
    public function after_step_creation($payload)
    {
        $redirect_link = add_query_arg(
            [
                'page'      => WPFNL_EDIT_FUNNEL_SLUG,
                'id'        => $payload['funnelID'],
                'step_id'   => $payload['stepID'],
            ],
            admin_url('admin.php')
        );
        return [
            'success'       => true,
            'redirectLink'  => $redirect_link,
        ];
    }


}
