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
        <h1>Cookies</h1>
        </article>
        <article>
            <?php

$username = $_SERVER["REMOTE_USER"];
$username = get_current_user();

$firstVisit = time();
$latestVisit = time();
setcookie("name", $username, time() + (86400 * 30), "/", "", 0);
setcookie("latestVisit", $latestVisit, time () + (86400 * 30), "/");

if (!isset($_COOKIE["firstVisit"])) {
    setcookie("firstVisit", $firstVisit, time() + (86400 * 30), "/");
}

if (isset($_COOKIE["name"])) {
    echo "Welcome " . $_COOKIE["name"] . "<br>";
    echo "<p>Du var här senast: " . date("H:i:s d.m.Y", $_COOKIE["latestVisit"]);
    echo "<p>Du var här första gången: " . date("H:i:s d.m.Y", $_COOKIE["firstVisit"]);
} else {
    echo "Sorry no cookies";
}

?>
        </article>
    </section>
</body>
</html>
