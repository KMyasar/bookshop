<?php
class history
{
    public $uid;
    public $table;
    public $conn;
    use Stockgettersetter;
    public function __construct()
    {
        $this->table = 'history';
        $this->conn = database::connection();
    }
    public function makehistory($array,$uid)
    {
        $date = date("Y-m-d");
        print($date);
        $sql = "INSERT INTO `history`(`pid`, `bookname`, `price`, `cartid`, `quantity`, `firstname`, `lastname`, `email`, `address`, `address2`, `country`, `state`, `post`, `type`, `nameonncard`, `number`, `exp`, `cvv`, `transactionid`, `date`,`uid`) 
        VALUES ('$array[0]','$array[1]','$array[2]','$array[3]','$array[4]','$array[5]','$array[6]','$array[7]','$array[8]','$array[9]','$array[10]','$array[11]','$array[12]','$array[13]','$array[14]','$array[15]','$array[16]','$array[17]','$array[18]','$date','$uid');";
        try {
            $this->conn->query($sql);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
