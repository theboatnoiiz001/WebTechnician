<?php
include('../core/config.php');
if (!isset($_SESSION['uid'])) {
    if (isset($_POST['name'])) {
        if ($_POST['surname'] != "" && $_POST['name'] != "" && $_POST['email'] != "" && $_POST['password'] != "" && $_POST['province'] != "" && $_POST['gender'] != "") {
            $checkuser = $connect->prepare(" SELECT `id` FROM `user` WHERE `email`=? ");
            $checkuser->execute($_POST['email']);
            if ($checkuser->rowCount() == 0) {
                $add = $connect->prepare("INSERT INTO `users`(`email`, `password`, `gender`, `provinc`, `name`, `surname`) VALUES (?,?,?,?,?,?)");
                $add->execute($_POST['email'], $_POST['password'], $_POST['gender'], $_POST['provinc'], $_POST['name'], $_POST['surname']);
                $data = [
                    'status' => 200,
                    'msg' => "Log-in Success"
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
