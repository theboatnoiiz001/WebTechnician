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
        <div class="col-md-12">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">Filter
                </div>
                <div class="card-body">
                    <div class="row ml-1">
                        <div style="margin-right:20px;">
                            <b>Type: </b>
                            <select class="form-control" style="width:150px;margin-left:10px;">
                                <option selected>Refregerator</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div style="margin-right:20px;">
                            <b>Province </b>
                            <select class="form-control" style="width:150px;margin-left:10px;">
                                <option selected>Province</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div style="margin-right:20px;">
                            <b>Date </b>
                            <select class="form-control" style="width:200px;margin-left:10px;">
                                <option value="1">newest - oldest</option>
                                <option value="2">oldest - newest</option>
                            </select>
                        </div>
                        <div style="margin-right:20px;">
                            <b>Status: </b>
                            <select class="form-control" style="width:150px;margin-left:10px;">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div style="margin-right:20px;">
                            <b>Price: </b>
                            <select class="form-control" style="width:200px;margin-left:10px;">
                                <option value="1">1000-2000</option>
                                <option value="2">2000-3000</option>
                                <option value="3">3000+</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-center mt-2">
                        <button class="btn btn-primary">Filter Use</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">Trouble
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Type</th>
                                <th scope="col">Provinc</th>
                                <th scope="col">Detail</th>
                                <th scope="col">Post date</th>
                                <th scope="col">Status</th>
                                <th scope="col">User</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                                <th scope="row">Refrigerator</th>
                                <td>Bangkok</td>
                                <td>อาการของปัญหาที่พบแบบคร่าวๆ</td>
                                <td>19/09/2564</td>
                                <td>On Fixing</td>
                                <td>profile</td>
                                <td><a href="post.php" class="btn btn-primary">Details</a></td>
                            </tr>
                            <tr>
                                <th scope="row">Refrigerator</th>
                                <td>Bangkok</td>
                                <td>อาการของปัญหาที่พบแบบคร่าวๆ</td>
                                <td>19/09/2564</td>
                                <td>On Fixing</td>
                                <td>profile</td>
                                <td><a href="post.php" class="btn btn-primary">Details</a></td>
                            </tr>
                            <tr>
                                <th scope="row">Refrigerator</th>
                                <td>Bangkok</td>
                                <td>อาการของปัญหาที่พบแบบคร่าวๆ</td>
                                <td>19/09/2564</td>
                                <td>On Fixing</td>
                                <td>profile</td>
                                <td><a href="post.php" class="btn btn-primary">Details</a></td>
                            </tr>
                            <tr>
                                <th scope="row">Refrigerator</th>
                                <td>Bangkok</td>
                                <td>อาการของปัญหาที่พบแบบคร่าวๆ</td>
                                <td>19/09/2564</td>
                                <td>On Fixing</td>
                                <td>profile</td>
                                <td><a href="post.php" class="btn btn-primary">Details</a></td>
                            </tr>
                            <tr>
                                <th scope="row">Refrigerator</th>
                                <td>Bangkok</td>
                                <td>อาการของปัญหาที่พบแบบคร่าวๆ</td>
                                <td>19/09/2564</td>
                                <td>On Fixing</td>
                                <td>profile</td>
                                <td><a href="post.php" class="btn btn-primary">Details</a></td>
                            </tr>
                            <tr>
                                <th scope="row">Refrigerator</th>
                                <td>Bangkok</td>
                                <td>อาการของปัญหาที่พบแบบคร่าวๆ</td>
                                <td>19/09/2564</td>
                                <td>On Fixing</td>
                                <td>profile</td>
                                <td><a href="post.php" class="btn btn-primary">Details</a></td>
                            </tr>
                            <tr>
                                <th scope="row">Refrigerator</th>
                                <td>Bangkok</td>
                                <td>อาการของปัญหาที่พบแบบคร่าวๆ</td>
                                <td>19/09/2564</td>
                                <td>On Fixing</td>
                                <td>profile</td>
                                <td><a href="post.php" class="btn btn-primary">Details</a></td>
                            </tr>
                            <tr>
                                <th scope="row">Refrigerator</th>
                                <td>Bangkok</td>
                                <td>อาการของปัญหาที่พบแบบคร่าวๆ</td>
                                <td>19/09/2564</td>
                                <td>On Fixing</td>
                                <td>profile</td>
                                <td><a href="post.php" class="btn btn-primary">Details</a></td>
                            </tr>
                            <tr>
                                <th scope="row">Refrigerator</th>
                                <td>Bangkok</td>
                                <td>อาการของปัญหาที่พบแบบคร่าวๆ</td>
                                <td>19/09/2564</td>
                                <td>On Fixing</td>
                                <td>profile</td>
                                <td><a href="post.php" class="btn btn-primary">Details</a></td>
                            </tr>
                            <tr>
                                <th scope="row">Refrigerator</th>
                                <td>Bangkok</td>
                                <td>อาการของปัญหาที่พบแบบคร่าวๆ</td>
                                <td>19/09/2564</td>
                                <td>On Fixing</td>
                                <td>profile</td>
                                <td><a href="post.php" class="btn btn-primary">Details</a></td>
                            </tr>
                            <tr>
                                <th scope="row">Refrigerator</th>
                                <td>Bangkok</td>
                                <td>อาการของปัญหาที่พบแบบคร่าวๆ</td>
                                <td>19/09/2564</td>
                                <td>On Fixing</td>
                                <td>profile</td>
                                <td><a href="post.php" class="btn btn-primary">Details</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <?php
        include("template/footer.php");
    ?>
</body>

</html>