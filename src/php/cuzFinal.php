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
    SELECT * FROM manager
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
    INSERT INTO customize
    (Customize_Name, Member_ID, WOuter_Name, WBand_Name, WPointer_Name, WFace_Name, Div_Name, WFont_Name, WFontSize_ID, WFontText, PBox_PIC, PBand_PIC, Customize_PacPic, Customize_WPicF, Customize_Price, Customize_SUM, Customize_Shipping, Customize_Total, Customize_CName, Customize_Phone, Customize_Address,funcName1, funcName2, funcName3)
    VALUES ('$received_data->cuzName','$received_data->id','$received_data->bezelName','$received_data->bandName','$received_data->pointName','$received_data->faceName','$received_data->diveFun','$received_data->font','$received_data->fontSize','$received_data->msg','$received_data->boxBtn','$received_data->ribbonBtn','$received_data->bezelName')";
    $statement = $connect -> prepare($query);
    $statement -> execute();
    $output = array(
        'message' => '輸入成功'
    );
    echo json_encode($output);
}
if($received_data->action =='fetchSingle'){//單筆資料
    $query="
    SELECT * FROM member
    WHERE Member_ID ='$received_data->id.'
    ";
    $statement= $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row){
        $data['Member_Mail']=$row['Member_Mail'];
        $data['Member_Phone']=$row['Member_Phone'];
        $data['Member_Profile']=$row['Member_Profile'];
        $data['Member_Name']=$row['Member_Name'];
        $data['Member_Profile']=$row['Member_Profile'];
    }
    echo json_encode ($data);
}
if($received_data->action =='update'){
$data =array(
    ':Manager_Account'=>$received_data->managerAcc,
    ':Manager_PSW'=>$received_data->mangerPsw,
    ':Manager_Status'=>$received_data->managerSts,
    ':Manager_ID'=>$received_data->managerId,
);
    $query = "
    UPDATE manager
    SET Manager_Account = :Manager_Account,
    Manager_PSW = :Manager_PSW,
    Manager_Status = :Manager_Status
    WHERE Manager_ID = :Manager_ID";
    $statement= $connect->prepare($query);
    $statement->execute($data);
    $output = array(
        'message'=>'修改完成'
    );
    echo json_encode($output);

}

if($received_data->action =='delete'){
    $query = "
    DELETE FROM manager
    WHERE Manager_ID = '$received_data->id.'";
    $statement= $connect->prepare($query);
    $statement->execute($data);
    $output = array(
        'message'=>'已刪除'
    );
    echo json_encode($output);

}

?>