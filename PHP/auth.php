<!-- If the player registers or logs in  -->
<?php $type = empty($_GET) ? NULL : array_keys($_GET)[0]; ?>

<div class="center">

    <img src="Assets/title.png" class="title">

    <form method="post" class="card">

        <h2> <?= $type == "register" ? "New traveler" : "Back to hell..."; ?> </h2>

        <p>
            <label for="login">Login</label>
            <input type="text" name="login" required>
        </p>

        <p>
            <label for="password">Password</label>
            <input type="password" name="password" required>
        </p>

        <?php if ($type == "register") { ?>

            <p>
                <label for="password"> Confirm password</label>
                <input type="password" name="cpassword" required>
            </p>

        <?php } ?>

        <p id="formInfo"></p>

        <p>
            <button type="submit" name="submit">S T A R T</button>
        </p>

        <small> <?= $type == "register" ? "Already registered ? <a class='loginRegister' href='' onClick='window.history.replaceState(null, null, window.location.pathname);' >log in</a>" : "No account ? <a class='loginRegister' href='?register'>Register</a>" ?> </small>

    </form>
    <a href="PHP/leaderboard.php" class="leaderboard">Leaderboard</a>

</div>

<?php

    if ($type == "register") {

        // —— If user send form
        if (isset($_POST["submit"])) {

            // —— If password input and username input are not empty
            if ($_POST['password'] == $_POST['cpassword']) {

                // —— Prepare and execute user selection in database
                $stmt = $DB->prepare('SELECT Login FROM users WHERE Login = ?');
                $stmt->execute(array($_POST['login']));

                // —— If already exists, show error message
                if ($stmt->fetch())
                    exit("<script>document.getElementById('formInfo').innerHTML = 'The user already exists'; </script>");

                    echo "OK";
                // —— Prepare and execute user insertion in database
                $stmt = $DB->prepare('INSERT INTO users(Login, Password) VALUE(?, ?)');
                $stmt->execute(array(
                    $_POST['login'],
                    // Hash password
                    password_hash($_POST['password'], PASSWORD_DEFAULT)
                ));

                // —— Start new session and add user data
                if (!isset($_SESSION)) session_start();

                $_SESSION['_userID']    = $DB->lastInsertId();
                $_SESSION['Login']      = $_POST['login'];

                // echo "<script> window.location.href = 'User.php'; </script>";
                echo "<meta http-equiv='refresh' content='0'>";

            } else echo "<script>document.getElementById('formInfo').innerHTML = 'The two passwords do not match'; </script>";

        }

    } else {

        // —— If user send form
        if (isset($_POST["submit"])) {

            // —— If password input and username input are not empty
            if((!empty($_POST['login'])) && (!empty($_POST['password']))){

                // Prepare and execute user selection in database
                $stmt = $DB->prepare('SELECT _ID, Password, Login FROM users WHERE Login = ?');
                $stmt->execute(array($_POST['login']));
                $stmt = $stmt->fetch();

                // —— If no user are found, show error message
                if (!$stmt) {

                    echo "<script>document.getElementById('formInfo').innerHTML = 'Wrong username or password' </script>";

                } else {

                    // —— Check salted password and compare it
                    if (password_verify($_POST['password'], $stmt['Password'])) {

                        // —— If password is correct, start new session and add user data
                        if (!isset($_SESSION)) session_start();

                        $_SESSION['_userID'] = $stmt['_ID'];
                        $_SESSION['Login']   = $_POST['login'];

                        // —— Redirec user to his user profil page
                        // echo "<script> window.location.href = 'User.php'; </script>";
                        echo "<meta http-equiv='refresh' content='0'>";
                        // —— If password is wrong, show error message
                    } else echo "<script>document.getElementById('formInfo').innerHTML = 'Wrong username or password' </script>";
                }
            }
        }
    }

?>