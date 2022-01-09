<?php
include("../core/config.php");
if(isset($_GET['id'])){
    $getComment = $connect->prepare("SELECT * FROM `comments` WHERE `post_id` = ?");
    $getComment->execute([$_GET['id']]);
    while($row = $getComment->fetch()){
        $getTechComment = $connect->prepare("SELECT * FROM `users` WHERE `id` = ?");
        $getTechComment->execute([$row['user_id']]);
        $getTechComment = $getTechComment->fetch();
        if($getTechComment['profile'] == 0){
            $imgProfile = "person";
        }else{
            $imgProfile = $getTechComment['profile'];
        }
        echo'<div class="pl-3">
            <img src="uploads/'.$imgProfile.'.jpg" style="border-radius: 1000px;" height="50px"> <b class="pl-2"> '.$getTechComment['name'].'
                '.$getTechComment['surname'].'</b>
            <br>
            <p class="pl-4">'.$row['comment'].'</p>
            <hr>
        </div>';
    }
}
?>
