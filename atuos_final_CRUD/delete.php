<?php
session_start();
$message = '';
if (isset($_POST['cancel'])) {
    header("Location: index.html");
    return;
}

if (!isset($_GET['auto_id'])) {
    $_SESSION['error'] = "error connection to database";
    header("Location:view.php");
    return;
}

if (isset($_POST['Delete'])) {
    require_once "./connect_to_db.php";
    $sql = "DELETE from autos where auto_id=" . $_GET['auto_id'];
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $_SESSION['message'] = 'Deleted successfully';
    header("Location:view.php");
    return;
} else if (isset($_POST['cancel'])) {
    $_SESSION['message'] = 'Canceled';
    header("Location:view.php");
    return;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MURHAF ELAMSRI</title>
</head>

<body>
    <h3>Ary you confirming Delete</h3>
    <form method="post">
        <input type="submit" name='Delete' value="Delete">
    </form>
    <a href="./view.php">cancel</a>
</body>

</html>