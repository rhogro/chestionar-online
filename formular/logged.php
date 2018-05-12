<!DOCTYPE html>

<html>
    <head>
    <meta charset="utf-8" />
    <link href="https://fonts.googleapis.com/css?family=Mitr" rel="stylesheet">    
    <title> Forms </title>  
    </head>
    <body>
        <h1> Forms </h1>
        <?php
        include 'decode_token.php';
        $user = decodeCookie();
        if($user->accType == "creator"){
            echo "Welcome creator ".$user->username."<br>\n";
            echo "<table>
            \n\t <caption> Your Forms </caption>
            \n </table>";
        }
        else if ($user->accType == "user"){
            echo "Welcome user ".$user->username."<br>";
        }
        else{
            echo "Error. Maybe unimplemented user type";
        }
        ?>
    </body>
</html>

