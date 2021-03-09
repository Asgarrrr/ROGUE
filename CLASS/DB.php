<?php

    // —— Tecursively search file hack ;3
    // $level = "";

    // while (file_exists("..") && !file_exists($level . "config.php"))
    //     $level = $level . "../";

    // // —— Load configuration file
    // $config = include($level . "config.php");

    try {

        $DB = new PDO("mysql:host=mysql-roguesn1.alwaysdata.net;dbname=roguesn1_sb", "roguesn1_sb", "23w9j423w9j4");

    } catch (PDOException $e) {
        die("Error ! — " . $e->getMessage());
    }

?>