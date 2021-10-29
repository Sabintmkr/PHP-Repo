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
    //Initialize variables for new product
    $id="";
    $header_index = "Create Upcoming Item";
    $uname = "";
    $uimage = "";
    $udate = "";
    $umsg = "";
    $user_action = "create";

//Initialize variables for update product
    if(isset($_GET["id"])){
    $id=$_GET["id"];
    $header_index="Edit Upcoming Item";

    $p_detail = getUpcoming($id);
        
    $uname = $p_detail['u_name'];
    $uimage = $p_detail['u_image'];
    $udate = $p_detail['u_date'];
    $umsg = $p_detail['u_msg'];
    $user_action = "edit";
    }

    
    
?>


<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?=$header_index;?></h3>
    </div>
</div>

<div class="container emp-profile">
    <form action="upcomingcontroller.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-6">
                <label>Item Name:</label>
                <input type="text" class="form-control" id="input_name" name="input_name" value="<?=$uname;?>" required>
            </div>
            <div class="col-lg-6">
                <label>Date:</label>
                <input type="text" class="form-control" id="input_date" name="input_date" value="<?=$udate;?>" required>
            </div>
        </div>
       <div class="row">
            <div class="col-lg-6">
                <?php 
                 if(isset($_GET["id"]) == null || isset($_GET["id"]) == ""){ ?>
                <label>Upload Image:</label>
                <input type="file" class="form-control" id="input_image" name="input_image" />
                <?php 
                 }
                ?>
            </div>
       </div>
        <?php 
        if(isset($_GET["id"])){ ?>
            <div class="row">
                <div class="col-lg-6">
                    <label>Current Image:</label><br>
                    <img src="<?=htmlspecialchars_decode($uimage);?>" alt="<?=htmlspecialchars_decode($uname);?>" style="width:182px;"/>
                </div>
                <div class="col-lg-6">
                    <label>Upload New Image:</label>
                    <input type="file" class="form-control" id="input_image" name="input_image">
                    </div>
                    </div>
        <?php 
        }
        ?>
           <div class="row">
                <div class="col-lg-12">
                    <label>Message:</label>
                    <textarea class="form-control" id="input_msg" name="input_msg" value="<?=$umsg;?>" required rows="5" cols="40"><?=$umsg;?></textarea>
                </div>
           </div>
        
        <br>
        <div class="form-group"><input type="submit" class="btn btn-primary" value="Save" id="btnSubmit" name="btnSubmit" /></div>
        <input type="hidden" id="id" name="id" value="<?=$id;?>"/>
        <input type="hidden" id="user_action" name="user_action" value="<?=$user_action;?>"/>
    </form>
</div>




<?php include('dashboard_footer.php'); ?>