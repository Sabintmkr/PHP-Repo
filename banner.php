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

$query = "select * from banner";
$banner_list = sqlSelectStatement($query);
?>

<!--Section for User Actions for Logged In Users-->
<?php if(isset($_SESSION['current_session'])){ ?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Banner Index</h3>
    </div>
    <div class="box-body row">
        <div class="col-md-3">
            <form method="get" action="bannerform.php">
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
                    <th data-sort-ignore="true">Image</th>
                    <th data-sort-ignore="true">Name</th>
                    <th data-sort-ignore="true">Status</th>
                    <th data-sort-ignore="true">Message</th>
                    <th data-sort-ignore="true">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(!empty($banner_list)){
                        foreach($banner_list as $list){ ?>
                <tr>
                    <td><img src="<?=htmlspecialchars_decode($list['b_image']);?>"
                            alt="<?=htmlspecialchars_decode($list['b_name']);?>" style="width:182px; height:268px;" />
                    </td>
                    <td><?= $list['b_name']?></td>
                    <td><?= $list['b_status']?></td>
                    <td><?= $list['b_msg']?></td>
                    <td>
                        <form method="get" action="bannerform.php">
                            <input type="button" class="btn btn-primary" value="Edit"
                                onclick="location.href='bannerform.php?id=<?= $list['b_id'];?>'" />
                            <?php
                                        if($list['b_id'] != '1' || $list['b_id'] != 2 || $list['b_id'] != 3){ 
                                    ?>
                            <input type="button" class="btn btn-danger btnDelete" value="Delete" id="btnDelete"
                                name="btnDelete" />
                            <?php 
                                        }
                                    ?>

                            <input type="hidden" id="id" name="id" value="<?= $list['b_id']?>" />
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
        if (confirm("Are you sure to delete the Product?")) {
            var plat_id = "<?= $list['b_id']?>"
            alert(plat_id);
            $.ajax({
                method: "POST",
                url: 'bannerajax.php',
                data: {
                    pid: plat_id,
                    action: "delete"
                },
                success: function(data, status, xhr) {
                    var resp = data.split("||");
                    alert(resp[1]);
                    if (resp[0] == "0") {
                        window.location.replace("banner.php");
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