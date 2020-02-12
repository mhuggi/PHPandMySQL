
<?php

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

if (isset($_POST["regusername"])) {

    $usrn = test_input($_POST["regusername"]);
    $pass = test_input($_POST["regpass"]);
    $pass = hash("sha256", $pass);
    $email = test_input($_POST["regemail"]);
    $role = "user";
    $status = "unconfirmed";


    $stmt = $conn->prepare("SELECT * FROM users WHERE namn = ?");
    $stmt->bind_param("s", $usrn);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Användarnamnet finns redan";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (namn, losen, epost, roll, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $usrn, $pass, $email, $role, $status);
    
    
        if ($stmt->execute()) {
            print "Ditt konto har skapats!";
        } else {
            print "Något gick fel";
        }
    }
    

    }




$conn->close();
?>