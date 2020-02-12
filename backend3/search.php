<?php

if (isset($_GET["query"])) {
    $conn = create_conn();
    $search = test_input($_GET["query"]);
    $search = "%" . $search . "%";

//$sql = "SELECT * FROM loppis WHERE beskrivning LIKE '%$search%' OR rubrik LIKE '%$search%' ORDER BY datum DESC";
    $stmt = $conn->prepare("SELECT * FROM loppis WHERE beskrivning LIKE ? OR rubrik LIKE ? ORDER BY datum DESC");
    $stmt->bind_param("ss", $search, $search);
    $stmt->execute();
    $result = $stmt->get_result();


    while ($row = $result->fetch_assoc()) {
        echo "<p class='post'> Rubrik: " . $row["rubrik"] . "<br>Beskrivning: " . $row["beskrivning"] . "<br>Pris: " . $row["pris"] . "<br>";
        echo "<a href='market.php?edit=".$row['id']."'>Editera</a></p>";
        
    }
    $conn->close();

} else {
    $conn = create_conn();
    $sql = "SELECT * FROM loppis ORDER BY datum DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<p class='post'> Rubrik: " . $row["rubrik"] . "<br>Beskrivning: " . $row["beskrivning"] . "<br>Pris: " . $row["pris"] . "<br>";
            echo "<a href='market.php?edit=".$row['id']."'>Editera</a></p>";

        }
    } else {
        echo "0 results";
    }

}
