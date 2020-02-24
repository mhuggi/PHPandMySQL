<?php include "init.php"?>
<?php include "head.php"?>
<?php include "navbar.php"?>

<?php
//Controller
if (isset($_SESSION['username'])) {
    //if ($_GET['user'] == $_SESSION['username']) {
        $user = test_input($_SESSION['username']);

$conn = create_conn();
$stmt = $conn->prepare("SELECT * FROM users WHERE namn = ?");
$stmt->bind_param("s", $user);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

echo "Användare: " . $row['namn'] . "<br>";
echo "Epost: " . $row['id'] . "<br>";

$userId = $row['id'];

$stmt = $conn->prepare("SELECT * FROM files WHERE userID = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

echo "Användare: " . $row['filename'] . "<br>";
echo "<img src='" . $row['filename'] . "'";
        echo '<article>
        <h1>Ladda upp fil</h1>
        <form action="profile.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload file" name="submit">
</form>

        </article>
';
include "filer.php";

$filer = scandir($target_dir);
print_r($filer);

    } else {
        echo "Du försöker se på nån annans profil";
    }

//}

?>
