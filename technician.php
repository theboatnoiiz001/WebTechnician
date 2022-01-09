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
                            <b>Gender </b>
                            <select class="form-control" id="gender" style="width:150px;margin-left:10px;">
                                <option value="-1">Select Gender</option>
                                <option value="man">Man</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div style="margin-right:20px;">
                            <b>Province </b>
                            <select class="form-control" id="province" style="width:200px;margin-left:10px;">
                                <option value="-1">Select Province</option>
                                <?php
                                    $province = $connect->prepare("SELECT * FROM `provinces`");
                                    $province->execute();
                                    while($row = $province->fetch()){
                                           echo '<option value="'.$row['code'].'">'.$row['name_en'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div style="margin-right:20px;">
                            <b>Ranking </b>
                            <select class="form-control" id="ranking" style="width:200px;margin-left:10px;">
                                <option value="-1">Select Ranking</option>
                                <option value="1">Highest - Lowest</option>
                                <option value="2">Lowest - Highest</option>
                            </select>
                        </div>
                        <div style="margin-right:20px;">
                            <b>Status: </b>
                            <select class="form-control" id="status" style="width:150px;margin-left:10px;">
                                <option value="-1">Select Status</option>
                                <option value="1">Work Finding</option>
                                <option value="2">On Working</option>
                                <option value="3">Unavailable</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-center mt-2">
                        <button class="btn btn-primary" onClick="getDataTable()">Filter Use</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">Technician
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Type</th>
                                <th scope="col">Firstname</th>
                                <th scope="col">Last name</th>
                                <th scope="col">Province</th>
                                <th scope="col">About</th>
                                <th scope="col">Status</th>
                                <th scope="col">Rating</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="dataTable">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <?php
        include("template/footer.php");
    ?>

    <script>
        getDataTable();
        function getDataTable(){
            let gender = $("#gender").val();
            let province = $("#province").val();
            let ranking = $("#ranking").val();
            let status = $("#status").val();

            $.post("api/technicianFilter.php",{gender:gender,province:province,ranking:ranking,status:status},function(data){
                $("#dataTable").html(data);
            })
        }
    </script>
</body>

</html>