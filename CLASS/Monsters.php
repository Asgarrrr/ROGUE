<?php
    class Monsters implements JsonSerializable {

        private $DB;

        private $_ID;
        private $eName;
        private $eBaseStr;
        private $eBaseInt;
        private $eBaseDef;

        public function __construct(int $_ID, PDO $DB) {

            // —— Prepared statement for the recuperation of the entity
            $result = $DB->prepare("
                SELECT * FROM entity WHERE _eID = ?
            ");

            $result->execute(array($_ID));

            $result = $result->fetch();

            // —— Database ———————————————————————————————————
            $this->DB           = $DB;

            // —— Monster ————————————————————————————————————
            $this->_ID          = $result["_eID"];
            $this->eName        = $result["eName"];
            $this->eBaseStr     = $result["eBaseStr"];
            $this->eBaseInt     = $result["eBaseInt"];
            $this->eBaseDef     = $result["eBaseDef"];

        }

        public function PhysicalAttack($target_ID) {

            require "Heros.php";
            $target = new Heros($target_ID, $this->DB);

            echo "$this->eName attaque $target->name";
            $target->defense($this->eBaseStr);
        }

        public function MagicalAttack($target) {
            echo "$this->eName attaque $target->name";
            $target->defense($this->eBaseInt);
        }

        public function defense($attack) {
            $this->HP -= ($attack - $this->eBaseDef);
            echo "$this->name a perdu ".($attack - $this->eBaseDef)."PV";
        }

        public function jsonSerialize() {

            echo json_encode(get_object_vars($this));

        }

    }

?>