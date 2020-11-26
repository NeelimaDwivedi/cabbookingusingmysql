<?php
class dbconnection{
    public $servername;
    public $user;
    public $pass;
    public $conn;
    function __construct() {
        $this->conn=new mysqli('localhost', 'root', '', 'cabbooking');
            if ($this->conn->connect_error) {
                die("connection failed:" .$this->conn->connect_error);
            }

    }
}
  
?>