<!DOCTYPE html>
<html lang="en">
<?php
include("template/header.php");
if(!isset($_SESSION['uid'])){
    header("location:login.php");
    exit();
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
                                <th scope="col">Provinc</th>
                                <th scope="col">Detail</th>
                                <th scope="col">Post date</th>
                                <th scope="col">Status</th>
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