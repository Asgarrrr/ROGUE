<style>

    body {
        font-family: "Courier New", Courier, "Lucida Sans Typewriter", "Lucida Typewriter", monospace;
        color: #FFF7ED;
    }

    .testform{
        max-width: 300px;
        border: 1px solid #FFF7ED;
        padding: 20px;
        margin: 0 auto;
    }

    .rollStats {
        display: flex;
        justify-content: space-around;
    }

    .rollStats > strong {
        color: #DB59D0;
    }

    #abl_roll {
        background-color: transparent;
        color: white;
        border: 1px solid #fff7ed;
        width: 100%;
        padding: 3px;
        border-radius: 4px;
        margin-bottom: 17px;
    }


</style>

"  .ﺣ.\a  ؆ﭳ ﭳ\aζ  ϊ )\aζ  -"


<form method="post" class="testform">


    <h2>Create your Hero</h2>

    <p>
        <label for="login">Name</label>
        <input type="text" name="name" required>
    </p>

    <button type="button" id="abl_roll">Roll ability scores</button>

    <div class="rollStats">

        <strong>

            <abbr title="Strength — measuring physical power and carrying capacity"> Str: </abbr>
            <span id="str_score">8</span>

        </strong>

        <strong>

            <abbr title="Dexterity — measuring agility, balance, coordination and reflexes"> Dex: </abbr>
            <span id="dex_score">6</span>

        </strong>
        <strong>

            <abbr title="Intelligence — measuring deductive reasoning, cognition, knowledge, memory, logic and rationality"> Int: </abbr>
            <span id="int_score">4</span>

        </strong>
        <strong>

            <abbr title="Constitution — measuring endurance, stamina and good health"> Con: </abbr>
            <span id="con_score">6</span>

        </strong>
    </div>

    <p>
        <label for="race">Select race:</label>
        <select name="race">
            <option value="0">Human</option>
            <option value="1">Elf</option>
            <option value="2">Dwarf</option>
            <option value="3">Halfling</option>
            <option value="4">Ork</option>
        </select>
    </p>

    <p>
        <label for="class">Select class:</label>
        <select name="class">
            <option value="0">Figther</option>
            <option value="1">Mage</option>
            <option value="2">Rogue</option>
        </select>
    </p>

    <p>
        <label for="race">Select gender:</label>
        <select name="race">
            <option value="0">Male</option>
            <option value="1">Female</option>
            <option value="0">Tractopelle</option>
        </select>
    </p>

    <p>
        <button type="submit" name="submit">-|---- start</button>
    </p>


</form>

<?php

    require "CLASS/Entity.php";

    $test = new Entity('1', $DB);

    echo $test->FunctionName();

?>

<script src="SCRIPT/index.js"></script>