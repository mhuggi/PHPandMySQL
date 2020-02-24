<?php

$conn = create_conn();
if ($_SESSION["role"] == "admin" || $_SESSION["role"] == "editor") {
    $sql = "SELECT * FROM loppis";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Rubrik: " . $row["rubrik"]. " -  Beskrivning: " . $row["beskrivning"]. "<br>";
    }
} else {
    echo "0 results";
}

if (isset($_POST["editId"])) {
    $id = test_input($_POST["editId"]);
    
$sql = "SELECT * FROM loppis WHERE id = '$id'";

$result = $conn->query($sql);
$row = $result->fetch_assoc();
$rubrik = $row["rubrik"];
$beskr = $row["beskrivning"];
$salj = $row["saljare"];
$pris = $row["pris"];




echo "id: " . $row["id"];
?>

<form action="index.php" method="post" required>
<input type="hidden" name="id" value='<?php echo $id ?>'>
  Rubrik: <input type="text" name="newRub" value='<?php echo $rubrik ?>'><br>
  Beskrivning: <input type="text" name="newBes" value='<?php echo $beskr ?>'><br>
  Säljare: <input type="text" name="newSalj" value='<?php echo $salj ?>'><br>
  Pris: <input type="text" name="newPris" value='<?php echo $pris ?>'><br>
  <input type="submit">
</form>



<?php
}
if (isset($_POST["newRub"])) {
    $newRub = test_input($_POST["newRub"]);
    $newBes = test_input($_POST["newBes"]);
    $newSalj = test_input($_POST["newSalj"]);
    $newPris = test_input($_POST["newPris"]);
    $id = test_input($_POST["id"]);

$stmt = $conn->prepare("UPDATE loppis SET rubrik = ?, beskrivning = ?, saljare = ?, pris = ? WHERE id = ?");
$stmt->bind_param("ssssi", $newRub, $newBes, $newSalj, $newPris, $id);



if ($stmt->execute()) {
    print "Varan är uppdaterad";
} else {
    print "Något gick fel";
}

$conn->close();
}

} else {
    print "Vänligen logga in som editor eller admin för att editera!!";
}



?>