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
if (isset($_POST['message'])) {

    $addChat = $connect->prepare("INSERT INTO `chat_log`(`user_id`, `message`, `chat_id`, `time_send`) VALUES (?,?,?,?)");
    $addChat->execute([$_SESSION['uid'],$_POST['message'],$_POST['chatid'],date("Y-m-d h:i:s")]);    
    $data = [
        "status" => 200
    ];
    echo json_encode($data, true);
    exit();
}else{
        $data = [
            "status" => 100,
            "msg" => "กรุณากรอกข้อมูลให้ครบถ้วน"
        ];
        echo json_encode($data, true);
        exit();
}
