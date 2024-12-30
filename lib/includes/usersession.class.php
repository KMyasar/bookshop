<?php

class usersession
{
    public $conn;
    public $token;
    public $data;
    public $sid;
    public $table;

    /**
     * Authenticate the user using email and password.
     *
     * @param string $email
     * @param string $password
     * @return bool
     */
    public static function authenticate($email, $password)
    {
        $valid = false;
        $username = user::login($email, $password);
        if ($username) {
            $user = new user($username);
            [$ip, $agent, $time, $token] = sessions::Token();

            $sql = "UPDATE `sessions` SET `token` = ?, `ip` = ?, `time` = ?, `user_agent` = ?, `active` = 1 WHERE `sid` = ?";
            try {
                $stmt = $user->conn->prepare($sql);
                $stmt->bind_param("ssssi", $token, $ip, $time, $agent, $user->id);
                $stmt->execute();
                sessions::set("session_token", $token);
                $valid = true;
            } catch (Exception $e) {
                error_log($e->getMessage());
            }
        }
        return $valid;
    }

    /**
     * Authorize the session token.
     *
     * @param string $token
     * @return bool
     */
    public static function authorize($token)
    {
        $session = new usersession($token);
        if (isset($_SERVER['REMOTE_ADDR']) && isset($_SERVER['HTTP_USER_AGENT'])) {
            if ($session->isValid() && $session->isActive()) {
                if ($_SERVER['REMOTE_ADDR'] === $session->getIP() &&
                    $_SERVER['HTTP_USER_AGENT'] === $session->getUserAgent()) {
                    // Enable fingerprint validation if required
                    // if ($session->getFingerprint() === $_SESSION['fingerprint']) {
                    return true;
                } else {
                    return false;
                }
            } else {
                $session->removeSession();
                // sessions::destroy();
                session_destroy();
                return false;
            }
        }
        return false;
    }

    /**
     * Constructor to initialize the session object.
     *
     * @param string $session_token
     */
    public function __construct($session_token)
    {
        $this->conn = database::connection();
        $this->token = $session_token;
        $this->table = 'sessions';

        $sql = "SELECT * FROM `sessions` WHERE `token` = ?";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $this->token);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 1) {
                $this->data = $result->fetch_assoc();
                $this->sid = $this->data['sid'];
            }
        } catch (Exception $e) {
            error_log($e->getMessage() . " happened in usersession constructor");
        }
    }

    /**
     * Get the username of the current session.
     *
     * @return string
     */
    public function getUser()
    {
        $obj = new user($this->sid);
        return $obj->username;
    }

    /**
     * Check if the session is valid within a one-hour window.
     *
     * @return bool
     */
    public function isValid()
    {
        if (isset($this->data['time'])) {
            $login_time = DateTime::createFromFormat('Y-m-d H:i:s', $this->data['time']);
            return (3600 > time() - $login_time->getTimestamp());
        }
        return false;
    }

    /**
     * Get the IP address of the session.
     *
     * @return string|false
     */
    public function getIP()
    {
        return $this->data['ip'] ?? false;
    }

    /**
     * Get the user agent of the session.
     *
     * @return string|false
     */
    public function getUserAgent()
    {
        return $this->data['user_agent'] ?? false;
    }

    /**
     * Deactivate the current session.
     *
     * @return bool
     */
    public function deactivate()
    {
        if (!$this->conn) {
            $this->conn = database::connection();
        }
        $sql = "UPDATE `$this->table` SET `active` = 0 WHERE `sid` = ?";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $this->sid);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage() . " at deactivate session");
            return false;
        }
    }

    /**
     * Check if the session is active.
     *
     * @return bool
     */
    public function isActive()
    {
        return isset($this->data['active']) && $this->data['active'];
    }

    /**
     * Get the fingerprint of the session.
     *
     * @return string|false
     */
    public function getFingerprint()
    {
        return $this->data['fingerprint'] ?? false;
    }

    /**
     * Remove the current session.
     */
    public function removeSession()
    {
        if (isset($this->sid)) {
            $this->deactivate();
            sessions::set('is_logged', false);
        }
    }
}
