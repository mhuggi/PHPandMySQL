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
        <h1>Guestbook</h1>

        <form action="guestbook.php" method="get">
        Namn: <input type="text" name="name"><br>
        Kommentar: <input type="text" name="comment"><br>
        <input type="submit">
        </form>

        </article>
        <article>
            <?php
    /*$commentFile = fopen("comments.txt", "w") or die("Could not open file");
    fclose($commentFile);
*/

if (isset($_GET["comment"])) {
    $user = test_input($_GET["name"]);
    $comment = test_input($_GET["comment"]);


    $commentFile = fopen("comments.txt", "a+") or die("Could not open file");
    $data = date("d.m.Y H:i ") . $user . ": " . $comment . "<br>";
    $data .= file_get_contents("comments.txt");
    file_put_contents("comments.txt", $data);
    

    fclose($commentFile);

    $commentFile = fopen("comments.txt", "r") or die("Could not open file");
    while(! feof($commentFile)) {
        $line = fgets($commentFile);
        echo $line. "<br>";
      }
      fclose($commentFile);


      




}

?>
        </article>
    </section>
</body>
</html>
