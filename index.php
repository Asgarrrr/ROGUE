<?php

    if (!isset($_SESSION)) session_start();

    include("CLASS/DB.php");
    // include("CLASS/initDB.php")

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="STYLE/main.css">
        <title>Document</title>
    </head>
    <body>

        <?php

            if (!$_SESSION["_ID"])
                require "PHP/auth.php";
            else
                echo $_SESSION["_ID"];

            if (!isset($_SESSION["CharacterID"]))
                require "PHP/select.php";
            else
                echo $_SESSION["CharacterID"];

        ?>

    </body>
</html>