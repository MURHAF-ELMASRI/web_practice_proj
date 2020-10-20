<?php
require_once "/XAMPP/htdocs/car_databse/connect_to_db.php";
$message = "";



$make = $_POST['make'] ?? "";
$year = $_POST['year'] ?? "";
$mileage = $_POST['mileage'] ?? "";

if (isset($_POST['delete'])) {
    $id = $_POST['auto_id'];
    $sql = "delete from autos where auto_id = $id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
} else if (!isset($_GET['name']))
    die("missing parameter");
else if (isset($_POST['Logout']))
    header("/index.php");
else if (ctype_space($make))
    $message = "<div >Make is required</div>";
else if (!is_numeric($mileage) && !is_numeric($year))
    $message = "<div >Mileage and year must be numeric</div>";
else if (!$_POST['fcar']) {
    $message = "<div >image required</div>";
} else {
    $file = $_POST['fcar'] ?? false;
    $base = "/img/";
    if (!$file || strncmp($base, $file, strlen($base)) !== 0) {
        $message = "the image directory is not correct";
    } else {

        $sql = "INSERT INTO autos(make,year,mileage,image_url) VALUES(:make,:year,:mileage,:image_url)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ":make" => $_POST['make'],
            ":year" => $_POST['year'],
            ":mileage" => $_POST['mileage'],
            ":image_url" => ('.' . $_POST['fcar'])
        ));
        $message = "<div style='color:green;'>Recorded</div>";
    }
}



$sql = "SELECT auto_id,year,mileage,make,image_url from autos ORDER BY make";
$stmt = $pdo->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/car_databse/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MURHAF ELMASRI</title>
</head>

<body>
    <h1>Tracking Autos for <?= $_GET['name'] ?> </h1>
    <div><?= $message ?> </div>
    <form method="post">
        <label for="make">Make</label>
        <input type="text" name='make' value='<?= htmlentities($make) ?>'>
        <label for="year">Year</label>
        <input type="text" name='year' value='<?= htmlentities($year) ?>'>
        <label for="mileage">Mileage</label>
        <input type="text" name="mileage" value='<?= htmlentities($mileage) ?>'>
        <label for="fcar">enter file directory</label>
        <input type="text" name="fcar">
        <input type="submit" value="Add">
        <input type="submit" value="Logout">
    </form>
    <h2>Automobiles</h2>
    <div class="container">
        <table>
            <tr>
                <th>id</th>
                <th>YEAR</th>
                <th>MAKE</th>
                <th>Mileage</th>
                <th>url</th>
                <th>image</th>
            </tr>
            <?php
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
    </div>
</body>

</html>