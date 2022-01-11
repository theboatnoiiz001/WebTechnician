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

if($member['role'] == "member"){
    $checkReq = $connect->prepare("SELECT * FROM `register_tech` WHERE `user_id` = ? AND `status` = 0");
    $checkReq->execute([$_SESSION['uid']]);
    if($checkReq->rowCount() == 0){
        $addReq = $connect->prepare("INSERT INTO `register_tech`(`user_id`, `type_work`, `comment`, `accept_by`, `created_at`, `status`) VALUES (?,?,?,?,?,?)");
        $addReq->execute([$_SESSION['uid'],$_POST['type'],$_POST['message'],0,date("Y-m-d H:i:s"),0]);
        $data = [
            'status' => 200,
            'msg' => "ส่งคำขอสำเร็จ!"
        ];
        echo json_encode($data, true);
        exit();
    }else{
        $data = [
            'status' => 100,
            'msg' => "คุณส่งคำขอแล้วรอแอดมินตรวจสอบ!"
        ];
        echo json_encode($data, true);
        exit();
    }
    
}else{
    $data = [
        'status' => 100,
        'msg' => "คุณเป็นช่างอยู่แล้ว"
    ];
    echo json_encode($data, true);
    exit();
}
?>
