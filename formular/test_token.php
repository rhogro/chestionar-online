<?php
require_once 'inc/vendor/autoload.php';
use \Firebase\JWT\JWT;

    function validJWT($token) {
		$res = array(false, '');
		// using a try and catch to verify
		try {
			$decoded = JWT::decode($token, 'rhogro', array('HS256'));
		} catch (Exception $e) {
			return $res;
		}	
		$res['0'] = true;
		$res['1'] = (array) $decoded;
		return $res;
	}
    
	// checks if an username is valid
	$tokenVal = validJWT($_COOKIE["token"]);
 
	// check if the first array value is true
	if (!$tokenVal['0']) {
        header("Location: localhost/login.html");
	    die();
	}
?>