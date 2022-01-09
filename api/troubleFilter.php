<?php
include("../core/config.php");
$sqlMain = "SELECT * FROM `posts` WHERE `id` != 0";
if(isset($_POST['type']) && isset($_POST['province']) && isset($_POST['date']) && isset($_POST['status']) && isset($_POST['price'])){
    if($_POST['type'] == -1 && $_POST['province'] == -1 && $_POST['date'] == -1 && $_POST['status'] == -1 && $_POST['price'] == -1){
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
            echo'<tr>
                    <th scope="row">'.getTypeFix($row['type']).'</th>
                    <td>'.getProvince($row['province'],$connect).'</td>
                    <td>'.($row['topic']).'</td>
                    <td>'.($row['create_at']).'</td>
                    <td>'.getStatusType($row['status']).'</td>
                    <td><a class="btn btn-primary" href="post.php?id='.$row['idpost'].'">Open</a></td>
                </tr>';
        }
    }else{
        $ele = array();
        if($_POST['type'] != -1){
            $sqlMain = $sqlMain." AND `type` = ?";
            $ele[] = $_POST['type'];
        }
    
        if($_POST['province'] != -1){
            $sqlMain = $sqlMain." AND `province` = ?";
            $ele[] = $_POST['province'];
        }
    
        if($_POST['status'] != -1){
            $sqlMain = $sqlMain." AND `status` = ?";
            $ele[] = $_POST['status'];
        }    
    
        if($_POST['price'] != -1){
            $sqlMain = $sqlMain." AND `price` = ?";
            $ele[] = $_POST['price'];
        }
        
        if($_POST['date'] != -1){
            if($_POST['date'] == 1){
                $sqlMain = $sqlMain." ORDER BY `create_at` DESC";
            }else{
                $sqlMain = $sqlMain." ORDER BY `create_at` ASC";
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
            echo'<tr>
                    <th scope="row">'.getTypeFix($row['type']).'</th>
                    <td>'.getProvince($row['province'],$connect).'</td>
                    <td>'.($row['topic']).'</td>
                    <td>'.($row['create_at']).'</td>
                    <td>'.getStatusType($row['status']).'</td>
                    <td><a class="btn btn-primary" href="post.php?id='.$row['idpost'].'">Open</a></td>
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
            echo'<tr>
                    <th scope="row">'.getTypeFix($row['type']).'</th>
                    <td>'.getProvince($row['province'],$connect).'</td>
                    <td>'.($row['topic']).'</td>
                    <td>'.($row['create_at']).'</td>
                    <td>'.getStatusType($row['status']).'</td>
                    <td><a class="btn btn-primary" href="post.php?id='.$row['idpost'].'">Open</a></td>
                </tr>';
        }
}

?>