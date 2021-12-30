<?php
require_once("connectDB.php");
$dba=file_get_contents("php://input");
$received_data = json_decode($dba);//轉格式
$data= array();//命名一個空陣列
// $uEmail = $_POST["uEmail"];
// $uPsw = $_POST["uPsw"];
// echo $uEmail;
// if($received_data->action =='fetchall'){
//     $query="
//     SELECT * FROM manager
//     ";
//     $statement = $connect->prepare($query);
//     $statement -> execute();
//     while($row = $statement->fetch(PDO::FETCH_ASSOC))
//     {
//         $data[]=$row;
//     }
//     echo json_encode($data);
// }
if($received_data->action =='insert'){
   
    $query = "
    INSERT INTO member
    (Member_Mail, Member_PSWD, Member_Name)
    VALUES ('$received_data->memAcc','$received_data->memPsw','$received_data->memName')";
    $statement = $connect -> prepare($query);
    $statement -> execute();
    $data = array(
        'message' => '註冊成功,請重新登入'
    );
    echo json_encode($data);
}
if($received_data->action =='fetchSingle'){//單筆資料
    $query=
    "select * 
    from member 
    where Member_Mail = '$received_data->memAcc' and Member_PSWD = '$received_data->memPsw'";
    $statement= $connect->prepare($query);

    $statement->execute();
    if($statement->rowCount() == 0){
        // echo "error";
        echo "帳密錯誤";
    }else{
        $result = $statement->fetch(PDO::FETCH_ASSOC); //[11,22,33]
        $data['Member_ID']=$result['Member_ID'];
    }

    echo json_encode ($data);
}
if($received_data->action =='update'){
$data =array(
    ':Member_ID'=>$received_data->id,
    ':Member_Profile'=>$received_data->memImg,
    ':Member_Mail'=>$received_data->memEmail,
    ':Member_Card'=>$received_data->memCard,
    ':Member_Address'=>$received_data->memAdd,
    ':Member_Phone'=>$received_data->memTel,
);
    $query = "
    UPDATE member
    SET Member_Profile = :Member_Profile,
    Member_Mail = :Member_Mail,
    Member_Card = :Member_Card,
    Member_Address = :Member_Address,
    Member_Phone = :Member_Phone
    WHERE Member_ID = :Member_ID";
    $statement= $connect->prepare($query);
    $statement->execute($data);
    $data = array(
        'message'=>'修改完成'
    );
    echo json_encode($data);

}
if($received_data->action =='update1'){
$data =array(
    ':Member_ID'=>$received_data->id,
    ':Member_Mail'=>$received_data->memEmail,
    ':Member_Card'=>$received_data->memCard,
    ':Member_Address'=>$received_data->memAdd,
    ':Member_Phone'=>$received_data->memTel,
);
    $query = "
    UPDATE member
    SET
    Member_Mail = :Member_Mail,
    Member_Card = :Member_Card,
    Member_Address = :Member_Address,
    Member_Phone = :Member_Phone
    WHERE Member_ID = :Member_ID";
    $statement= $connect->prepare($query);
    $statement->execute($data);
    $data = array(
        'message'=>'修改完成'
    );
    echo json_encode($data);

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