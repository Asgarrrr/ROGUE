<?php

    if ( !isset($_SESSION) )
        session_start();

    if ( !isset($_SESSION["_userID"]) || !isset($_SESSION["CharacterID"]) )
        return header( "Location: ../" );

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
                    <p>Potion   : <span id="potion"></span></p>
                    <p>Gold     : <span id="gold"></span></p>
                </strong>

                <hr>

                <strong>
                    <p>
                        <abbr title="Strength — measuring physical power and carrying capacity"> Str:</abbr>
                        <span class="stat" id="str_score">—</span>
                        <span>[ <span>10</span> ]</span>
                        <input type="button" class="addStat" id="str_scoreAdd" value="+">
                    </p>

                    <p>
                        <abbr title="Dexterity — measuring agility, balance, coordination and reflexes"> Dex:</abbr>
                        <span class="stat" id="dex_score">—</span>
                        <span>[ <span>10</span> ]</span>
                        <input type="button" class="addStat" id="dex_scoreAdd" value="+">
                    </p>

                    <p>
                        <abbr title="Intelligence — measuring deductive reasoning, cognition, knowledge, memory, logic and rationality"> Int:</abbr>
                        <span class="stat" id="int_score">—</span>
                        <span>[ <span>10</span> ]</span>
                        <input type="button" class="addStat" id="int_scoreAdd" value="+">
                    </p>

                    <p>
                        <abbr title="Def — measuring endurance, stamina and good health"> Def:</abbr>
                        <span class="stat" id="def_score">—</span>
                        <span>[ <span>10</span> ]</span>
                        <input type="button" class="addStat" id="def_scoreAdd" value="+">
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


            <form method="post">
                <input type="submit" name="logout" value="logout" />
            </form>

        </div>

        <div id="game">
            <div id="monster">
                <span id="monsterName"></span>
                <span id="monsterHP"></span>
                <p id="message"></p>
            </div>
            <div></div>
            <div class="actions">
                <form action="">
                    <input type="button" id="retry"         value="Rest on this floor">
                    <input type="button" id="physical"      value="Attack">
                    <input type="button" id="magical"       value="Use spell">
                    <input type="button" id="redoOfHealer"  value="Drink potion ( + 10HP )">

                    <input type="button" id="nextfloor"     value="Go to the next floor">
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
            session_destroy();

            echo ("<script>window.location = window.location</script>");

        }

    ?>


</html>