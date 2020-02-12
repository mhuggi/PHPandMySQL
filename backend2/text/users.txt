<?php
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
echo "Lista på användare<br>";

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["namn"]. " " . $row["epost"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();




?>