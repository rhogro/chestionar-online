<?php
require 'test_token.php';
?>

<!DOCTYPE html>

<html>
<head>
    <title>New Form</title>
    <meta charset="utf-8">

    <script type='text/javascript'>
        function addFields(){
            // Number of inputs to create
            var number = parseInt(document.getElementById("questionNumber").value);
            // Container <div> where dynamic content will be placed
            var container = document.getElementById("container");
            // Clear previous contents of the container
            while (container.hasChildNodes()) {
                container.removeChild(container.lastChild);
            }
          console.log(number);
            for (i=1;i<=number;i++){
                // Append a node with a random text
                container.appendChild(document.createTextNode("Question " + i));
                // Create an <input> element, set its type and name attributes
                var input = document.createElement("input");
                input.type = "text";
                input.name = "question" + i;
                container.appendChild(input);
                var btn = document.createElement("BUTTON");        // Create a <button> element
                btn.setAttribute('type', 'button');
                var btnText = document.createTextNode("Add answer");       // Create a text node
                btn.appendChild(btnText); 
                container.appendChild(btn);
                btn.answerNum = i;
                btn.setAttribute('onclick','addAnswers('+ i + ')');
                // Append a line break
                container.appendChild(document.createElement("br"));
                var answerContainer = document.createElement("div");
                container.appendChild(answerContainer);
                answerContainer.id = "answerContainer"+i;
                container.appendChild(document.createElement("br"));
            }
        }
        function addAnswers(i){
            var container = document.getElementById("answerContainer"+i);
            var para = document.createElement("p"); // Create a <p> element
            para.appendChild(document.createTextNode("Answer "));
            container.appendChild(para);
            // Create an <input> element, set its type and name attributes
            var input = document.createElement("input");
            input.type = "text";
            input.name = "answer" + i;
            container.appendChild(input);
        }
    </script>
</head>

<body>
    <h1> New Form </h1>
    <form id="ajax_contact" method="post" action="newForm_handler.php">
        <table>
            <tr>
                <td> Form name: </td>
                <td>
                    <input type="text" name="formName">
                </td>
            </tr>
            <tr>
                <td> Number of questions: </td>
                <td>
                    <input type="text" id="questionNumber" name="questionNumber">
                </td>
            </tr>
            <tr>
                <td colspan=2>
                    <a href="#" id="filldetails" onclick="addFields()">Fill Details</a>
                    <div id="container"/>
                </td>
            </tr>
        </table>
        <input type="submit" value="Finish Form">
        <br><br>
    </form>
    <script src="https://code.jquery.com/jquery-2.1.0.js" integrity="sha256-D6d1KSapXjq2tfZ6Ie9AYozkRHyB3fT2ys9mO2+4Wvc=" crossorigin="anonymous"></script>
    <script src="app.js"></script>
</body>
</html>
