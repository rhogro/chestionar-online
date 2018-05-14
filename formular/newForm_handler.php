<?php
    require 'test_token.php';
    require_once 'inc/vendor/autoload.php';
    use \Firebase\JWT\JWT;
    require ($_SERVER['DOCUMENT_ROOT'].'/connect.php'); 

    $decoded = JWT::decode($_COOKIE["token"], 'rhogro', array('HS256'));
    $form_name = $_POST['formName'];
    $user_id = $decoded->id;

    $res_name = mysqli_query($conexiune, "SELECT * FROM forms WHERE name='$form_name'");
    if(mysqli_num_rows($res_name) > 0) {
        echo "Sorry... there is a form with this name";
    }
    else{
        $query = mysqli_query($conexiune, "INSERT INTO forms (name, user_id) VALUES ('$form_name', '$user_id')");
			if($query){
				echo 'Form created!<br>';
            }
            else{		
			    echo 'Form not created. There is a problem';
            }
		}