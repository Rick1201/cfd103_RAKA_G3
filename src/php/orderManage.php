<?php
require_once("connectDB.php");
$dba=file_get_contents("php://input");
$received_data = json_decode($dba);
$data= array();
if($received_data->action =='fetchall'){
    $query="
    SELECT * FROM orderlist
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
    INSERT INTO PBand
    (PBand_Color, PBand_Pic, PBand_Status)
    VALUES ('$received_data->newColor','$received_data->newPIC','$received_data->newStatus')";
    $statement = $connect -> prepare($query);
    $statement -> execute();
    $output = array(
        'message' => '輸入成功'
    );
    echo json_encode($output);
}
if($received_data->action =='fetchSingle'){
    $query="
    SELECT * FROM orderdetail O 
    join product p on o.Product_ID = p.Product_ID
    WHERE o.Order_ID = '$received_data->id.'
    ";
    $statement= $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    // foreach($result as $row){
    //     $data['id'] = $row['Manager_ID'];
    //     $data['Manager_Account']=$row['Manager_Account'];
    //     $data['Manager_PSW']=$row['Manager_PSW'];
    //     $data['Manager_Status']=$row['Manager_Status'];

    // }
    echo json_encode ($result);
}
// while($row = $statement->fetch(PDO::FETCH_ASSOC))
// {
//     $data[]=$row;
// }
// echo json_encode($data);
// }
if($received_data->action =='update'){
$data =array(
    ':PBand_ID'=>$received_data->boxId,
    ':PBand_Color'=>$received_data->boxColor,
    ':PBand_Pic'=>$received_data->boxPic,
    ':PBand_Status'=>$received_data->boxSts,
);
    $query = "
    UPDATE PBand
    SET PBand_Color = :PBand_Color,
    PBand_Pic = :PBand_Pic,
    PBand_Status = :PBand_Status
    WHERE PBand_ID = :PBand_ID";
    $statement= $connect->prepare($query);
    $statement->execute($data);
    $output = array(
        'message'=>'修改完成'
    );
    echo json_encode($output);

}

if($received_data->action =='delete'){
    $query = "
    DELETE FROM PBand
    WHERE PBand_ID = '$received_data->id.'";
    $statement= $connect->prepare($query);
    $statement->execute($data);
    $output = array(
        'message'=>'已刪除'
    );
    echo json_encode($output);

}

?>