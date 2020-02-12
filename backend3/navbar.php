<body>
    <section>
        <header>
            <a href="./"><img src="logo.png" id="logo" alt="Emil site" /></a>
            <nav>
    <ul>
        <li><a href="./index.php">Hem</a></li>
        <li><a href="./market.php">Loppis</a></li>

        <li><a href="./admin.php">Admin</a></li>
        <li><a href="./rapporter.html">Rapporter</a></li>
        <?php
if (isset($_SESSION["username"])) {
    print "<li><a href='logout.php'>Logga ut</a></li>";

print "<li class='logged'>User: " . $_SESSION["username"]. " <br>";
print "Role: " . $_SESSION["role"]. "</li>";
} else {

    print "Du är inte inloggad";
    print "<li><a href='login.php'>Logga in</a></li>";
    
}

?>


    </ul>
</nav>
</header>



