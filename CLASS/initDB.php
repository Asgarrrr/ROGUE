<?php

    require "DB.php";

    if ($config["dev"])
        echo "";

    array(
        "CREATE TABLE Users (
            _ID         int(11)         NOT NULL AUTO_INCREMENT PRIMARY KEY,
            Login       varchar(255)    NOT NULL,
            Password    varchar(255)    NOT NULL

        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
    );



?>