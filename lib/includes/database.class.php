<?php

class database
{
    public static $conn = null;
    public static function connection()
    {
        $Server_name = "localhost";
        $user = "root";
        $password = "";
        $db_name = "readandcatch";
        try {
            if (database::$conn != null) {
                return database::$conn;
            } else {
                $connection = new mysqli($Server_name, $user, $password, $db_name);
                if (!($connection->connect_error)) {
                    database::$conn = $connection;
                    return database::$conn;
                }
                throw new Exception("Connection error occured");
            }
        } catch (Exception $exp) {
            return false;
        }
    }
}
