<?php
header('Content-Type: application/json; charset=utf-8');
include("../core/config.php");
if (!isset($_SESSION['uid'])) {
    $data = [
        'status' => 100,
        'msg' => "กรุณาเข้าสู่ระบบก่อน"
    ];
    echo json_encode($data, true);
    exit();
}
if (isset($_POST['type'])) {
    $checkImg = $connect->prepare("SELECT `name` FROM `image_log` WHERE `user_id` = ? AND `post_id` = ? ORDER BY `id` ASC limit 1");
    $checkImg->execute([$_SESSION['uid'],$_SESSION['idpost']]);
    if ($checkImg->rowCount() == 0) {
        $data = [
            "status" => 100,
            "msg" => "กรุณาอัพโหลดรูปภาพอย่างน้อย 1รูป"
        ];
        echo json_encode($data, true);
        exit();
    }

    $img = $checkImg->fetch();
    if($_POST['topic'] != ""){
        $post = $connect->prepare("INSERT INTO `posts`(`user_id`, `topic`, `type`, `province`, `address`, `phone`, `detail`, `status`, `tech`, `create_at`, `price`,`idpost`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
        $post->execute([$_SESSION['uid'],$_POST['topic'],$_POST['type'],$_POST['province'],$_POST['address'],$_POST['phone'],$_POST['detail'],0,0,date("Y-m-d H:i:s"),$_POST['price'],$_SESSION['idpost']]);
        
        $updateImg = $connect->prepare("UPDATE `image_log` SET `status` = 1 WHERE `user_id` = ? AND `post_id` = ?");
        $updateImg->execute([$_SESSION['uid'],$_SESSION['idpost']]);
        
        $data = [
            "status" => 200,
            "msg" => "โพสต์สำเร็จ!",
            "id" => $_SESSION['idpost']
        ];
        echo json_encode($data,true);
        exit();
    }else{
        $data = [
            "status" => 100,
            "msg" => "กรุณากรอกข้อมูลให้ครบถ้วน"
        ];
        echo json_encode($data, true);
        exit();
    }
}
