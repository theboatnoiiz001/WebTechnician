<!DOCTYPE html>
<html lang="en">
<?php
include("template/header.php");
?>

<body>
    <?php
        include("template/nav.php");
    ?>
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
                                            <img src="uploads/mock.jpeg" class="rounded mx-auto d-block mr-1 mb-1"
                                                data-action="zoom" height="150px">
                                            <img src="uploads/mock.jpeg" class="rounded mx-auto d-block mr-1 mb-1"
                                                data-action="zoom" height="150px">
                                            <img src="uploads/mock.jpeg" class="rounded mx-auto d-block mr-1 mb-1"
                                                data-action="zoom" height="150px">
                                            <img src="uploads/mock.jpeg" class="rounded mx-auto d-block mr-1 mb-1"
                                                data-action="zoom" height="150px">
                                            <img src="uploads/mock.jpeg" class="rounded mx-auto d-block mr-1 mb-1"
                                                data-action="zoom" height="150px">
                                            <img src="uploads/mock.jpeg" class="rounded mx-auto d-block mr-1 mb-1"
                                                data-action="zoom" height="150px">
                                            <img src="uploads/mock.jpeg" class="rounded mx-auto d-block mr-1 mb-1"
                                                data-action="zoom" height="150px">
                                            <img src="uploads/mock.jpeg" class="rounded mx-auto d-block mr-1 mb-1"
                                                data-action="zoom" height="150px">
                                            <img src="uploads/mock.jpeg" class="rounded mx-auto d-block mr-1 mb-1"
                                                data-action="zoom" height="150px">
                                            <img src="uploads/mock.jpeg" class="rounded mx-auto d-block mr-1 mb-1"
                                                data-action="zoom" height="150px">
                                            <img src="uploads/mock.jpeg" class="rounded mx-auto d-block mr-1 mb-1"
                                                data-action="zoom" height="150px">
                                            <img src="uploads/mock.jpeg" class="rounded mx-auto d-block mr-1 mb-1"
                                                data-action="zoom" height="150px">
                                        </div>
                                        <br>
                                        <label>Type: </label><b class="ml-2">Refrigerator</b>
                                        <br>
                                        <label>Address: </label><b class="ml-2">325/2 หมู่ 5 ถ.เมรี ซ.เมรี 12 ต. บ้านสวน
                                            อ. เมือง จ. ชลบุรี 20000</b>
                                        <br>
                                        <label>Phone: </label><b class="ml-2">+66 8x-xxx-xxxx</b>
                                        <br>
                                        <label>Details: </label><b class="ml-2">ไฟตู้เย็นกระพริบเป็นช่วงๆ
                                            เสียบางครั้งก็ไม่เย็น </b>
                                        <br>
                                        <br>
                                        <button class="btn btn-primary">I can Fix!</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card cardCenter">
                                    <div class="card-body">
                                        <label><strong>Status : <b id="statusFix">On Fixing</b></strong></label>
                                        <br>
                                        <div class="text-center">
                                            <img src="asset/img/person.png" height="200px">
                                            <br>
                                            <p>(Technician Profile)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card cardCenter">
                                    <div class="card-body">
                                        <label><strong>Comment</strong></label>
                                        <hr>
                                        <div class="pl-3">
                                            <img src="asset/img/person.png" height="50px"> <b class="pl-2">Kittisak
                                                Ngoasriphai</b>
                                            <br>
                                            <p class="pl-4">มันต้องแก่ตรงนั้นนะ</p>
                                            <hr>
                                        </div>
                                        <div class="pl-3">
                                            <img src="asset/img/person.png" height="50px"> <b class="pl-2">Kittisak
                                                Ngoasriphai</b>
                                            <br>
                                            <p class="pl-4">มันต้องแก่ตรงนั้นนะ</p>
                                            <hr>
                                        </div>
                                        <div class="pl-3">
                                            <img src="asset/img/person.png" height="50px"> <b class="pl-2">Kittisak
                                                Ngoasriphai</b>
                                            <br>
                                            <p class="pl-4">มันต้องแก่ตรงนั้นนะ</p>
                                            <hr>
                                        </div>
                                        <div class="pl-3">
                                            <img src="asset/img/person.png" height="50px"> <b class="pl-2">Kittisak
                                                Ngoasriphai</b>
                                            <br>
                                            <p class="pl-4">มันต้องแก่ตรงนั้นนะ</p>
                                            <hr>
                                        </div>
                                    </div>
                                    <div id="comment" class="p-4">
                                        <b>Comment</b>
                                        <input type="text" class="form-control" id="commentText">
                                        <button class="btn btn-primary mt-2">Send</button>
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
</body>

</html>