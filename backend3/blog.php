<?php include "init.php"?>
<?php include "head.php"?>
<?php include "navbar.php"?>

<article>
        <h1>Inlägg</h1>
        <form action="blog.php" method="post">
        Rubrik: <input type="text" name="rubrik" required><br>
        Text: <input type="text" name="comm" required><br>
        <input type="submit">
    </form>
</article>

<article>

<?php
$conn = create_conn();
$sql = "SELECT * FROM blog ORDER BY time DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<h3>" . $row["rubrik"] . "</h3>";
        echo "<p>" . $row['com'] . "<br> Skrivet av: "
            . $row['user'] . "</p>";
        echo $row['undrcom'] . "<br>";
        echo '<form method="post">
            <input type="hidden" name="id" value=' . $row["id"] . '>
            Kommentar: <input type="text" name="newComm" >
            <input type="submit">
        </form>';

    }
} else {
    echo "0 results";
}
$conn->close();

if (isset($_POST["newComm"])) {
    $id = test_input($_POST["id"]);
    $conn = create_conn();
    $sql = "SELECT * FROM blog WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $undrcom = $row['undrcom'] . $_SESSION["username"] . ": " . $_POST["newComm"] . "<br>";

    $stmt = $conn->prepare("UPDATE blog SET undrcom = ? WHERE id = ?");
    $stmt->bind_param("si", $undrcom, $id);
    if ($stmt->execute()) {
        ?>
            <script type="text/javascript">
            window.location.href = 'blog.php';
            </script>
<?php

    } else {
        print "Något gick fel";
    }

    $conn->close();
}

if (isset($_SESSION["username"])) {
    if (isset($_POST['comm'])) {
        $conn = create_conn();
        $comm = test_input($_POST["comm"]);
        $usrn = $_SESSION["username"];
        $rubrik = test_input($_POST["rubrik"]);

        $stmt = $conn->prepare("INSERT INTO blog (rubrik, user, com) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $rubrik, $usrn, $comm);

        if ($stmt->execute()) {
            ?>
            <script type="text/javascript">
            window.location.href = 'blog.php';
            </script>
<?php
} else {
            print "Något gick fel";
        }
        $conn->close();

    }
} else {
    print "Vänligen logga in för att kommentera!";
}

echo "</article>";
?>
