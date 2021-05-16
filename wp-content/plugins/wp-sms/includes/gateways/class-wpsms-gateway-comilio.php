<?php

namespace WP_SMS\Gateway;

class comilio extends \WP_SMS\Gateway {
	private $wsdl_link = "https://api.comilio.it/rest/v1";
	public $tariff = "https://www.comilio.it/tariffe";
	public $unitrial = false;
	public $unit;
	public $flash = "disable";
	public $isflash = false;
	private $smsh_response_status = 0;

	public function __construct() {
		parent::__construct();
		$this->validateNumber = "";
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

		$payload = array(
			'message_type'  => 'SmartPro',
			'phone_numbers' => $this->to,
			'text'          => $this->msg,
			'sender_string' => $this->from
		);

		$to_smsh = curl_init( "{$this->wsdl_link}/message" );
		curl_setopt( $to_smsh, CURLOPT_POST, true );
		curl_setopt( $to_smsh, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $to_smsh, CURLOPT_USERPWD, $this->username . ":" . $this->password );
		curl_setopt( $to_smsh, CURLOPT_POSTFIELDS, json_encode( $payload ) );
		curl_setopt( $to_smsh, CURLOPT_TIMEOUT, 10 );
		curl_setopt( $to_smsh, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json' ) );

		$result = curl_exec( $to_smsh );

		$this->smsh_response_status = curl_getinfo( $to_smsh, CURLINFO_HTTP_CODE );

		if ( $result ) {
			$jsonObj = json_decode( $result );

			if ( null === $jsonObj ) {
				// Log the result
				$this->log( $this->from, $this->msg, $this->to, $jsonObj, 'error' );

				return false;
			} elseif ( $this->smsh_response_status != 200 ) {
				// Log the result
				$this->log( $this->from, $this->msg, $this->to, $this->smsh_response_status, 'error' );

				return false;
			} else {
				$result = $jsonObj->message_id;

				// Log the result
				$this->log( $this->from, $this->msg, $this->to, $result );

				/**
				 * Run hook after send sms.
				 *
				 * @since 2.4
				 *
				 * @param string $result result output.
				 */
				do_action( 'wp_sms_send', $result );

				return $result;
			}
		} else {
			// Log the result
			$this->log( $this->from, $this->msg, $this->to, $result, 'error' );

			return new \WP_Error( 'send-sms', $result );
		}
	}

	public function GetCredit() {
		// Check username and password
		if ( ! $this->username && ! $this->password ) {
			return new \WP_Error( 'account-credit', __( 'Username/Password does not set for this gateway', 'wp-sms' ) );
		}

		$to_smsh = curl_init( "{$this->wsdl_link}/credits" );

		curl_setopt( $to_smsh, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $to_smsh, CURLOPT_USERPWD, $this->username . ":" . $this->password );
		curl_setopt( $to_smsh, CURLOPT_TIMEOUT, 10 );

		$result = curl_exec( $to_smsh );

		$this->smsh_response_status = curl_getinfo( $to_smsh, CURLINFO_HTTP_CODE );

		if ( $result ) {
			$jsonObj = json_decode( $result );

			if ( null === $jsonObj ) {
				return new \WP_Error( 'account-credit', $result );
			} elseif ( $this->smsh_response_status != 200 ) {
				return new \WP_Error( 'account-credit', $result );
			} else {
				for ( $i = 0; $i < count( $jsonObj ); $i ++ ) {
					if ( $jsonObj[ $i ]->message_type === 'SmartPro' ) {
						return $jsonObj[ $i ]->quantity;
					}
				}

				return new \WP_Error( 'account-credit', $result );
			}
		} else {
			return new \WP_Error( 'account-credit', $result );
		}
	}
}
