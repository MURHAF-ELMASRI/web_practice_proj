<html>
<h1>Data of users</h1>

<?php
require_once 'create_pdo_connection.php';
$sql = 'select name,password from user';
$stmt = $pdo->query($sql);
echo "<table>
    <tr>
    <th>user Name</th>
    <th>password</th>
    </tr>  
    ";

while ($row = $stmt->fetch($pdo::FETCH_ASSOC)) {

    echo " <tr><td>" . $row['name'] . "</td><td>" . $row['password'] . "</td></tr>";
}

echo "</table>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="table.css">
    <title>Document</title>
</head>

<body>
    <h1>the data in user database</h1>
</body>

</html>