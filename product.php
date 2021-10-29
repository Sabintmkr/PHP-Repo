<?php

include('dashboard_header.php');
include 'libcommon.php';

$id=$_SESSION['usr'];

if(!isset($_SESSION['usr']) || empty($_SESSION['usr'])){
  header("Location: error.php?msg=Access Denied!!! Please Login");
  die();
}

$currentuser_detail = getUserDetail($id);

if(empty($currentuser_detail)){
  header("Location: error.php?msg=Unauthorized Access are denied..");
}

$query = "select * from product";
$product_list = sqlSelectStatement($query);
?>

<!--Section for User Actions for Logged In Users-->
<?php if(isset($_SESSION['current_session'])){ ?>
  <div class="box">
    <div class="box-header"><h3 class="box-title">Product Index</h3></div>
    <div class="box-body row">
         <div class="col-md-3">
            <form method="get" action="productform.php">
                <input type="submit" class="btn btn-primary" value="Add New"/>
            </form>
        </div>
    </div>
  </div>
<?php }?>

<br><br>
<!--Category Index-->
<div class="table-responsive container" style="text-align: center !important;">
    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th data-sort-ignore="true">Image</th>
                    <th data-sort-ignore="true">Name</th>
                    <th data-sort-ignore="true">Category</th>
                    <th data-sort-ignore="true">Type</th>
                    <th data-sort-ignore="true">Price</th>
                    <th data-sort-ignore="true">Release Date</th>
                    <th data-sort-ignore="true">Sale</th>
                    <th data-sort-ignore="true">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(!empty($product_list)){
                        foreach($product_list as $list){ ?>
                            <tr>
                                <td><img src="<?=htmlspecialchars_decode($list['p_image']);?>" alt="<?=htmlspecialchars_decode($list['p_name']);?>" style="width:182px; height:268px;"/></td>
                                <td><?= $list['p_name']?></td>
                                <td><?= $list['p_category']?></td>
                                <td><?= $list['p_type']?></td>
                                <td><?= $list['p_price']?></td>
                                <td><?= $list['p_releasedate']?></td>
                                <td><?= $list['p_sale']?></td>
                                <td>
                                    <form method="get" action="productform.php">
                                    <input type="button" class="btn btn-primary" value="Edit" onclick="location.href='productform.php?id=<?= $list['p_id'];?>'"/>
                                    <input type="button" class="btn btn-danger btnDelete" value="Delete" id="btnDelete" name="btnDelete"/>
                                    <input type="hidden" id="id" name="id" value="<?= $list['p_id']?>"/>
                                </td>
                            </tr>
                         <?php
                        }
                     }
                ?>
            </tbody>

        </table>
        </div>
        </div>

<?php include('dashboard_footer.php'); ?>
<script>
    $(document).ready(function(){
        $('.btnDelete').click(function(){
            if(confirm("Are you sure to delete the Product?")){
                var plat_id = "<?= $list['p_id']?>"
                alert(plat_id);
                $.ajax({
                    method:"POST",
                    url: 'productajax.php',
                    data: {pid:plat_id,action:"delete"},
                    success: function (data, status, xhr) {
                        var resp = data.split("||");
                        alert(resp[1]);
                        if(resp[0]=="0"){
                        window.location.replace("product.php");
                        }

                    },
                    error: function (jqXhr, textStatus, errorMessage) {
                        alert("Server Connection Lost. Please try again");
                    }
                });
            }
         });
    });
</script>

