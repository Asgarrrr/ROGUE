<?php

    class Entity implements JsonSerializable {

        private $_ID;
        private $_name;
        private $_baseStr;
        private $_baseDex;
        private $_baseInt;
        private $_baseDef;

        public function __construct(int $_ID, PDO $DB) {

            // —— Prepared statement for the recuperation of the entity
            $result = $DB->prepare("SELECT * FROM entity WHERE _eID = ?");
            $result->execute(array($_ID));

            $result = $result->fetch();

            $this->_ID      = $result["_eID"];
            $this->_name    = $result["eName"];
            $this->_baseStr = $result["eBaseStr"];
            $this->_baseDex = $result["eBaseDex"];
            $this->_baseInt = $result["eBaseInt"];
            $this->_baseDef = $result["eBaseDef"];

        }

        public function jsonSerialize() {

            echo json_encode(get_object_vars($this));

        }

    }

?>




