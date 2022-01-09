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

if(isset($_POST['chatid'])){
    $getDataChat = $connect->prepare("SELECT * FROM `chat_id` WHERE `id` = ?");
    $getDataChat->execute([$_POST['chatid']]);
    if($getDataChat->rowCount() != 0){
        $getDataChat = $getDataChat->fetch();

        $updateStatusChat = $connect->prepare("UPDATE `chat_id` SET `status` = 2,`created_at` = ? WHERE `id` = ?");
        $updateStatusChat->execute([date("Y-m-d H:i:s"),$_POST['chatid']]);

        $getDataReq = $connect->prepare("SELECT * FROM `work_request` WHERE `id` = ?");
        $getDataReq->execute([$getDataChat['request_id']]);
        $getDataReq = $getDataReq->fetch();

        $updatePost = $connect->prepare("UPDATE `posts` SET `status` = ? WHERE `idpost` = ?");
        $updatePost->execute([2,$getDataReq['post_id']]);

        $insertChat = $connect->prepare("INSERT INTO `chat_log`(`user_id`, `message`, `chat_id`, `time_send`) VALUES (?,?,?,?)");
        $insertChat->execute([-1,"งานนี้ถูกซ่อมสำเร็จแล้ว!",$_POST['chatid'],date("Y-m-d H:i:s")]);

        $data = [
            'status' => 200,
            'msg' => "งานสำเร็จแล้ว!",
            'postsid' => $getDataReq['post_id']
        ];
        echo json_encode($data, true);
        exit();
    }
}
?>
