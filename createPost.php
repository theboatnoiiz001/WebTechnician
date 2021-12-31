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
            <div class="col-md-12">
                <div class="card cardCenter border-primary">
                    <div class="card-header border-primary" text-center">Create Post</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="card cardCenter">
                                    <div class="card-body">
                                        <label>Type</label>
                                        <select class="form-control">
                                            <option selected>Open this select menu</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                        <br>
                                        <label>Address</label>
                                        <textarea id="address" class="form-control"></textarea>
                                        <br>
                                        <label>Province</label>
                                        <select class="form-control" id="province">
                                            <option selected>Open this select menu</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                        <br>
                                        <label>Phone</label>
                                        <input type="tel" name="phone" id="phone" class="form-control">
                                        <br>
                                        <label>Details</label>
                                        <textarea id="details" class="form-control"></textarea>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card cardCenter">
                                    <div class="card-body">
                                        <label><strong>Add Image</strong></label>
                                        <div class="custom-file">
                                            <input type="file" name="files[]" multiple
                                                class="custom-file-input form-control" id="customFile">
                                            <label class="custom-file-label" for="customFile">Choose Image</label>
                                        </div>
                                        <div class="form-group" style="margin-top:10px;">
                                            <button type="button" name="upload" value="upload" id="upload"
                                                class="btn btn-block btn-dark"><i class="fa fa-fw fa-upload"></i>
                                                Upload</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 text-center mt-5 mb-2">
                            <button class="btn btn-primary">Create</button>
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