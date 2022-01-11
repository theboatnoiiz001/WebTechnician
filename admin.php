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
        <br>

        <div class="col-md-12 mt-3">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">รายการสมัครเป็นช่าง
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ชื่อ</th>
                                <th scope="col">ฝ่ายที่สมัคร</th>
                                <th scope="col">ข้อความ</th>
                                <th scope="col">เวลา</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    $getHistory = $connect->prepare("SELECT * FROM `register_tech` WHERE `status` = ? ORDER BY `id` DESC");
                                    $getHistory->execute([0]);
                                    while($row = $getHistory->fetch()){
                                        $member = $connect->prepare("SELECT * FROM `users` WHERE `id` = ?");
                                        $member->execute([$row['user_id']]);
                                        $member = $member->fetch();
                                        echo'<tr>
                                                <th scope="row"><a href="profile.php?id='.$member['id'].'" target="_blank">'.$member['name'].' ' .$member['surname'].'</a></th>
                                                <td>'.getTypeTech($row['type_work']).'</td>
                                                <td>'.$row['comment'].'</td>
                                                <td>'.$row['created_at'].'</td>
                                                <td><button class="btn btn-success" onClick="approve('.$row['id'].')">อณุมัติ</button></td>
                                                <td><button class="btn btn-danger" onClick="reject('.$row['id'].')">ไม่อณุมัติ</button></td>
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
        function approve(id) {

                $.post("api/ApproveRegisterTech.php", {
                    idReg: id,
                    type: "approve"
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
        }

        function reject(id) {

            $.post("api/ApproveRegisterTech.php", {
                idReg: id,
                type: "reject"
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
        }
    </script>
    <?php
        include("template/footer.php");
    ?>
</body>

</html>