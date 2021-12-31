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
        <div class="d-flex flex-row-reverse">
            <p>Have Trouble ? <a href="createPost.php" class="btn btn-primary">Create Post</a></p>
        </div>
        <div class="row">
            <div class="col-md-6 p-2">
                <div class="card border-primary">
                    <div class="card-header">Newest Trouble <small class="text-muted"><a href="#">Show more...</a></small></div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Type</th>
                                <th scope="col">Provinc</th>
                                <th scope="col">Detail</th>
                                <th scope="col">User</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-6 p-2">
                <div class="card border-primary">
                    <div class="card-header">Top Technicians <small class="text-muted"><a href="#">Show more...</a></small></div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Type</th>
                                <th scope="col">Provinc</th>
                                <th scope="col">Detail</th>
                                <th scope="col">User</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12 p-2">
                <div class="card border-danger">
                    <div class="card-header">How To Use ?</div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="text-center p-2">
                                <img src="asset/img/htu01.png" width="150px" height="150px">
                                <br>
                                <h4 class="badge badge-pill badge-primary">1</h4>
                                <p>Log in with your account</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center p-2">
                                <img src="asset/img/htu02.png" width="150px" height="150px">
                                <br>
                                <h4 class="badge badge-pill badge-primary">2</h4>
                                <p>Post Your Trouble</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center p-2">
                                <img src="asset/img/htu03.png" width="150px" height="150px">
                                <br>
                                <h4 class="badge badge-pill badge-primary">3</h4>
                                <p>Choose a technician</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center p-2">
                                <img src="asset/img/htu04.png" width="150px" height="150px">
                                <br>
                                <h4 class="badge badge-pill badge-primary">4</h4>
                                <p>make a deal</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 p-5">
                            <div class="text-center">
                                <img src="asset/img/htu05.png" width="250px" height="250px">
                                <br>
                                <h2 class="badge badge-pill badge-success">5</h2>
                                <h3>success</h3>
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