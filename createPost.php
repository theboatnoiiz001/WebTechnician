<?php
include("template/header.php");
if(!isset($_SESSION['uid'])){
    header("location:login.php");
    exit();
}else{
    $_SESSION['idpost'] = rand(100000,999999);
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
                    <div class="card-header border-primary" text-center">Create Post</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="card cardCenter">
                                    <div class="card-body">
                                        <label>Topic</label>
                                        <input type="text" name="topic" id="topic" class="form-control">
                                        <br>
                                        <label>Type</label>
                                        <select class="form-control" id="type">
                                            <option value="1">Air condition</option>
                                            <option value="2">Refrigerator</option>
                                            <option value="3">Drain pipe</option>
                                            <option value="4">Shower</option>
                                            <option value="5">Unknow</option>
                                        </select>
                                        <br>
                                        <label>Address</label>
                                        <textarea id="address" class="form-control"></textarea>
                                        <br>
                                        <label>Province</label>
                                        <select class="form-control" id="province">
                                            <?php
                                                $province = $connect->prepare("SELECT * FROM `provinces`");
                                                $province->execute();
                                                while($row = $province->fetch()){
                                                    echo '<option value="'.$row['code'].'">'.$row['name_en'].'</option>';
                                                }
                                            ?>
                                        </select>
                                        <br>
                                        <label>Phone</label>
                                        <input type="tel" name="phone" id="phone" class="form-control">
                                        <br>
                                        <label>Details</label>
                                        <textarea id="details" class="form-control"></textarea>
                                        <br>
                                        <label>Price</label>
                                        <select class="form-control" name="price" id="price">
                                            <option value="1">1-1999 บาท</option>
                                            <option value="2">2000-4999 บาท</option>
                                            <option value="3">5000+ บาท</option>
                                        </select>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card cardCenter">
                                    <div class="card-body">
                                        <label><strong>Add Image</strong></label>
                                        <div id="imgPost">
                                            
                                        </div>
                                        <br>
                                        <div class="custom-file">
                                            <input type="file" name="files[]" multiple
                                                class="custom-file-input form-control" id="customFile" onchange="uploadFile(this)">
                                            <label class="custom-file-label" for="customFile">Choose Image</label>
                                        </div>
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

    function addPost(){
        let topic = $("#topic").val();
        let type = $("#type").val();
        let address = $("#address").val();
        let province = $("#province").val();
        let phone = $("#phone").val();
        let details = $("#details").val();
        let price = $("#price").val();

        if(topic != "" && type != "" && address != "" && province != "" && phone != "" && details != "" && price != ""){
            $.post("api/addpost.php",{topic:topic,type:type,address:address,province:province,phone:phone,detail:details,price:price},function(data){
                if(data.status == 200){
                    Swal.fire(
                        'Good job!',
                        data.msg,
                        'success'
                    )
                    setTimeout(function(){
                        window.location = "./post.php?id="+data.id;
                    },1000);
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.msg,
                    })
                    return;
                }
            })
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'กรุณากรอกข้อมูลให้ครบถ้วน',
            })
            return;
        }
        
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
                url: "api/upload.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
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