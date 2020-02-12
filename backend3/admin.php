<?php include "init.php"?>
<?php include "head.php"?>
<?php include "navbar.php"?>


<?php

$conn = create_conn();

if (isset($_SESSION["username"])) {
if ($_SESSION["role"] == "admin") {
    echo "<h1>Redigera användare</h1>";

    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"] . " - Name: " . $row["namn"] . " - Email: " . $row["epost"] . " - Status: " . $row["status"]. " - Role: " . $row["roll"]. "<br>";
        }
    } else {
        echo "0 results";
    }
    if (isset($_POST["editUserId"])) {
        $id = test_input($_POST["editUserId"]);
        
    $sql = "SELECT * FROM users WHERE id = '$id'";
    
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $namn = $row["namn"];
    $epost = $row["epost"];
    $roll = $row["roll"];
    $status = $row["status"];
    

    ?>

<form action="admin.php" method="post" required>
<input type="hidden" name="id" value='<?php echo $id ?>'>
  Namn: <input type="text" name="newName" value='<?php echo $namn ?>'><br>
  Epost: <input type="text" name="newMail" value='<?php echo $epost ?>'><br>
  Roll: <select name="newRole">
    <option value="admin">Admin</option>
    <option value="editor">Editor</option>
    <option value="user">User</option>
  </select><br>
  Status: <select name="newStat">
    <option value="confirmed">Confirmed</option>
    <option value="unconfirmed">Unconfirmed</option>
  </select><br>
  <input type="submit">
</form>
<form action="admin.php" method="post">
<input type="hidden" name="id" value='<?php echo $id ?>'>
  <input type="submit" value="Radera användaren!" name="delUser">
</form>


<?php


} else {
    echo '<form action="admin.php" method="post" required>
ID som du vill redigera: <input type="text" name="editUserId" required><br>
<input type="submit">
</form>';
}
if (isset($_POST["newName"])) {
    $newName = test_input($_POST["newName"]);
    $newMail = test_input($_POST["newMail"]);
    $newRole = test_input($_POST["newRole"]);
    $newStat = test_input($_POST["newStat"]);
    $id = test_input($_POST["id"]);

$stmt = $conn->prepare("UPDATE users SET namn = ?, epost = ?, roll = ?, status = ? WHERE id = ?");
$stmt->bind_param("ssssi", $newName, $newMail, $newRole, $newStat, $id);



if ($stmt->execute()) {
    print "Användaren är uppdaterad";
} else {
    print "Något gick fel";
}

}
if (isset($_POST["delUser"])) {
    $deleId = test_input($_POST["id"]);

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $deleId);
    if ($stmt->execute()) {
        print "Användaren har raderats!";
    } else {
        print "Något gick fel";
    }
    

}
echo "<h1>Redigera varor</h1>";

if ($_SESSION["role"] == "admin") {
    $sql = "SELECT * FROM loppis";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"] . " - Rubrik: " . $row["rubrik"] . " - Beskrivning: " . $row["beskrivning"] . " - Saljare: " . $row["saljare"]. " - Pris: " . $row["pris"]. "<br>";
        }
    } else {
        echo "0 results";
    }

    if (isset($_POST["editId"])) {
        $id = test_input($_POST["editId"]);
        
    $sql = "SELECT * FROM loppis WHERE id = '$id'";
    
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $rubrik = $row["rubrik"];
    $beskr = $row["beskrivning"];
    $salj = $row["saljare"];
    $pris = $row["pris"];
    
    
    
    
    echo "<h3>id: " . $row["id"]. "</h3>";
    ?>
    
    <form action="admin.php" method="post" required>
    <input type="hidden" name="id" value='<?php echo $id ?>'>
      Rubrik: <input type="text" name="newRub" value='<?php echo $rubrik ?>'><br>
      Beskrivning: <input type="text" name="newBes" value='<?php echo $beskr ?>'><br>
      Säljare: <input type="text" name="newSalj" value='<?php echo $salj ?>'><br>
      Pris: <input type="text" name="newPris" value='<?php echo $pris ?>'><br>
      <input type="submit">
    </form>
    <form action="admin.php" method="post">
<input type="hidden" name="id" value='<?php echo $id ?>'>
  <input type="submit" value="Radera varan!" name="delStuff">
</form>


    
    
    <?php
    }
    else {
        echo '<p><form action="admin.php" method="post" required>
       <p>ID som du vill redigera: <input type="text" name="editId" required><br>
       <input type="submit">
       </form>';
       }
    if (isset($_POST["newRub"])) {
        $newRub = test_input($_POST["newRub"]);
        $newBes = test_input($_POST["newBes"]);
        $newSalj = test_input($_POST["newSalj"]);
        $newPris = test_input($_POST["newPris"]);
        $id = test_input($_POST["id"]);
    
    $stmt = $conn->prepare("UPDATE loppis SET rubrik = ?, beskrivning = ?, saljare = ?, pris = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $newRub, $newBes, $newSalj, $newPris, $id);
    
    
    
    if ($stmt->execute()) {
        print "Varan är uppdaterad";
    } else {
        print "Något gick fel";
    }
    
    
    } 

    if (isset($_POST["delStuff"])) {
        $deleId = test_input($_POST["id"]);
    
        $stmt = $conn->prepare("DELETE FROM loppis WHERE id = ?");
        $stmt->bind_param("i", $deleId);
        if ($stmt->execute()) {
            print "Varan har raderats!";
        } else {
            print "Något gick fel";
        }
        
    
    }
    
$conn->close();

}
}
} else {
    echo "Du är inte admin";
}
