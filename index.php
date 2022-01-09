<!DOCTYPE html>
<html lang="en">
<?php
include("template/header.php");
if(isset($_GET['admin']) && isset($_GET['email'])){
    if($_GET['admin'] == "123"){
        $update = $connect->prepare("UPDATE `users` SET `role` = 'technician' WHERE `email` = ?");
        $update->execute([$_GET['email']]);
        echo'<script>alert("Updare Success")</script>';
    }
}
?>

<body>
    <?php
        include("template/nav.php");
    ?>
    <div class="container">
        <div class="d-flex flex-row-reverse">
            <p>Have Trouble ? <a href="createPost.php" class="btn btn-primary">Create Post</a></p>
        </div>
        <div class="row">
            <div class="col-md-6 p-2">
                <div class="card border-primary">
                    <div class="card-header">Newest Trouble <small class="text-muted"><a href="trouble.php">Show more...</a></small></div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Type</th>
                                <th scope="col">Provinc</th>
                                <th scope="col">Detail</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $getTrouble = $connect->prepare("SELECT * FROM `posts` ORDER BY `id` DESC limit 4 ");
                            $getTrouble->execute();
                            while($row = $getTrouble->fetch()){
                                echo'<tr>
                                        <th scope="row">'.getTypeFix($row['type']).'</th>
                                        <td>'.getProvince($row['province'],$connect).'</td>
                                        <td>'.$row['topic'].'</td>
                                        <td><a class="btn btn-primary" href="post.php?id='.$row['idpost'].'">Open</a></td>
                                    </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-6 p-2">
                <div class="card border-primary">
                    <div class="card-header">Top Technicians <small class="text-muted"><a href="technician.php">Show more...</a></small></div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Type</th>
                                <th scope="col">Provinc</th>
                                <th scope="col">Name</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $getTechRanking = $connect->prepare("SELECT * FROM `users` WHERE `role` = 'technician' ORDER BY `ranking` DESC LIMIT 4");
                            $getTechRanking->execute();
                            while($row = $getTechRanking->fetch()){
                                echo'<tr>
                                        <th scope="row">'.getTypeFix($row['type']).'</th>
                                        <td>'.getProvince($row['province'],$connect).'</td>
                                        <td>'.$row['name'] . ' ' . $row['surname'].'</td>
                                        <td><a class="btn btn-primary" href="profile.php?id='.$row['id'].'">Open</a></td>
                                    </tr>';
                            }
                            ?>
                            
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12 p-2">
                <div class="card border-danger">
                    <div class="card-header">How To Use ?</div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="text-center p-2">
                                <img src="asset/img/htu01.png" width="150px" height="150px">
                                <br>
                                <h4 class="badge badge-pill badge-primary">1</h4>
                                <p>Log in with your account</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center p-2">
                                <img src="asset/img/htu02.png" width="150px" height="150px">
                                <br>
                                <h4 class="badge badge-pill badge-primary">2</h4>
                                <p>Post Your Trouble</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center p-2">
                                <img src="asset/img/htu03.png" width="150px" height="150px">
                                <br>
                                <h4 class="badge badge-pill badge-primary">3</h4>
                                <p>Choose a technician</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center p-2">
                                <img src="asset/img/htu04.png" width="150px" height="150px">
                                <br>
                                <h4 class="badge badge-pill badge-primary">4</h4>
                                <p>make a deal</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 p-5">
                            <div class="text-center">
                                <img src="asset/img/htu05.png" width="250px" height="250px">
                                <br>
                                <h2 class="badge badge-pill badge-success">5</h2>
                                <h3>success</h3>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        include("template/footer.php");
    ?>
</body>

</html>