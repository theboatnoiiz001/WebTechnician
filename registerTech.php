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
                    <label>ชนิดช่างที่จะสมัคร</label>
                    <br>
                    <select class="form-control" id="type">
                        <option value="1">Air condition</option>
                        <option value="2">Refrigerator</option>
                        <option value="3">Drain pipe</option>
                        <option value="4">Shower</option>
                    </select>
                    <br>
                    <label>ข้อความ</label>
                    <br>
                    <input id="message" type="text" class="form-control" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onClick="sendReq()">ส่งคำขอสมัคร</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <br>
        <div class="text-center">
            <button class="btn btn-success" data-toggle="modal" data-target="#sendReq"><i
                    class="fas fa-paper-plane"></i> สมัครงาน</button>
        </div>

        <div class="col-md-12 mt-3">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">ประวัติการสมัครงาน
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Status</th>
                                <th scope="col">ฝ่ายที่สมัคร</th>
                                <th scope="col">ข้อความ</th>
                                <th scope="col">เวลา</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    $getHistory = $connect->prepare("SELECT * FROM `register_tech` WHERE `user_id` = ? ORDER BY `id` DESC");
                                    $getHistory->execute([$_SESSION['uid']]);
                                    while($row = $getHistory->fetch()){
                                        
                                        echo'<tr>
                                                <th scope="row">'.getStatusRegister($row['status']).'</th>
                                                <td>'.getTypeTech($row['type_work']).'</td>
                                                <td>'.$row['comment'].'</td>
                                                <td>'.$row['created_at'].'</td>
                                            </tr>';
                                    }
                                ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function sendReq() {
            let type = $("#type").val();
            let message = $("#message").val();

            if (type != "" && message != "") {
                $.post("api/sendRegisterTech.php", {
                    type: type,
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
    <?php
        include("template/footer.php");
    ?>
</body>

</html>