<?php
	// Grant token UchtpSb3Uk8ciF9G9t4YT8ECbJX3mj9q77Rwl74B6Qw1
	//Web security
	define('SALT', 'rawbiteSalty');

	date_default_timezone_set('Europe/Copenhagen');

	// Development values
	$whitelist = array('127.0.0.1', '::1', 'localhost');

	if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
		error_reporting(E_ALL);
		define('AGREEMENT_NO', 1387294);
		define('ECONOMIC_USER', 'tas');
		define('ECONOMIC_PASSWORD', 'lj7akoxo');

		define('CUSTOMER_RECEIPT_MAIL', 'tas@interactify.dk');
		define('ORDER_RECEIVE_MAIL', 'tas@interactify.dk');
		
	} 

?>