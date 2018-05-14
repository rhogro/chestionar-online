<?php
require 'test_token.php';
    echo "create new form";
?>

<!DOCTYPE html>

<html>
<head>
    <title>New Form</title>
    <meta charset="utf-8">
</head>
<body>
    <h1> New Form </h1>
    <form action="newForm_handler.php" method="post">
        <table>
            <tr>
                <td> Form name: </td>
                <td>
                    <input type="text" name="formName">
                </td>
            </tr>
        </table>
        <input type="submit" value="Add Question">
        <br><br>
    </form>
</body>
</html>
