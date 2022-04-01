<!DOCTYPE html>
<html lang="en">
<?php
include("template/header.php");
if(!isset($_SESSION['uid'])){
    header("location:login.php");
    exit();
}
if(isset($_GET['delete'])){

    $countPost = $connect->prepare("SELECT * FROM `posts` WHERE `idpost` = ?");
    $countPost->execute([$_GET['delete']]);
    if($countPost->rowCount() != 0){
        $dataWork = $countPost->fetch();
        $del = $connect->prepare("DELETE FROM `posts` WHERE `idpost` = ? AND `user_id` = ?");
        $del->execute([$_GET['delete'],$_SESSION['uid']]);

        if($dataWork['status'] != 0){
            $getWork = $connect->prepare("SELECT * FROM `work_request` WHERE `post_id` = ? AND `user_id` = ?");
            $getWork->execute([$_GET['delete'],$_SESSION['uid']]);
            $getWork = $getWork->fetch();
        
            $delWork = $connect->prepare("DELETE FROM `work_request` WHERE `post_id` = ? AND `user_id` = ?");
            $delWork->execute([$_GET['delete'],$_SESSION['uid']]);
        
            $delChat = $connect->prepare("DELETE FROM `chat_id` WHERE `request_id` = ?");
            $delChat->execute([$getWork['id']]);
        }
    }

    
}
?>

<body>
    <?php
        include("template/nav.php");
    ?>
    <div class="container">
        <div class="col-md-12 mt-3">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">History
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Type</th>
                                <th scope="col">Province</th>
                                <th scope="col">Detail</th>
                                <th scope="col">Post date</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    $getHistory = $connect->prepare("SELECT * FROM `posts` WHERE `user_id` = ? ORDER BY `id` DESC");
                                    $getHistory->execute([$_SESSION['uid']]);
                                    while($row = $getHistory->fetch()){
                                        
                                        echo'<tr>
                                                <th scope="row">'.getTypeFix($row['type']).'</th>
                                                <td>'.getProvince($row['province'],$connect).'</td>
                                                <td>'.$row['detail'].'</td>
                                                <td>'.$row['create_at'].'</td>
                                                <td>'.getStatusType($row['status']).'</td>
                                                <td><a href="post.php?id='.$row['idpost'].'" class="btn btn-primary">Open</a></td>
                                                <td><a href="?delete='.$row['idpost'].'" class="btn btn-danger">Delete post</a></td>
                                            </tr>';
                                    }
                                ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <?php
        include("template/footer.php");
    ?>
</body>

</html>