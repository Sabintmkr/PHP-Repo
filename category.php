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

$query = "select * from category";
$catgeory_list = sqlSelectStatement($query);
?>

<!--Section for User Actions for Logged In Users-->
<?php if(isset($_SESSION['current_session'])){ ?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Category Index</h3>
    </div>
    <div class="box-body row">
        <div class="col-md-3">
            <form method="get" action="categoryForm.php">
                <input type="submit" class="btn btn-primary" value="Add New" />
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
                    <th data-sort-ignore="true">Id</th>
                    <th data-sort-ignore="true">Platform</th>
                    <th data-sort-ignore="true">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(!empty($catgeory_list)){
                        foreach($catgeory_list as $list){ ?>
                <tr>
                    <td><?= $list['cat_id']?></td>
                    <td><?= $list['cat_platform']?></td>
                    <td>
                        <form method="get" action="categoryForm.php">
                            <input type="button" class="btn btn-primary" value="Edit"
                                onclick="location.href='categoryForm.php?id=<?= $list['cat_id'];?>'" />
                            <input type="button" class="btn btn-danger btnDelete" value="Delete" id="btnDelete"
                                name="btnDelete" />
                            <input type="hidden" id="id" name="id" value="<?= $list['cat_id']?>" />
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
$(document).ready(function() {
    $('.btnDelete').click(function() {
        if (confirm("Are you sure to delete the Category?")) {
            var plat_id = "<?= $list['cat_id']?>"
            alert(plat_id);
            $.ajax({
                method: "POST",
                url: 'categoryajax.php',
                data: {
                    cid: plat_id,
                    action: "delete"
                },
                success: function(data, status, xhr) {
                    var resp = data.split("||");
                    alert(resp[1]);
                    if (resp[0] == "0") {
                        window.location.replace("category.php");
                    }

                },
                error: function(jqXhr, textStatus, errorMessage) {
                    alert("Server Connection Lost. Please try again");
                }
            });
        }
    });
});
</script>