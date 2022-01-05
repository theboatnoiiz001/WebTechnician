<?php
include("../core/config.php");
if (!isset($_SESSION['uid'])) {
    $data = [
        "status" => 100,
        "msg" => "กรุณาเข้าสู่ระบบก่อน"
    ];
    echo json_encode($data, true);
    exit();
}
if (isset($_POST['idpost'])) {
    if ($_POST['comment'] == "") {
        $data = [
            "status" => 100,
            "msg" => 'กรุณากรอกข้อความที่จะคอมเม้น'
        ];
        echo json_encode($data, true);
        exit();
    }
}
$data = null;
$ckpost = $connect->prepare("SELECT `id` FROM `post` WHERE `post_id` = ?");
$ckpost->execute([$_POST['post_id']]);
if ($ckpost->rowCount() != 0) {
    $checkComment = $connect->prepare("SELECT `create_at` FROM `comment` WHERE `user_id` = ? ORDER BY `id` DESC");
    $checkComment->execute([$_SESSION['uid']]);
    $timeComment = $checkComment->fetch();
    if ((time() - $timeComment['[create_at]']) > 30) {
        $addComment = $connect->prepare("INSERT INTO `comments`(`user_id`, `post_id`, `comment`, `create_at`) VALUES (?,?,?,?)");
        $addComment->execute([$_SESSION['uid'], $_POST['post_id'], $_POST['comment'], time()]);
        $data = [
            "status" => 200,
            "msg" => 'คอมเม้นสำเร็จ'
        ];
        echo json_encode($data, true);
        exit();
    } else {
        $data = [
            "status" => 100,
            "msg" => 'กรุณารอ ' .  (30 - (time() - $timeComment['create_at'])) . 'วินาที เพื่อคอมเม้น'
        ];
        echo json_encode($data, true);
        exit();
    }
} else {
    $data = [
        "status" => 100,
        "msg" => 'ไม่พบPOST'
    ];
    echo json_encode($data, true);
    exit();
}
