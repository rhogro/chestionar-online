<?php/*
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
    }*/
?>

<?php


// Only process POST reqeusts.
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $formName = $_POST['formName'];
    var_dump($formName);
    $data = $_POST['data'];
    $data = json_decode($data);
    foreach($data as $questionId => $questionData) {
        //aici parcurgem intrebarile la questionID

        foreach($questionData->answers as $answers) {
            //aici parcurgem raspunsurile la questionID
        }
    }

} else {
    // Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}

?>

