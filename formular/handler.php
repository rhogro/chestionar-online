<?php
 
require_once 'inc/2fa.php';
 
$auth = new userAuth();
 
if (!empty($_POST)) {
  $username = $_POST['username'];
  $password = sha1($_POST['password']);
  //.......
  // do your data santization and validation here
  // Like check if values are empty or contain invalid characters
  //.......
 
  // If everything is valid, redirect to page
  echo $auth->createLink($username, $password);
 
} 
 ?>