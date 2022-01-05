<?php
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
    $checkImg = $connect->prepare("SELECT `name` FROM `img_logs` WHERE `uid` = ? ORDER BY `id` ASC limit 1");
    $checkImg->execute([$_SESSION['uid']]);
    if ($checkImg->rowCount() == 0) {
        $data = [
            "status" => 100,
            "msg" => "กรุณาอัพโหลดรูปภาพอย่างน้อย 1รูป"
        ];
        echo json_encode($data, true);
        exit();
    }
    $img = $checkImg->fetch();
    if($_POST['type'] == 1 || $_POST['type'] == 2 || $_POST['type'] == 3){
        $post = $connect->prepare("INSERT INTO `posts`(`user_id`, `topic`, `type`, `provinc`, `address`, `phone`, `detail`, `status`, `tech`, `create_at`, `price`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $post->execute([$_SESSION['uid'],$_SESSION['idpost'],$_POST['type'],$_POST['province'],$_POST['address'],$_POST['phone'],$_POST['detail'],0,$img['img'],$_POST['detail'],$_POST['contentPost'],$_POST['amount'],$_POST['province'],$_POST['amphoe'],$_POST['district'],$_POST['zipcode'],strtotime($_POST['date']),time()]);
        $updateImg = $connect->prepare("UPDATE `img_logs` SET `status` = 1 WHERE `formid` = ?");
        $updateImg->execute([$_SESSION['idpost']]);
        
        $data = [
            "status" => 200,
            "msg" => "โพสต์สำเร็จ!",
            "id" => $_SESSION['idpost'],
            "timeLast" => $_POST['date']
        ];
        echo json_encode($data,true);
        exit();
    }
}
