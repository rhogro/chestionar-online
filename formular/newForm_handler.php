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
    // Get the form fields and remove whitespace.
    $name = strip_tags(trim($_POST["name"]));
            $name = str_replace(array("\r","\n"),array(" "," "),$name);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Check that data was sent to the mailer.
    if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Set a 400 (bad request) response code and exit.
        http_response_code(400);
        echo "Oops! There was a problem with your submission. Please complete the form and try again.";
        exit;
    }

    // Set the recipient email address.
    // FIXME: Update this to your desired email address.
    $recipient = "hello@example.com";

    // Set the email subject.
    $subject = "New contact from $name";

    // Build the email content.
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Build the email headers.
    $email_headers = "From: $name <$email>";

    // Send the email.
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // Set a 200 (okay) response code.
        http_response_code(200);
        echo "Thank You! Your message has been sent.";
    } else {
        // Set a 500 (internal server error) response code.
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }

} else {
    // Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}

?>

