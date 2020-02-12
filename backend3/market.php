<?php include "init.php"?>
<?php include "head.php"?>
<?php include "navbar.php"?>

<?php 
//Controller
if (isset($_GET['edit'])) {
    echo '<article>';
     include "edit.php";
     echo '</article>';

} else {
    echo '<article>
    <h1>Sök på lopptorger</h1>
    <form action="market.php" method="get">
        Söksträng: <input type="text" name="query" >
        <input type="submit" value="Sök" >
</form>
</article>';
include "search.php";

}

?>
