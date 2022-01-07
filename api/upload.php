<?php
include("../core/config.php");
if(!isset($_SESSION['uid'])){
    $data = [
        "status" => 100,
        "msg" => "กรุณาเข้าสู่ระบบก่อน"
    ];
    echo json_encode($data,true);
    exit();
}
if(isset($_FILES['file']['name'])){
	$name = md5(uniqid());
	$valid_ext = array('png','jpeg','jpg');
	$target_path = "../uploads/";
	$target_path = $target_path . $name . ".jpg"; 
	$file_extension = pathinfo($target_path, PATHINFO_EXTENSION);
	$file_extension = strtolower($file_extension);
	if(in_array($file_extension,$valid_ext)){
        compressImage($_FILES['file']['tmp_name'],$target_path,60);
		$addData = $connect->prepare("INSERT INTO `image_log`(`user_id`, `post_id`, `name`, `status`, `created_at`) VALUES (?,?,?,?,?)");
		$addData->execute([$_SESSION['uid'],$_SESSION['idpost'],$name,0,date("Y-m-d h:i:s")]);
		echo $name;
    }else{
        echo "InvalidFileType";
    }
}
function compressImage($source, $destination, $quality) {

            $info = getimagesize($source);

            if ($info['mime'] == 'image/jpeg') 
                $image = imagecreatefromjpeg($source);

            elseif ($info['mime'] == 'image/gif') 
                $image = imagecreatefromgif($source);

            elseif ($info['mime'] == 'image/png') 
                $image = imagecreatefrompng($source);

            imagejpeg($image, $destination, $quality);

        }
?>