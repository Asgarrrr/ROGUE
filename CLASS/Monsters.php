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
                SELECT * FROM entity WHERE Heros._ID = ?
            ");

            $result->execute(array($_ID));

            $result = $result->fetch();

            // —— Database ———————————————————————————————————
            $this->DB           = $DB;

            // —— Monster ————————————————————————————————————
            $this->_ID          = $result["_ID"];
            $this->eName        = $result["eName"];
            $this->eBaseStr     = $result["eBaseStr"];
            $this->eBaseInt     = $result["eBaseInt"];
            $this->eBaseCon     = $result["eBaseDef"];

        }

        public function attaque() {

        }

        public function jsonSerialize() {

            echo json_encode(get_object_vars($this));

        }

    }

?>