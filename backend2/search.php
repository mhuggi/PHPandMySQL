<?php

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

if (isset($_POST["search"])) {
    $search = test_input($_POST["search"]);
    
$sql = "SELECT * FROM loppis WHERE beskrivning LIKE '%$search%' OR rubrik LIKE '%$search%'";
//$sql = "SELECT * FROM loppis";

echo "Du sökte: ". $search. "<br>";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Rubrik: " . $row["rubrik"]. " - Beskrivning: " . $row["beskrivning"] . " - Pris: " . $row["pris"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();

}




?>