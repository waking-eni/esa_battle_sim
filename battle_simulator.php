<?php

// decode json
$json = file_get_contents('api/army/read.php');
$data = (array)json_decode($json);
var_dump($data);

// array of armies
$armies = array();

// count the number of armies and fill the armies array
$numOfArmies = 0;
foreach($data as $obj) {
    if($obj->id)
        $numOfArmies++;
    $armies[$i] = array(
        "id" => $obj->id,
        "name" => $obj->name,
        "units" => $obj->units,
        "attack_strategy" => $obj->attack_strategy
    );
}

// armies still alive
$armiesAlive = $numOfArmies;

// game loop
if($numOfArmies >= 5) {
    while($armiesAlive > 1) {
        for($i = sizeof($armies); $i >= 0; $i--) {
            // call strategy and attack functions
            $attacked_id = strategy($armies[$i], $armies, $armiesAlive);
            $result = attack($armies[$i], $armies[$attacked_id]);

            // delete the army if it has no units left
            if($result['units'] == 0) {
                unset($result);
                $armiesAlive--;
            }

            // if there is only one army left
            if($armiesAlive == 1) {
                echo "Done";
                break;
            }
        }
    }
}

// subtract damage
function damage($army1, $army2) {
    if($army2['units'] == 1)
        $army2['units'] -= 1;
    else 
        $army2['units'] -= floor($army1['units'] * 0.5);
}

// attack and call the function to subtract damage
function attack($army1, $army2) {
    if($army1['units'] > $army2['units']) {
        damage($army1, $army2);
        return $army2;
    } else if($army2['units'] > $army1['units']) {
        damage($army2, $army1);
        return $army1;
    }
}

// pick the attacked army based on attack_strategy
function strategy($army, $armies, $armiesAlive) {
    $weakestUnits = 100;
    $weakestId = 0;
    $strongestUnits = 1;
    $strongestId = 0;
    for($i = 0; $i < sizeof($armies); $i++) {
        // skip the attacker
        if($armies['id'] == $army['id'])
            continue;
        if($armies['units'] <= $weakestUnits) {
            $weakestUnits = $armies['units'];
            $weakestId = $armies['id'];
        }
        if($armies['units'] >= $strongestUnits) {
            $strongestUnits = $armies['units'];
            $strongestId = $armies['id'];
        }
    }

    switch($army['attack_strategy']) {
        case "random":
            $attackedId = rand(0, $armiesAlive);
            break;
        case "weakest":
            $attackedId = $weakestId;
            break;
        case "strongest":
            $attackedId = $strongestId;
            break;
    }

    return $attackedId;
}