<?php
include("../core/config.php");
$getAllChat = $connect->prepare("SELECT * FROM `chat_id` WHERE `user_id` = ? OR `tech_id` = ? ORDER BY `created_at` DESC");
$getAllChat->execute([$_SESSION['uid'],$_SESSION['uid']]);
while($row = $getAllChat->fetch()){
    if($row['user_id'] == $_SESSION['uid']){
        $chat2 = $row['tech_id'];
    }else{
        $chat2 = $row['user_id'];
    }
    $getDataChat2 = $connect->prepare("SELECT * FROM `users` WHERE `id` = ?");
    $getDataChat2->execute([$chat2]);
    $getDataChat2 = $getDataChat2->fetch();

    $getLastChat = $connect->prepare("SELECT * FROM `chat_log` WHERE `chat_id` = ? ORDER BY `id` DESC limit 1");
    $getLastChat->execute([$row['id']]);
    
    if($getLastChat->rowCount() == 0){
        $message = "เริ่มต้นแชท";
    }else{
        $getLastChat = $getLastChat->fetch();
        $message = $getLastChat['message'];
    }
    if($row['status'] == 2){
        $border = "success";
    }else{
        $border = "danger";
    }
    echo'<a href="chat.php?id='.$row['id'].'" style="text-decoration:none;color:black;">
            <div class="card border-'.$border.' m-3">
                <div class="card-header bg-'.$border.' text-white">'.$getDataChat2['name'].' '.$getDataChat2['surname'].'</div>
                <div class="card-body">
                    <img src="uploads/'.$getDataChat2['profile'].'.jpg" height="50px" class="mr-2">
                    '.$message.'
                </div>
            </div>
        </a>';
}
?>