<?php
require_once("connectDB.php");
$dba=file_get_contents("php://input");
$received_data = json_decode($dba);
$data= array();
if($received_data->action =='fetchall'){
    $query="
    SELECT * FROM wband
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
    INSERT INTO wband
    (itemName, url, WBand_Status)
    VALUES ('$received_data->newName','$received_data->newPIC','$received_data->newStatus')";
    $statement = $connect -> prepare($query);
    $statement -> execute();
    $output = array(
        'message' => '輸入成功'
    );
    echo json_encode($output);
}
// if($received_data->action =='fetchSingle'){
//     $query="
//     SELECT * FROM manager
//     WHERE Manager_ID ='$received_data->id.'
//     ";
//     $statement= $connect->prepare($query);
//     $statement->execute();
//     $result = $statement->fetchAll();
//     foreach($result as $row){
//         $data['id'] = $row['Manager_ID'];
//         $data['Manager_Account']=$row['Manager_Account'];
//         $data['Manager_PSW']=$row['Manager_PSW'];
//         $data['Manager_Status']=$row['Manager_Status'];

//     }
//     echo json_encode ($data);
// }
if($received_data->action =='update'){
$data =array(
    ':WBand_ID'=>$received_data->itemId,
    ':itemName'=>$received_data->itemName,
    ':url'=>$received_data->itemPIC,
    ':WBand_Status'=>$received_data->itemSts,
);
    $query = "
    UPDATE wband
    SET itemName = :itemName,
    url = :url,
    WBand_Status = :WBand_Status
    WHERE WBand_ID = :WBand_ID";
    $statement= $connect->prepare($query);
    $statement->execute($data);
    $output = array(
        'message'=>'修改完成'
    );
    echo json_encode($output);

}

if($received_data->action =='delete'){
    $query = "
    DELETE FROM wband
    WHERE WBand_ID = '$received_data->id.'";
    $statement= $connect->prepare($query);
    $statement->execute($data);
    $output = array(
        'message'=>'已刪除'
    );
    echo json_encode($output);

}

?>