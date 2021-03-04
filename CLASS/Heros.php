<?php

    class Heros implements JsonSerializable {

        // —— Database ————————————————————
        protected $DB;

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
            $result = $DB->prepare("
                SELECT * FROM Heros

                    INNER JOIN Floors  	ON Heros.floor		= Floors._fID
                    INNER JOIN Entity 	ON Heros.baseEntity = Entity._eID

                WHERE Heros._ID = ?
            ");

            $result->execute(array($_ID));

            $result = $result->fetch();

            // —— Database ———————————————————————————————————
            $this->DB           = $DB;

            // —— Heros ——————————————————————————————————————
            $this->_ID          = $result["_ID"];
            $this->_IDUser      = $result["_IDUser"];
            $this->name         = $result["name"];
            $this->gender       = $result["gender"];
            $this->baseEntity   = $result["baseEntity"];
            $this->class        = $result["class"];
            $this->level        = $result["level"];
            $this->experience   = $result["experience"];
            $this->skillsPoint  = $result["skillsPoint"];
            $this->gold         = $result["gold"];
            $this->potions      = $result["potions"];
            $this->maxHP        = $result["maxHP"];
            $this->HP           = $result["HP"];
            $this->maxMP        = $result["maxMP"];
            $this->MP           = $result["MP"];
            $this->str_score    = $result["str_score"];
            $this->dex_score    = $result["dex_score"];
            $this->int_score    = $result["int_score"];
            $this->def_score    = $result["def_score"];

            // —— INNER JOIN Floors ——————————————————————————
            $this->floor        = $result["floor"];
            $this->flore        = $result["flore"];

            // —— INNER JOIN Entity ——————————————————————————
            $this->_eID         = $result["_eID"];
            $this->eName        = $result["eName"];
            $this->eBaseStr     = $result["eBaseStr"];
            $this->eBaseDex     = $result["eBaseDex"];
            $this->eBaseInt     = $result["eBaseInt"];
            $this->eBaseDef     = $result["eBaseDef"];
            $this->eBaseHP      = $result["eBaseHP"];
            $this->eBaseMP      = $result["eBaseMP"];
            $this->fmonsters    = array(

                                    $result["fmonster1"],
                                    $result["fmonster2"],
                                    $result["fmonster3"],
                                    $result["fmonster4"],
                                    $result["fmonster5"],

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
                $hero["_ID"],
            ));

        }

        public function saveFloor($floor) {

            $save = $this->DB->prepare("UPDATE Heros SET floor = ?")

            $save->execute(array($floor));
        }

        public function deadHero() {

            $delete = $this->DB->prepare("DELETE FROM Heros WHERE Heros._ID = ?");

            $delete->execute(array($this->_ID));

        }

        public function jsonSerialize() {

            echo json_encode(get_object_vars($this), JSON_NUMERIC_CHECK);

        }

    }

?>