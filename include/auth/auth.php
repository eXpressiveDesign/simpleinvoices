<?php

/*
 * Modules excluded from auth:
 *   api/paypal - PayPal IPN callbacks originate from PayPal servers
 *   api/cron   - automated scheduler, no browser session
 *
 * Web installer: when the DB has no tables yet or essential bootstrap data is
 * missing, allow the request through without a session so index.php can route
 * to module=install (otherwise login is required before routing runs).
 */

$installer_incomplete = !$install_tables_exists || !checkDataExists(1);
$require_auth = (function () use ($module, $view) :bool {
	switch($module){
		case 'api':
			$auth_exempt_views = [
				'cron',
				'paypal',

				'paypal_checkout', 
				'stripe_checkout',
				'stripe_webhook',
				'mollie_checkout',
				'authorizenet_checkout',
				'kofi_checkout',
				'coinbase_checkout',
				'adyen_checkout',
				'eway_checkout',
				'paymentsgateway_checkout',				
			];
			return !in_array($view, $auth_exempt_views, true);
		
		case 'payment':
			$auth_exempt_views = [
				'success', 
				'cancel'
			];
			return !in_array($view, $auth_exempt_views, true);
	}

	return true;
})();

if ($require_auth) {
	if (!isset($auth_session->id)) {
		if (!isset($_GET['module'])) {
			$_GET['module'] = '';
		}
		if ($_GET['module'] !== "auth" && !$installer_incomplete) {
			$siBase = rtrim(str_replace('\\', '', dirname($_SERVER['PHP_SELF'])), '/');
			header('Location: ' . $siBase . '/?module=auth&view=login');
			exit;
		}
	}
}
