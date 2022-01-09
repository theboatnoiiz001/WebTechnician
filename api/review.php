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
    if(isset($_POST['q1'])){
        $getDataTech = $connect->prepare("SELECT * FROM `posts` WHERE `idpost` = ?");
        $getDataTech->execute([$_POST['postid']]);
        $getDataTech = $getDataTech->fetch();

        $sum = $_POST['q1']+$_POST['q2']+$_POST['q3']+$_POST['q4']+$_POST['q5'];
        $avg = number_format((float)($sum/5), 2, '.', '');
        $addReview = $connect->prepare("INSERT INTO `review`(`user_id`, `q1`, `q2`, `q3`, `q4`, `q5`, `post_id`, `tech_id`, `avg`) VALUES (?,?,?,?,?,?,?,?,?)");
        $addReview->execute([$_SESSION['uid'],$_POST['q1'],$_POST['q2'],$_POST['q3'],$_POST['q4'],$_POST['q5'],$_POST['postid'],$getDataTech['tech'],$avg]);

        $getAvgTech = $connect->prepare("SELECT AVG(`avg`) avgData FROM `review` WHERE `tech_id` = ?");
        $getAvgTech->execute([$getDataTech['tech']]);
        $getAvgTech = $getAvgTech->fetch();

        $updateAvg = $connect->prepare("UPDATE `users` SET `ranking` = ? WHERE `id` = ?");
        $updateAvg->execute([$getAvgTech['avgData'],$getDataTech['tech']]);
        
        $data = [
            'status' => 200,
            'msg' => "ขอบคุณสำหรับความคิดเห็น"
        ];
        echo json_encode($data, true);
        exit();
    }
?>