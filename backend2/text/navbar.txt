<nav>
    <ul>
        <li><a href="./index.php">Hem</a></li>
        <li><a href="./admin.php">Admin</a></li>
        <li><a href="./rapporter.html">Rapporter</a></li>



    </ul>
</nav>
<?php
if (isset($_SESSION["username"])) {
print "Du är inloggad som: " . $_SESSION["username"];
}

?>