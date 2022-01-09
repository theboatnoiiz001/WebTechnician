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
if($dataPost['status'] != 2){
    header("location:index.php");
    exit();
}

$checkReview = $connect->prepare("SELECT * FROM `review` WHERE `post_id` = ?");
$checkReview->execute([$_GET['id']]);
if($checkReview->rowCount() != 0){
    header("location:index.php");
    exit();
}

$getDataTech = $connect->prepare("SELECT * FROM `users` WHERE `id` =?");
$getDataTech->execute([$dataPost['tech']]);
$getDataTech = $getDataTech->fetch();
?>

<body>
    <?php
        include("template/nav.php");
    ?>
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="card cardCenter border-primary">
                    <div class="card-header text-center">แสดงความคิดเห็นหลังเสร็จงาน</div>
                    <div class="card-body">
                        <div style="margin-left:50px;margin-top:10px;margin-bottom:20px;">
                            <p>โพสต์: <a href="post.php?id=<?php echo $dataPost['idpost'];?>"><b><?php echo $dataPost['topic'];?></b></a></p>
                            <p>ช่างที่รับผิดชอบ: <b><?php echo $getDataTech['name'] . ' ' . $getDataTech['surname'];?></b> (<?php echo getRanking($getDataTech['id'],$connect).' '.$getDataTech['ranking'].'/5';?>)</p>
                        </div>
                        <label>1. การประสานงานของช่อง</label>
                        <select class="form-control" id="q1">
                            <option value="5">⭐⭐⭐⭐⭐</option>
                            <option value="4">⭐⭐⭐⭐</option>
                            <option value="3">⭐⭐⭐</option>
                            <option value="2">⭐⭐</option>
                            <option value="1">⭐</option>
                        </select>
                        <br>
                        <label>2. การอำนวยความสะดวกของช่าง</label>
                        <select class="form-control" id="q2">
                            <option value="5">⭐⭐⭐⭐⭐</option>
                            <option value="4">⭐⭐⭐⭐</option>
                            <option value="3">⭐⭐⭐</option>
                            <option value="2">⭐⭐</option>
                            <option value="1">⭐</option>
                        </select>
                        <br>
                        <label>3. การบริการของช่อง</label>
                        <select class="form-control" id="q3">
                            <option value="5">⭐⭐⭐⭐⭐</option>
                            <option value="4">⭐⭐⭐⭐</option>
                            <option value="3">⭐⭐⭐</option>
                            <option value="2">⭐⭐</option>
                            <option value="1">⭐</option>
                        </select>
                        <br>
                        <label>4. การให้คำแนะนำของช่าง</label>
                        <select class="form-control" id="q4">
                            <option value="5">⭐⭐⭐⭐⭐</option>
                            <option value="4">⭐⭐⭐⭐</option>
                            <option value="3">⭐⭐⭐</option>
                            <option value="2">⭐⭐</option>
                            <option value="1">⭐</option>
                        </select>
                        <br>
                        <label>5. การให้คำแนะนำของช่าง</label>
                        <select class="form-control" id="q5">
                            <option value="5">⭐⭐⭐⭐⭐</option>
                            <option value="4">⭐⭐⭐⭐</option>
                            <option value="3">⭐⭐⭐</option>
                            <option value="2">⭐⭐</option>
                            <option value="1">⭐</option>
                        </select>
                        <br>
                        <input type="submit" class="btn btn-primary" onClick="review()" value="ส่งความคิดเห็น">
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
        function review(){
            let postid = <?php echo $_GET['id'];?>;
            let q1 = $("#q1").val();
            let q2 = $("#q2").val();
            let q3 = $("#q3").val();
            let q4 = $("#q4").val();
            let q5 = $("#q5").val();
            $.post("api/review.php",{q1:q1,q2:q2,q3:q3,q4:q4,q5:q5,postid:postid},function(data){
                if(data.status == 200){
                    Swal.fire(
                        'Good job!',
                        data.msg,
                        'success'
                    )
                    setTimeout(function(){
                        window.location = "./";
                    },1000);
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.msg,
                    })
                }
            })
        }
    </script>
</body>

</html>