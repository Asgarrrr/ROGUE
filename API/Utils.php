<?php

    $content = trim(file_get_contents("php://input"));

    $data = json_decode($content, true);

    if (!isset($data["methode"]))
        throw new Exception('You must indicate the action to perform.');

    require "../CLASS/DB.php";

    switch ($data["methode"]) {

        case 'create': {

            $stmt = $DB->prepare("

                INSERT INTO `heros`
                    (`_IDUser`, `name`, `gender`, `baseEntity`, `class`, `str_score`, `dex_score`, `int_score`, `def_score`)
                VALUES
                    (?, ?, ?, ?, ?, ?, ?, ?, ?)

            ");

            $stmt->execute(array(
                $data["_IDUser"],
                $data["name"],
                $data["gender"],
                $data["race"],
                $data["job"],
                $data["str_score"],
                $data["dex_score"],
                $data["int_score"],
                $data["def_score"]
            ));

            $stmt = $DB->prepare("
                SELECT * FROM heros

                    INNER JOIN floors  	ON heros.floor		= floors._fID
                    INNER JOIN entity 	ON heros.baseEntity = entity._eID

                WHERE heros._ID = ?
            ");

            $stmt->execute(array(
                $DB->lastInsertId(),
            ));

            echo json_encode($stmt->fetch());



        }
            break;

        case 'delete': {

            $stdt = $DB->prepare("DELETE FROM `heros` WHERE _ID = ?");

            echo $stdt->execute(array($data["id"]));
        }
            break;

        default:
            break;
    }


?>