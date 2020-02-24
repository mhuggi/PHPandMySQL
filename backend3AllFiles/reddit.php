<?php include "init.php"?>
<?php include "head.php"?>
<?php include "navbar.php"?>

<article>
<article>
<?php 
if (isset($_SESSION['username'])) {
    ?>
        <h1>Ladda upp fil</h1>
        <form action="reddit.php" method="post" enctype="multipart/form-data">
        Rubrik: <input type="text" name="rubrik" id="rubrik"><br>
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload file" name="submit">
</form>

        </article>
<?php } else {
    echo "<h1>Logga in för att ladda upp files</h1>";

}
?>
        <article>
            <?php
function getNextId()
{
    $conn = create_conn();
    $sql = "SELECT * FROM files ORDER BY time DESC";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $nextId = $row["id"] + 1;
    return $nextId;
    $conn->close();

}

if (isset($_POST["submit"])) {

    $target_dir = "uploads/";
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]), PATHINFO_EXTENSION));
    $imageId = getNextId();
    $target_file = $target_dir . $imageId . "." . $imageFileType;

// Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
// Check file size
    if ($_FILES["fileToUpload"]["size"] > 10000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "mp4" && $imageFileType != "avi") {
        echo "Sorry, only JPG, JPEG, PNG, GIF, MP4 and AVI files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
if (isset($_POST["rubrik"])) {
    $conn = create_conn();

    $user = test_input($_SESSION['username']);
    $conn = create_conn();
    $stmt = $conn->prepare("SELECT * FROM users WHERE namn = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $userId = $row['id'];

    $rubrik = test_input($_POST["rubrik"]);
    $usrn = $_SESSION["username"];
    $stmt = $conn->prepare("INSERT INTO files (userID, filename, title) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $userId, $target_file, $rubrik);

    if ($stmt->execute()) {
        echo "Uppladdad!";
    } else {
        print "Något gick fel<br>";
    }
    $conn->close();

}

$conn = create_conn();

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 5;
$offset = ($pageno-1) * $no_of_records_per_page;

$total_pages_sql = "SELECT COUNT(*) FROM files";
$result = mysqli_query($conn,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

?>
<article>
        <h1>Order by</h1>
        <form action="reddit.php" method="post" enctype="multipart/form-data">
        <?php 
        if (isset($_POST['orderByUpvote'])) {
            ?>
    <input type="submit" value="Order by upvotes" name="orderByTime">
        <?php 
        $sql = "SELECT * FROM files ORDER BY time DESC LIMIT $offset, $no_of_records_per_page";
    unset($_POST['orderByUpvote']); 
    } else {
            ?>     <input type="submit" value="Order by newest post" name="orderByUpvote">
            <?php 
            $sql = "SELECT * FROM files ORDER BY votes DESC LIMIT $offset, $no_of_records_per_page";

            unset($_POST['orderByTime']);
        }


        ?>
</form>

        </article>
<?php

$res_data = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($res_data)){
    //here goes the data
    echo "<h2>" . $row["title"] . "</h2>Upvotes: " . $row["votes"] . "<br>";
    $imgId = $row['id'];
    echo "<a href='reddit.php?upvote=" . $imgId . "'>
    <button>Upvote</button>
</a>";
    echo "<a href='reddit.php?downvote=" . $imgId . "'>
<button>Downvote</button>
</a><br>";

    echo "<a href='" . $row['filename'] . "'><img src='" . $row['filename'] . "' width='300px'></a>";

    }

mysqli_close($conn);
?>
<ul class="pagination">
<li><a href="?pageno=1">First</a></li>
<li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
    <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
</li>
<li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
    <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
</li>
<li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
</ul>
<?php

if (isset($_GET["upvote"])) {

    $id = test_input($_GET["upvote"]);
    $conn = create_conn();
    $stmt = $conn->prepare("SELECT * FROM files WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $upvotes = $row["votes"] + 1;

    $stmt = $conn->prepare("UPDATE files SET votes = ? WHERE id = ?");
    $stmt->bind_param("ii", $upvotes, $id);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>             <script type="text/javascript">
    window.location.href = 'reddit.php';
    </script>
<?php

} else if (isset($_GET["downvote"])) {
    $id = test_input($_GET["downvote"]);
    $conn = create_conn();
    $stmt = $conn->prepare("SELECT * FROM files WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $downvotes = $row["votes"] - 1;

    $stmt = $conn->prepare("UPDATE files SET votes = ? WHERE id = ?");
    $stmt->bind_param("ii", $downvotes, $id);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>             <script type="text/javascript">
    window.location.href = 'reddit.php';
    </script>
<?php

}

?>