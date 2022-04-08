<?php
header('Content-Type: application/json; charset=utf-8');
include('../core/config.php');
if (!isset($_SESSION['uid'])) {
    if (isset($_POST['name'])) {
        if ($_POST['surname'] != "" && $_POST['name'] != "" && $_POST['email'] != "" && $_POST['password'] != "" && $_POST['province'] != "" && $_POST['gender'] != "") {
            $checkuser = $connect->prepare(" SELECT `id` FROM `users` WHERE `email`=? ");
            $checkuser->execute([$_POST['email']]);
            if ($checkuser->rowCount() == 0) {
                $password_hash = md5($_POST['password']);
                $add = $connect->prepare("INSERT INTO `users`(`email`, `password`, `gender`, `province`, `name`, `surname`) VALUES (?,?,?,?,?,?)");
                $add->execute([$_POST['email'], $password_hash , $_POST['gender'], $_POST['province'], $_POST['name'], $_POST['surname']]);
                $data = [
                    'status' => 200,
                    'msg' => "Register Success"
                ];
                echo json_encode($data, true);
                exit();
            } else {
                $data = [
                    'status' => 100,
                    'msg' => "userUsed"
                ];
                echo json_encode($data, true);
                exit();
            }
        } else {
            $data = [
                'status' => 100,
                'msg' => "Incomplete"
            ];
            echo json_encode($data, true);
            exit();
        }
    }else{
        $data = [
            'status' => 100,
            'msg' => "Incomplete POST"
        ];
        echo json_encode($data,true);
        exit();
    }
}
