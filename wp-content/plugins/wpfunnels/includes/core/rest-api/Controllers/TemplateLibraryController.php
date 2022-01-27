<?php

namespace WPFunnels\Rest\Controllers;

use WP_Error;
use WP_REST_Request;
use WP_REST_Response;
use WP_REST_Server;
use WPFunnels\Wpfnl_functions;

class TemplateLibraryController extends Wpfnl_REST_Controller {

    public static $funnel_api_url = 'https://templates.getwpfunnels.com/wp-json/wp/v2/wpfunnels/';

    public static $funnel_builder_api_url = 'https://templates.getwpfunnels.com/wp-json/wp/v2/template_builder/';

    public static $funnel_categories_api_url = 'https://templates.getwpfunnels.com/wp-json/wp/v2/template_industries/';

    public static $funnel_steps_api_url = 'https://templates.getwpfunnels.com/wp-json/wp/v2/wpfunnel_steps/';

//    public static $funnel_api_url = 'https://dev.remotefunnels.local/wp-json/wp/v2/wpfunnels/';
//
//    public static $funnel_builder_api_url = 'https://dev.remotefunnels.local/wp-json/wp/v2/template_builder/';
//
//    public static $funnel_categories_api_url = 'https://dev.remotefunnels.local/wp-json/wp/v2/template_industries/';
//
//    public static $funnel_steps_api_url = 'https://dev.remotefunnels.local/wp-json/wp/v2/wpfunnel_steps/';


    /**
     * Endpoint namespace.
     *
     * @var string
     */
    protected $namespace = 'wpfunnels/v1';

    /**
     * Route base.
     *
     * @var string
     */
    protected $rest_base = 'templates/';

    public function update_items_permissions_check( $request ) {
        $permission = current_user_can('manage_options');
        if ( ! Wpfnl_functions::wpfnl_rest_check_manager_permissions( 'templates' ) ) {
            return new WP_Error( 'wpfunnels_rest_cannot_edit', __( 'Sorry, you cannot edit this resource.', 'wpfnl' ), array( 'status' => rest_authorization_required_code() ) );
        }
        return true;
    }

    /**
     * Makes sure the current user has access to READ the settings APIs.
     *
     * @since  3.0.0
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|boolean
     */
    public function get_items_permissions_check( $request ) {
        if ( ! Wpfnl_functions::wpfnl_rest_check_manager_permissions( 'templates' ) ) {
            return new WP_Error( 'wpfunnels_rest_cannot_view', __( 'Sorry, you cannot list resources.', 'wpfnl' ), array( 'status' => rest_authorization_required_code() ) );
        }
        return true;
    }



    public function register_routes()
    {
        register_rest_route(
            $this->namespace, '/' . $this->rest_base . 'get_templates' , array(
                array(
                    'methods'               => WP_REST_Server::READABLE,
                    'callback'              => array( $this, 'get_templates' ),
                    'permission_callback'   => array( $this, 'get_items_permissions_check' ),
                ),
            )
        );

    }


	/**
	 * Prepare a single setting object for response.
	 *
	 * @param $request
	 * @return WP_REST_Response
	 */
    public function get_templates($request) {
        $templates = $this->get_funnels_data();
        $templates['success'] = true;
        return $this->prepare_item_for_response( $templates, $request );
    }


	/**
	 * @param $url
	 * @param $args
	 * @return array
	 */
    private function remote_get($url, $args)
    {
        $response = wp_remote_get($url, $args);
        if ( is_wp_error($response) || 200 !== (int) wp_remote_retrieve_response_code($response) ) {
            return [
                'success' => false,
                'message' => $response->get_error_message(),
                'data'    => $response,
            ];
        }
        return [
            'success' => true,
            'message' => 'Data successfully retrieved',
            'data'    => json_decode(wp_remote_retrieve_body($response), true),
        ];
    }


