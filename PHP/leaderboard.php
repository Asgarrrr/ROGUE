<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Leaderboard !</title>

        <link rel="stylesheet" href="../Style/main.css">
    </head>
    <body class="container leaderboardBody">

    <a href="../">—— Back to home</a>
    <h1>
        Leaderboard
    </h1>

    <table class="leaderboardTable">
        <thead>
            <tr>
                <th>Username</th>
                <th>Number of dead</th>
                <th>Deepest floor reached </th>
            </tr>
        </thead>
        <tbody>

        <?php

            require "../CLASS/DB.php";

            $users = $DB->query(" SELECT Users.Login, Users.dead, Users.maxFloor FROM Users WHERE 1 ; ");

            foreach ($users as $key => $value) {

        ?>

            <tr>
                <td><?= $value["Login"] ?></td>
                <td><?= $value["dead"] ?></td>
                <td><?= $value["maxFloor"] ?></td>
            </tr>


        <?php } ?>

        </tbody>
    </table>







    </body>
</html>