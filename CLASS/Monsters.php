<?php

    // —— Creation of the monsters class
    class Monsters implements JsonSerializable {

        private $DB;        // PDO

        private $_ID;       // Int
        private $eName;     // String
        private $eBaseStr;  // Int
        private $eBaseDex;  // Int
        private $eBaseInt;  // Int
        private $eBaseDef;  // Int

        public function __construct(int $_ID, PDO $DB) {

            // —— Prepared statement for the recuperation of the entity
            $result = $DB->prepare("
                SELECT * FROM Entity WHERE _eID = ?
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
            $this->eBaseHP  *= $floor;
            $this->eBaseMP  *= $floor;
        }

        public function jsonSerialize() {

            echo json_encode(get_object_vars($this));

        }

    }

?>