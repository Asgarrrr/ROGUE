<?php

    // —— Creation of the heros class
    class Heros implements JsonSerializable {

        // —— Database ————————————————————
        protected $DB;          // PDO

        // —— Properties of Hero ——————————
        private $_ID;           // Int
        private $_IDUser;       // Int
        private $name;          // String
        private $gender;        // String
        private $baseEntity;    // Int
        private $class;         // String
        private $level;         // Int
        private $experience;    // Int
        private $skillsPoint;   // Int
        private $gold;          // Int
        private $potions;       // Int
        private $maxHP;         // Int
        private $HP;            // Int
        private $maxMP;         // Int
        private $MP;            // Int
        private $str_score;     // Int
        private $dex_score;     // Int
        private $int_score;     // Int
        private $def_score;     // Int

        private $stuff;         // Array

        // —— Floor properties ————————————
        private $floor;         // Int
        private $flore;         // String
        private $fmonsters;     // Array

        // —— Base Entity Properties ——————
        private $_eID;          // Int
        private $eName;         // String
        private $eBaseStr;      // Int
        private $eBaseDex;      // Int
        private $eBaseInt;      // Int
        private $eBaseDef;      // Int
        private $eBaseHP;       // Int
        private $eBaseMP;       // Int

        public function __construct(int $_ID, PDO $DB) {

            // —— Prepared statement for the recuperation of the entity
            $heroStmt = $DB->prepare("
                SELECT * FROM Heros

                    INNER JOIN Floors  	    ON Heros.floor		= Floors._fID
                    INNER JOIN Entity 	    ON Heros.baseEntity = Entity._eID

                WHERE Heros._ID = ?
            ");

            $heroStmt->execute(array($_ID));
            $hero = $heroStmt->fetch();

            // —— Prepared statement for the recuperation of the inventory
            $stuffStmt = $DB->prepare("
                SELECT * FROM Inventory

	                INNER JOIN Stuffs ON Inventory._iSID = Stuffs._sID

                WHERE Inventory._iEID = ?

            ");

            $stuffStmt->execute(array($_ID));

            // —— Divided into 3 equipment groups
            $stuff = array([], [], []);

            // —— Assignment by type
            foreach($stuffStmt as $value)
                array_push($stuff[$value["sType"]], $value);

            // —— Database ———————————————————————————————————
            $this->DB           = $DB;

            // —— Heros ——————————————————————————————————————
            $this->_ID          = $hero["_ID"];
            $this->_IDUser      = $hero["_IDUser"];
            $this->name         = $hero["name"];
            $this->gender       = $hero["gender"];
            $this->baseEntity   = $hero["baseEntity"];
            $this->class        = $hero["class"];
            $this->level        = $hero["level"];
            $this->experience   = $hero["experience"];
            $this->skillsPoint  = $hero["skillsPoint"];
            $this->gold         = $hero["gold"];
            $this->potions      = $hero["potions"];
            $this->maxHP        = $hero["maxHP"];
            $this->HP           = $hero["HP"];
            $this->maxMP        = $hero["maxMP"];
            $this->MP           = $hero["MP"];
            $this->str_score    = $hero["str_score"];
            $this->dex_score    = $hero["dex_score"];
            $this->int_score    = $hero["int_score"];
            $this->def_score    = $hero["def_score"];

            $this->stuff        = $stuff;

            $this->weapon       = $hero["weapon"];
            $this->armor        = $hero["armor"];
            $this->accessory    = $hero["accessory"];

            // —— INNER JOIN Floors ——————————————————————————
            $this->floor        = $hero["floor"];
            $this->flore        = $hero["flore"];

            // —— INNER JOIN Entity ——————————————————————————
            $this->_eID         = $hero["_eID"];
            $this->eName        = $hero["eName"];
            $this->eBaseStr     = $hero["eBaseStr"];
            $this->eBaseDex     = $hero["eBaseDex"];
            $this->eBaseInt     = $hero["eBaseInt"];
            $this->eBaseDef     = $hero["eBaseDef"];
            $this->eBaseHP      = $hero["eBaseHP"];
            $this->eBaseMP      = $hero["eBaseMP"];
            $this->fmonsters    = array(

                                    $hero["fmonster1"],
                                    $hero["fmonster2"],
                                    $hero["fmonster3"],
                                    $hero["fmonster4"],
                                    $hero["fmonster5"],

                                );

        }

        public function PhysicalAttack($target) {
            echo "$this->name attaque $target->eName";
            $target->defense($this->str_score);
        }

        public function MagicalAttack($target) {
            echo "$this->name attaque $target->eName";
            $target->defense($this->int_score);
        }

        public function defense($attack) {
            $this->HP -= ($attack - $this->def_score);
            echo "$this->name a perdu ".($attack - $this->def_score)."PV";
        }

        public function saveFight($hero) {

            $save = $this->DB->prepare("
                UPDATE Heros SET
                    level       = ?,
                    experience  = ?,
                    skillsPoint = ?,
                    gold        = ?,
                    potions     = ?,
                    maxHP       = ?,
                    HP          = ?,
                    maxMP       = ?,
                    MP          = ?,
                    str_score   = ?,
                    dex_score   = ?,
                    int_score   = ?,
                    def_score   = ?,
                    weapon      = ?,
                    armor       = ?,
                    accessory   = ?
                WHERE _ID   = ?
            ");

            $save->execute(array(
                $hero["level"],
                $hero["experience"],
                $hero["skillsPoint"],
                $hero["gold"],
                $hero["potions"],
                $hero["maxHP"],
                $hero["HP"],
                $hero["maxMP"],
                $hero["MP"],
                $hero["str_score"],
                $hero["dex_score"],
                $hero["int_score"],
                $hero["def_score"],
                $hero["weapon"],
                $hero["armor"],
                $hero["accessory"],
                $hero["_ID"],
            ));

        }

        public function saveFloor($floor) {

            $save = $this->DB->prepare("UPDATE Heros SET floor = ? WHERE _ID = ?");

            $save->execute(array($floor, $this->_ID));
        }

        public function deadHero() {

            $delete = $this->DB->prepare("DELETE FROM Inventory WHERE `_iEID` = ?");
            $delete->execute(array($this->_ID));

            $delete = $this->DB->prepare("DELETE FROM Heros WHERE Heros._ID = ?");
            $delete->execute(array($this->_ID));

        }

        public function jsonSerialize() {

            echo json_encode(get_object_vars($this), JSON_NUMERIC_CHECK);

        }

    }

?>