<!DOCTYPE html>
<html lang="en">
<?php
include("template/header.php");
if(!isset($_GET['id'])){
    header("location:index.php");
    exit();
}else{
    $dataProfile = $connect->prepare("SELECT * FROM `users` WHERE `id` = ?");
    $dataProfile->execute([$_GET['id']]);
    $dataProfile = $dataProfile->fetch();


    $dataDetail = $connect->prepare("SELECT * FROM `userDetail` WHERE `user_id` = ? ORDER BY `id` DESC limit 1");
    $dataDetail->execute([$_GET['id']]);
    if($dataDetail->rowCount() == 0){
        $status = false;
    }else{
        $status = true;
        $dataDetail = $dataDetail->fetch();
    }
    
}
?>

<body>
    <?php
        include("template/nav.php");
    ?>
    <div class="modal fade" id="sendReq" tabindex="-1" role="dialog" aria-labelledby="sendReq" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">คำส่งติดต่อช่าง</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>ราคาที่จะเสนอ</label>
                    <br>
                    <input id="price" type="number" class="form-control" value="">
                    <br>
                    <label>ข้อความส่งหาช่าง</label>
                    <br>
                    <input id="message" type="text" class="form-control" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onClick="sendReq()">ส่งคำขอ</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="text-center">
            <h3>Profile</h3>
            <br>
            <img src="uploads/<?php echo $dataProfile['profile']?>.jpg" style="border-radius: 1000px;" data-action="zoom" height="200px">
            <br><br>
            <b>
                <h4><?php echo $dataProfile['name'] . ' ' . $dataProfile['surname']?></h4>
            </b>
            <?php echo getRanking($dataProfile['id'],$connect) . ' (' . $dataProfile['ranking'].'/5)';?>
            <hr>
            <button class="btn btn-primary" data-toggle="modal" data-target="#sendReq"><i class="fas fa-paper-plane"></i> ติดต่อช่าง</button>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6 p-2">
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white text-center">About Me</div>
                    <div class="card-body">
                        <div class="mt-4 ml-5">
                            <p>
                                <?php
                                    if($status){
                                        echo $dataDetail['aboutMe'];
                                    }else{
                                        echo'ยังไม่มีข้อมูลเกี่ยวกับฉัน';
                                    }
                                ?>
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-3 p-2">
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white text-center">Address</div>
                    <div class="card-body">
                        <div class="text-center">
                            <i style="font-size:50px;" class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="mt-4">
                            <p><?php
                                    if($status){
                                        echo $dataDetail['address'];
                                    }else{
                                        echo'ยังไม่มีข้อมูลที่อยู่';
                                    }
                                ?></p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-3 p-2">
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white text-center">Contact</div>
                    <div class="card-body">
                        <div class="mt-4" style="padding-left:20px;">
                                <?php
                                    if($status){
                                        echo'<i class="fas fa-phone-volume"></i> <b>'.$dataDetail['phone'].'</b><br>
                                            <i class="fas fa-envelope" style="margin-top:20px;"></i> <b>'.$dataDetail['facebook'].'</b><br>
                                            <i class="fab fa-facebook-square" style="margin-top:20px;"></i> <b>'.$dataDetail['facebook'].'</b><br>
                                            <i class="fab fa-instagram-square" style="margin-top:20px;"></i> <b>'.$dataDetail['instagram'].'</b><br>';
                                    }else{
                                        echo'ยังไม่มีข้อมูลติดต่อ';
                                    }
                                ?>
                            

                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-12 p-2">
                <div class="card border-primary">
                    <div class="card-header">History</div>
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
                                    $getHistory = $connect->prepare("SELECT * FROM `posts` WHERE `tech` = ? ORDER BY `id` DESC");
                                    $getHistory->execute([$_GET['id']]);
                                    while($row = $getHistory->fetch()){
                                        
                                        echo'<tr>
                                                <th scope="row">'.getTypeFix($row['type']).'</th>
                                                <td>'.getProvince($row['province'],$connect).'</td>
                                                <td>'.$row['topic'].'</td>
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
    </div>
    <?php
        include("template/footer.php");
    ?>
    <script>
        function sendReq(){
            let tech = <?php echo $_GET['id'];?>;
            let price = $("#price").val();
            let message = $("#message").val();

            if (price != "" && message != "") {
                $.post("api/sendReqToTech.php", {
                    tech: tech,
                    price: price,
                    message: message
                }, function(data) {
                    if (data.status == 200) {
                        Swal.fire(
                            'Good job!',
                            data.msg,
                            'success'
                        )
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.msg,
                        })
                    }
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                })
            }
        }
    </script>
</body>

</html>