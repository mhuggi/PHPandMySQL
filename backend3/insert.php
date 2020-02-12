

<?php
$conn = create_conn();

if (isset($_SESSION["username"])) {
if (isset($_POST['pris'])) {

    $rubrik = test_input($_POST["rubrik"]);
    $beskr = test_input($_POST["beskr"]);
    $salj = $_SESSION["username"];
    $pris = test_input($_POST["pris"]);

    $stmt = $conn->prepare("INSERT INTO loppis (rubrik, beskrivning, saljare, pris) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $rubrik, $beskr, $salj, $pris);

    if ($stmt->execute()) {
        print "Din anons har lagts upp!";
    } else {
        print "Något gick fel";
    }

} 
}
else {
    print "Vänligen logga in för att sälja saker!";
}

$conn->close();


?>