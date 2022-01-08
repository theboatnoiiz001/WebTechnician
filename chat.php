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
    <div class="p-4">
        <br>
        <div class="row">
            <div class="col-md-4">
                <div class="card cardCenter border-primary">
                    <div class="card-header border-primary" text-center">แชท/คำขอแชท</div>
                    <div class="card-body">
                        <ul class="nav nav-tabs">
                            <li class='nav-item'>
                                <a class='nav-link active' data-toggle='tab' href='#s1'>แชททั้งหมด</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link ' data-toggle='tab' href='#s2'>คำขอทั้งหมด <span
                                        class="badge badge-danger"><?php echo $getReqNav->rowCount(); ?></span></a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class='tab-pane container fade in show active' id='s1'>
                                <div id="listChat">

                                </div>
                            </div>
                            <div class='tab-pane container fade' id='s2'>
                                <?php
                                    $getReqAll = $connect->prepare("SELECT * FROM `work_request` WHERE `user_id` = ? AND `status` = 0");
                                    $getReqAll->execute([$_SESSION['uid']]);
                                    while($row = $getReqAll->fetch()){
                                        $getTech = $connect->prepare("SELECT * FROM `users` WHERE `id` = ?");
                                        $getTech->execute([$row['tech']]);
                                        $getTech = $getTech->fetch();
                                        ?>
                                        <div class="card border-danger m-3">
                                            <div class="card-header border-danger"><?php echo $getTech['name'].' '.$getTech['surname'];?> (<?php echo $row['create_at'];?>)</div>
                                            <div class="card-body">
                                                <img src="asset/img/person.png" height="50px" class="mr-2">
                                                <?php echo $row['message'];?>
                                                <br>
                                                ขอเสนอราคาที่ : <?php echo $row['price'];?>บาท
                                                <hr>
                                                <button class="btn btn-success" onClick="agreeThis(<?php echo $row['id'];?>)">อณุมัติ</button>
                                                <button class="btn btn-danger" onClick="deleteThis(<?php echo $row['id'];?>)">ไม่สนใจ</button>
                                            </div>
                                        </div>
                                <?php
                                    }
                                ?>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <?php
            if(isset($_GET['id'])){
                $getDataChat = $connect->prepare("SELECT * FROM `chat_id` WHERE (`user_id` = ? OR `tech_id` = ?) AND `id` = ?");
                $getDataChat->execute([$_SESSION['uid'],$_SESSION['uid'],$_GET['id']]);
                $getDataChat = $getDataChat->fetch();
                if($getDataChat['user_id'] == $_SESSION['uid']){
                    $chat2 = $getDataChat['tech_id'];
                }else{
                    $chat2 = $getDataChat['user_id'];
                }
                $getDataChat2 = $connect->prepare("SELECT * FROM `users` WHERE `id` =?");
                $getDataChat2->execute([$chat2]);
                $getDataChat2 = $getDataChat2->fetch();

                $getDataReq = $connect->prepare("SELECT * FROM `work_request` WHERE `id` = ?");
                $getDataReq->execute([$getDataChat['request_id']]);
                $getDataReq = $getDataReq->fetch();

                if($getDataReq['post_id'] == 0){
                    $showDetail = false;
                }else{
                    $showDetail = true;
                    $dataPost = $connect->prepare("SELECT * FROM `posts` WHERE `idpost` = ?");
                    $dataPost->execute([$getDataReq['post_id']]);
                    $dataPost = $dataPost->fetch();
                }
                
                ?>
            <div class="col-md-8">
                <div class="card cardCenter">
                    <div class="card-header" text-center"><b><?php echo $getDataChat2['name'];?> <?php echo $getDataChat2['surname'];?></b></div>
                    <div class="card-body">
                        <?php
                            if($showDetail){
                        ?>
                        <div class="text-center">
                            <p>ประเภทช่าง: <b><?php echo getTypeFix($dataPost['type']);?></b></p>
                            <p>สถานณะ: <b><?php echo getStatusType($dataPost['status']);?></b></p>
                            <p>ติดต่อจากโพสต์: <a href="post.php?id=<?php echo $dataPost['idpost'];?>"><?php echo $dataPost['topic'];?></a>
                            </p>
                            <?php
                                if($dataPost['tech'] != $_SESSION['uid']){
                                    echo '<button class="btn btn-success">งานเสร็จแล้ว</button>';
                                }
                            ?>
                            
                        </div>
                        <?php
                            }
                        ?>
                        <hr>
                        <div id="bodyChat" class="p-2" style="max-height: 500px;overflow-y: scroll;">
                            
                        </div>
                        <hr>
                        <div id="comment" class="p-4">
                            <input type="text" class="form-control" id="chatText">
                            <button class="btn btn-primary mt-2" onClick="sendMessage()">Send</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>

        </div>
    </div>
    </div>
    <?php
        include("template/footer.php");
    ?>
    <script>
    getListChat();
    getMessageChat();
    setTimeout(function() {
        $('#bodyChat').animate({
            scrollTop: $('#bodyChat')[0].scrollHeight
        }, 500);
    }, 2000)

    setInterval(getListChat, 500);
    setInterval(getMessageChat, 500);
    function agreeThis(id){
        $.post("api/agreeReq.php",{req_id:id},function(data){
            if(data.status == 200){
                Swal.fire(
                    'Good job!',
                    data.msg,
                    'success'
                )
                setTimeout(function(){
                    window.location = "./chat.php?id=" + data.chatid;
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

    function getListChat() {
        $.get("./api/getChatAll.php", function(data) {
            $("#listChat").html(data);
        })
    }



    function deleteThis(id){
        console.log("ignoreThis " + id)
    }

    
    <?php
    if(isset($_GET['id'])){
        ?>

            function sendMessage(){
                let message = $("#chatText").val();
                let chatid = <?php echo $_GET['id'];?>;
                if(message != ""){
                    $.post("api/addMessage.php",{chatid:chatid,message:message},function(data){
                        if(data.status != 200){
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.msg,
                        })
                        }else{
                            getMessageChat();
                            $('#bodyChat').animate({
                                scrollTop: $('#bodyChat')[0].scrollHeight
                            }, 800);
                        }
                        $("#chatText").val("")
                    })
                }
            }
            function getMessageChat() {
                $.get("./api/getMessageChat.php?id=<?php echo $_GET['id'];?>", function(data) {
                    $("#bodyChat").html(data);
                })
            }
    <?php
    }
    ?>
    </script>
</body>

</html>