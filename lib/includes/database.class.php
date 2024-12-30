<?php

class database
{
    public static $conn = null;
    public static function connection()
    {
        $Server_name = get_config("server_name");
        $user = get_config("user");
        $password = get_config("password");
        $db_name = get_config("db_name");
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
