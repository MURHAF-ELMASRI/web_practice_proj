<?php
session_start();
$message = '';
if (isset($_POST['cancel'])) {
    header("Location: index.html");
    return;
}

$name = '';
$pass = '';

if (isset($_POST['email']) && isset($_POST['pass'])) {
    $name = $_POST['email'];
    $pass = $_POST['pass'];
    if (empty(trim($_POST['email'])) || empty(trim($_POST['pass']))) {
        $_SESSION['error'] = "user name and password are required";
        error_log($message);
        header("Location: login.php");
        return;
    }
    print_r($name);
    print_r($pass);
    $salt = 'XyZzy12*_';
    $enterd_var = hash('md5', $salt . $pass);
    $saved_hash = "1a52e17fa899cf40fb04cfc42e6352f1";
    if ($enterd_var === $saved_hash) {
        $_SESSION['name'] = $name;
        header("Location: view.php");
        return;
    } else {
        $message = "Incorrect password";
        $_SESSION['error'] = $message;
        error_log($message);
        header("Location: login.php?");
        return;
    }
}
?>

<!-- view -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>MURHAF ELMASRI</title>

</head>

<body>
    <h1>Enter user name and password</h1>
    <div class='error'>
        <?php
        if (isset($_SESSION['error'])) {
            echo "" . $_SESSION['error'];
            unset($_SESSION['error']);
        }
        ?>
    </div>
    <form method="post">
        <input type="text" name='email'>
        <input type="text" name='pass'>
        <input type="submit" value="Log In">
    </form>
    <form method="post">
        <input type="hidden" name="cancel">
        <input type="submit" name="cancel" value='cancel'>
    </form>
</body>

</html>