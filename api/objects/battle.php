<?php
class Battle{
  
    // database connection and table name
    private $conn;
    private $table_name = "battles";
  
    // object properties
    public $id;
    public $status;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read battles
    function read(){
    
        // select all query
        $query = "SELECT * FROM " . $this->table_name . ";";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create battle
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    status=:status;";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->status=htmlspecialchars(strip_tags($this->status));
    
        // bind values
        $stmt->bindParam(":status", $this->status);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
}