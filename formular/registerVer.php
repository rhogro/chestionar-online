<!DOCTYPE html>
<html>
	<head>
		<title> Afisare </title>
	</head>
	<body>
			<?php 
				include "connect.php";
				$username=$_POST['username'];
				$email=$_POST['mail'];
				$password=sha1($_POST['password']);
				$accType=$_POST['accType'];
				
				$res_u = mysqli_query("SELECT * FROM users WHERE username='$username'");
				$res_e = mysqli_query("SELECT * FROM users WHERE email='$email'");

				if(mysqli_num_rows($res_u) > 0) {
					echo "Sorry... username already taken";
					$name_error = "Sorry... username already taken"; 	
				}else if(mysqli_num_rows($res_e) > 0){
					echo "A user already registered with this email address";
					$email_error = "Sorry... email already taken"; 	
				}else{
					$query = mysqli_query("INSERT INTO users (username, email, password, accType) 
						VALUES ('$username', '$email', '$password', '$accType')");
					$results = mysqli_query($db_name, $query);
					if($query){
						echo 'Account created!<br>';
					}
					
					echo '<a href="http://webspace.ulbsibiu.ro/cristian.beckert/formular/login.html"> Go back to login page </a>';
					exit();
				}
				
			?>
	</body>
</html?