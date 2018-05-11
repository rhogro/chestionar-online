<?php
/********* LOCALHOST DATABASE (WAMP) *********/

// Informatii baza de date
$host = "localhost:3308"; //aici numele serverului
$user = "root"; // aici userul
$passw = ""; //parola
$db_name = "u_cristianbecker"; // numele bazei de date
$conexiune = mysqli_connect($host,$user,$passw) or
die("Nu ma pot conecta la MySQL!");
mysqli_select_db($conexiune,$db_name) or die("Nu gasesc baza de date!");
?>