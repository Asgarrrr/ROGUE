<?php

    class Heros implements JsonSerializable {

        private $DB;

        private $_ID;
        private $_IDUser;
        private $name;
        private $gender;
        private $baseEntity;
        private $class;
        private $level;
        private $experience;
        private $HP;
        private $str_score;
        private $dex_score;
        private $int_score;
        private $def_score;

        private $floor;
        private $flore;

        private $_eID;
        private $eName;
        private $eBaseStr;
        private $eBaseDex;
        private $eBaseInt;
        private $eBaseDef;

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
            $this->HP           = $result["HP"];
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

        }

        public function PhysicalAttack($target) {
            echo "$this->name attaque $target->eName";

        }

        public function defense($target) {
            $target->HP -= ($this->str_score - $target->eBaseDef);
        }

        public function jsonSerialize() {

            echo json_encode(get_object_vars($this));

        }

    }

?>