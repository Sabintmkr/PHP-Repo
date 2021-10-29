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

$query = "select * from employee";
$emp_list = sqlSelectStatement($query);
?>

<!--Section for User Actions for Logged In Users-->
<?php if(isset($_SESSION['current_session'])){ ?>
  <div class="box">
    <div class="box-header"><h3 class="box-title">Employee Index</h3></div>
    <div class="box-body row">
         <div class="col-md-3">
            <form method="get" action="employeeform.php">
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
                    <th data-sort-ignore="true">Id</th>
                    <th data-sort-ignore="true">Username</th>
                    <th data-sort-ignore="true">Name</th>
                    <th data-sort-ignore="true">Address</th>
                    <th data-sort-ignore="true">Contact</th>
                    <th data-sort-ignore="true">Email</th>
                    <th data-sort-ignore="true">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(!empty($emp_list)){
                        foreach($emp_list as $list){ ?>
                            <tr>
                                <td><?= $list['emp_id']?></td>
                                <td><?= $list['emp_username']?></td>
                                <td><?= $list['emp_first_name']." ". $list['emp_last_name']?></td>
                                <td><?= $list['emp_address']?></td>
                                <td><?= $list['emp_phone']?></td>
                                <td><?= $list['emp_email']?></td>
                                <td>
                                    <form method="get" action="employeeform.php">
                                    <input type="button" class="btn btn-primary" value="Edit" onclick="location.href='employeeform.php?id=<?= $list['emp_id'];?>'"/>
                                    <?php if($_SESSION['usr'] != $list['emp_id']){?>
                                        <input type="button" class="btn btn-danger btnDelete" value="Delete" id="btnDelete" name="btnDelete"/>
                                    <?php }?>

                                   
                                    <input type="hidden" id="id" name="id" value="<?= $list['emp_id']?>"/>
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
            if(confirm("Are you sure to delete the Employee?")){
                var e_id = "<?= $list['emp_id']?>"
                alert(e_id);
                $.ajax({
                    method:"POST",
                    url: 'employeeajax.php',
                    data: {eid:e_id,action:"delete"},
                    success: function (data, status, xhr) {
                        var resp = data.split("||");
                        alert(resp[1]);
                        if(resp[0]=="0"){
                        window.location.replace("employee.php");
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

