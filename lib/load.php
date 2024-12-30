<?php
/**
 * including the libary files in the one module
 */
include_once 'includes/database.class.php';
include_once 'includes/sessions.class.php';
include_once 'includes/trait.class.php';
include_once 'includes/user.class.php';
include_once 'includes/usersession.class.php';
include_once 'includes/webapi.class.php';  
include_once 'includes/trait2.class.php';
include_once 'includes/stock.class.php'; 
include_once 'includes/advertise.class.php';
include_once 'includes/feedback.class.php';
include_once 'includes/cart.class.php';
include_once 'includes/history.class.php';

/**
 * Create an object for webAPI and gets configuration file in varible
 * and initilise the session
 */
$wapi = new webapi();
$wapi->init_session();
/**
 * Reading the json configuration and decode it.
 *
 * @param String $key
 * @return String   Returns the value of the key and return false if it fails
 */
function get_config($key)
{
    //using the global variable which assigns the json file in webAPI
    global $__site_config;
    $array = json_decode($__site_config, true);
    if (isset($array[$key])) //check whether the key is availble or not
        return $array["$key"]; //returns the value of the key
    else
        return false;
}
// Connection parameters
function get_image($pid)
{
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "readandcatch";

    // Create connection
    $conn = new mysqli($host, $user, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the last uploaded image from the database
    $sql = "SELECT * FROM `Stocks` WHERE `pid`=$pid;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output the image as base64-encoded data
        $row = $result->fetch_assoc();
        return '<img src="data:' . 'image/jpeg' . ';base64,' . base64_encode($row['image']) . '" />';
    } else {
        echo "No images found in database";
    }

    $conn->close();
}