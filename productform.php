<?php 
    include('dashboard_header.php'); 
    include 'libcommon.php';

    $id=$_SESSION['usr'];
//echo($id);
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
    $header_index = "Create Product";
    $pname = "";
    $pcategory = "";
    $ptype = "";
    $pprice = "";
    $pstatus = "";
    $psale = "";
    $pimage = "";
    $preleasedate = "";
    $user_action = "create";

//Initialize variables for update product
    if(isset($_GET["id"])){
    $id=$_GET["id"];
    $header_index="Edit Product";

    $p_detail = getProduct($id);
        
    $pname = $p_detail['p_name'];
    $pcategory = $p_detail['p_category'];
    $ptype = $p_detail['p_type'];
    $pprice = $p_detail['p_price'];
    $pstatus = $p_detail['p_status'];
    $psale = $p_detail['p_sale'];
    $pimage = $p_detail['p_image'];
    $preleasedate = $p_detail['p_releasedate'];
    $user_action = "edit";
    }

    $category_list = getCategoryList();
    
?>


<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?=$header_index;?></h3>
    </div>
</div>

<div class="container emp-profile">
    <form action="productcontroller.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-6">
                <label>Product Name:</label>
                <input type="text" class="form-control" id="input_name" name="input_name" value="<?=$pname;?>" required>
            </div>
            <div class="col-lg-6">
                <label>Category:</label>
                <select class="form-control" id="input_category" name="input_category" required><option value="">--Select--</option>
                <?php
                    foreach($category_list as $list){
                        $selected = "";
                        if($list["cat_platform"]==$pcategory){
                            $selected = "selected";
                        }
                ?>
                <option value="<?=$list["cat_platform"];?>" <?=$selected;?>><?=$list["cat_platform"];?></option>

                <?php } ?>
          </select>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <label>Type:</label>
                <!--<input type="text" class="form-control" id="input_type" name="input_type" value="<?=$ptype;?>" required>-->
                <?php
                if($ptype == Null){
                ?>
                    <select class="form-control" id="input_type" name="input_type" required><option value="">--Select--</option>
                    <option value="Game">Game</option>
                    <option value="Accessories">Accessories</option>
                    </select>
                <?php }
                else{
                ?>
                    <select class="form-control" id="input_type" name="input_type" required><option value="<?=$ptype;?>"><?=$ptype?></option>
                    <option value="Game">Game</option>
                    <option value="Accessories">Accessories</option>
                    </select>
                <?php
                }
                ?>
            </div>
            <div class="col-lg-6">
                <label>Price:</label>
                <input type="text" class="form-control" id="input_price" name="input_price" value="<?=$pprice;?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <label>Status:</label>
                <input type="text" class="form-control" id="input_status" name="input_status" value="<?=$pstatus;?>" required>
            </div>
            <div class="col-lg-6">
                <label>Sale Option:</label>
                <!--<input type="text" class="form-control" id="input_sale" name="input_sale" value="<?=$psale;?>" required>-->
                <?php
                if($psale == 'Yes'){
                ?>
                    <select class="form-control" id="input_sale" name="input_sale" required>
                    <option value="Yes" selected>Yes</option>
                    <option value="No">No</option>
                    </select>
                <?php }
                else{
                ?>
                    <select class="form-control" id="input_sale" name="input_sale" required><option value="<?=$psale;?>"><?=$psale?></option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                    </select>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <label>Release Date (YYYY-MM-DD):</label>
                <input type="text" class="form-control" id="input_releasedate" name="input_releasedate" value="<?=$preleasedate;?>" required>
            </div>
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
                    <img src="<?=htmlspecialchars_decode($pimage);?>" alt="<?=htmlspecialchars_decode($pname);?>" style="width:182px;"/>
                </div>
                <div class="col-lg-6">
                    <label>Upload New Image:</label>
                    <input type="file" class="form-control" id="input_image" name="input_image" value="<?=$pimage;?>"/>
                    </div>
                    </div>
        <?php 
        }
        ?>
           
        
        <br>
        <div class="form-group"><input type="submit" class="btn btn-primary" value="Save" id="btnSubmit" name="btnSubmit" /></div>
        <input type="hidden" id="id" name="id" value="<?=$id;?>"/>
        <input type="hidden" id="user_action" name="user_action" value="<?=$user_action;?>"/>
    </form>
</div>




<?php include('dashboard_footer.php'); ?>