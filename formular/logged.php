<?php
if(!isset($_COOKIE["token"])){
    header('Location:login.html');
    die();
}
?>
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
        include ($_SERVER['DOCUMENT_ROOT'].'/connect.php');
        include 'decode_token.php';
        $user = decodeCookie();
        if($user->accType == "creator"){
            echo "Welcome creator ".$user->username."<br>\n";
            echo "<a href=newForm.php> Create new form </a> <br>\n";
            $sql = $conexiune->prepare("SELECT name, form_id FROM forms WHERE user_id=?");
            $sql->bind_param("s", $user->id);  /* bind parameters for markers */
            $sql->execute();                        /* execute query */
            $sql->bind_result($rez_name, $rez_id);

            echo "<table>
            \n\t <caption> Your Forms </caption>
            \n\t <tr>
            \n\t\t<th>Form name</th>
            \n\t\t<th>Action</th>
            \n\t</tr>";
            while($sql->fetch())
            {
                echo"
                \n\t<tr>
                \n\t\t<td>".$rez_name."</td>
                \n\t\t<td> <a href=#> Modify </a> <a href=#> Delete </a> </td>
                \n\t</tr>";
            }
            echo "\n </table>";
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

