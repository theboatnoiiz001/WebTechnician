<?php
include("template/header.php");
if(!isset($_SESSION['uid'])){
    header("location:login.php");
    exit();
}else{
    if(isset($_POST['status'])){
        if($_POST['status'] != -1){
            $updateStatus = $connect->prepare("UPDATE `users` SET `status` = ? WHERE `id` = ?");
            $updateStatus->execute([$_POST['status'],$_SESSION['uid']]);
        }
    }
    $getData = $connect->prepare("SELECT * FROM `userDetail` WHERE `user_id` = ?");
    $getData->execute([$_SESSION['uid']]);
    if($getData->rowCount() == 0){
        $insertData = $connect->prepare("INSERT INTO `userDetail`(`user_id`) VALUES (?)");
        $insertData->execute([$_SESSION['uid']]);

        $getData = $connect->prepare("SELECT * FROM `userDetail` WHERE `user_id` = ?");
        $getData->execute([$_SESSION['uid']]);
    }
    $getData = $getData->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">

<body>
    <?php
        include("template/nav.php");
    ?>
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card cardCenter border-primary">
                    <div class="card-header border-primary" text-center">Update Profile</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="card cardCenter">
                                    <div class="card-body">
                                        <label>Facebook</label>
                                        <input type="text" name="facebook" id="facebook" class="form-control"
                                            value="<?php echo $getData['facebook'];?>">
                                        <br>
                                        <label>Instagram</label>
                                        <input type="text" name="instagram" id="instagram" class="form-control"
                                            value="<?php echo $getData['instagram'];?>">
                                        <br>
                                        <div <?php if($member['role'] == "member"){echo'style="display:none;"';}?>>
                                            <label>TypeWork</label>
                                            <select class="form-control" id="type">
                                                <option value="1">Air condition</option>
                                                <option value="2">Refrigerator</option>
                                                <option value="3">Drain pipe</option>
                                                <option value="4">Shower</option>
                                                <option value="5">Unknow</option>
                                            </select>
                                            <br>
                                        </div>
                                        <label>Address</label>
                                        <textarea id="address"
                                            class="form-control"><?php echo $getData['address'];?></textarea>
                                        <br>
                                        <label>AboutMe</label>
                                        <textarea id="aboutMe"
                                            class="form-control"><?php echo $getData['aboutMe'];?></textarea>
                                        <br>
                                        <label>Phone</label>
                                        <input type="tel" name="phone" id="phone" class="form-control"
                                            value="<?php echo $getData['phone'];?>">
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card cardCenter">
                                    <div class="card-body">
                                        <label><strong>Add Image</strong></label>
                                        <div id="imgPost">
                                            <img src="<?php echo $website;?>/uploads/<?php echo $member['profile'];?>.jpg"
                                                class="rounded mx-auto d-block mr-1 mb-1" data-action="zoom"
                                                height="150px">
                                        </div>
                                        <br>
                                        <div class="custom-file">
                                            <input type="file" name="files[]" multiple
                                                class="custom-file-input form-control" id="customFile"
                                                onchange="uploadFile(this)">
                                            <label class="custom-file-label" for="customFile">Choose Image</label>
                                        </div>

                                        <?php if($member['role'] != "member"){
                                            ?>
                                        <br><br>
                                        <hr>
                                        <div class="text-center">
                                            <label><strong>อัพเดตสถานะ</strong></label>
                                        </div>
                                        Status now: <b><?php echo getStatusTech($member['status']);?></b>
                                        <form method="post">
                                            <select class="form-control" id="status" name="status">
                                                <option value="-1">Select Status</option>
                                                <option value="1">Work Finding</option>
                                                <option value="2">On Working</option>
                                                <option value="3">Unavailable</option>
                                            </select>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary mt-2">Update
                                                    Status</button>
                                            </div>
                                        </form>

                                        <?php
                                        }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 text-center mt-5 mb-2">
                            <button class="btn btn-primary" onClick="addPost()">Create</button>
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
    function addPost() {
        let facebook = $("#facebook").val();
        let instagram = $("#instagram").val();
        let type = $("#type").val();
        let address = $("#address").val();
        let aboutMe = $("#aboutMe").val();
        let phone = $("#phone").val();

        $.post("api/updateProfile.php", {
            facebook: facebook,
            instagram: instagram,
            type: type,
            address: address,
            aboutMe: aboutMe,
            phone: phone
        }, function(data) {
            if (data.status == 200) {
                Swal.fire(
                    'Good job!',
                    data.msg,
                    'success'
                )
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.msg,
                })
            }
        })

    }

    function uploadFile(emt) {
        var imagefile = emt.files[0].type;
        var match = ["image/jpeg", "image/png", "image/jpg"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'ไฟล์รูปภาพผิดพลาด',
            })
            return;
        } else {
            var formData = new FormData();
            formData.append('file', emt.files[0]);
            console.log(emt.files[0])
            $.ajax({
                type: "POST",
                url: "api/uploadProfile.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#imgPost").html("")
                    $("#imgPost").append(renderImg(data))
                }
            })
        }

    }

    function renderImg(id) {
        return `<img src="<?php echo $website;?>/uploads/${id}.jpg" class="rounded mx-auto d-block mr-1 mb-1" data-action="zoom" height="150px">`;
    }
    </script>
</body>

</html>