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

if ($member['role'] != "admin") {
    $data = [
        'status' => 100,
        'msg' => "แอดมินเท่านั้น"
    ];
    echo json_encode($data, true);
    exit();
}

if($_POST['type'] == "approve"){
    $getDataReq = $connect->prepare("SELECT * FROM `register_tech` WHERE `id` = ?");
    $getDataReq->execute([$_POST['idReg']]);
    $getDataReq = $getDataReq->fetch();


    $updateUser  = $connect->prepare("UPDATE `users` SET `role` = ?, `type` = ?, `ranking` = ? WHERE `id` = ?");
    $updateUser->execute(["technician",$getDataReq['type_work'],0,$getDataReq['user_id']]);

    $updateReq = $connect->prepare("UPDATE `register_tech` SET `status` = 1, `accept_by` = ? WHERE `id` = ?");
    $updateReq->execute([$_SESSION['uid'],$_POST['idReg']]);

    $data = [
        'status' => 200,    
        'msg' => "ยืนยันสำเร็จ"
    ];
    echo json_encode($data, true);
    exit();
}else{
    $updateReq = $connect->prepare("UPDATE `register_tech` SET `status` = 2, `accept_by` = ? WHERE `id` = ?");
    $updateReq->execute([$_SESSION['uid'],$_POST['idReg']]);

    $data = [
        'status' => 200,
        'msg' => "ปฏิเสธสำเร็จ"
    ];
    echo json_encode($data, true);
    exit();
}
?>
