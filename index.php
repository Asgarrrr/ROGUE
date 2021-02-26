<?php

    if (!isset($_SESSION)) session_start();

    include("CLASS/DB.php");

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="Style/main.css">
        <title>Document</title>
    </head>
    <body>

        <?php

            if (!(isset($_SESSION) && isset($_SESSION["_userID"])))
                return require "PHP/auth.php";

            if (!isset($_SESSION["CharacterID"]))
                return require "PHP/select.php";

            return header( "Location: PHP/dungeon.php" );

        ?>

    </body>
</html>