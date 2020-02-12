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
        <h1>Sessioner</h1>
        <p>Var god och logga in</p>
        <form action="session.php" method="get">
        Användarnam: <input type="text" name="username"><br>
        Lösenord: <input type="password" name="pass"><br>
        <input type="submit">
        </form>

        </article>
        <article>
            <?php
if (isset($_SESSION["username"])) {
    if ($_SESSION["username"] == "Eme") {
        echo "<h1>Du är inloggad som Eme</h1>";
        echo "<p><a href='./hemlis.php'>Min dagbok</a> ";
    }
} 

if (isset($_GET["username"])) {
    $usrn = test_input($_GET["username"]);
    $pass = test_input($_GET["pass"]);

    if ($usrn == "Eme") {
        echo "<p>Eme";
        $_SESSION["username"] = $usrn;
        $_SESSION["password"] = $pass;

        echo "<p><a href='./hemlis.php'>Min dagbok</a> ";
    } else {
        echo "Unknown user";
    }

}

?>
        </article>
    </section>
</body>
</html>
