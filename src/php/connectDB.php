<?php
$dbname = "tibamefe_cfd103g3";
$user = "root";
$password = "alice1105";

$dsn = "mysql:host=localhost;port=3306;dbname=$dbname;charset=utf8";
$connect = new PDO($dsn, $user, $password);
?>