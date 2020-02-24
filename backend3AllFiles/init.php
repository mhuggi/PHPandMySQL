<?php
session_start();

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  function create_conn() {
    $servername = "localhost";
$username = "salmiemi";
$password = "b8L57XxHWV";
$dbname = "salmiemi";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset('utf-8');
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
return $conn;

  }
//Databaskonfiguration
?>