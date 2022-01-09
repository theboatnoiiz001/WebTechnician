<!DOCTYPE html>
<html lang="en">
<?php
include("template/header.php");
if(!isset($_GET['id'])){
    header("location:index.php");
    exit();
}
$dataPost = $connect->prepare("SELECT * FROM `posts` WHERE `idpost` = ?");
$dataPost->execute([$_GET['id']]);
$dataPost = $dataPost->fetch();
?>

<body>
    <?php
        include("template/nav.php");
    ?>
    <div class="modal fade" id="sendReq" tabindex="-1" role="dialog" aria-labelledby="sendReq" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">ส่งคำขอซ่อม</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>ราคาที่จะเสนอ</label>
                    <br>
                    <input id="price" type="number" class="form-control" value="">
                    <br>
                    <label>ข้อความที่จะส่งหาคนโพสต์</label>
                    <br>
                    <input id="message" type="text" class="form-control" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onClick="iCanFix()">ส่งคำขอ</button>
                </div>
            </div>
        </div>
    </div>
    <div class="p-4">
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card cardCenter border-primary">
                    <div class="card-header border-primary" text-center">Topic: ตู้เย็นพัง</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card cardCenter">
                                    <div class="card-body">
                                        <label>Image</label>
                                        <div class="row text-left">
                                            <?php
                                                $getListImage = $connect->prepare("SELECT * FROM `image_log` WHERE `post_id` = ?");
                                                $getListImage->execute([$_GET['id']]);
                                                while($row = $getListImage->fetch()){
                                                    echo'<img src="uploads/'.$row['name'].'.jpg" class="rounded mx-auto d-block mr-1 mb-1"
                                                    data-action="zoom" height="150px">';
                                                }
                                            ?>
                                        </div>
                                        <br>
                                        <label>Type: </label><b
                                            class="ml-2"><?php echo getTypeFix($dataPost['type']);?></b>
                                        <br>
                                        <label>Address: </label><b class="ml-2"><?php echo $dataPost['address'];?></b>
                                        <br>
                                        <label>Phone: </label><b class="ml-2"><?php echo $dataPost['phone'];?></b>
                                        <br>
                                        <label>Details: </label><b class="ml-2"><?php echo $dataPost['detail'];?></b>
                                        <br>
                                        <label>Price: </label><b class="ml-2"><?php echo getPrice($dataPost['price']);?> บาท</b>
                                        <br>
                                        <br>
                                        <?php
                                            if($dataPost['status'] == 0){
                                                echo'<button class="btn btn-primary" data-toggle="modal" data-target="#sendReq">I can
                                                Fix!</button>';
                                            }
                                        ?>

                                        <?php
                                        $checkReview = $connect->prepare("SELECT * FROM `review` WHERE `post_id` = ?");
                                        $checkReview->execute([$_GET['id']]);
                                        if($checkReview->rowCount() != 0){
                                        $getDataStar = $checkReview->fetch();
                                        ?>
                                        <div class="col-md-12">
                                            <div class="card cardCenter border-success">
                                                <div class="card-header border-success" text-center">
                                                    การแสดงความคิดเห็นงานนี้</div>
                                                <div class="card-body">
                                                    <label>การประสานงานของช่อง : <?php echo getStar($getDataStar['q1']);?></label>
                                                    <hr>
                                                    <label>การอำนวยความสะดวกของช่าง : <?php echo getStar($getDataStar['q2']);?></label>
                                                    <hr>
                                                    <label>การบริการของช่อง : <?php echo getStar($getDataStar['q3']);?></label>
                                                    <hr>
                                                    <label>การให้คำแนะนำของช่าง : <?php echo getStar($getDataStar['q4']);?></label>
                                                    <hr>
                                                    <label>การให้คำแนะนำของช่าง : <?php echo getStar($getDataStar['q5']);?></label>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        ?>


                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card cardCenter">
                                    <div class="card-body">
                                        <label><strong>Status : <b
                                                    id="statusFix"><?php echo getStatusType($dataPost['status']);?></b></strong></label>
                                        <br>
                                        <div class="text-center">
                                            <?php
                                                if($dataPost['status'] != 0){
                                                    $getTech = $connect->prepare("SELECT * FROM `users` WHERE `id` = ?");
                                                    $getTech->execute([$dataPost['tech']]);
                                                    $getTech = $getTech->fetch();
                                                    if($getTech['profile'] == 0){
                                                        $imgProfile = "person";
                                                    }else{
                                                        $imgProfile = $getTech['profile'];
                                                    }
                                                    echo'<a href="profile.php?id='.$getTech['id'].'"><img src="uploads/'.$imgProfile.'.jpg" style="border-radius: 1000px;" height="150px">
                                                    <br>
                                                    <p>('.$getTech['name'].' '.$getTech['surname'].')</p></a>';
                                                    echo getRanking($getTech['id'],$connect) . ' ('.$getTech['ranking'].')';
                                                }
                                            ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="card cardCenter">
                                    <div class="card-body">
                                        <label><strong>Comment</strong></label>
                                        <hr>
                                        <div id="listComment">
                                        </div>
                                    </div>
                                    <div id="comment" class="p-4">
                                        <b>Comment</b>
                                        <input type="text" class="form-control" id="commentText">
                                        <button class="btn btn-primary mt-2" onClick="comment()">Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    <?php
        include("template/footer.php");
    ?>
    <script>
    setInterval(getListComment, 1000);

    $('#commentText').keyup(function(e) {
        if (e.keyCode == 13) {
            comment();
        }
    });

    function comment() {
        let commentText = $("#commentText").val();
        let post_id = <?php echo $_GET['id'];?>;
        if (commentText != "") {
            $.post("api/comment.php", {
                post_id: post_id,
                comment: commentText
            }, function(data) {
                if (data.status == 200) {
                    getListComment();
                    $("#commentText").val("");
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

    function getListComment() {
        $.get("./api/getComment.php?id=<?php echo $_GET['id'];?>", function(data) {
            $("#listComment").html(data);
        })
    }

    function iCanFix() {
        let idpost = <?php echo $_GET['id'];?>;
        let price = $("#price").val();
        let message = $("#message").val();
        if (price != "" && message != "") {
            $.post("api/iconfix.php", {
                idpost: idpost,
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