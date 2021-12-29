<?php
$dbname = "raka1111";
$user = "root";
$password = "wei12345";

$dsn = "mysql:host=localhost;port=3306;dbname=$dbname";
$connect = new PDO($dsn, $user, $password);
$dba=file_get_contents("php://input");
$received_data = json_decode($dba);
$data= array();
if($received_data->action =='fetchall'){
    $query="
    SELECT * FROM product
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
    INSERT INTO product
    (Product_Name, Product_Price, Product_MType, Product_BType, Product_CType,Product_Info, 
    Product_Spec, Product_PIC01, Product_PIC02, Product_PIC03, Product_PIC04, Product_Status)
    VALUES ('$received_data->productName','$received_data->productPrice','$received_data->productMType'
    ,'$received_data->productBType','$received_data->productCType','$received_data->productInfo','$received_data->productSpec'
    ,'$received_data->productPIC1','$received_data->productPIC2','$received_data->productPIC3','$received_data->productPIC4'
    ,'$received_data->productStatus')";
    
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
    ':Product_Name'=>$received_data->productName,
    ':Product_Price'=>$received_data->productPrice,
    ':Product_MType'=>$received_data->productMType,
    ':Product_BType'=>$received_data->productCType,
    ':Product_CType'=>$received_data->productBType,
    ':Product_Info'=>$received_data->productInfo,
    ':Product_Spec'=>$received_data->productSpec,
    ':Product_PIC01'=>$received_data->productPIC1,
    ':Product_PIC02'=>$received_data->productPIC2,
    ':Product_PIC03'=>$received_data->productPIC3,
    ':Product_PIC04'=>$received_data->productPIC4,
    ':Product_Status'=>$received_data->productStatus,
    ':Product_ID'=>$received_data->productId,
);
    $query = "
    UPDATE product
    SET Product_Name = :Product_Name,
    Product_Price = :Product_Price,
    Product_MType = :Product_MType,
    Product_BType = :Product_BType,
    Product_CType = :Product_CType,
    Product_Info = :Product_Info,
    Product_Spec = :Product_Spec,
    Product_PIC01 = :Product_PIC01,
    Product_PIC02 = :Product_PIC02,
    Product_PIC03 = :Product_PIC03,
    Product_PIC04 = :Product_PIC04,
    Product_Status = :Product_Status
    WHERE Product_ID = :Product_ID";
    $statement= $connect->prepare($query);
    $statement->execute($data);
    $output = array(
        'message'=>'修改完成'
    );
    echo json_encode($output);

}

if($received_data->action =='delete'){
    $query = "
    DELETE FROM product
    WHERE Product_ID = '$received_data->id.'";
    $statement= $connect->prepare($query);
    $statement->execute($data);
    $output = array(
        'message'=>'已刪除'
    );
    echo json_encode($output);

}

?>