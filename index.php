<?php

    if (!isset($_SESSION)) session_start();

    include("CLASS/DB.php");

    if (isset($_GET["DESTROYME"])) {
        $_SESSION["gameover"] = true;
        unset($_SESSION["CharacterID"]);
        header("LOCATION: ./");
    }

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

            if (isset($_SESSION["gameover"]) && $_SESSION["gameover"] == true ) { ?>

                <form action="" id="gameover" method="post">
                    <img src="Assets/gameOver.png" alt="" srcset="">
                    <input type="submit" name="disableGameOver" value="Retry ?">
                </form>

            <?php }

            if (isset($_POST["disableGameOver"])) {
                $_SESSION["gameover"] = false;
                echo "<script> document.location.assign('./'); </script>";
            }

            if (!(isset($_SESSION) && isset($_SESSION["_userID"])))
                return require "PHP/auth.php";

            if (!isset($_SESSION["CharacterID"]))
                return require "PHP/select.php";

            return header( "Location: PHP/dungeon.php" );

        ?>

    </body>
    <script>
        document.getElementById("closeGameOver").addEventListener("click", () => {
            document.getElementById("gameover").style.display = "none"
        })
    </script>
</html>