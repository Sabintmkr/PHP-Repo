<?php 
    include 'libcommon.php';
    include('layout_header.php'); 
    

    
    //Initialize variables for new customer
    $id="";
    $header_index = "Register";
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

?>

<br /> <hr/>
<div class="container-fluid box">
    <div class="box-header">
        <h3 class="box-title"><?=$header_index;?></h3>
    </div>
</div>

<div class="container">
    <form action="customer_regcontroller.php" method="post" enctype="multipart/form-data">
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
        <?php if(isset($_GET["id"])== null){?>
           
            <div class="row">
                <div class="col-lg-6">
                    <label>Username:</label>
                    <input type="text" class="form-control" id="input_usrname" name="input_usrname" value="<?=$c_usrname;?>" required>
                </div>
                <div class="col-lg-6">
                    <label>Password:</label>
                    <input type="text" class="form-control" id="input_password" name="input_password" value="<?=$c_password;?>" required>
                </div>
            </div>
        <?php }
        else{?>
            <input type="hidden" class="form-control" id="input_password" name="input_password" value="<?=$c_password;?>" required>
        <?php }?>    
        <br>
        <div class="form-group"><input type="submit" class="btn btn-primary" value="Save" id="btnSubmit" name="btnSubmit" /></div>
        <input type="hidden" id="id" name="id" value="<?=$id;?>"/>
        <input type="hidden" id="user_action" name="user_action" value="<?=$user_action;?>"/>
    </form>
</div>
<br /> <hr/>



<?php include('layout_foot.php'); ?>