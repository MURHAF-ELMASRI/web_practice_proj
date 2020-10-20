<?php
session_start();
if (!isset($_SESSION['name']))
    die("missing parametre");
require_once("./connect_to_db.php");
$stmt = $pdo->query("select make,model,year,mileage from autos where auto_id=" . $_GET['auto_id']);
$row = $stmt->fetch();
$name = $_SESSION['name'];
$make = $row['make'] ?? " ";
$model = $row['model'] ?? " ";
$year = $row['year'] ?? "";
$mileage = $row['mileage'] ?? "";
if (isset($_POST['Save'])) {
    if (empty(trim($_POST['make'])) || empty(trim($_POST['model'])) || empty(trim($_POST['year'])) || empty(trim($_POST['mileage']))) {
        $_SESSION['error'] = 'All values are required';
        header("Location:add.php");
        return;
    } else if (!is_numeric($mileage) || !is_numeric($year)) {
        $_SESSION['error'] = "<div >Mileage and year must be numeric</div>";
        header("Location: add.php");
        return;
    } else {
        require_once("./connect_to_db.php");
        $sql = "update autos set make=:make ,model=:model,year=:year ,mileage=:mileage where auto_id=" . $_GET['auto_id'];
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ":make" => htmlentities($_POST['make']),
            ":model" => htmlentities($_POST['model']),
            ":year" =>  htmlentities($_POST['year']),
            ":mileage" =>  htmlentities($_POST['mileage'])
        ));
        $_SESSION["message"] = "successfully";
        header("Location: view.php");
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
        <input type="text" name='make' value=<?= htmlentities($make) ?>>
        <label for="model">MODEL</label>
        <input type="text" name='model' value=<?= htmlentities($model) ?>>
        <label for="year">Year</label>
        <input type="text" name="year" value=<?= htmlentities($year) ?>>
        <label for="mileage">Mileage</label>
        <input type="text" name="mileage" value=<?= htmlentities($mileage) ?>>
        <input type="submit" value="Save" name='Save'>
    </form>
    <form method='post'>
        <input type="hidden" name="cancel">
        <input type="submit" name="cancel" value="cancel">
    </form>

</body>

</html>