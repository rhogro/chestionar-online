<?php

// Example of decoding JWT Web Token with public key
// Package: https://github.com/firebase/php-jwt

require_once 'inc/vendor/autoload.php';

use \Firebase\JWT\JWT;

function decode($jwt, $key){
    $decoded = JWT::decode($jwt, $key, array('HS256'));
    $id = $decoded->id;
    $accType = $decoded->accType;
    $username = $decoded->username;

    echo "<br>username: ".$username."<br>account type: ".$accType;  
    return $decoded;  
}
?>