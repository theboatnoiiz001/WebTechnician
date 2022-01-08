<?php
include("../core/config.php");
$getDataChat = $connect->prepare("SELECT * FROM `chat_id` WHERE (`user_id` = ? OR `tech_id` = ?) AND `id` = ?");
$getDataChat->execute([$_SESSION['uid'],$_SESSION['uid'],$_GET['id']]);
$getDataChat = $getDataChat->fetch();
if($getDataChat['user_id'] == $_SESSION['uid']){
    $chat2 = $getDataChat['tech_id'];
}else{
    $chat2 = $getDataChat['user_id'];
}

$getChat = $connect->prepare("SELECT * FROM `chat_log` WHERE `chat_id` = ?");
$getChat->execute([$_GET['id']]);

$getUser2 = $connect->prepare("SELECT * FROM `users` WHERE `id` = ?");
$getUser2->execute([$chat2]);
$getUser2 = $getUser2->fetch();
if($getChat->rowCount() == 0){
    echo'<div class="card m-3 border-primary">
            <div class="card-body text-center">
                <b>เริ่มต้นแชทกัน !</b>
            </div>
        </div>';
}
while($row = $getChat->fetch()){
    if($row['user_id'] == $_SESSION['uid']){
        echo'<div class="card m-3 float-right border-primary">
                <div class="card-body" style="width:400px">
                    '.$row['message'].'
                </div>
            </div>';
    }else{
        echo'<div class="card m-3 col-md-12">
                <div class="card-body">
                    <img src="uploads/'.$getUser2['profile'].'.jpg" height="50px" class="mr-2">
                    '.$row['message'].'
                </div>
            </div>';
    }
}
?>