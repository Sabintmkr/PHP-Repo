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
    //Initialize variables for new employee
    $id="";
    $header_index = "Create Employee";
    $e_usrname = "";
    $e_password = "";
    $e_fname = "";
    $e_lname = "";
    $e_address = "";
    $e_phone = "";
    $e_email = "";
    $user_action = "create";

//Initialize variables for update employee
    if(isset($_GET["id"])){
    $id=$_GET["id"];
    $header_index="Edit Employee";

    $emp_detail = getEmployee($id);

    $e_usrname = $emp_detail['emp_username'];
    $e_password = $emp_detail['emp_password'];
    $e_fname = $emp_detail['emp_first_name'];
    $e_lname = $emp_detail['emp_last_name'];
    $e_address = $emp_detail['emp_address'];
    $e_phone = $emp_detail['emp_phone'];
    $e_email = $emp_detail['emp_email'];
    $user_action = "edit";
    }
?>


<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?=$header_index;?></h3>
    </div>
</div>

<div class="container emp-profile">
    <form action="employeecontroller.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-6">
                <label>First Name:</label>
                <input type="text" class="form-control" id="input_fname" name="input_fname" value="<?=$e_fname;?>" required>
            </div>
            <div class="col-lg-6">
                <label>Last Name:</label>
                <input type="text" class="form-control" id="input_lname" name="input_lname" value="<?=$e_lname;?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <label>Address:</label>
                <input type="text" class="form-control" id="input_address" name="input_address" value="<?=$e_address;?>" required>
            </div>
            <div class="col-lg-6">
                <label>Phone:</label>
                <input type="text" class="form-control" id="input_phone" name="input_phone" value="<?=$e_phone;?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <label>Email:</label>
                <input type="text" class="form-control" id="input_email" name="input_email" value="<?=$e_email;?>" required>
            </div>
            <div class="col-lg-6">
                <label>Username:</label>
                <input type="text" class="form-control" id="input_usrname" name="input_usrname" value="<?=$e_usrname;?>" required>
            </div>
        </div>
        <?php if(isset($_GET["id"])== null){?>
           
            <div class="row">
                <div class="col-lg-6">
                    <label>Password:</label>
                    <input type="text" class="form-control" id="input_password" name="input_password" value="<?=$e_password;?>" required>
                </div>
                <div class="col-lg-6">
                
                </div>
            </div>
        <?php }
        else{?>
            <input type="hidden" class="form-control" id="input_password" name="input_password" value="<?=$e_password;?>" required>
        <?php }?>    
        <br>
        <div class="form-group"><input type="submit" class="btn btn-primary" value="Save" id="btnSubmit" name="btnSubmit" /></div>
        <input type="hidden" id="id" name="id" value="<?=$id;?>"/>
        <input type="hidden" id="user_action" name="user_action" value="<?=$user_action;?>"/>
    </form>
</div>




<?php include('dashboard_footer.php'); ?>