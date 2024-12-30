<?php

class user
{
    Use SQLGetterSetter;
    public $id;
    public $username;
    public $conn;
    public $table;
    public $uid;
    public $sid;
    public static function signup($first, $last, $email, $password)
    {
        $valid = false;
        //getting database connection
        $conn = database::connection();
        $username = $first . $last;
        //Using the BCRYPT hashing with time cost
        $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 9]);
        //Generate the username with first and last name of user and number
        $sql = "INSERT INTO `auth` (`username`, `firstname`, `lastname`,`email`,`password`) 
            SELECT CONCAT('$username', COUNT(`id`)), '$first', '$last','$email','$password'
            FROM `auth` WHERE `username` LIKE '$username%';";
        try {
            $conn->query($sql);
            $sql1 = "SELECT `id` FROM `auth` WHERE `email` = '$email';";
            try {
                //If User credentials has succeed Gets the user's id to create relational table
                $result = $conn->query($sql1);
                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    $id_auth = $row['id'];
                    $sql2 = "INSERT INTO `user`(`uid`,`email`,`firstname`,`lastname`) VALUES ('$id_auth','$email','$first','$last');";
                    $sql2 .="INSERT INTO `sessions`(`sid`) VALUES ('$id_auth');";
                    try {
                        $conn->multi_query($sql2);
                        $valid = true;
                    } catch (Exception $e) {
                        echo $e->getMessage()."catch from last";
                        return $valid;
                    }
                }
            } catch (Exception $e) {
                echo $e->getMessage(). "catch from second";
                return $valid;
            }
            return true;
        } catch (Exception $e) {
            echo $e->getMessage()." catch from first query";
            return $valid;
        }
    }
    /**
     * login authentication
     *
     * @param String $input1
     * @param String $password
     * @return String  returns username if the authencation success or false
     */
    public static function login($input1, $password)
    {
        //Getting the database connection
        $conn = database::connection();
        $sql = "SELECT * FROM `auth` WHERE `email` = '$input1' OR `username` = '$input1';";
        try {
            $result = $conn->query($sql);
            if ($result->num_rows != 0) {
                $row = $result->fetch_assoc();
                //PHP password verify
                if (password_verify($password, $row['password'])) {
                    return $row['username'];
                } else {
                    return false;
                }
            }
        } catch (Exception $e) {
            return false;
        }
    }
    /**
     * Construct Username and id with either email or username  
     *
     * @param String $input
     */
    public function __construct($enter)
    {
        $this->table = 'user';
        $this->conn = database::connection();
        $sql = "SELECT * FROM `auth` WHERE `email` = '$enter' OR `username` = '$enter' or `id` = '$enter';";
        try {
            $result = $this->conn->query($sql);
            if ($result->num_rows==1) {
                $row = $result->fetch_assoc();
                $this->id = $row['id'];
                $this->username = $row['username'];
            }

        } catch (Exception $e) {
            echo "query error happen";
        }
    }
}
