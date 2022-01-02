<?php
include('../core/config.php');

if (!isset($_SESSION['uid'])) {
    if (isset($_POST['email'])) {
        if ($_POST['email'] != "" && $_POST['password'] != "") {
            $checkuser = $connect->prepare("SELECT `id` FROM `user` WHERE `email` = ? AND `password` = ?");
            $checkuser->execute([$_POST['email'], $_POST['password']]);
            if ($checkuser->rowCount() != 0) {
                $data = [
                    'status' => 200,
                    'msg' => "success"
                ];
                echo json_encode($data, true);
                exit();
            }else{
                $data = [
                    'status' => 100,
                    'msg' => "Email or password Incorrect"
                ];
                echo json_encode($data,true);
                exit();
            }
        }else{
            $data = [
                'status' => 100,
                'msg' => "Incomplete"
            ];
            echo json_encode($data,true);
            exit();
        }
    }else{
        $data = [
            'status' => 100,
            'msg' => "POST ERROR"
        ];
        echo json_encode($data,true);
        exit();
    }
}else{
    $data = [
        'status' => 100,
        'msg' => "เข้าสู่ระบบอยู่แล้ว"
    ];
    echo json_encode($data,true);
    exit();
}
