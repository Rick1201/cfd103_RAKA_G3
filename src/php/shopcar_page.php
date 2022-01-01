<?php
require_once("connectDB.php");
$dba=file_get_contents("php://input");
$received_data = json_decode($dba);
$data= array();

if($received_data->action =='insert'){
   
    $query = "
    INSERT INTO orderlist
    (Member_ID, Order_Date, Order_SUM, Order_Shipping, Order_Total, Order_Name, Order_Phone, Order_Address, Order_Notes, Member_Card)
    VALUES ('$received_data->id',now(),'$received_data->sum','$received_data->ship','$received_data->oTotal','$received_data->oName', '$received_data->oTel','$received_data->oAddress', '$received_data->oPs', '$received_data->oCard')";
    // echo $query;
    $statement = $connect -> prepare($query);
    $statement -> execute();
    $output = array(
        'message' => '訂單輸入成功'
    );
    echo json_encode($output);
}

?>