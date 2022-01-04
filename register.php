<!DOCTYPE html>
<html lang="en">
<?php
include("template/header.php");
?>

<body>
    <?php
        include("template/nav.php");
    ?>
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <div class="card cardCenter border-primary text-center">
                    <div class="card-header">Register</div>
                    <div class="card-body">
                        <label>Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                        <br>
                        <label>Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <br>
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                        <br>
                        <label>Surname</label>
                        <input type="text" name="surname" id="surname" class="form-control">
                        <br>
                        <label>Gender</label>
                        <select class="form-control" name="gender" id="gender">
                            <option value="man">Man</option>
                            <option value="woman">Woman</option>
                        </select>
                        <br>
                        <label>Province</label>
                        <select class="form-control" name="province" id="province">
                            <?php
                                $province = $connect->prepare("SELECT * FROM `provinces`");
                                $province->execute();
                                while($row = $province->fetch()){
                                    echo '<option value="'.$row['code'].'">'.$row['name_en'].'</option>';
                                }
                            ?>
                        </select>
                        <br>
                        <input type="submit" class="btn btn-primary" onClick="register()" value="Register">
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