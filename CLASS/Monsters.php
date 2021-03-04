<?php
    class Monsters implements JsonSerializable {

        private $DB;

        private $_ID;
        private $eName;
        private $eBaseStr;
        private $eBaseDex;
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
            $this->eBaseDex     = $result["eBaseDex"];
            $this->eBaseInt     = $result["eBaseInt"];
            $this->eBaseDef     = $result["eBaseDef"];
            $this->eBaseHP      = $result["eBaseHP"];
            $this->eBaseMP      = $result["eBaseMP"];

        }
        
        public function Difficulty($floor) {
            $this->eBaseStr *= $floor;
            $this->eBaseDex *= $floor;
            $this->eBaseInt *= $floor;
            $this->eBaseDef *= $floor;
            $this->eBaseHP *= $floor;
            $this->eBaseMP *= $floor;
        }

        public function jsonSerialize() {

            echo json_encode(get_object_vars($this));

        }

    }

?>