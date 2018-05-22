<!DOCTYPE html>
<html>
	<head>
		<title> Afisare </title>
	</head>
	<body>
			<?php 
				include ($_SERVER['DOCUMENT_ROOT'].'/connect.php');
				$username=$_POST['username'];
				$email=$_POST['mail'];
				$password=sha1($_POST['password']);
				$password2=sha1($_POST['password2']);
				$accType=$_POST['accType'];
				
				$sql = $conexiune->prepare("SELECT username FROM users WHERE username = ?");
				$sql->bind_param("s", $username);
				$sql->execute();
				$sql->bind_result($rez_username);

				$sql = $conexiune->prepare("SELECT * FROM users WHERE email = ?");
				$sql->bind_param("s", $email);
				$sql->execute();
				$sql->bind_result($rez_email);

				if(mysqli_num_rows($rez_username) > 0) {
					echo "Sorry... username already taken";
					$name_error = "Sorry... username already taken"; 	
				}else if(mysqli_num_rows($res_email) > 0){
					echo "A user already registered with this email address";
					$email_error = "Sorry... email already taken"; 	
				}else if($password != $password2){
					echo "Password and verification password don't match!";
				}else{
					$sql = $conexiune->prepare("INSERT INTO users (username, email, password, accType) 
						VALUES (?, ?, ?, ?)");
					$sql->bind_param("ssss",$username, $email, $password, $accType);
					if($sql->execute()){
						echo 'Account created!<br>';
					}
					
					echo '<a href="login.html"> Go back to login page </a>';
					exit();
				}
				
			?>
	</body>
</html?