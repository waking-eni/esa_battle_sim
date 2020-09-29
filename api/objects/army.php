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
    public $battles_id;
  
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
                    name=:name, units=:units, attack_strategy=:attack_strategy, battle_id=:battle_id;";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->units=htmlspecialchars(strip_tags($this->units));
        $this->attack_strategy=htmlspecialchars(strip_tags($this->attack_strategy));
        $this->battle_id=htmlspecialchars(strip_tags($this->battle_id));
    
        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":units", $this->units);
        $stmt->bindParam(":attack_strategy", $this->attack_strategy);
        $stmt->bindParam(":battle_id", $this->battle_id);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }

    function read_from_battle_id($id) {
        // select all query
        $query = "SELECT * FROM " . $this->table_name . " WHERE battle_id=:battle_id;";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        
        //bind values
        $stmt->bindParam(":battle_id", $this->battle_id);
        
        // execute query
        $stmt->execute();
            
        return $stmt;
    }
}