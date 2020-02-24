<?php include "init.php"?>
<?php include "head.php"?>
<?php include "navbar.php"?>


<script>
function getData(str) {
    if (str.length == 0) {
        document.getElementById("ajaxData").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("ajaxData").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "ajaxSearch.php?q="+str, true);
        xmlhttp.send();
    }
}
</script>
<article>
<h1>Skriv in text för att läta på användare</h1>
<input type="text" name="users" oninput="getData(this.value)">
</article>
<article>
<?php 
if (isset($_GET['xtraInfo'])) {
    $id = test_input($_GET['xtraInfo']);
    $conn = create_conn();
    $stmt = $conn->prepare("SELECT * FROM users WHERE id LIKE ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

echo "ID: " . $row['id'] . "<br> Namn: " . $row['namn'] . "<br> Epost: " .$row['epost'] . "<br> Roll: " . $row['roll'];

} 
?>
</article>
<article>


<div id="ajaxData">Här kommer tillägsinformation</div>
</article>