<?php

session_start();

if (isset($_POST["cancel"]))
    header("./index.html");

if (isset($_POST['who']) && isset($_POST['pass'])) {
    if (strpos($_POST['who'], '@') == false) {
        $_SESSION['who'] = $_POST['who'];
        $_SESSION['error'] = "Email must have an at-sign (@)";
        error_log("Error : Email must have an at-sign (@)");
        header("Location: login.php");
        return;
    } else {
        $salt = 'XyZzy12*_';
        $stored_h = "1a52e17fa899cf40fb04cfc42e6352f1";

        $enterd_pass_hash = hash('md5', $salt . $_POST['pass']);
        if ($enterd_pass_hash == $stored_h) {
            $_SESSION['name'] = $_POST['who'];
            $_SESSION['succeed'] = "succeed";
            unset($_SESSION['who']);
            header("Location: view.php");
            error_log("succeed : Logged in");

            return;
        } else {
            $_SESSION['error'] = "Incorrect password";
            error_log("Error : Incorrent password");

            $_SESSION['who'] = $_POST['who'];

            header("Location: ./login.php");
            return;
        }
    }
}
$who = $_SESSION['who'] ?? '';

?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title>MURHAF ELMASRI</title>
</head>

<body>
    <h1>Please Log In</h1>
    <p style="color:red;">
        <?php
        if (isset($_SESSION['error'])) {
            echo "" . $_SESSION['error'];
            unset($_SESSION['error']);
            unset($_SESSION['who']);
        }
        ?>
    </p>
    <form method="post">
        <label for="who">User Name</label>
        <input name="who" type="text" size="40" value=<?= $who ?>>
        <label for="pass">Password</label>
        <input type="text" size="40" name="pass">
        <input type="submit" value="Log In">
        <input type="submit" value="cancel">
    </form>
</body>

</html>