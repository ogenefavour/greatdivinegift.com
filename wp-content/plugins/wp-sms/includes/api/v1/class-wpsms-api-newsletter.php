<?php

namespace WP_SMS\Api\V1;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * @category   class
 * @package    WP_SMS_Api
 * @version    1.0
 */
class Newsletter extends \WP_SMS\RestApi {

	public function __construct() {
		// Register routes
		add_action( 'rest_api_init', array( $this, 'register_routes' ) );

		parent::__construct();
	}

	/**
	 * Register routes
	 */
	public function register_routes() {

		// SMS Newsletter
		register_rest_route( $this->namespace . '/v1', '/newsletter', array(
			array(
				'methods'  => \WP_REST_Server::CREATABLE,
				'callback' => array( $this, 'subscribe_callback' ),
				'args'     => array(
					'name'     => array(
						'required' => true,
					),
					'mobile'   => array(
						'required' => true,
					),
					'group_id' => array(
						'required' => false,
					),
				),
			),
			array(
				'methods'  => \WP_REST_Server::DELETABLE,
				'callback' => array( $this, 'unsubscribe_callback' ),
				'args'     => array(
					'name'   => array(
						'required' => true,
					),
					'mobile' => array(
						'required' => true,
					),
				),
			),
			array(
				'methods'  => \WP_REST_Server::EDITABLE,
				'callback' => array( $this, 'verify_subscriber_callback' ),
				'args'     => array(
					'name'       => array(
						'required' => true,
					),
					'mobile'     => array(
						'required' => true,
					),
					'activation' => array(
						'required' => true,
					),
				),
			)
		) );
	}

	/**
	 * @param WP_REST_Request $request
	 *
	 * @return WP_Error|WP_REST_Response
	 */
	public function subscribe_callback( \WP_REST_Request $request ) {
		// Get parameters from request
		$params = $request->get_params();

		$group_id = isset ( $params['group_id'] ) ? $params['group_id'] : 1;
		$result   = self::subscribe( $params['name'], $params['mobile'], $group_id );

		if ( is_wp_error( $result ) ) {
			return self::response( $result->get_error_message(), 400 );
		}

		return self::response( $result );
	}

	/**
	 * @param WP_REST_Request $request
	 *
	 * @return WP_Error|WP_REST_Response
	 */
	public function unsubscribe_callback( \WP_REST_Request $request ) {
		// Get parameters from request
		$params = $request->get_params();

		$group_id = isset ( $params['group_id'] ) ? $params['group_id'] : 1;
		$result   = self::unSubscribe( $params['name'], $params['mobile'], $group_id );

		if ( is_wp_error( $result ) ) {
			return self::response( $result->get_error_message(), 400 );
		}

		return self::response( __( 'Your number has been successfully unsubscribed.', 'wp-sms' ) );
	}

	/**
	 * @param WP_REST_Request $request
	 *
	 * @return WP_Error|WP_REST_Response
	 */
	public function verify_subscriber_callback( \WP_REST_Request $request ) {
		// Get parameters from request
		$params = $request->get_params();

		$group_id = isset ( $params['group_id'] ) ? $params['group_id'] : 1;
		$result   = self::verifySubscriber( $params['name'], $params['mobile'], $params['activation'], $group_id );

		if ( is_wp_error( $result ) ) {
			return self::response( $result->get_error_message(), 400 );
		}

		return self::response( __( 'Your number has been successfully subscribed.', 'wp-sms' ) );
	}
}

new Newsletter();