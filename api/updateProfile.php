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

$update = $connect->prepare("UPDATE `userDetail` SET `facebook` = ?, `aboutMe` = ?, `address` = ?, `phone` = ?, `instagram` = ? WHERE `user_id` = ?");
$update->execute([$_POST['facebook'],$_POST['aboutMe'],$_POST['address'],$_POST['phone'],$_POST['instagram'],$_SESSION['uid']]);
$data = [
    'status' => 200,
    'msg' => "อัพเดตข้อมูลสำเร็จ"
];
echo json_encode($data, true);
exit();
?>
