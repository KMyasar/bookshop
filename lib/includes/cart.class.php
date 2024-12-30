<?php
class cart
{
    public $table;
    public $conn;
    public $cart_count;
    use Stockgettersetter;

    public function __construct()
    {
        $this->table = 'cart';
        $this->conn = database::connection();
    }
    public function checkexist($cartid)
    {
        $sql = "SELECT `quantity` FROM `$this->table` WHERE `cartid` = '$cartid';";
        try {
            $result = $this->conn->query($sql);
            if ($result->num_rows == 1) {
                //print("Res: ".$result->fetch_assoc()["$var"]);
                $row = $result->fetch_assoc();
                return $row['quantity'];
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage() . "in train get";
            return false;
        }
    }
    public function isexist($uid)
    {
        $return = array();
        $sql = "SELECT `cartid` FROM `$this->table` WHERE `uid` = '$uid';";
        try {
            $result = $this->conn->query($sql);
            if ($result->num_rows > 0) {
                $this->cart_count = $result->num_rows;
                while ($row = $result->fetch_row()) {
                    array_push($return, $row[0]);
                }
                return $return;
            }
            else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage() . "in train get";
            return false;
        }
    }
    public function zerotodel($cartid)
    {
        $sql = "DELETE FROM `cart` WHERE `cartid` = '$cartid';";
        try {
            $this->conn->query($sql);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage().__LINE__;
            return false;
        }
    }
    public function clearcart($uid){
        $sql = "DELETE FROM `cart` WHERE `uid` = '$uid';";
        try {
            $this->conn->query($sql);
            sessions::delete('checklist');
            return true;
        } catch (Exception $e) {
            echo $e->getMessage().__LINE__;
            return false;
        }   
    }
}
