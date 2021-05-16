<?php

namespace WP_SMS;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Integrations {

	public $sms;
	public $date;
	public $options;
	public $cf7_data;

	public function __construct() {
		global $sms;

		$this->sms     = $sms;
		$this->date    = WP_SMS_CURRENT_DATE;
		$this->options = Option::getOptions();

		// Contact Form 7
		if ( isset( $this->options['cf7_metabox'] ) ) {
			add_filter( 'wpcf7_editor_panels', array( $this, 'cf7_editor_panels' ) );
			add_action( 'wpcf7_after_save', array( $this, 'wpcf7_save_form' ) );
			add_action( 'wpcf7_before_send_mail', array( $this, 'wpcf7_sms_handler' ) );
		}

		// Woocommerce
		if ( isset( $this->options['wc_notif_new_order'] ) ) {
			add_action( 'woocommerce_new_order', array( $this, 'wc_new_order' ) );
		}

		// EDD
		if ( isset( $this->options['edd_notif_new_order'] ) ) {
			add_action( 'edd_complete_purchase', array( $this, 'edd_new_order' ) );
		}
	}

	public function cf7_editor_panels( $panels ) {
		$new_page = array(
			'wpsms' => array(
				'title'    => __( 'SMS Notification', 'wp-sms' ),
				'callback' => array( $this, 'cf7_setup_form' )
			)
		);

		$panels = array_merge( $panels, $new_page );

		return $panels;
	}

	public function cf7_setup_form( $form ) {
		$cf7_options       = get_option( 'wpcf7_sms_' . $form->id() );
		$cf7_options_field = get_option( 'wpcf7_sms_form' . $form->id() );

		if ( ! isset( $cf7_options['phone'] ) ) {
			$cf7_options['phone'] = '';
		}
		if ( ! isset( $cf7_options['message'] ) ) {
			$cf7_options['message'] = '';
		}
		if ( ! isset( $cf7_options_field['phone'] ) ) {
			$cf7_options_field['phone'] = '';
		}
		if ( ! isset( $cf7_options_field['message'] ) ) {
			$cf7_options_field['message'] = '';
		}

		include_once WP_SMS_DIR . "includes/templates/wpcf7-form.php";
	}

	public function wpcf7_save_form( $form ) {
		update_option( 'wpcf7_sms_' . $form->id(), $_POST['wpcf7-sms'] );
		update_option( 'wpcf7_sms_form' . $form->id(), $_POST['wpcf7-sms-form'] );
	}

	public function wpcf7_sms_handler( $form ) {
		$cf7_options       = get_option( 'wpcf7_sms_' . $form->id() );
		$cf7_options_field = get_option( 'wpcf7_sms_form' . $form->id() );
		$this->set_cf7_data();

		if ( $cf7_options['message'] && $cf7_options['phone'] ) {
			$this->sms->to = explode( ',', $cf7_options['phone'] );

			$this->sms->msg = preg_replace_callback( '/%([a-zA-Z0-9._-]+)%/', function ( $matches ) {
				foreach ( $matches as $item ) {
					if ( isset( $this->cf7_data[ $item ] ) ) {
						return $this->cf7_data[ $item ];
					}
				}
			}, $cf7_options['message'] );

			$this->sms->SendSMS();
		}

		if ( $cf7_options_field['message'] && $cf7_options_field['phone'] ) {

			$to = preg_replace_callback( '/%([a-zA-Z0-9._-]+)%/', function ( $matches ) {
				foreach ( $matches as $item ) {
					if ( isset( $this->cf7_data[ $item ] ) ) {
						return $this->cf7_data[ $item ];
					}
				}
			}, $cf7_options_field['phone'] );

			$this->sms->to = array( $to );

			$this->sms->msg = preg_replace_callback( '/%([a-zA-Z0-9._-]+)%/', function ( $matches ) {
				foreach ( $matches as $item ) {
					if ( isset( $this->cf7_data[ $item ] ) ) {
						return $this->cf7_data[ $item ];
					}
				}
			}, $cf7_options_field['message'] );

			$this->sms->SendSMS();
		}
	}

	private function set_cf7_data() {
		foreach ( $_POST as $index => $key ) {
			if ( is_array( $key ) ) {
				$this->cf7_data[ $index ] = implode( ', ', $key );
			} else {
				$this->cf7_data[ $index ] = $key;
			}
		}
	}

	public function wc_new_order( $order_id ) {
		$order          = new \WC_Order( $order_id );
		$this->sms->to  = array( $this->options['admin_mobile_number'] );
		$template_vars  = array(
			'%order_id%'     => $order_id,
			'%status%'       => $order->get_status(),
			'%order_number%' => $order->get_order_number(),
		);
		$message        = str_replace( array_keys( $template_vars ), array_values( $template_vars ), $this->options['wc_notif_new_order_template'] );
		$this->sms->msg = $message;

		$this->sms->SendSMS();
	}

	public function edd_new_order() {
		$this->sms->to  = array( $this->options['admin_mobile_number'] );
		$this->sms->msg = $this->options['edd_notif_new_order_template'];
		$this->sms->SendSMS();
	}

}

new Integrations();