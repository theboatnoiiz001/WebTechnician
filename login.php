<?php
include("template/header.php");
if(isset($_SESSION['uid'])){
    header("location:index.php");
    exit();
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
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <div class="card cardCenter border-primary text-center">
                    <div class="card-header">Log-in</div>
                    <div class="card-body">
                    <label>Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                        <br>
                        <label>Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <br>
                        <input type="submit" class="btn btn-primary" onClick="login()" value="Sign in">
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