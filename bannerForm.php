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
//Initialize variables for new banner
    $id="";
    $header_index = "Create Banner";
    $bname = "";
    $bimage = "";
    $bstatus = "";
    $bmsg = "";
    $user_action = "create";

//Initialize variables for update banner
    if(isset($_GET["id"])){
    $id=$_GET["id"];
    $header_index="Edit Banner";

    $p_detail = getBanner($id);
        
    $bname = $p_detail['b_name'];
    $bimage = $p_detail['b_image'];
    $bstatus = $p_detail['b_status'];
    $bmsg = $p_detail['b_msg'];
    $user_action = "edit";
    }
?>


<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?=$header_index;?></h3>
    </div>
</div>

<div class="container emp-profile">
    <form action="bannercontroller.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-6">
                <label>Banner Name:</label>
                <input type="text" class="form-control" id="input_name" name="input_name" value="<?=$bname;?>" required>
            </div>
            <div class="col-lg-6">
                <label>Status:</label>
                <?php 
                 if(isset($_GET["id"]) == null || isset($_GET["id"]) == ""){ ?>
                <select class="form-control" id="input_status" name="input_status" required>
                    <option value="">--Select--</option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
                <?php }
                else{?>
                <select class="form-control" id="input_status" name="input_status" required>
                    <option value="<?=$bstatus?>" selected><?=$bstatus?></option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
                <?php } ?>
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
                <img src="<?=htmlspecialchars_decode($bimage);?>" alt="<?=htmlspecialchars_decode($bname);?>"
                    style="width:182px;" />
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
            <div class="col-lg-6">
                <label>Message:</label>
                <input type="text" class="form-control" id="input_msg" name="input_msg" value="<?=$bmsg;?>" required>
            </div>
        </div>

        <br>
        <div class="form-group"><input type="submit" class="btn btn-primary" value="Save" id="btnSubmit"
                name="btnSubmit" /></div>
        <input type="hidden" id="id" name="id" value="<?=$id;?>" />
        <input type="hidden" id="user_action" name="user_action" value="<?=$user_action;?>" />
    </form>
</div>




<?php include('dashboard_footer.php'); ?>