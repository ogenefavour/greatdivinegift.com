<?php

use WP_SMS\Gateway;

/**
 * @return mixed
 */
function wp_sms_initial_gateway() {
	require_once WP_SMS_DIR . 'includes/class-wpsms-option.php';

	return Gateway::initial();
}