<?php

$image='';
if(isset($_FILES['file']['name'])){
    $image_name = $_FILES['file']['name'];
    $valid_extensions = array("jpg","jpeg","png");
    $extension = pathinfo($image_name, PATHINFO_EXTENSION);
    if(in_array($extension, $valid_extensions))
    {
        $upload_path='./images/'.uniqid(). '.' .$extension;
        if(move_uploaded_file($_FILES['file']['tmp_name'],$upload_path))
        {
            $message = '照片上傳';
            $image =$upload_path;
        }else{
            $message = '照片上傳錯誤';
        }

    }else{
        $message='只接受.jpg .jpeg 與.png格式檔案';
    }
}
else{
    $message = '選擇照片';
}
$output = array(
    'message' => $message,
    'image' => $image
);
echo json_encode($output);
?>