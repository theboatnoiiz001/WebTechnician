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
    $checkReq = $connect->prepare("SELECT `id` FROM `work_request` WHERE `user_id` = ? AND `tech` = ? AND `post_id` = ? AND `status` = ?");
    $checkReq->execute([$_SESSION['uid'],$_POST['tech'],-1,0]);
    if($checkReq->rowCount() == 0){
        $addReq = $connect->prepare("INSERT INTO `work_request`(`post_id`, `tech`, `user_id`, `price`, `message`, `status`,`create_at`) VALUES (?,?,?,?,?,?,?)");
        $addReq->execute([-1,$_POST['tech'],$_SESSION['uid'],$_POST['price'],$_POST['message'],0,date("Y-m-d H:i:s")]);
        $data = [
            'status' => 200,
            'msg' => "ส่งคำขอสำเร็จ!"
        ];
        echo json_encode($data, true);
        exit();
    }else{
        $data = [
            'status' => 100,
            'msg' => "คุณส่งคำขอแล้วรอช่างกดรับคำขอ!"
        ];
        echo json_encode($data, true);
        exit();
    }
    
}else{
    $data = [
        'status' => 100,
        'msg' => "เฉพาะผู้ใช้เท่านั้นถึงจะส่งคำขอได้"
    ];
    echo json_encode($data, true);
    exit();
}
?>
