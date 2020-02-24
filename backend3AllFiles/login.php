<?php include "head.php" ?>
<?php include "init.php" ?>
<?php include "navbar.php" ?>

<?php
$conn = create_conn();

if (isset($_POST["logusername"])) {
    $usrn = test_input($_POST["logusername"]);
    $pass = test_input($_POST["logpass"]);
    
    $passHash = hash('sha256', $pass);


    
$sql = "SELECT * FROM users WHERE namn = '$usrn'";




$result = $conn->query($sql);
}

if (isset($_SESSION["username"])) {
print "Du är inloggad som: " . $_SESSION["username"];
print '<form action="logout.php">
    <input type="submit" value="Logga ut" />
</form>';



} else {
    print '<article>
<form action="login.php" method="post">
Användarnam: <br><input type="text" name="logusername"><br>
Lösenord:<br><input type="password" name="logpass"><br>
<input type="submit" value="Logga in">
</form>

</article>';

}

        if (isset($_POST["logusername"])) {

$row = $result->fetch_assoc();
if ($passHash == $row["losen"]) {
    echo "Välkommen " . $row["namn"] . "<br>";
    
    $_SESSION["username"] = $usrn;
    $_SESSION["role"] = $row["roll"];
    print "Du loggas in om 2 sekunder";
    header("refresh:2;url=index.php");

} else {
    echo "Fel lösenord";

} 
        }

/*if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if (isset($_GET["logusername"])) {
            if ($pass == $row["losen"]) {
                echo "Hej " . $row["namn"] . " rätt lösenord";
            break;
            } else {
                echo "Fel lösenord";

            } 
        }

    }
} else {
    echo "0 results";
}

*/
