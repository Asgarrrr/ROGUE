<?php

    // —— Tecursively search file hack ;3
    $level = "";

    while (file_exists("..") && !file_exists($level . "config.php"))
        $level = $level . "../";

    // —— Load configuration file
    $config = include($level . "config.php");

    try {

        $DB = new PDO("mysql:host=$config[hostname];dbname=$config[database]", "$config[user]", "$config[password]");

        // —— Set the PDO error mode to exception
        $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        die("Error ! — " . $e->getMessage());
    }

?>