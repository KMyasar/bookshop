<?php

class usersession
{
    public $conn;
    public $token;
    public $data;
    public $sid;
    public $table;

    public static function authenticate($email, $password)
    {
        $valid = false;
        $username = user::login($email, $password);
        if ($username) {
            $user = new user($username);
            [$ip, $agent, $time, $token] = sessions::Token();
            $sql = "UPDATE `sessions` SET `token` = '$token',`ip` = '$ip',`time`='$time',
            `user_agent`='$agent',`active`=1 WHERE `sid`='$user->id';";
            try {
                $user->conn->query($sql);
                sessions::set("session_token", $token);
                $valid = true;
                return $valid;
            } catch (Exception $e) {
                echo $e->getMessage();
                return $valid;
            }
        }
    }
    public static function authorize($token)
    {
        $session = new usersession($token);
        if (isset($_SERVER['REMOTE_ADDR']) and isset($_SERVER["HTTP_USER_AGENT"])) {
            if ($session->isValid() and $session->isActive()) {
                if ($_SERVER['REMOTE_ADDR'] == $session->getIP()) {
                    if ($_SERVER['HTTP_USER_AGENT'] == $session->getUserAgent()) {
                        // temp. diable
                        // if ($session->getFingerprint() == $_SESSION['fingerprint']) {
                        //     return true;
                        // } else {
                        //     throw new Exception("FingerPrint doesn't match");
                        // }
                        return true;
                    } else {
                        // echo "User agent does't match";
                        return false;
                    }
                } else {
                    // echo "IP doesn't match";
                    return false;
                }
            } else {
                $session->removeSession();
                sessions::destory();
                // echo "Invalid session";
                return false;
            }
        } else {
            // echo "Ip and browser is null";
            return false;
        }
    }
    public function __construct($session_token)
    {
        $this->conn = database::connection();
        $this->token = $session_token;
        $this->table = 'sessions';
        $sql = "SELECT * FROM `sessions` WHERE `token` = '$this->token';";
        try {
            $result = $this->conn->query($sql);
            if ($result->num_rows == 1) {
                $this->data = $result->fetch_assoc();
                $this->sid = $this->data['sid'];
            }
        } catch (Exception $e) {
            echo $e->getMessage()." happened in usersession";
        }
    }
    public function getUser()
    {
        $obj = new user($this->sid);
        return $obj->username;
    }

    /**
     * Check if the validity of the session is within one hour, else it inactive.
     *
     * @return boolean
     */
    public function isValid()
    {
        if (isset($this->data['time'])) {
            $login_time = DateTime::createFromFormat('Y-m-d H:i:s', $this->data['time']);
            if (3600 > time() - $login_time->getTimestamp()) {
                return true;
            } else {
                return false;
            }
        } else {
            // echo "Login time has expired";
           return false;
        }
    }

    public function getIP()
    {
        return isset($this->data["ip"]) ? $this->data["ip"] : false;
    }

    public function getUserAgent()
    {
        return isset($this->data["user_agent"]) ? $this->data["user_agent"] : false;
    }

    public function deactivate()
    {
        if (!$this->conn) {
            $this->conn = database::connection();
        }
        $sql = "UPDATE `$this->table` SET `active` = '0' WHERE `sid`='$this->sid';";
        try {
            $this->conn->query($sql);
            return false;
        } catch (Exception $e) {
            echo $e->getMessage()."at deactivate session";
            return false;
        }
    }

    public function isActive()
    {
        if (isset($this->data['active'])) {
            return $this->data['active'] ? true : false;
        }
    }

    public function getFingerprint()
    {
        if (isset($this->data['fingerprint'])) {
            return $this->data['fingerprint'] ? true : false;
        }
    }

    //This function remove current session
    public function removeSession()
    {
        if (isset($this->data['sid'])) {
            $session = new usersession('session_token');
            if ($session->deactivate()) {
                sessions::set('is_logged', false);
            }
        }
    }
}
