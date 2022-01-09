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
    $checkReq = $connect->prepare("SELECT * FROM `work_request` WHERE `id` = ?");
    $checkReq->execute([$_POST['req_id']]);
    $checkReq = $checkReq->fetch();
    if($checkReq['post_id'] != 0){
        $updatePost = $connect->prepare("UPDATE `posts` SET `tech` = ?, `status` = ? WHERE `idpost` = ?");
        $updatePost->execute([$checkReq['tech'],1,$checkReq['post_id']]);

        $updateReq = $connect->prepare("UPDATE `work_request` SET `status` = ? WHERE `id` = ?");
        $updateReq->execute([1,$_POST['req_id']]);

        $updateReq2 = $connect->prepare("DELETE FROM `work_request` WHERE `post_id` = ? AND `status` = ?");
        $updateReq2->execute([$checkReq['post_id'],0]);

        $addChat = $connect->prepare("INSERT INTO `chat_id`(`user_id`, `tech_id`, `request_id`, `message`, `status`, `created_at`) VALUES (?,?,?,?,?,?)");
        $addChat->execute([$checkReq['user_id'],$checkReq['tech'],$_POST['req_id'],"StartChat",0,date("Y-m-d H:i:s")]);
        $id = $connect->lastInsertId();
        $data = [
            'status' => 200,
            'msg' => "อณุมัติสำเร็จ",
            'chatid' => $id
        ];
        echo json_encode($data, true);
        exit();
    }else{
        $addChat = $connect->prepare("INSERT INTO `chat_id`(`user_id`, `tech_id`, `request_id`, `message`, `status`, `created_at`) VALUES (?,?,?,?,?,?)");
        $addChat->execute([$checkReq['user_id'],$checkReq['tech'],$_POST['req_id'],"StartChat",0,date("Y-m-d H:i:s")]);
        $id = $connect->lastInsertId();
        $data = [
            'status' => 200,
            'msg' => "อณุมัติสำเร็จ",
            'chatid' => $id
        ];
        echo json_encode($data, true);
        exit();
    }
}
?>
