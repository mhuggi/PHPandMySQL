<?php

$conn = create_conn();
echo "Dina upplägg:<br>";

if (isset($_SESSION["username"])) {
    $usrn = $_SESSION["username"];
    $sql = "SELECT * FROM loppis WHERE saljare = '$usrn'";

    $result = $conn->query($sql);
    $allowedId = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"] . " - Rubrik: " . $row["rubrik"] . "<br>";
            array_push($allowedId, $row["id"]);


        }
    } else {
        echo "0 results";
    }


if (isset($_POST["deleId"])) {
    $deleId = test_input($_POST["deleId"]);
    $stmt = $conn->prepare("DELETE FROM loppis WHERE id = ?");
    $stmt->bind_param("i", $deleId);
    if ($stmt->execute()) {
        print "Varan har raderats!";
    } else {
        print "Något gick fel";
    }
    
    }

}
$conn->close();
