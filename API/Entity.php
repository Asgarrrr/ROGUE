<?php

    // —— Loads all the parameters of my post method.
    $content = trim( file_get_contents("php://input") );

    // —— Transforms the character string into a JSON object
    $data = json_decode($content, true);

    // —— A entity ID must be specified
    if (!isset($data["ID"]))
        throw new Exception("ID Required !");

    // —— Inclusion of the database and Entity class
    require "../CLASS/Entity.php";
    require "../CLASS/DB.php";

    if (!isset($DB))
        throw new Exception("DATABASE ERROR ——");

    // Create new Entity with specified ID
    $entity = new Entity($data["ID"], $DB);

    // —— Return entity data
    $entity->jsonSerialize();

?>