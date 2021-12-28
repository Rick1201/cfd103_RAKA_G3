<?php
$dbname = "raka01";
$user = "root";
$password = "t72124229155";

$dsn = "mysql:host=localhost;port=3306;dbname=$dbname";
$connect = new PDO($dsn, $user, $password);
$dba=file_get_contents("php://input");
$received_data = json_decode($dba);
$data= array();
if($received_data->action =='fetchall'){
    $query="
    SELECT * FROM wouter
    ";
    $statement = $connect->prepare($query);
    $statement -> execute();
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
        $data[]=$row;
    }
    echo json_encode($data);
}

?>