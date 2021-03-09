<?php

    // —— Loads all the parameters of my post method.
    $content = trim(file_get_contents("php://input"));

    // —— Transforms the character string into a JSON object
    $data = json_decode($content, true);

    // —— A entity ID and Methode must be specified
    if (!isset($data["id"]))
        throw new Exception("You must indicate the identifier of the target");

    if (!isset($data["methode"]))
        throw new Exception('You must indicate the action to perform.');

    // —— Inclusion of the database and Heros class
    require "../CLASS/Heros.php";
    require "../CLASS/DB.php";

    if (!isset($DB))
        throw new Exception("DATABASE ERROR ——");

    // —— Create new Heros with specified ID
    $hero = new Heros($data["id"], $DB);

    // —— Switch between the different methods
    switch ($data["methode"]) {
        case 'jsonSerialize':
                $hero->jsonSerialize();
            break;
        case 'saveFight':
                $hero->saveFight($data["data"]);
            break;
        case 'deadHero':
                $hero->deadHero();
            break;
        case 'saveFloor':
                $hero->saveFloor($data["floor"]);
            break;

        default:
            break;
    }

?>