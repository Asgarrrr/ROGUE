<?php

    // —— Loads all the parameters of my post method.
    $content = trim( file_get_contents("php://input") );

    // —— Transforms the character string into a JSON object
    $data = json_decode( $content, true );

    // —— A method name must be specified
    if (!isset($data["methode"]))
        throw new Exception('You must indicate the action to perform.');

    // —— Inclusion of the database
    require "../CLASS/DB.php";

    if (!isset($DB))
        throw new Exception("DATABASE ERROR ——");

    // —— Switch between the different methods
    switch ($data["methode"]) {

        // —— Creation of the user, addition of his basic equipment, and get it all back
        case 'create': {

            $stmt = $DB->prepare(" INSERT INTO `Heros` (`_IDUser`, `name`, `gender`, `baseEntity`, `class`, `str_score`, `dex_score`, `int_score`, `def_score`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?) ");

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

            $insered = $DB->lastInsertId();

            $addStuff = $DB->prepare("
                INSERT INTO `Inventory` (`_iEID`, `_iSID`) VALUES (:id, '1'), (:id, '4'), (:id, '5')
            ");

            $addStuff->bindParam(':id', $insered );

            $addStuff->execute();

            $stmt = $DB->prepare("
                SELECT * FROM Heros

                    INNER JOIN Floors  	ON Heros.floor		= Floors._fID
                    INNER JOIN Entity 	ON Heros.baseEntity = Entity._eID

                WHERE Heros._ID = ?
            ");

            $stmt->execute( array( $insered ) );

            echo json_encode($stmt->fetch());

        }
            break;

        case 'delete': {

            $stdt = $DB->prepare(" DELETE FROM Inventory WHERE _iEID = ?; ");
            $stdt->execute( array( $data["id"] ) );

            $stdt = $DB->prepare(" DELETE FROM Heros WHERE _ID = ?; ");

            echo $stdt->execute( array( $data["id"] ) );
        }
            break;

    }


?>