<?php
echo $_POST['img'];
$encoded_image1 =$_POST['img'];
// echo $_POST['img2'];
// $encoded_image2 =$_POST['img2'];
storeImg($encoded_image1);
// storeImg($encoded_image2);
// $fileImg_parts = explode(";base64,", $encoded_image);
// $image_type_aux = explode("image/", $fileImg_parts[0]);
// $image_type = $image_type_aux[1];
// $image_base64 = base64_decode($fileImg_parts[1]);
// $results = '../dist/images/' . uniqid() .'.'. $image_type;
// echo $results;
// file_put_contents($results, $image_base64);

function storeImg($encoded_image) {
    $fileImg_parts = explode(";base64,", $encoded_image);
    $image_type_aux = explode("image/", $fileImg_parts[0]);
    $image_type = $image_type_aux[1]; //png
    $image_base64 = base64_decode($fileImg_parts[1]);
    $results = '../images/' . uniqid() .'.'. $image_type;
    echo $results;
    file_put_contents($results, $image_base64);
    }
?>