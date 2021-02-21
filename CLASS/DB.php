

<?php

    // —— Load configuration file
    $config = include("config.php");

    try {

        $DB = new PDO("mysql:host=$config[hostname];dbname=$config[database]", "$config[user]", "$config[password]");

    } catch (PDOException $e) {

        if ($config['dev'])
            echo "Error ! — " . $e->getMessage();

        die();

    }

?>


