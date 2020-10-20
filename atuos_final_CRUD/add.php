<?php
session_start();
if (!isset($_SESSION['name']))
    die("missing parametre");

$name = $_SESSION['name'];

$make = $_POST['make'] ?? " ";
$year = $_POST['year'] ?? "";
$mileage = $_POST['mileage'] ?? "";
if (isset($_POST['Add'])) {
    if (empty(trim($_POST['make']))) {
        $_SESSION['error'] = 'Make is required';
        header("Location:add.php");
        return;
    } else if (!is_numeric($mileage) || !is_numeric($year)) {
        $_SESSION['error'] = "<div >Mileage and year must be numeric</div>";
        header("Location: add.php");
        return;
    } else {
        require_once("./connect_to_db.php");
        $model = 'null';
        $sql = "INSERT INTO autos(make,model,year,mileage) VALUES(:make,:model,:year,:mileage)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ":make" => htmlentities($_POST['make']),
            ":model" => htmlentities($model),
            ":year" =>  htmlentities($_POST['year']),
            ":mileage" =>  htmlentities($_POST['mileage'])
        ));
        $_SESSION["message"] = "added";
        header("Location:view.php");
        return;
    }
} else if (isset($_POST['cancel'])) {
    $_SESSION['message'] = 'Canceled';
    header("Location: view.php");
    return;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MURHAF ELMASRI</title>
</head>

<body>
    <h1>Add automobile</h1>
    <?php
    if (isset($_SESSION['error'])) {
        echo $_SESSION['error'] . "";
        unset($_SESSION['error']);
    }
    ?>
    <form method="post">
        <label for="make">Make</label>
        <input type="text" name='make'>
        <label for="model">MODEL</label>
        <input type="text" name='model'>
        <label for="year">Year</label>
        <input type="text" name="year">
        <label for="mileage">Mileage</label>
        <input type="text" name="mileage">
        <input type="submit" value="Add" name='Add'>
    </form>
    <form method='post'>
        <input type="hidden" name="cancel">
        <input type="submit" name="cancel" value="cancel">
    </form>

</body>

</html>