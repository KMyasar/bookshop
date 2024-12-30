<?php

class advertise
{
    use Stockgettersetter;
    public $count;
    public $table;
    public $conn;

    public function __construct()
    {
        $this->table = 'advertise';
        $this->conn = database::connection();
        $sql = "SELECT COUNT(`pid`) FROM `advertise`;";
        try {
            $result = $this->conn->query($sql);
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $this->count = $row["COUNT(`pid`)"];
            }
        } catch (Exception $e) {
            echo __FILE__ . "query error happen";
        }
    }

    public function getimage($pid)
    {
        $sql = "SELECT * FROM `Stocks` WHERE `pid`='$pid';";
        try {
            $result = $this->conn->query($sql);
            if ($result->num_rows == 1) {
                // Output the image as base64-encoded data
                $row = $result->fetch_assoc();
                return '<img src="data:' . 'image/jpeg' . ';base64,' . base64_encode($row['image']) . '" />';
            } else {
                echo "No images found in database";
            }
        } catch (Exception $e) {
            echo $e->getMessage() . __FILE__;
        }
    }

    public static function getbanner()
    {
        $sql = "SELECT `pid` FROM `advertise` WHERE `banner` = '1';";
        $conn = database::connection();
        $return = array();
        try {
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_row()) {
                    array_push($return, $row[0]);
                }
            }
            return [$return,$result->num_rows];
        } catch (Exception $e) {
            echo $e->getMessage() . __FILE__;
        }
    }
    public static function getstatic()
    {
        $sql = "SELECT `pid` FROM `advertise` WHERE `static` = '1';";
        $conn = database::connection();
        $return = array();
        try {
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_row()) {
                    array_push($return, $row[0]);
                }
            }
            return [$return,$result->num_rows];
        } catch (Exception $e) {
            echo $e->getMessage() . __FILE__;
        }
    }
}
