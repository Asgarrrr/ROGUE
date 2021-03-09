<?php

    // —— Loads all the parameters of my post method.
    $content = trim(file_get_contents("php://input"));

    // —— Transforms the character string into a JSON object
    $data = json_decode($content, true);

    // —— A monster ID and Methode must be specified
    if (!isset($data["id"]))
        throw new Exception("You must indicate the identifier of the target");

    if (!isset($data["methode"]))
        throw new Exception('You must indicate the action to perform.');

    // —— Inclusion of the database and Monsters class
    require "../CLASS/Monsters.php";
    require "../CLASS/DB.php";

    if (!isset($DB))
        throw new Exception("DATABASE ERROR ——");

    // —— Create new Monsters with specified ID
    $monster = new Monsters($data["id"], $DB);

    // —— Switch between the different methods
    switch ($data["methode"]) {
        case 'jsonSerialize':
                $monster->Difficulty($data["floor"]);
                $monster->jsonSerialize();
            break;

        default:
            break;
    }

?>