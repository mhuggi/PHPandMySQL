<?php
session_start();

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

//Databaskonfiguration
$servername = "localhost";
$username = "salmiemi";
$password = "b8L57XxHWV";
$dbname = "salmiemi"

?>