<?php
$token = $_COOKIE["token"];
include 'decode_token.php';
decode($token, "rhogro");
//test
?>