<?php

// Example of decoding JWT Web Token with public key
// Package: https://github.com/firebase/php-jwt

require_once 'inc/vendor/autoload.php';

use \Firebase\JWT\JWT;

function decode($jwt){
    $decoded = JWT::decode($jwt, "rhogro", array('HS256'));
    $id = $decoded->id;
    $accType = $decoded->accType;
    $username = $decoded->username;
    return $decoded;  
}

function decodeCookie(){
    $jwt = $_COOKIE["token"];
    return decode($jwt);
}
?>