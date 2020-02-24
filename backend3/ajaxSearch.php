<?php include "init.php"?>

<?php
$conn = create_conn();

$query = "%" . $_GET["q"]. "%";
echo "Du sökte på strängen " . $query . "<br>";


$stmt = $conn->prepare("SELECT * FROM users WHERE namn LIKE ?");
$stmt->bind_param("s", $query);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<a href='ajax.php?xtraInfo=" .$row["id"]."'> Namn: " . $row["namn"]. "</a><br>";
    }
} else {
    echo "0 results";
}
$conn->close();

?>