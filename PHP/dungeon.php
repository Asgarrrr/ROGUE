<?php
    if (!isset($_SESSION)) session_start();
?>


<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>

        <link rel="stylesheet" href="../Style/main.css">
    </head>
    <body>

    <div id="toggle" class="chartoggle" title="Open character sheet">
        <div class="char_port" id="char_port"></div>
        <div class="char_baseData">
            <span id="heroName"></span>
            <attr class="HP">HP: <span id="currentHP">6</span></attr>
            <attr class="MP">MP: <span id="currentMP">0</span></attr>
        </div>
    </div>

    <div class="flex">
        <div id="charscreen">

            <p>
                <span>
                    Level
                    <span id="level"></span>
                </span>
                <span id="race"></span>
                <span id="class"></span>
            </p>

            <p>Experience : <span id="exp"></span></p>

            <p>Hit Points   : <span id="HitP"></span></p>
            <p>Spell Points : <span id="SpeP"></span></p>
            <p>Armor Class  : <span id="ArmP"></span></p>

            <hr>

            <p>
                <abbr title="Strength — measuring physical power and carrying capacity"> Str:
                    <span id="str_score">6</span>
                    <span>[ <span id="str_stuff">6</span> ]</span>
                </abbr>
            </p>

            <p>
                <abbr title="Dexterity — measuring agility, balance, coordination and reflexes"> Dex:
                    <span id="str_score">6</span>
                    <span>[ <span id="dex_score">6</span> ]</span>
                </abbr>
            </p>

            <p>
                <abbr title="Intelligence — measuring deductive reasoning, cognition, knowledge, memory, logic and rationality"> Int:
                    <span id="str_score">6</span>
                    <span>[ <span id="int_score">6</span> ]</span>
                </abbr>
            </p>

            <p>
                <abbr title="Constitution — measuring endurance, stamina and good health"> Con:
                    <span id="str_score">6</span>
                    <span>[ <span id="con_score">6</span> ]</span>
                </abbr>
            </p>

        </div>
        <div id="game"></div>
    </div>

</body>
<script src="../SCRIPT/dungeon.js"></script>

<script>
    loadCharacter(<?= $_SESSION["CharacterID"] ?>);
</script>
</html>