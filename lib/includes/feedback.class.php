<?php
class feedback
{
    use Stockgettersetter;
    public $count;
    public $array;
    public $conn;
    public $table;

    public function __construct()
    {
        $this->table = 'feedback';
        $sql = "SELECT COUNT(`pid`) FROM `feedback`;";
        $this->conn =  database::connection();
        try {
            $result = $this->conn->query($sql);
            if ($result->num_rows>0) {
                $row = $result->fetch_assoc();
                $this->count = $row['COUNT(`pid`)'];
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
