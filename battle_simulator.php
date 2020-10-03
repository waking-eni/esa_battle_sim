<?php

// decode json
$json = file_get_contents('http://localhost/phpprojects/esa_battle_sim/api/army/read.php');
$data = json_decode($json, true);
//var_dump($data);

/*$json_errors = array(
    JSON_ERROR_NONE => 'No error has occurred',
    JSON_ERROR_DEPTH => 'The maximum stack depth has been exceeded',
    JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded',
    JSON_ERROR_SYNTAX => 'Syntax error',
);
 echo 'Last error : ', $json_errors[json_last_error()], PHP_EOL, PHP_EOL;*/

// array of armies
$armies = array();

// count the number of armies and fill the armies array
$numOfArmies = 0;
for($i = 0; $i < count($data["records"]); $i++) {
    if($data["records"][$i]["id"])
        $numOfArmies++;
    $armies[$i] = array(
        "id" => $data["records"][$i]["id"],
        "name" => $data["records"][$i]["name"],
        "units" => $data["records"][$i]["units"] + 0,
        "attack_strategy" => $data["records"][$i]["attack_strategy"]
    );
}
//var_dump($numOfArmies);
//var_dump($armies);

// armies still alive
$armiesAlive = $numOfArmies;
var_dump($armiesAlive);
// game loop
if($numOfArmies >= 5) {
    while($armiesAlive > 1) {
        for($i = sizeof($armies) - 1; $i >= 0; $i--) {
            // call strategy and attack functions
            $attacked_id = strategy($armies[$i], $armies, $armiesAlive);
            $result = attack($armies[$i], $armies[$attacked_id]);
            var_dump($result);

            // delete the army if it has no units left
            if($result != NULL) {
                if($result['units'] == 0) {
                    unset($result);
                    $armiesAlive--;
                }
            }
            

            // if there is only one army left
            if($armiesAlive == 1) {
                var_dump($armiesAlive);
                break;
            }
        }
        $armiesAlive--;
    }
}

// subtract damage
function damage(&$army1, &$army2) {
    if($army2['units'] == 1) 
        $army2['units'] -= 1;
    else if($army1['units'] == $army2['units']) {
        $army1['units'] = (int)$army1['units']/2;
        $army2['units'] = (int)$army2['units']/2;
    }
    else {
        $army2['units'] -= (int)floor($army1['units'] / 2);
        echo "did it";
        var_dump($army2['units']);}
}

// attack and call the function to subtract damage
function attack($army1, $army2) {
    if($army1['units'] > $army2['units']) {
        damage($army1, $army2);
        return $army2;
    } else if($army2['units'] > $army1['units']) {
        damage($army2, $army1);
        return $army1;
    } else {
        damage($army1, $army2);
    }
}

// pick the attacked army based on attack_strategy
function strategy($army, $armies, $armiesAlive) {
    $weakestUnits = 100;
    $weakestId = 0;
    $strongestUnits = 1;
    $strongestId = 0;
    for($i = 0; $i < sizeof($armies) - 1; $i++) {
        // skip the attacker
        if($armies[$i]['id'] == $army['id'])
            continue;
        if($armies[$i]['units'] <= $weakestUnits) {
            $weakestUnits = $armies[$i]['units'];
            $weakestId = $armies[$i]['id'];
        }
        if($armies[$i]['units'] >= $strongestUnits) {
            $strongestUnits = $armies[$i]['units'];
            $strongestId = $armies[$i]['id'];
        }
    }

    switch($army['attack_strategy']) {
        case "random":
            $attackedId = rand(0, ($armiesAlive - 1));
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