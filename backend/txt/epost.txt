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
        <h1>Registrera dig</h1>
        <form action="epost.php" method="get">
        E-post: <input type="text" name="email"><br>
        Användarnamn: <input type="text" name="username"><br>
        <input type="submit">
        </form>



        </article>
        <article>
            <?php
//phpinfo();
if (isset($_GET["email"])) {

    $passChars = array("a", "b", "c", "d", 1, 2, 3, 4, 5, "E", "F", "G", "H");

    $randomPass = array_rand($passChars, 7);
    $pass = array();

    for ($i = 0; $i < 7; $i++) {
        array_push($pass, $passChars[$randomPass[$i]]);
    }

    print "<p> Lösenord: " . implode($pass);
    $email = test_input($_GET["email"]);
    $user = test_input($_GET["username"]);
    $email = $_GET["email"];
    $user = $_GET["username"];
    print "<p> Välkommen " . $user . " med eposten " . $email . "!";
    
    $subject = "Thanks for registering";
    $message = "Thanks for registering. Your password is: " . implode($pass) . ". And username: " . $user;

    mail($email,$subject,$message);

    
} else {
    print "<p>Fyll i formuläret";
}

?>
        </article>
    </section>
</body>
</html>
