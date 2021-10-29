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
  header("Location: error.php?msg=Missing banner name.");
  exit;
}

if(!isset($_POST["input_status"]) || $_POST["input_status"]==null){
    header("Location: error.php?msg=Missing status for banner.");
    exit;
}

if(!isset($_POST["input_msg"]) || $_POST["input_msg"]==null){
    header("Location: error.php?msg=Missing message for banner.");
    exit;
}


if($user_action=="create"){
    if(empty($_FILES["input_image"]["name"])){
        $to_be_uploaded_path = "images/unknown_image.png";
      }
      else{
        
        $imageFileType = strtolower(pathinfo($_FILES["input_image"]["name"],PATHINFO_EXTENSION));
        $to_be_uploaded_path = "images/".strtolower(str_replace(" ","_",$_POST["input_name"])).".".$imageFileType;
    
        // Check if file already exists
        if (file_exists($to_be_uploaded_path)) {
          unlink($to_be_uploaded_path);
        }
    
        //Upload File to Server
        move_uploaded_file($_FILES["input_image"]["tmp_name"], $to_be_uploaded_path);
      }



  $query = "insert into banner(b_name,b_status,b_image,b_msg)VALUES(".singleQuote($_POST["input_name"]).",".singleQuote($_POST["input_status"]).","
  .singleQuote($to_be_uploaded_path)."," .singleQuote($_POST["input_msg"]).")";


  $new_id=addBanner($query);

  header("Location: banner.php");
}

if($user_action=="edit"){
  if(!isset($_POST["id"]) || $_POST["id"]==null){
    header("Location: error.php?msg=Banner ID is missing.");
  }

  $query = "update banner set b_name=".singleQuote($_POST["input_name"]).",b_status=".singleQuote($_POST["input_status"]).",b_msg=".singleQuote($_POST["input_msg"])
  ."where b_id=".singleQuote($_POST["id"]);
  //updateBanner($query);
  if(!empty($_FILES["input_image"]["name"])){
  $imageFileType = strtolower(pathinfo($_FILES["input_image"]["name"],PATHINFO_EXTENSION));
  
  $to_be_uploaded_path = "images/".strtolower(str_replace(" ","_",$_POST["input_name"])).".".$imageFileType;

    // Check if file already exists
    if (file_exists($to_be_uploaded_path)) {
        unlink($to_be_uploaded_path);
      }
  

    //Upload File to Server
    move_uploaded_file($_FILES["input_image"]["tmp_name"], $to_be_uploaded_path);

  $query = "update banner set b_name=".singleQuote($_POST["input_name"]).",b_status=".singleQuote($_POST["input_status"]).",b_image=".singleQuote($to_be_uploaded_path).
  ",b_msg=".singleQuote($_POST["input_msg"])."where b_id=".singleQuote($_POST["id"]);
    }
  updateBanner($query);

  header("Location: banner.php");
}

//End Create and Edit


?>