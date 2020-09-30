<?php
class Army{
  
    // database connection and table name
    private $conn;
    private $table_name = "armies";
  
    // object properties
    public $id;
    public $name;
    public $units;
    public $attack_strategy;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read armies
    function read(){
    
        // select all query
        $query = "SELECT * FROM " . $this->table_name . ";";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create army
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, units=:units, attack_strategy=:attack_strategy;";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->units=htmlspecialchars(strip_tags($this->units));
        $this->attack_strategy=htmlspecialchars(strip_tags($this->attack_strategy));
    
        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":units", $this->units);
        $stmt->bindParam(":attack_strategy", $this->attack_strategy);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }

    // delete the army
    function delete(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
}