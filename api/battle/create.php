<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate battle object
include_once '../objects/battle.php';
  
$database = new Database();
$db = $database->getConnection();
  
$battle = new Battle($db);
  
// set battle property values
$battle->status = "battle ready";
  
// create the battle
if($last_id = $battle->create()){
  
    // set response code - 201 created
    http_response_code(201);
  
    // tell the user
    echo json_encode(array("message" => "Battle " . $last_id . " was created."));
}
  
// if unable to create the battle, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create a battle."));
}