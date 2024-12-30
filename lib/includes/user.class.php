<?php

class user
{
    use SQLGetterSetter;
    public $id;
    public $username;
    public $conn;
    public $table;
    public $uid;
    public $sid;
    public static function signup($first, $last, $email, $password)
    {
        $conn = database::connection();
        $username = $first . $last;
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 9]);

        try {
            // Generate unique username by appending a random number
            $stmt = $conn->prepare("INSERT INTO `auth` (`username`, `firstname`, `lastname`, `email`, `password`) 
                                VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $username, $first, $last, $email, $hashedPassword);
            $stmt->execute();

            // Fetch the user's ID
            $userId = $conn->insert_id;

            // Insert into related tables
            $stmt = $conn->prepare("INSERT INTO `user`(`uid`, `email`, `firstname`, `lastname`) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isss", $userId, $email, $first, $last);
            $stmt->execute();

            $stmt = $conn->prepare("INSERT INTO `sessions`(`sid`) VALUES (?)");
            $stmt->bind_param("i", $userId);
            $stmt->execute();

            return true;
        } catch (Exception $e) {
            // Log the error and handle appropriately
            error_log("Signup error: " . $e->getMessage());
            return false;
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
        // Getting the database connection
        $conn = database::connection();
        $sql = "SELECT * FROM `auth` WHERE `email` = ? OR `username` = ?";

        try {
            // Using prepared statements to prevent SQL Injection
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $input1, $input1); // Binding parameters (s = string)
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows != 0) {
                $row = $result->fetch_assoc();

                // Verifying the password
                if (password_verify($password, $row['password'])) {
                    return $row['username'];
                } else {
                    return false; // Invalid password
                }
            } else {
                return false; // User not found
            }
        } catch (Exception $e) {
            // Log the error for debugging (optional)
            error_log("Login error: " . $e->getMessage());
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

        $sql = "SELECT * FROM `auth` WHERE `email` = ? OR `username` = ? OR `id` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $enter, $enter, $enter);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $this->id = $row['id'];
            $this->username = $row['username'];
        } else {
            throw new Exception("User not found");
        }
    }
}
