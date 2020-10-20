<!-- model -->
<?php
require_once("create_pdo_connection.php");
if (isset($_POST['pass']) && isset($_POST["nam"])) {
    $sql = "INSERT INTO user (name,password) VALUES(:n,:p); ";
    echo ("<pre> $sql </pre");
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':n' => $_POST["nam"],
        ':p' => $_POST['pass']
    ));
}

?>


<!-- view -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign it</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>


    <h1>
        Please enter your name and password
    </h1>

    <form method="post">
        <legend>form</legend>
        <label for="nam">Name : </label>
        <input type="text" name="nam" size="10">
        <label for="pass">Password : </label>
        <input type="password" name="pass">
        <input type="submit" value="GO">
    </form>

    <div class="view">

    </div>
</body>

</html>