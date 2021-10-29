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

    //Initialize variables for new category
    $id="";
    $header_index = "Create Category";
    $category_name = "";
    $user_action = "create";

    //Initialize variables for update category
    if(isset($_GET["id"])){
    $id=$_GET["id"];
    $header_index="Edit Category";

    $category_detail = getCategory($id);

    $category_name = $category_detail['cat_platform'];
    
    $user_action = "edit";
    }
?>


<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?=$header_index;?></h3>
    </div>
</div>

<div class="container emp-profile">
    <form action="categorycontroller.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-6">
                <label>Platform Name:</label>
                <input type="text" class="form-control" id="input_catname" name="input_catname"
                    value="<?=$category_name;?>" required>
            </div>
            <div class="col-lg-6"></div>
        </div>
        <br>
        <div class="form-group"><input type="submit" class="btn btn-primary" value="Save" id="btnSubmit"
                name="btnSubmit" /></div>
        <input type="hidden" id="id" name="id" value="<?=$id;?>" />
        <input type="hidden" id="user_action" name="user_action" value="<?=$user_action;?>" />
    </form>
</div>




<?php include('dashboard_footer.php'); ?>