
<? include "../CLASS/DB.php"; ?>

    <?php

        $stdt = $DB->prepare("

            SELECT * FROM heros

                INNER JOIN floors  	ON heros.floor		= floors._fID
                INNER JOIN entity 	ON heros.baseEntity = entity._eID

            WHERE heros._IDUser = ?

        ");

        $stdt->execute(array($_SESSION["_userID"]));

    ?>

    <div class="center container">

        <h1>Select à hero</h1>

        <div class="wrapper">

            <?php foreach ($stdt as $key => $value) { ?>

                <form class="card" method="POST" id="<?= $value["_ID"] ?>">

                    <div class="flex" style="margin-bottom: 5px;">
                        <div class="char_port <?= $value["eName"] ."_". $value["gender"] ?>"></div>
                        <h2 class="heroName"><?= $value["name"] ?></h2>
                    </div>

                    <strong><?= "An level ".$value["level"] ." ". $value["eName"]." ". $value["class"] ?></strong>

                    <div class="rollStats">

                        <abbr title="Strength — measuring physical power"> Str:
                            <span><?= $value["str_score"] ?></span>
                        </abbr>

                        <abbr title="Dexterity — measuring agility, balance, coordination and reflexes"> Dex:
                            <span><?= $value["dex_score"] ?></span>
                        </abbr>

                        <abbr title="Intelligence — measuring ability power and stamina"> Int:
                            <span><?= $value["int_score"] ?></span>
                        </abbr>


                        <abbr title="Defense — measuring blocked damage"> Def:
                            <span><?= $value["def_score"] ?></span>
                        </abbr>

                    </div>

                    <p><?= $value["flore"] ?></p>

                    <button type="submit" value="<?= $value["_ID"] ?>" name="characterChoice">Start</button>
                    <button type="button" class="removeHero"  value="<?= $value["_ID"] ?>" name="remove">Delete</button>

                </form>

            <?php } ?>

            <form method="post" class="card" id="createHeroForm" onsubmit="return false">

                <h2>Create your Hero</h2>

                <p>
                    <label for="login">Name</label>
                    <input type="text" id="name" placeholder="The dead's name doesn't matter" maxlength="15" required>
                </p>

                <button type="button" id="abl_roll" class="button">Roll ability scores</button>

                <div class="rollStats">

                    <abbr title="Strength — measuring physical power"> Str:
                        <span id="str_score">6</span>
                    </abbr>

                    <abbr title="Dexterity — measuring agility, balance, coordination and reflexes"> Dex:
                        <span id="dex_score">6</span>
                    </abbr>

                    <abbr title="Intelligence — measuring ability power and stamina"> Int:
                        <span id="int_score">6</span>
                    </abbr>

                    <abbr title="Defense — measuring blocked damage"> Def:
                        <span id="def_score">6</span>
                    </abbr>

                </div>

                <p>
                    <label for="race">Select race:</label>
                    <select id="race">
                        <option value="1">Human</option>
                        <option value="2">Elf</option>
                        <option value="3">Dwarf</option>
                        <option value="4">Dark Elf</option>
                        <option value="5">Orc</option>
                    </select>
                </p>

                <p>
                    <label for="class">Select class:</label>
                    <select id="class">
                        <option value="Figther">Figther</option>
                        <option value="Mage">Mage</option>
                        <option value="Rogue">Rogue</option>
                    </select>
                </p>

                <p>
                    <label for="gender">Select gender:</label>
                    <select id="gender">
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </p>

                <p>
                    <button type="submit" name="submit" id="createHero">Create</button>
                </p>

            </form>

        </div>

        <form method="post" class="logout">
            <button type="submit" name="logout"><—— Logout</button>
        </form>

        <script>
            const idUser = "<?= $_SESSION["_userID"] ?>";
        </script>

        <script src="SCRIPT/utils.js"></script>
        <script src="SCRIPT/createHeros.js"></script>

        <?php

            if (isset($_POST["characterChoice"])) {

                $_SESSION["CharacterID"] = $_POST["characterChoice"];

                echo "<meta http-equiv='refresh' content='0'>";

            }

            // —— Session Destruction
            if(isset($_POST['logout'])) {

                $_SESSION = array();
                session_destroy();

                echo ("<script>window.location = window.location</script>");

            }

        ?>

    </div>