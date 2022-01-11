<?php
require_once("connectDB.php");
$dba=file_get_contents("php://input");
$received_data = json_decode($dba);
$data= array();
if($received_data->action =='fetchall'){
    $query="
    SELECT * FROM member
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
    INSERT INTO wface
    (itemName, url, WFace_Status)
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
    ':Member_ID'=>$received_data->itemId,
    ':Member_Mail'=>$received_data->itemAcc,
    ':Member_PSWD'=>$received_data->itemPswd,
    ':Member_Name'=>$received_data->itemName,
    ':Member_Phone'=>$received_data->itemPhone,
    ':Member_Address'=>$received_data->itemAdds,
    ':Member_Card'=>$received_data->itemCard,
    ':Member_Status'=>$received_data->itemSts,
);
    $query = "
    UPDATE member
    SET Member_Mail = :Member_Mail,
    Member_PSWD = :Member_PSWD,
    Member_Name = :Member_Name,
    Member_Phone = :Member_Phone,
    Member_Address = :Member_Address,
    Member_Card = :Member_Card,
    Member_Status = :Member_Status
    WHERE Member_ID = :Member_ID";
    $statement= $connect->prepare($query);
    $statement->execute($data);
    $output = array(
        'message'=>'修改完成'
    );
    echo json_encode($output);

}

if($received_data->action =='delete'){
    $query = "
    DELETE FROM member
    WHERE Member_ID = '$received_data->id.'";
    $statement= $connect->prepare($query);
    $statement->execute($data);
    $output = array(
        'message'=>'已刪除'
    );
    echo json_encode($output);

}

?>