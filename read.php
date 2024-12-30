<?php
// Connect to the MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "readandcatch";
global $imageSrc;
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Retrieve the blob data from the database
$sql = "SELECT * FROM `Stocks` WHERE `pid`=1;";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the blob data from the database
$sql = "SELECT * FROM `Stocks` WHERE `pid`=1;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // Construct an Image object from the result set
    $row = $result->fetch_assoc();
    $id = $row["pid"];
    $imageSrc = $row["image"];
}

$conn->close();
?>

<!-- Render the image in the HTML page -->
<html>

<head>
    <title>PHP Blob Image Example</title>
</head>

<body>
    <img src="<?php echo $imageSrc; ?>" />
</body>

</html>