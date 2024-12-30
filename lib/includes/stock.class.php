<?php
class stock
{
    public $pid;
    public $table;
    public $conn;
    use Stockgettersetter;

    public function __construct($pid)
    {
        $this->table = 'Stocks';
        $this->conn = database::connection();
        $sql = "SELECT * FROM `$this->table` WHERE `pid`='$pid';";
        try {
            $result = $this->conn->query($sql);
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $this->pid = $row['pid'];
            }
        } catch (Exception $e) {
            echo __FILE__ . "query error happen";
        }
    }

    public function getimage($wid,$hei)
    {
        $sql = "SELECT * FROM `$this->table` WHERE `pid`='$this->pid';";
        try {
            $result = $this->conn->query($sql);
            if ($result->num_rows == 1) {
                // Output the image as base64-encoded data
                $row = $result->fetch_assoc();
                return '<img src="data:' . 'image/jpeg' . ';base64,' . base64_encode($row['image']) . '" width="'.$wid.'"'. 'height="'.$hei.'"'.'/>';
            } else {
                echo "No images found in database";
            }
        } catch (Exception $e) {
            echo $e->getMessage() . __FILE__;
        }
    }

    public static function getnewarrivals()
    {
        $sql = "SELECT `pid` FROM `Stocks` WHERE `dop` > '2023-01-01';";
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
    public static function getcategory($cat,$val)
    {
        $sql = "SELECT `pid` FROM `Stocks` WHERE `$cat` ='$val';";
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
