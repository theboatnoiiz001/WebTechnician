<?php
include('../core/config.php');
if (!isset($_SESSION['uid'])) {
    if (isset($_POST['name'])) {
        if ($_POST['surname'] != "" && $_POST['email'] != "" && $_POST['password'] != "") {
            $checkuser = $connect->prepare(" SELECT `id` FROM `user` WHERE `email`=? ");
            $checkuser->execute($_POST['email']);
            if ($checkuser->rowCount() == 0) {
                $add = $connect->prepare("INSERT INTO `user`(`name`, `surname`, `email`, `password`) VALUE (?,?,?,?)");
                $add->execute($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['password']);
                $data = [
                    'status' => 200,
                    'msg' => "success"
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
