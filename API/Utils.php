<?php

    $content = trim(file_get_contents("php://input"));

    $data = json_decode($content, true);

    if (!isset($data["methode"]))
        throw new Exception('You must indicate the action to perform.');

    require "../CLASS/DB.php";

    switch ($data["methode"]) {

        case 'create': {

            $stmt = $DB->prepare("

                INSERT INTO `Heros`
                    (`_IDUser`, `name`, `gender`, `baseEntity`, `class`, `str_score`, `dex_score`, `int_score`, `con_score`)
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
                $data["con_score"]
            ));

            $stmt = $DB->prepare("
                SELECT * FROM Heros

                    INNER JOIN Floors  	ON Heros.floor		= Floors._fID
                    INNER JOIN Entity 	ON Heros.baseEntity = Entity._eID

                WHERE Heros._ID = ?
            ");

            $stmt->execute(array(
                $DB->lastInsertId(),
            ));

            echo json_encode($stmt->fetch());



        }
            break;

        case 'delete': {

            $stdt = $DB->prepare("DELETE FROM `Heros` WHERE _ID = ?");

            echo $stdt->execute(array($data["id"]));
        }
            # code...
            break;

        default:
            # code...
            break;
    }


?>