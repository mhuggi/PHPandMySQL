<?php include "init.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <section>
    <?php include "navbar.php"?>

        <article>
        <h1>Hem</h1>
        <p>Första sida</p>
        </article>
        <article>
            <?php
//phpinfo();
if (isset($_SESSION["username"])) {
    if ($_SESSION["username"] == "Eme") {
        echo "<h1>Du är inloggad som Eme</h1>";
    }
}

print "<h2>Uppg 1 </h2>";
$user = $_SERVER["REMOTE_USER"];
$ipAddr = $_SERVER['REMOTE_ADDR'];
$srvSoftwr = $_SERVER['SERVER_SOFTWARE'];
$srvSign = $_SERVER['SERVER_SIGNATURE'];
print "Välkommen " . $user . "<br>";
print "Din ip är " . $ipAddr . "<br>";
print "Apache version: " . $srvSoftwr . "<br>";
print "Signature: " . $srvSign;

print "<h2>Uppg 2</h2>";
print "<p>Datum</p>";
$months = array("Januari", "Februari", "Mars", "April", "Maj", "Juni", "Juli", "Augusti", "September", "Oktober", "November", "December");
$days = array("Måndag", "Tisdag", "Onsdag", "Torsdag", "Fredag", "Lördag", "Söndag");


$date = new DateTime();
$week = $date->format("W");
$month = date("m");

for ($i = 0; $i < $month; $i++) {
    if ($i == ($month - 1)) {
        $monthText = $months[$i];
    }
}
$dayOfWeek = date("N", time());

$weekDay = $days[$dayOfWeek - 1];
print "<p>". $weekDay . " ";
print date("d ");
print $monthText;
print date(" Y");
print "<br> Vecka: " . $week;


print "<h2>Uppg 8</h2>";
print "<p>Besökräknare</p>";

include "besok.php";





?>
        </article>
    </section>
</body>
</html>