    private function get_funnels($args = [], $force_update = false)
    {
        $builder_type = Wpfnl_functions::get_builder_type();
        $cache_key = 'wpfunnels_remote_template_data_' . WPFNL_VERSION;
        $data = get_transient($cache_key);
        if ($force_update || false === $data) {
            $timeout = ($force_update) ? 25 : 8;

            // fetch and set builder type
            $params = [
                '_fields'       => 'id,name,slug',
                'hide_empty'    => false,
                'search'        => Wpfnl_functions::get_builder_type(),
            ];
            $url = add_query_arg($params, self::$funnel_builder_api_url);

			$builder_data = self::remote_get($url, [
                'timeout'       => $timeout,
            ]);

			if ($builder_data['success']) {
                $builder = $builder_data['data'][0];

                // fetch all the steps from the remote server
                $params = [
                    '_fields'       	=> 'id,title,link,slug,featured_media,steps,featured_image,divi_content,steps_order,builder,industry,is_pro,type,step_type,funnel_id,funnel_name,_qubely_css,_qubely_interaction_json,__qubely_available_blocks',
                    'template_builder'  => $builder['id'],
					'per_page'  		=> 100,
				];
                $url = add_query_arg($params, self::$funnel_steps_api_url);

				$steps_data = [];
                $_steps_data = self::remote_get($url, [
                    'timeout'       => $timeout,
                ]);
                if( $_steps_data['success'] ) {
                    foreach ( $_steps_data['data'] as $step ) {
                        if(isset($step['builder']['slug']) && $step['builder']['slug'] == $builder_type) {
                            $steps_data[] = $step;
                        }
                    }
                    $steps_data['data'] = $steps_data;
                    $steps_data['success'] = true;
                }

                // fetch the templates from the remote server
                $params = [
                    '_fields'           => 'id,title,link,slug,featured_media,featured_image,steps_order,builder,industry,is_pro,funnel_data',
                    'template_builder'  => $builder['id'],
                    'per_page'  		=> 100,
                ];
                $url = add_query_arg($params, self::$funnel_api_url);
                $template_data = self::remote_get($url, [
                    'timeout'       => $timeout,
                ]);
				if (!$template_data['success'] || !$steps_data['success']) {
                    set_transient($cache_key, [], 2 * HOUR_IN_SECONDS);
                    return false;
                }


                // fetch the funnel categories from the remote server
                $categories_data = self::remote_get(self::$funnel_categories_api_url, [
                    'timeout'       => $timeout,
                ]);
                if (!$categories_data['success']) {
                    set_transient($cache_key, [], 2 * HOUR_IN_SECONDS);
                    return false;
                }

                $data['templates'] = $template_data['data'];
                $data['steps'] = $steps_data['data'];
                $data['categories'] = $categories_data['data'];
                update_option(WPFNL_TEMPLATES_OPTION_KEY, $data, 'no');
                set_transient($cache_key, $data, 12 * HOUR_IN_SECONDS);
            }
            return false;
        }
        return $data;
    }


    /**
     * get funnel templates data
     * @param array $args
     * @param bool $force_update
     * @return array|mixed|void
     * @since 1.0.0
     */
    public function get_funnels_data($args = [], $force_update = false)
    {
        $builder_type = Wpfnl_functions::get_builder_type();
        self::get_funnels($args, $force_update);
        $template_data = get_option(WPFNL_TEMPLATES_OPTION_KEY);
        if (empty($template_data)) {
            return [];
        }
        return $template_data;
    }


    /**
     * @param $step_id
     * @param bool $force_update
     * @return array
     * @since 1.0.0
     */
    public static function get_step($step_id, $force_update = false)
    {
        $timeout = ($force_update) ? 25 : 8;
        $params = [
            '_fields'      => 'id,title,link,slug,featured_media,post_meta,rawData,steps,divi_content,featured_image,steps_order,builder,industry,is_pro,type,step_type,funnel_id,funnel_name,_qubely_css,_qubely_interaction_json,__qubely_available_blocks',
        ];

        $url = add_query_arg($params, self::$funnel_steps_api_url . $step_id);
        $api_args = [
            'timeout' => $timeout,
        ];
        $response = (new TemplateLibraryController)->remote_get($url, $api_args);

        if ($response['success']) {
            $step = $response['data'];
            return [
                'title'         => (isset($step['title']['rendered'])) ? $step['title']['rendered'] : '',
                'post_meta'     => (isset($step['post_meta'])) ? $step['post_meta'] : '',
                'data'          => $step,
                'content'       => isset($response['data']['content']['rendered']) ? $response['data']['content']['rendered'] : '',
                'rawData'       => isset($response['data']['rawData']) ? $response['data']['rawData'] : '',
				'divi_content'  => isset($response['data']['divi_content']) ? $response['data']['divi_content'] : '',
                'message'       => $response['message'],
                'success'       => $response['success'],
            ];
        }

        return [
            'title'        => '',
            'post_meta'    => [],
            'message'      => $response['message'],
            'data'         => $response['data'],
            'success'      => $response['success'],
            'content'      => '',
        ];
    }


    /**
     * Prepare a single setting object for response.
     *
     * @since  1.0.0
     * @param object          $item Setting object.
     * @param WP_REST_Request $request Request object.
     * @return WP_REST_Response $response Response data.
     */
    public function prepare_item_for_response( $item, $request ) {
        $data     = $this->add_additional_fields_to_object( $item, $request );
        $response = rest_ensure_response( $data );
        return $response;
    }
}
