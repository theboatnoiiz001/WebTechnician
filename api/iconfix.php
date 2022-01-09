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

if($member['role'] == "technician"){
    $getDataPost = $connect->prepare("SELECT * FROM `posts` WHERE `idpost` = ?");
    $getDataPost->execute([$_POST['idpost']]);
    $getDataPost = $getDataPost->fetch();
    if($getDataPost['status'] != 0){
        $data = [
            'status' => 100,
            'msg' => "มีช่างได้รับงานนี้เรียบร้อยแล้ว"
        ];
        echo json_encode($data, true);
        exit();
    }
    $checkReq = $connect->prepare("SELECT `id` FROM `work_request` WHERE `post_id` = ? AND `tech` = ?");
    $checkReq->execute([$_POST['idpost'],$_SESSION['uid']]);
    if($checkReq->rowCount() == 0){
        $addReq = $connect->prepare("INSERT INTO `work_request`(`post_id`, `tech`, `user_id`, `price`, `message`, `status`,`create_at`) VALUES (?,?,?,?,?,?,?)");
        $addReq->execute([$_POST['idpost'],$_SESSION['uid'],$getDataPost['user_id'],$_POST['price'],$_POST['message'],0,date("Y-m-d H:i:s")]);
        $data = [
            'status' => 200,
            'msg' => "ส่งคำขอสำเร็จ!"
        ];
        echo json_encode($data, true);
        exit();
    }else{
        $data = [
            'status' => 100,
            'msg' => "คุณส่งคำขอโพสต์นี้แล้ว!"
        ];
        echo json_encode($data, true);
        exit();
    }
    
}else{
    $data = [
        'status' => 100,
        'msg' => "เฉพาะช่างเท่านั้นที่สามารถรับงานได้"
    ];
    echo json_encode($data, true);
    exit();
}
?>
