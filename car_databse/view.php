<?php
session_start();
if (!isset($_SESSION['name'])) {
    die('Not logged in');
}
$name = $_SESSION['name'];
if (isset($_POST['delete'])) {
    require_once("./connect_to_db.php");
    $id = $_POST['auto_id'];
    $sql = "delete from autos where auto_id = $id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MURHAF ELMASRI</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>TRACKING Autos for <?= $name ?> </h1>
    <div style="color:green;">
        <?php
        if (isset($_SESSION['succeed'])) {
            echo "Logged in successfully";
            unset($_SESSION['succeed']);
        }
        if (isset($_SESSION['message'])) {
            echo "Record added " . $_SESSION['message'];
            unset($_SESSION['message']);
        }
        ?>
    </div>

    <div>
        <h2>Automobiles</h2>
    </div>
    <div>
        <a href="./logout.php">Log out</a> | <a href="./add.php">add</a>
    </div>
    <table>
        <tr>
            <th>id</th>
            <th>Year</th>
            <th>make</th>
            <th>mileage</th>
            <th>url</th>
            <th>pics</th>
            <th>delete</th>
        </tr>
        <?php
        require_once('./connect_to_db.php');
        $sql = "SELECT auto_id,year,mileage,make,image_url from autos ORDER BY make";
        $stmt = $pdo->query($sql);
        while ($row = $stmt->fetch($pdo::FETCH_ASSOC)) {
            $id = $row['auto_id'];
            $make = $row['make'];
            $year = $row['year'];
            $mileage = $row['mileage'];
            $url = $row['image_url'];
            echo "<tr> 
        <td>$id</td>
        <td>$year</td>
        <td>$make</td>
        <td>$mileage</td>
        <td>$url</td>
        <td><img src='$url'>
        </td>
        <td>
        <form method='post'>
        <input type='hidden' value='$id' name='auto_id' >
        <input type='submit' value='del' name='delete' >
        </form>
        </td>
           
        </tr>";
        }
        ?>
    </table>
</body>

</html>