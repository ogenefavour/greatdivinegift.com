<?php

namespace WP_SMS\Gateway;

class fayasms extends \WP_SMS\Gateway {
	private $wsdl_link = "http://sms.fayasms.ir/post/send.asmx?wsdl";
	public $tariff = "http://fayasms.ir/";
	public $unitrial = true;
	public $unit;
	public $flash = "disable";
	public $isflash = false;

	public function __construct() {
		parent::__construct();
		$this->validateNumber = "09xxxxxxxx";

		@ini_set( "soap.wsdl_cache_enabled", "0" );
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

		try {
			$client                 = new \SoapClient( $this->wsdl_link );
			$parameters['username'] = $this->username;
			$parameters['password'] = $this->password;
			$parameters['from']     = $this->from;
			$parameters['to']       = $this->to;
			$parameters['text']     = $this->msg;
			$parameters['isflash']  = $this->isflash;
			$parameters['udh']      = "";
			$parameters['recId']    = array( 0 );
			$parameters['status']   = 0x0;

			$result = $client->SendSms( $parameters )->SendSmsResult;

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
		} catch ( \SoapFault $ex ) {
			// Log th result
			$this->log( $this->from, $this->msg, $this->to, $ex->faultstring, 'error' );
			return new \WP_Error( 'send-sms', $ex->faultstring );
		}
	}

	public function GetCredit() {
		// Check username and password
		if ( ! $this->username && ! $this->password ) {
			return new \WP_Error( 'account-credit', __( 'Username/Password does not set for this gateway', 'wp-sms' ) );
		}

		if ( ! class_exists( 'SoapClient' ) ) {
			return new \WP_Error( 'required-class', __( 'Class SoapClient not found. please enable php_soap in your php.', 'wp-sms' ) );
		}

		try {
			$client = new \SoapClient( $this->wsdl_link );

			return $client->GetCredit( array(
				"username" => $this->username,
				"password" => $this->password
			) )->GetCreditResult;
		} catch ( \SoapFault $ex ) {
			return new \WP_Error( 'account-credit', $ex->faultstring );
		}
	}
}