<?php include "init.php"?>

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
        <h1>Super secret</h1>
        <p>Blaablaablaa</p>
        </article>
        <article>
            <?php
if (isset($_SESSION["username"])) {
    if ($_SESSION["username"] == "Eme") {
        echo "<h1>Emes dagbok</h1>";
        echo "<p>Inlägg 1: Idag är det min födelsedag";
    }
} else {
    echo "<p>Gå bort";
}

?>
        </article>
    </section>
</body>
</html>
