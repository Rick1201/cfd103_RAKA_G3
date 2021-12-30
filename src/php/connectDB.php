<?php
$dbname = "raka1111";
$user = "root";
$password = "wei12345";

$dsn = "mysql:host=localhost;port=3306;dbname=$dbname;charset=utf8";
$connect = new PDO($dsn, $user, $password);
?>