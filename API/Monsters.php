<?php

    $content = trim(file_get_contents("php://input"));

    $data = json_decode($content, true);

    if (!isset($data["id"]))
        throw new Exception("You must indicate the identifier of the target");

    if (!isset($data["methode"]))
        throw new Exception('You must indicate the action to perform.');


    require "../CLASS/Monsters.php";
    require "../CLASS/DB.php";


    $monster = new Monsters($data["id"], $DB);


    switch ($data["methode"]) {
        case 'jsonSerialize':
                $monster->jsonSerialize();
            break;
        case 'PhysicalAttack':
                $monster->PhysicalAttack($data["target"]);
            break;
        case 'defense':
                $monster->defense($data["target"]);
            break;
        default:
            # code...
            break;
    }

?>