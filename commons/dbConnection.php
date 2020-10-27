<?php

class dbConnetion{
    
    public $conn;
    private $hostname = "192.168.1.110";
    private $dbusername = "root";
    private $dbpassword = "2486";
    private $db = "animspire";
    
    function __construct() {
        $this->conn = new mysqli(
        $this->hostname,
        $this->dbusername,
        $this->dbpassword,
        $this->db
                );
        if(!$this->conn->connect_error)
        {
         $GLOBALS["con"]=$this->conn;    
        }
    else{
            echo "Not Success";
            $GLOBALS["conn"]= $this->conn;
        
        }
    }
    
    
}

?>