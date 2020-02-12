<?php include "init.php"?>
<?php include "head.php"?>

<body>
    <section>
    <?php include "navbar.php"?>

        <article>
        <h1>Hämta data</h1>
            <?php include "users.php" ?>
        </article>
        <h1>Sälj varor</h1>
<p>Var god och mata in varorna</p>
<form action="index.php" method="post">
Rubrik: <br><input type="text" name="rubrik" required><br>
Beskrivning: <br><input type="text" name="beskr" required><br>
Pris: <br><input type="text" name="pris" required><br>

<input type="submit" value="Mata in" />
</form>
<?php include "insert.php" ?>

<h1>Registrera dig</h1>
<p>Mata in information</p>
<form action="index.php" method="post" required>
Användarnam: <input type="text" name="regusername" required><br>
Lösenord: <input type="password" name="regpass" required><br>
Epost: <input type="text" name="regemail" required><br>
<input type="submit">
</form>
<?php include "register.php"?>


<h1>Be om nytt lösenord</h1>
<p>Mata in information</p>
<form action="index.php" method="post" required>
Användarnam: <input type="text" name="resusername" required><br>
<input type="submit">
</form>
<?php include "passreset.php"?>

<?php
if (isset($_SESSION["role"])) {
if ($_SESSION["role"] == "admin" || $_SESSION["role"] == "editor") {
    ?>
<h1>Editera varorna</h1>
<form action="index.php" method="post" required>
ID för varan: <input type="text" name="editId" required><br>
<input type="submit">
</form>
<?php include "editdb.php"?>

<?php 
} else {
    print "<h1>Logga in som admin eller editor för att editera!";
}
}

?>
<h1>Radera inlägg</h1>
<p>Du kan radera dina egna inlägg</p>
<?php include "delete.php"?>

<form action="index.php" method="post" required>
ID som du vill radera: <input type="text" name="deleId" required><br>
<input type="submit">
</form>

<h1>Leta i databasen</h1>
<?php include "search.php"?>

<form action="index.php" method="post" required>
Rubrik eller beskrivning: <input type="text" name="search" required><br>
<input type="submit">
</form>






    </section>
</body>
</html>
