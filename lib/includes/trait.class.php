<?php


/**
 * To use this trait, the PHP Object's constructor should have
 * $id, $conn, $tabel variables set.
 *
 * $id - The ID of the MySQL Table Row.
 * $conn - The MySQL Connection.
 * $table - The MySQL Table Name.
 */
trait SQLGetterSetter
{
    public function __call($name, $arguments)
    {
        $property = preg_replace("/[^0-9a-zA-Z]/", "", substr($name, 3));
        $property = strtolower(preg_replace('/\B([A-Z])/', '_$1', $property));
        if (substr($name, 0, 3) == "get") {
            return $this->_get_data($property);
        } elseif (substr($name, 0, 3) == "set") {
            return $this->_set_data($property, $arguments[0]);
        } else {
            throw new Exception("Post::__call() -> $name, function unavailable.");
        }
        // print("\nname :".$name);
        // print_r($arguments);
        // print("\nproperty :".$property);
    }

    private function _get_data($var)
    {
        if ($this->conn) {
            $this->conn = database::connection();
        }
        $sql = "SELECT `$var` FROM `$this->table` WHERE `uid` = '$this->id';";
        try {
            $result = $this->conn->query($sql);
            if ($result and $result->num_rows == 1) {
                //print("Res: ".$result->fetch_assoc()["$var"]);
                $row = $result->fetch_assoc();
                return $row["$var"];
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage()."in train get";
            return false;
        }
    }

    private function _set_data($var, $data)
    {
        $return = false;
        if (!$this->conn) {
            $this->conn = database::connection();
        }
        $sql = "UPDATE `$this->table` SET `$var`='$data' WHERE `uid` = '$this->uid';";
        try {
            $this->conn->query($sql);
            $return = true;
            return $return;
        } catch (Exception $e) {
            echo $e->getMessage()."In trait set";
            return $return;
        }
    }
}
