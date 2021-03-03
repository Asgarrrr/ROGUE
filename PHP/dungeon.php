<?php

    if ( !isset($_SESSION) )
        session_start();

    if ( !isset($_SESSION["_userID"]) || !isset($_SESSION["CharacterID"]) )
        return header( "Location: ../index.php" );

?>


<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="../Style/main.css">

        <title>Dungeon !</title>
    </head>
    <body class="center">

        <div id="toggle" class="chartoggle">

            <div class="char_port" id="char_port"></div>
            <div class="char_baseData">
                <span id="heroName"></span>
                <attr class="magenta">  HP: <span id="currentHP">0</span></attr>
                <attr class="cyan">     MP: <span id="currentMP">0</span></attr>
            </div>

        </div>

        <div id="charscreen">

            <div>

                <strong>
                    <p>Level <span id="level"></span> <span id="race"></span> <span id="class"></span></p>
                    <p>Exp      : <span id="exp"></span></p>
                    <p>Potions  : <span id="potions"></span></p>
                </strong>

                <hr>

                <strong>
                    <p>
                        <abbr title="Strength — measuring physical power and carrying capacity"> Str:</abbr>
                        <span class="stat" id="str_score">—</span>
                        <span>[ <span>10</span> ]</span>
                    </p>

                    <p>
                        <abbr title="Dexterity — measuring agility, balance, coordination and reflexes"> Dex:</abbr>
                        <span class="stat" id="dex_score">—</span>
                        <span>[ <span>10</span> ]</span>
                    </p>

                    <p>
                        <abbr title="Intelligence — measuring deductive reasoning, cognition, knowledge, memory, logic and rationality"> Int:</abbr>
                        <span class="stat" id="int_score">—</span>
                        <span>[ <span>10</span> ]</span>
                    </p>

                    <p>
                        <abbr title="Constitution — measuring endurance, stamina and good health"> Con:</abbr>
                        <span class="stat" id="con_score">—</span>
                        <span>[ <span>10</span> ]</span>
                    </p>

                </strong>

                <hr>

                <form action="">
                    <p>
                        <label for="weapon">Weapon :</label>
                        <select id="weapon">

                        </select>
                    </p>

                    <p>
                        <label for="armor">Armor :</label>
                        <select id="armor">

                        </select>
                    </p>

                    <p>
                        <label for="spell">Spell :</label>
                        <select id="spell">

                        </select>
                    </p>
                </form>

            </div>


            <form action="#" method="post">
                <input type="submit" name="logout" value="logout" />
            </form>

        </div>

        <div id="game">
            <div id="monster">
                <span id="monsterName"></span>
                <span id="monsterHP"></span>
            </div>
            <div></div>
            <div class="actions">
                <form action="">
                    <input type="button" id="attack" value="Attack">
                </form>
            </div>
            <div id="messageBox">
                <ul id="messages">
                </ul>
            </div>
        </div>

    </body>



    <script src="../SCRIPT/dungeon.js"></script>
    <script src="../SCRIPT/dungeonInteractions.js"></script>
    <script> const test = new Dungeon("<?= $_SESSION["CharacterID"] ?>").load() </script>

    <?php

    // —— Session Destruction
    if(isset($_POST['logout'])) {

        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        header("Refresh:0");

    }

?>


</html>