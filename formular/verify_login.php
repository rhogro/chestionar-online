<?php 
require_once 'inc/2fa.php';
 
$auth = new userAuth();
if (!empty($_GET['token'])) {
	$token = $_GET['token'];
	//.......
	// do your data santization here
	//.......
	   
	// pass along to be validated
	$auth->validLink($token);
}else{
	echo "don't try to cheat!";
}

?>