<?php
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

if(!isset($_SESSION['current_session'])){
  header("Location: error.php?msg=Session Out. Please re-login.");
  exit;
}

if(!isset($_POST)){
  header("Location: error.php?msg=Invalid Request");
  exit;
}

if(!isset($_POST["user_action"]) || $_POST["user_action"]==null){
  header("Location: error.php?msg=User action is not defined.");
}

//Create and Edit
$user_action = $_POST["user_action"];

//Front End Validation
if(!isset($_POST["input_name"]) || $_POST["input_name"]==null){
  header("Location: error.php?msg=Missing product name.");
  exit;
}

if(!isset($_POST["input_category"]) || $_POST["input_category"]==null){
    header("Location: error.php?msg=Missing category for product.");
    exit;
}

if(!isset($_POST["input_type"]) || $_POST["input_type"]==null){
    header("Location: error.php?msg=Missing product type.");
    exit;
}

if(!isset($_POST["input_price"]) || $_POST["input_price"]==null){
    header("Location: error.php?msg=Missing product price.");
    exit;
}

if(!isset($_POST["input_status"]) || $_POST["input_status"]==null){
    header("Location: error.php?msg=Missing availability status of product.");
    exit;
}

if(!isset($_POST["input_sale"]) || $_POST["input_sale"]==null){
    header("Location: error.php?msg=Missing sale information.");
    exit;
}

if(!isset($_POST["input_releasedate"]) || $_POST["input_releasedate"]==null){
    header("Location: error.php?msg=Missing product date of release or released date");
    exit;
}

if($user_action=="create"){
    if(empty($_FILES["input_image"]["name"])){
        $to_be_uploaded_path = "images/productimg/unknown_image.png";
      }
      else{
        
        $imageFileType = strtolower(pathinfo($_FILES["input_image"]["name"],PATHINFO_EXTENSION));
        $to_be_uploaded_path = "images/productimg/".strtolower(str_replace(" ","_",$_POST["input_name"])).".".$imageFileType;
    
        // Check if file already exists
        if (file_exists($to_be_uploaded_path)) {
          unlink($to_be_uploaded_path);
        }
    
        //Upload File to Server
        move_uploaded_file($_FILES["input_image"]["tmp_name"], $to_be_uploaded_path);
      }



  $query = "insert into product(p_name,p_category,p_type,p_price,p_status,p_sale,p_image,p_releasedate)VALUES(".singleQuote($_POST["input_name"]).",".singleQuote($_POST["input_category"]).","
  .singleQuote($_POST["input_type"]).",".singleQuote($_POST["input_price"]).",".singleQuote($_POST["input_status"]).",".singleQuote($_POST["input_sale"]).",".singleQuote($to_be_uploaded_path).
  ",".singleQuote($_POST["input_releasedate"]).")";


  $new_id=addProduct($query);

  header("Location: product.php");
}

if($user_action=="edit"){
  if(!isset($_POST["id"]) || $_POST["id"]==null){
    header("Location: error.php?msg=Product ID is missing.");
  }

  $query = "update product set p_name=".singleQuote($_POST["input_name"]).",p_category=".singleQuote($_POST["input_category"]).",p_type=".singleQuote($_POST["input_type"]).",
  p_price=".singleQuote($_POST["input_price"]).",p_status=".singleQuote($_POST["input_status"]).",p_sale=".singleQuote($_POST["input_sale"]).",
  p_releasedate=".singleQuote($_POST["input_releasedate"])."where p_id=".singleQuote($_POST["id"]);
  //updateCategory($query);
  if(!empty($_FILES["input_image"]["name"])){

  $imageFileType = strtolower(pathinfo($_FILES["input_image"]["name"],PATHINFO_EXTENSION));

  $to_be_uploaded_path = "images/productimg/".strtolower(str_replace(" ","_",$_POST["input_name"])).".".$imageFileType;

    // Check if file already exists
    if (file_exists($to_be_uploaded_path)) {
        unlink($to_be_uploaded_path);
      }
  

    //Upload File to Server
    move_uploaded_file($_FILES["input_image"]["tmp_name"], $to_be_uploaded_path);

  $query = "update product set p_name=".singleQuote($_POST["input_name"]).",p_category=".singleQuote($_POST["input_category"]).",p_type=".singleQuote($_POST["input_type"]).",
  p_price=".singleQuote($_POST["input_price"]).",p_status=".singleQuote($_POST["input_status"]).",p_sale=".singleQuote($_POST["input_sale"]).",p_image=".singleQuote($to_be_uploaded_path).", 
  p_releasedate=".singleQuote($_POST["input_releasedate"])."where p_id=".singleQuote($_POST["id"]);
  
  }
  updateCategory($query);

  header("Location: product.php");
}

//End Create and Edit


?>
