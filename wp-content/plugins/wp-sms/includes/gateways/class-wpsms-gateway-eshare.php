<?php

namespace WP_SMS\Gateway;

class eshare extends \WP_SMS\Gateway {
	public $tariff = "http://eshare.com/";
	public $unitrial = false;
	public $unit;
	public $flash = "enable";
	public $isflash = false;
	private $wsdl_link = "http://94.232.173.124/";

	public function __construct() {
		parent::__construct();
	}

	public function SendSMS() {

		/**
		 * Modify sender number
		 *
		 * @since 3.4
		 *
		 * @param string $this ->from sender number.
		 */
		$this->from = apply_filters( 'wp_sms_from', $this->from );

		/**
		 * Modify Receiver number
		 *
		 * @since 3.4
		 *
		 * @param array $this ->to receiver number
		 */
		$this->to = apply_filters( 'wp_sms_to', $this->to );

		/**
		 * Modify text message
		 *
		 * @since 3.4
		 *
		 * @param string $this ->msg text message.
		 */
		$this->msg = apply_filters( 'wp_sms_msg', $this->msg );

		// Get the credit.
		$credit = $this->GetCredit();

		// Check gateway credit
		if ( is_wp_error( $credit ) ) {
			// Log the result
			$this->log( $this->from, $this->msg, $this->to, $credit->get_error_message(), 'error' );

			return $credit;
		}

		// Implode numbers
		$to = implode( ',', $this->to );

		// Unicode message
		$msg = urlencode( $this->msg );

		$response = wp_remote_get( $this->wsdl_link . "/sendsms.ashx?user=" . $this->username . "&pass=" . $this->password . "&to=" . $to . "&text=" . $msg, array( 'timeout' => 30 ) );

		// Check gateway credit
		if ( is_wp_error( $response ) ) {
			// Log the result
			$this->log( $this->from, $this->msg, $this->to, $response->get_error_message(), 'error' );

			return new \WP_Error( 'account-credit', $response->get_error_message() );
		}

		$response_code = wp_remote_retrieve_response_code( $response );

		if ( $response_code == '200' ) {
			if ( strlen( $response['body'] ) > 3 ) {
				// Log the result
				$this->log( $this->from, $this->msg, $this->to, $response['body'] );

				/**
				 * Run hook after send sms.
				 *
				 * @since 2.4
				 *
				 * @param string $result result output.
				 */
				do_action( 'wp_sms_send', $response['body'] );

				return $response['body'];
			} else {
				// Log the result
				$this->log( $this->from, $this->msg, $this->to, $response['body'], 'error' );

				return $response['body'];
			}

		} else {
			// Log the result
			$this->log( $this->from, $this->msg, $this->to, $response['body'], 'error' );

			return new \WP_Error( 'send-sms', $response['body'] );
		}
	}

	public function GetCredit() {
		// Check username and password
		if ( ! $this->username && ! $this->password ) {
			return new \WP_Error( 'account-credit', __( 'Username/Password does not set for this gateway', 'wp-sms' ) );
		}

		return true;
	}
}