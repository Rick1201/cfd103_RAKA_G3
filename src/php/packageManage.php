<?php
require_once("connectDB.php");
$dba=file_get_contents("php://input");
$received_data = json_decode($dba);
$data= array();
if($received_data->action =='fetchall'){
    $query="
    SELECT * FROM pbox
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
    INSERT INTO pbox
    (PBox_Color, PBox_PIC, PBox_Status)
    VALUES ('$received_data->newColor','$received_data->newPIC','$received_data->newStatus')";
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
    ':PBox_ID'=>$received_data->boxId,
    ':PBox_Color'=>$received_data->boxColor,
    ':PBox_PIC'=>$received_data->boxPic,
    ':PBox_Status'=>$received_data->boxSts,
);
    $query = "
    UPDATE pbox
    SET PBox_Color = :PBox_Color,
    PBox_PIC = :PBox_PIC,
    PBox_Status = :PBox_Status
    WHERE PBox_ID = :PBox_ID";
    $statement= $connect->prepare($query);
    $statement->execute($data);
    $output = array(
        'message'=>'修改完成'
    );
    echo json_encode($output);

}

if($received_data->action =='delete'){
    $query = "
    DELETE FROM pbox
    WHERE PBox_ID = '$received_data->id.'";
    $statement= $connect->prepare($query);
    $statement->execute($data);
    $output = array(
        'message'=>'已刪除'
    );
    echo json_encode($output);

}

?>