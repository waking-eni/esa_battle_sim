<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate product object
include_once '../objects/army.php';
  
$database = new Database();
$db = $database->getConnection();
  
$army = new Army($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->name) &&
    !empty($data->units) &&
    !empty($data->attack_strategy) &&
    !empty($data->battle_id)
){
  
    // set armies property values
    $army->name = $data->name;
    $army->units = $data->units;
    $army->attack_strategy = $data->attack_strategy;
    $army->battle_id = $data->battle_id;
  
    // create the army
    if($army->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Army was created."));
    }
  
    // if unable to create the army, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create an army."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create an army. Data is incomplete."));
}