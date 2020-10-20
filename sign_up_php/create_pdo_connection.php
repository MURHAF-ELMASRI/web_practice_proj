<?php
$pdo = new PDO('mysql:host=localhost;port=3306; dbname=users', "root", "");
$pdo->setAttribute($pdo::ATTR_ERRMODE, $pdo::ERRMODE_EXCEPTION);
error_log("Hi my name is bixbay");
?>
