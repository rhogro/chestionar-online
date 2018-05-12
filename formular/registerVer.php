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
				
				$res_u = mysqli_query($conexiune, "SELECT * FROM users WHERE username='$username'");
				$res_e = mysqli_query($conexiune, "SELECT * FROM users WHERE email='$email'");

				if(mysqli_num_rows($res_u) > 0) {
					echo "Sorry... username already taken";
					$name_error = "Sorry... username already taken"; 	
				}else if(mysqli_num_rows($res_e) > 0){
					echo "A user already registered with this email address";
					$email_error = "Sorry... email already taken"; 	
				}else if($password != $password2){
					echo "Password and verification password don't match!";
				}else{
					$query = mysqli_query($conexiune, "INSERT INTO users (username, email, password, accType) 
						VALUES ('$username', '$email', '$password', '$accType')");
					if($query){
						echo 'Account created!<br>';
					}
					
					echo '<a href="login.html"> Go back to login page </a>';
					exit();
				}
				
			?>
	</body>
</html?