<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand p-2" href="./">
        <img src="asset/img/logo.png" alt="logo" height="36">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav" style="padding-left:20px;">
            <li class="nav-item active">
                <a class="nav-link" href="./"><i class="fas fa-home"></i> Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="trouble.php"><i class="fas fa-tools"></i> Trouble</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="technician.php"><i class="fas fa-users-cog"></i> Technicians</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.php"><i class="fas fa-address-card"></i> About us</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-md-auto">
            <?php
                if(isset($_SESSION['uid'])){
                    
                    if($member['role'] == "member"){
                        $getReqNav = $connect->prepare("SELECT `id` FROM `work_request` WHERE `user_id` = ? AND `status` = 0 AND `post_id` != -1");
                        $getReqNav->execute([$_SESSION['uid']]);
                    }else{
                        $getReqNav = $connect->prepare("SELECT `id` FROM `work_request` WHERE `tech` = ? AND `post_id` = -1 AND `status` = 0");
                        $getReqNav->execute([$_SESSION['uid']]);
                    }
                    if($member['role'] == "technician"){
                        $settingProfile = '<a class="dropdown-item" href="profile.php?id='.$_SESSION['uid'].'">โปรไฟล์ฉัน</a><a class="dropdown-item" href="updateProfile.php">ตั่งค่าโปรไฟล์</a>';
                    }else if($member['role'] == "member"){
                        $settingProfile = '<a class="dropdown-item" href="profile.php?id='.$_SESSION['uid'].'">โปรไฟล์ฉัน</a><a class="dropdown-item" href="updateProfile.php">ตั่งค่าโปรไฟล์</a><a class="dropdown-item" href="myPost.php">โพสต์ของฉัน</a> <a href="registerTech.php   " class="bg-warning dropdown-item"><i class="fas fa-toolbox"></i> สมัครเป็นช่าง</a>';
                    }else if($member['role'] == "admin"){
                        $settingProfile = '<a href="admin.php" class="bg-warning dropdown-item"><i class="fas fa-toolbox"></i>แอดมิน</a>';
                    }
                    echo'
                    <li class="nav-item">
                       
                        <a href="chat.php" class="btn btn-primary text-white">
                            <i class="fas fa-comment"></i> Chat <span class="badge badge-danger">'.$getReqNav->rowCount().'</span>
                        </a>
                        </li>
                    <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user"></i> สวัสดี '.$member['name'].' (' .$member['role'].')
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                '.$settingProfile.'
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</a>
                        </li>
                        ';
                }else{
                    ?>
            <li class="nav-item">
                <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="register.php"><i class="fas fa-user-plus"></i> Register</a>
            </li>
            <?php
                }
            ?>

        </ul>
    </div>
</nav>