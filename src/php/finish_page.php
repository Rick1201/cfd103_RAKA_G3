<?php
<<<<<<< HEAD
echo $_POST['img'];
$encoded_image1 =$_POST['img'];
// echo $_POST['img2'];
// $encoded_image2 =$_POST['img2'];
storeImg($encoded_image1);
// storeImg($encoded_image2);
=======
echo $_POST['img1'];
$encoded_image1 =$_POST['img1'];
echo $_POST['img2'];
$encoded_image2 =$_POST['img2'];
storeImg($encoded_image1);
storeImg($encoded_image2);
>>>>>>> b644049a3ce72978a54836e5d95a207597130a1e
// $fileImg_parts = explode(";base64,", $encoded_image);
// $image_type_aux = explode("image/", $fileImg_parts[0]);
// $image_type = $image_type_aux[1];
// $image_base64 = base64_decode($fileImg_parts[1]);
// $results = '../dist/images/' . uniqid() .'.'. $image_type;
// echo $results;
// file_put_contents($results, $image_base64);

<<<<<<< HEAD
=======

>>>>>>> b644049a3ce72978a54836e5d95a207597130a1e
function storeImg($encoded_image) {
    $fileImg_parts = explode(";base64,", $encoded_image);
    $image_type_aux = explode("image/", $fileImg_parts[0]);
    $image_type = $image_type_aux[1];
    $image_base64 = base64_decode($fileImg_parts[1]);
<<<<<<< HEAD
    $results = '../images/' . uniqid() .'.'. $image_type;
=======
    $results = './images' . uniqid() .'.'. $image_type;
>>>>>>> b644049a3ce72978a54836e5d95a207597130a1e
    echo $results;
    file_put_contents($results, $image_base64);
    }
?>