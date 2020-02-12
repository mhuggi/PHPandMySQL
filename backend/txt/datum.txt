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
        <h1>Datum</h1>
        <p>Uppg 3</p>
        <form action="datumRakna.php" method="get">
        Dag: <input type="text" name="day"><br>
        Månad: <input type="text" name="month"><br>
        År: <input type="text" name="year"><br>
        <input type="submit">
        </form>



        </article>
        <article>
            <?php
                //phpinfo();

            ?>
        </article>
    </section>
</body>
</html>
