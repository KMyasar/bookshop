<?php

class sessions
{
    public static $isError = false;
    /**
     * Initising the session
     *
     */
    public static function start()
    {
        session_start();
    }
    /**
     * Gets the session value
     * @param String $key
     * @return Mixed  Returns the value of the session's key
     */
    public static function get($key)
    {
        if (isset($_SESSION["$key"])) {
            return $_SESSION["$key"];
        } else {
            return false;
        }
    }
    /**
     * Assigns a session key and values
     *
     * @param String $key
     * @param Mixed $value
     */
    public static function set($key, $value)
    {
        $_SESSION["$key"] = $value;
    }
    /**
     * Deleting the specific varible in sessions
     *
     * @param String $key
     * @return Boolen  Returns false if the function fails
     */
    public static function delete($key)
    {
        if (isset($_SESSION["$key"])) {
            unset($_SESSION["$key"]);
        } else {
            return false;
        }
    }
    /**
     * Freeup the sessions and session gets empty
     *
     */
    public static function free()
    {
        session_unset();
    }
    /**
     * Destory the session id
     *
     */
    public static function destory()
    {
        session_destroy();
    }
    /**
     * Generates the session token based on the inputs
     *
     * @return String  Returns the hashed value(md5)
     */
    public static function Token()
    {
        date_default_timezone_set('Asia/Calcutta');
        $ip = $_SERVER['REMOTE_ADDR'];
        $browser_agent = $_SERVER['HTTP_USER_AGENT'];
        $req_time =  date('Y-m-d H:i:s');
        $session_token = md5($ip . $browser_agent . $req_time . rand());
        return [$ip, $browser_agent, $req_time, $session_token];
    }
    /**
     * Returns the current running script
     *
     * @return String
     */
    public static function CurrentScript()
    {
        return basename($_SERVER["SCRIPT_NAME"]);
    }
    /**
     * Loading the Templates which is under the _templates folder
     *
     * @param String $param
     * @return void
     */
    public static function load_script($script)
    {
?>
        <script>
            window.location.href = "/college-project/<?php print($script) ?>.php";
        </script>
<?php
    }
    public static function load_templates($param)
    {
        $path = $_SERVER["DOCUMENT_ROOT"] . "/college-project/_templates/$param.php";
        if (is_file($path)) {
            include_once "$path";
        } else {
            // sessions::load_templates("error");
        }
    }
    /**
     * Calling the _master file to loading the templates
     *
     */
    public static function Render_page()
    {
        $file = basename(sessions::CurrentScript(), ".php");
        if ($file === "login" or $file === "signup") {
            sessions::load_templates("_credentials");
        }
        elseif ($file == "checkout") {
            sessions::load_templates("_billing");
        }
        else {
            sessions::load_templates("_master");
        }
    }
}
