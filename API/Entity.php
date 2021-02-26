<?php

    $content = trim(file_get_contents("php://input"));

    $data = json_decode($content, true);

    if (!isset($data["ID"]))
        throw new Exception("ID");

    require "../CLASS/Entity.php";
    require "../CLASS/DB.php";

    $entity = new Entity($data["ID"], $DB);

    $entity->jsonSerialize();

?>