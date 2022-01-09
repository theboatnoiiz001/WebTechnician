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

if(isset($_POST['req_id'])){
    $del = $connect->prepare("DELETE FROM `work_request` WHERE `id` = ? AND (`tech` = ? OR `user_id` = ?)");
    $del->execute([$_POST['req_id'],$_SESSION['uid'],$_SESSION['uid']]);
    $data = [
        'status' => 200,
        'msg' => "ยกเลิกสำเร็จ"
    ];
    echo json_encode($data, true);
    exit();
}
?>
