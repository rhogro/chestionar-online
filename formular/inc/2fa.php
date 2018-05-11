<?php
// require the autoloader that composer created
require_once 'vendor/autoload.php';
include ($_SERVER['DOCUMENT_ROOT'].'/connect.php');
 
// use the firebase JWT Library previous installed using composer
use \Firebase\JWT\JWT;
 
// create a class for easy code structure and use
class userAuth {
	
	private $id;
	private $username;
	private $accType;
 
	// key for JWT signing and validation, shouldn't be changed
	private $key = "rhogro";

	// Checks if the user exists in the database
	private function validUser($username, $password) {
		global $conexiune;
		// doing a user exists check with minimal to no validation on user input
		$query = mysqli_query($conexiune, "SELECT * FROM users WHERE username ='$username' AND password = '$password'");
		$res=mysqli_fetch_assoc($query);
		if($res){
			// Add user username and id and type to empty username and id variable and return true
			$this->id = $res['id'];
			$this->username = $res['username'];
			$this->accType = $res['accType'];
    
			return true;
		} else {
			echo 'user-password combination not found';
			return false;
		}
	}

	// Generates and signs a JWT for User
	private function genJWT() {
		// Make an array for the JWT Payload
		$payload = array(
			"id" => $this->id,
			"username" => $this->username,
			"accType" => $this->accType,
			"exp" => time() + (60 * 60 * 12)	//12 hours
		);
 
		// encode the payload using our secretkey and return the token
		return JWT::encode($payload, $this->key);
	}

	// sends signed token in username to user if the user exists
	public function createLink($username, $password) {
		// check if the user exists
		if ($this->validUser($username, $password)) {
			// generate JSON web token and store as variable
			$token = $this->genJWT();
			// create link
			$link = 'http://localhost/formular/verify_login.php?token='.$token;
			header("Location: ".$link);
			die();
		} else {
			return 'We Couldn\'t Find You In Our Database. Maybe Wrong username/Password Combination';
		}
  
	}

	// Validates a given JWT from the user username
	private function validJWT($token) {
		$res = array(false, '');
		// using a try and catch to verify
		try {
			$decoded = JWT::decode($token, $this->key, array('HS256'));
		} catch (Exception $e) {
			return $res;
		}	
		$res['0'] = true;
		$res['1'] = (array) $decoded;
		return $res;
	}
 
 
	public function validLink($token) {
		// checks if an username is valid
		$tokenVal = $this->validJWT($token);
 
		// check if the first array value is true
		if ($tokenVal['0']) {
			// create user session and all that good stuff
			setcookie("token",$token,time()+60*60*12,"/");
			header("Location: logged.php");
			die();
		} else {
			return "There was an error validating your username. Send another link";
		}
	}
} 
?>