<?php
// Connection parameters
$host = "";
$user = "";
$password = "";
$database = "";

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if image has been uploaded
if (isset($_POST['upload'])) {
    // Get image details
    $imageName = $_FILES['image-file']['name'];
    $imageType = $_FILES['image-file']['type'];
    $imageData = addslashes(file_get_contents($_FILES['image-file']['tmp_name']));
    $detail = [$_POST['idbook'],$_POST['idauthor'],$_POST['idpub'],$_POST['iddop'],$_POST['idcategory'],$_POST['idabout'],$_POST['iddescription'],$_POST['idprice'],$_POST['idlang'],$_POST['idtype'],$_POST['idavailable'],$_POST['idsuggest']];
    // Insert image data into database
    $sql = "INSERT INTO `Stocks`(`bookname`, `author`, `publiser`, `dop`, `category`, `aboutauthor`, `description`, `price`, `language`, `type`, `available`, `image`,`suggest`) 
    VALUES ('$detail[0]','$detail[1]','$detail[2]','$detail[3]','$detail[4]','$detail[5]','$detail[6]',$detail[7],'$detail[8]','$detail[9]',$detail[10],'$imageData',$detail[11]);";
    if ($conn->query($sql) === TRUE) {
        echo "Image uploaded successfully";
    } else {
        echo "Error uploading image: " . $conn->error;
    }
}

$conn->close();
?>