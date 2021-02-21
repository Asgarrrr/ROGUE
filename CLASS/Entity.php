<?php

class Entity {

    private $_ID;
    private $_name;
    private $_baseStr;
    private $_baseDex;
    private $_baseInt;
    private $_baseCon;

    public function __construct(int $_ID, PDO $DB) {

        // —— Prepared statement for the recuperation of the entity
        $result = $DB->prepare("SELECT * FROM Entity WHERE _ID = ?");
        $result->execute(array($_ID));

        $result = $result->fetch();

        $this->_ID      = $result["_ID"];
        $this->_name    = $result["name"];
        $this->_baseStr = $result["baseStr"];
        $this->_baseDex = $result["baseDex"];
        $this->_baseInt = $result["baseInt"];
        $this->_baseCon = $result["baseCon"];

    }

    public function FunctionName()
    {
        print_r($this);
    }

}



?>




