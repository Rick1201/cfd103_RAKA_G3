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
// if($received_data->action =='insert'){
   
//     $query = "
//     INSERT INTO manager
//     (Manager_Account, Manager_PSW, Manager_Status)
//     VALUES ('$received_data->managerAcc','$received_data->mangerPsw','$received_data->managerSts')";
//     $statement = $connect -> prepare($query);
//     $statement -> execute();
//     $output = array(
//         'message' => '輸入成功'
//     );
//     echo json_encode($output);
// }
if($received_data->action =='fetchSingle'){//單筆資料
    $query=
    "select SUM(Order_Total)
    from orderlist 
    where Member_ID = '$received_data->memId'";
    $statement= $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC); //[11,22,33]
    $data['Order_Total']=$result['SUM(Order_Total)'];

    echo json_encode ($data);
}
// if($received_data->action =='update'){
// $data =array(
//     ':Manager_Account'=>$received_data->managerAcc,
//     ':Manager_PSW'=>$received_data->mangerPsw,
//     ':Manager_Status'=>$received_data->managerSts,
//     ':Manager_ID'=>$received_data->managerId,
// );
//     $query = "
//     UPDATE manager
//     SET Manager_Account = :Manager_Account,
//     Manager_PSW = :Manager_PSW,
//     Manager_Status = :Manager_Status
//     WHERE Manager_ID = :Manager_ID";
//     $statement= $connect->prepare($query);
//     $statement->execute($data);
//     $output = array(
//         'message'=>'修改完成'
//     );
//     echo json_encode($output);

// }

// if($received_data->action =='delete'){
//     $query = "
//     DELETE FROM manager
//     WHERE Manager_ID = '$received_data->id.'";
//     $statement= $connect->prepare($query);
//     $statement->execute($data);
//     $output = array(
//         'message'=>'已刪除'
//     );
//     echo json_encode($output);

// }
?>