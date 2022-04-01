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
                            <select class="form-control" id="type" style="width:150px;margin-left:10px;">
                                <option value="-1">Select Type</option>
                                <option value="1">Air condition</option>
                                <option value="2">Refrigerator</option>
                                <option value="3">Drain pipe</option>
                                <option value="4">Shower</option>
                                <option value="5">Unknow</option>
                            </select>
                        </div>
                        <div style="margin-right:20px;">
                            <b>Province </b>
                            <select class="form-control" id="province" style="width:150px;margin-left:10px;">
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
                            <b>Date</b>
                            <select class="form-control" id="date" style="width:200px;margin-left:10px;">
                                <option value="-1">Select Date</option>
                                <option value="1">newest - oldest</option>
                                <option value="2">oldest - newest</option>
                            </select>
                        </div>
                        <div style="margin-right:20px;">
                            <b>Status: </b>
                            <select class="form-control" id="status" style="width:150px;margin-left:10px;">
                                <option value="-1">Select Status</option>
                                <option value="0">Find a Technician</option>
                                <option value="1">On Fixing</option>
                                <option value="2">Trouble Fixed</option>
                            </select>
                        </div>
                        <div style="margin-right:20px;">
                            <b>Price: </b>
                            <select class="form-control" id="price" style="width:200px;margin-left:10px;">
                                <option value="-1">Select Price</option>
                                <option value="1">1000-1999</option>
                                <option value="2">2000-4999</option>
                                <option value="3">5000+</option>
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
                <div class="card-header bg-primary text-white">Trouble
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Type</th>
                                <th scope="col">Province</th>
                                <th scope="col">Topic</th>
                                <th scope="col">Post date</th>
                                <th scope="col">Price</th>
                                <th scope="col">Status</th>
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
            let type = $("#type").val();
            let province = $("#province").val();
            let date = $("#date").val();
            let status = $("#status").val();
            let price = $("#price").val();
            $.post("api/troubleFilter.php",{type:type,province:province,date:date,status:status,price:price},function(data){
                $("#dataTable").html(data);
            })

        }
    </script>
</body>

</html>