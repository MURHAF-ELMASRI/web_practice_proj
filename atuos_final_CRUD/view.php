<?php
session_start();
if (!isset($_SESSION['name']))
    die("parameter missing");

require_once "./connect_to_db.php";

$sql = "SELECT * FROM autos";
$stmt = $pdo->query($sql);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>MURHAF ELMASRI</title>
</head>

<body>

    <h1>view Automobiles</h1>
    <div>
        <?php
        if (isset($_SESSION['message'])) {
            echo "" . $_SESSION['message'];
            unset($_SESSION['message']);
        }
        ?>

    </div>
    <div>
        <table>
            <tr>
                <th>Make</th>
                <th>Model</th>
                <th>Year</th>
                <th>Mileage</th>
                <th>Action</th>
            </tr>
            <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $auto_id = $row["auto_id"] ?? "";
                $make = $row['make'] ?? "";
                $model = $row['model'] ?? "";
                $year = $row['year'] ?? "";
                $mileage = $row['mileage'] ?? "";
                echo "<tr>
                <td>$make</td>
                <td>$model</td>
                <td>$year</td>
                <td>$mileage</td>
                <td><a href='./delete.php?auto_id=$auto_id'>Delete</a>/<a href='./edit.php?auto_id=$auto_id'>Edit</a></td>
            </tr>";
            }
            ?>
        </table>
    </div>
    <a href="add.php">Add New</a>
    <br>
    <a href="index.html">Logout</a>
</body>

</html>