<?php

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

if (isset($_POST["resusername"])) {
    $usrn = test_input($_POST["resusername"]);
    
$sql = "SELECT * FROM users WHERE namn = '$usrn'";

$result = $conn->query($sql);
$row = $result->fetch_assoc();
$resname = $row["namn"];
$losen = hash('sha256', 'nylosen');

$stmt = $conn->prepare("UPDATE users SET losen = ? WHERE namn = ?");
$stmt->bind_param("ss", $losen, $resname);


if ($stmt->execute()) {
    print "Ditt nya lösenord är: nylosen";
} else {
    print "Något gick fel";
}

$conn->close();


}




?>