<?php
// Connection parameters
function get_image($pid)
{
        $host = get_config("server_name");
        $user = get_config("user");
        $password = get_config("password");
        $database = get_config("db_name");

    // Create connection
    $conn = new mysqli($host, $user, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the last uploaded image from the database
    $sql = "SELECT * FROM `Stocks` WHERE `pid`='$pid';";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output the image as base64-encoded data
        $row = $result->fetch_assoc();
        return base64_encode($row['image']);
    } else {
        echo "No images found in database";
    }

    $conn->close();
}

