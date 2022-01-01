<?php
require_once("connectDB.php");
$dba=file_get_contents("php://input");
$received_data = json_decode($dba);
$data= array();
if($received_data->action =='fetchall'){
    $query="
    SELECT * FROM orderlist order by Order_ID Desc limit 1
    ";
    $statement = $connect->prepare($query);
    $statement -> execute();
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
        $data[]=$row;
    }
    echo json_encode($data);
}
if($received_data->action =='insert'){
   
    $query = "
    INSERT INTO orderdetail
    (Order_ID, Product_ID , Order_Count, Product_Price)
    VALUES ('$received_data->orderId','$received_data->productId','$received_data->count','$received_data->price')";
    // echo $query;
    $statement = $connect -> prepare($query);
    $statement -> execute();
    $output = array(
        'message' => '訂單輸入成功'
    );
    echo json_encode($output);
}
?>