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
        //Initialize variables for new employe
    //Initialize variables for new customer
    $id="";
    $header_index = "Create Customer";
    $c_usrname = "";
    $c_password = "";
    $c_fname = "";
    $c_lname = "";
    $c_address = "";
    $c_suburb = "";
    $c_city = "";
    $c_state = "";
    $c_mobile = "";
    $c_email = "";
    $user_action = "create";

//Initialize variables for update customer
    if(isset($_GET["id"])){
    $id=$_GET["id"];
    $header_index="Edit Customer";

    $cus_detail = getCustomer($id);

    $c_usrname = $cus_detail['cl_username'];
    $c_password = $cus_detail['cl_password'];
    $c_fname = $cus_detail['cl_firstname'];
    $c_lname = $cus_detail['cl_lastname'];
    $c_address = $cus_detail['cl_address'];
    $c_suburb = $cus_detail['cl_suburb'];
    $c_city = $cus_detail['cl_city'];
    $c_state = $cus_detail['cl_state'];
    $c_mobile = $cus_detail['cl_mobile'];
    $c_email = $cus_detail['cl_email'];
    $user_action = "edit";
    }
?>


<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?=$header_index;?></h3>
    </div>
</div>
<div class="container emp-profile read">
    <form>
        <div class="row">
            <div class="col-lg-6">
                <label>First Name:</label>
                <input type="text" class="form-control" id="input_fname" name="input_fname" value="<?=$c_fname;?>" disabled>
            </div>
            <div class="col-lg-6">
                <label>Last Name:</label>
                <input type="text" class="form-control" id="input_lname" name="input_lname" value="<?=$c_lname;?>" disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <label>Email:</label>
                <input type="text" class="form-control" id="input_email" name="input_email" value="<?=$c_email;?>" disabled>
            </div>
            <div class="col-lg-6">
                <label>Mobile:</label>
                <input type="text" class="form-control" id="input_mobile" name="input_mobile" value="<?=$c_mobile;?>" disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <label>Address:</label>
                <input type="text" class="form-control" id="input_address" name="input_address" value="<?=$c_address;?>" disabled>
            </div>
            <div class="col-lg-6">
                <label>Suburb:</label>
                <input type="text" class="form-control" id="input_suburb" name="input_suburb" value="<?=$c_suburb;?>" disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <label>City:</label>
                <input type="text" class="form-control" id="input_city" name="input_city" value="<?=$c_city;?>" disabled>
            </div>
            <div class="col-lg-6">
                <label>State:</label>
                <input type="text" class="form-control" id="input_state" name="input_state" value="<?=$c_state;?>" disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <label>Username:</label>
                <input type="text" class="form-control" id="input_usrname" name="input_usrname" value="<?=$c_usrname;?>" disabled>
            </div>
           
        </div>
         
        <br>
        <div class="form-group"><input type="button" class="btn btn-success" value="Enable Edit" id="btnedit" name="btnedit" /></div>
        
    </form>
</div>
<div class="container emp-profile write">
    <form action="customercontroller.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-6">
                <label>First Name:</label>
                <input type="text" class="form-control" id="input_fname" name="input_fname" value="<?=$c_fname;?>" required>
            </div>
            <div class="col-lg-6">
                <label>Last Name:</label>
                <input type="text" class="form-control" id="input_lname" name="input_lname" value="<?=$c_lname;?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <label>Email:</label>
                <input type="text" class="form-control" id="input_email" name="input_email" value="<?=$c_email;?>" required>
            </div>
            <div class="col-lg-6">
                <label>Mobile:</label>
                <input type="text" class="form-control" id="input_mobile" name="input_mobile" value="<?=$c_mobile;?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <label>Address:</label>
                <input type="text" class="form-control" id="input_address" name="input_address" value="<?=$c_address;?>" required>
            </div>
            <div class="col-lg-6">
                <label>Suburb:</label>
                <input type="text" class="form-control" id="input_suburb" name="input_suburb" value="<?=$c_suburb;?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <label>City:</label>
                <input type="text" class="form-control" id="input_city" name="input_city" value="<?=$c_city;?>" required>
            </div>
            <div class="col-lg-6">
                <label>State:</label>
                <input type="text" class="form-control" id="input_state" name="input_state" value="<?=$c_state;?>" required>
            </div>
        </div>
     
        <br>
        <div class="form-group"><input type="submit" class="btn btn-primary" value="Save" id="btnSubmit" name="btnSubmit" /></div>
        <input type="hidden" id="id" name="id" value="<?=$id;?>"/>
        <input type="hidden" id="user_action" name="user_action" value="<?=$user_action;?>"/>
        <input type="hidden" class="form-control" id="input_usrname" name="input_usrname" value="<?=$c_usrname;?>">
        <input type="hidden" class="form-control" id="input_password" name="input_password" value="<?=$c_password;?>">
    </form>
</div>




<?php include('dashboard_footer.php'); ?>
<script>
     $(document).ready(function(){
        $(".write").hide();
        $(".read").show();

        $('#btnedit').click(function(){
            $(".write").show();
            $(".read").hide();


        });

       
    });
</script>