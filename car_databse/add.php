<?php
session_start();
require_once("./connect_to_db.php");
if (!isset($_SESSION['name'])) {
    die('Not logged in');
}

$name = $_SESSION['name'];

$make = $_POST['make'] ?? " ";
$year = $_POST['year'] ?? "";
$mileage = $_POST['mileage'] ?? "";
var_dump($_POST);
if (isset($_POST['add'])) {

    if (strlen($make) <= 0 || ctype_space($make)) {
        $_SESSION['error'] = "<div >Make is required</div>";
        header("Location: add.php");
        return;
    } else if (!is_numeric($mileage) || !is_numeric($year)) {
        $_SESSION['error'] = "<div >Mileage and year must be numeric</div>";
        header("Location: add.php");
        return;
    } else {

        $file = $_POST['fcar'] ?? NULL;
        $base = "/img/";
        if (!$file || strncmp($base, $file, strlen($base)) !== 0)
            $message = "the image directory is not correct";
        $sql = "INSERT INTO autos(make,year,mileage,image_url) VALUES(:make,:year,:mileage,:image_url)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ":make" => htmlentities($_POST['make']),
            ":year" =>  htmlentities($_POST['year']),
            ":mileage" =>  htmlentities($_POST['mileage']),
            ":image_url" =>  htmlentities(('.' . $file))
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>MURHAF ELMASRI</title>
</head>

<body>
    <h1>Trakcing Auto for <?= $_SESSION['name'] ?></h1>
    <div style="color: red;">
        <?php
        if (isset($_SESSION['error'])) {
            echo "" . $_SESSION['error'];
            unset($_SESSION['error']);
        }
        ?>
    </div>

    <div>
        <form method='post'>
            <label for="make">make</label>
            <input type="text" name="make">
            <label for="year">Year</label>
            <input type="text" name="year">
            <label for="mileage">mileage</label>
            <input type="text" name="mileage">
            <input type="submit" value='add' name="add">
            <input type="submit" value='cancel' name="cancel">

        </form>

    </div>
</body>

</html>