<?php
include("../core/config.php");
$sqlMain = "SELECT * FROM `users` WHERE `role` = 'technician'";
if(isset($_POST['gender']) && isset($_POST['province']) && isset($_POST['ranking']) && isset($_POST['status'])){
    if($_POST['gender'] == -1 && $_POST['province'] == -1 && $_POST['ranking'] == -1 && $_POST['status'] == -1){
        $sqlMain = $sqlMain." ORDER BY `id` DESC";
        $getData = $connect->prepare($sqlMain);
        $getData->execute();
        if($getData->rowCount() == 0){
            echo'<tr>
                    <th scope="row">ไม่พบข้อมูล</th>
                </tr>';
            exit();
        }
        while($row = $getData->fetch()){
            $dataDetail = $connect->prepare("SELECT * FROM `userDetail` WHERE `user_id` = ? ORDER BY `id` DESC limit 1");
            $dataDetail->execute([$row['id']]);
            if($dataDetail->rowCount() == 0){
                $status = false;
                $insertData = $connect->prepare("INSERT INTO `userDetail`(`user_id`) VALUES (?)");
                $insertData->execute([$row['id']]);

                $dataDetail = $connect->prepare("SELECT * FROM `userDetail` WHERE `user_id` = ?");
                $dataDetail->execute([$row['id']]);
            }else{
                $status = true;
            }
            $dataDetail = $dataDetail->fetch();
            echo'<tr>
                    <th scope="row">'.getTypeFix($row['type']).'</th>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['surname'].'</td>
                    <td>'.getProvince($row['province'],$connect).'</td>
                    <td>'.($dataDetail['aboutMe']).'</td>
                    <td>'.getStatusTech($row['status']).'</td>
                    <td>'.getRanking($row['id'],$connect).'</td>
                    <td><a class="btn btn-primary" href="profile.php?id='.$row['id'].'">Open</a></td>
                </tr>';
        }
    }else{
        $ele = array();
        if($_POST['gender'] != -1){
            $sqlMain = $sqlMain." AND `gender` = ?";
            $ele[] = $_POST['gender'];
        }
    
        if($_POST['province'] != -1){
            $sqlMain = $sqlMain." AND `province` = ?";
            $ele[] = $_POST['province'];
        }
    
        if($_POST['status'] != -1){
            $sqlMain = $sqlMain." AND `status` = ?";
            $ele[] = $_POST['status'];
        }
        
        if($_POST['ranking'] != -1){
            if($_POST['ranking'] == 1){
                $sqlMain = $sqlMain." ORDER BY `ranking` DESC";
            }else{
                $sqlMain = $sqlMain." ORDER BY `ranking` ASC";
            }
        }

        $getData = $connect->prepare($sqlMain);
        $getData->execute($ele);
        if($getData->rowCount() == 0){
            echo'<tr>
                    <th scope="row">ไม่พบข้อมูล</th>
                </tr>';
            exit();
        }
        while($row = $getData->fetch()){
            $dataDetail = $connect->prepare("SELECT * FROM `userDetail` WHERE `user_id` = ? ORDER BY `id` DESC limit 1");
            $dataDetail->execute([$row['id']]);
            if($dataDetail->rowCount() == 0){
                $status = false;
                $insertData = $connect->prepare("INSERT INTO `userDetail`(`user_id`) VALUES (?)");
                $insertData->execute([$row['id']]);

                $dataDetail = $connect->prepare("SELECT * FROM `userDetail` WHERE `user_id` = ?");
                $dataDetail->execute([$row['id']]);
            }else{
                $status = true;
            }
            $dataDetail = $dataDetail->fetch();
            echo'<tr>
                    <th scope="row">'.getTypeFix($row['type']).'</th>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['surname'].'</td>
                    <td>'.getProvince($row['province'],$connect).'</td>
                    <td>'.($dataDetail['aboutMe']).'</td>
                    <td>'.getStatusTech($row['status']).'</td>
                    <td>'.getRanking($row['id'],$connect).'</td>
                    <td><a class="btn btn-primary" href="profile.php?id='.$row['id'].'">Open</a></td>
                </tr>';
        }
    }
}else{
        $sqlMain = $sqlMain." ORDER BY `id` DESC";
        $getData = $connect->prepare($sqlMain);
        $getData->execute();
        if($getData->rowCount() == 0){
            echo'<tr>
                    <th scope="row">ไม่พบข้อมูล</th>
                </tr>';
            exit();
        }
        while($row = $getData->fetch()){
            $dataDetail = $connect->prepare("SELECT * FROM `userDetail` WHERE `user_id` = ? ORDER BY `id` DESC limit 1");
            $dataDetail->execute([$row['id']]);
            if($dataDetail->rowCount() == 0){
                $status = false;
                $insertData = $connect->prepare("INSERT INTO `userDetail`(`user_id`) VALUES (?)");
                $insertData->execute([$row['id']]);

                $dataDetail = $connect->prepare("SELECT * FROM `userDetail` WHERE `user_id` = ?");
                $dataDetail->execute([$row['id']]);
            }else{
                $status = true;
            }
            $dataDetail = $dataDetail->fetch();
            echo'<tr>
                    <th scope="row">'.getTypeFix($row['type']).'</th>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['surname'].'</td>
                    <td>'.getProvince($row['province'],$connect).'</td>
                    <td>'.($dataDetail['aboutMe']).'</td>
                    <td>'.getStatusTech($row['status']).'</td>
                    <td>'.getRanking($row['id'],$connect).'</td>
                    <td><a class="btn btn-primary" href="profile.php?id='.$row['id'].'">Open</a></td>
                </tr>';
        }
}

?>