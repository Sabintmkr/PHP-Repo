<?php
include 'libcommon.php';

//print_r($_POST);
//exit;
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

$user_action = $_POST["user_action"];

//Front End Validation
if(!isset($_POST["txtName"]) || $_POST["txtName"]==null){
  header("Location: error.php?msg=Actor Name is blank.");
  exit;
}
if(!isset($_POST["txtDOB"]) || $_POST["txtDOB"] == null){
  header("Location: error.php?msg=Actor DOB is blank.");
  exit;
}
if(!isset($_POST["txtIntro"]) || $_POST["txtIntro"] == null){
  header("Location: error.php?msg=Actor Introduction is blank.");
  exit;
}


if($user_action=="add"){
  if(empty($_FILES["txtPicture"]["name"])){
    $to_be_uploaded_path = "images/unknown.png";
  }
  else{
    // Allow certain file formats
    $imageFileType = strtolower(pathinfo($_FILES["txtPicture"]["name"],PATHINFO_EXTENSION));
    if(!in_array($imageFileType, ALLOWED_FILE_FORMATS)){
      header("Location: error.php?msg=Only JPG, JPEG and PNG files are allowed.");
      exit;
    }

    if($_FILES['txtPicture']['size']>UPLOAD_FILE_SIZE){
      header("Location: error.php?msg=Maximum file size of ".UPLOAD_FILE_SIZE." bytes is only allowed.");
      exit;
    }

    //Check Uploaded file Dimensions
    list($width, $height) = getimagesize($_FILES["txtPicture"]["tmp_name"]);
    if($width != "214" || $height != "317") {
      header("Location: error.php?msg=Image dimensions must be 214 x 317 pixels.");
      exit;
    }

    $to_be_uploaded_path = "images/actors/".strtolower(str_replace(" ","_",$_POST["txtName"])).".".$imageFileType;

    // Check if file already exists
    if (file_exists($to_be_uploaded_path)) {
      unlink($to_be_uploaded_path);
    }

    //Upload File to Server
    move_uploaded_file($_FILES["txtPicture"]["tmp_name"], $to_be_uploaded_path);
  }

  $sql = "insert into actor(name,dob,profile_image,intro)VALUES(".singleQuote($_POST["txtName"]).",".singleQuote($_POST["txtDOB"]).",".singleQuote($to_be_uploaded_path).",".singleQuote($_POST["txtIntro"]).")";

  $new_id=addNewActor($sql);

  header("Location: actor.php?id=".$new_id);
}

if($user_action=="update"){
  if(!isset($_POST["id"]) || $_POST["id"]==null){
    header("Location: error.php?msg=Actor ID is blank.");
  }

  $sql = "update actor set name=".singleQuote($_POST["txtName"]).",dob=".singleQuote($_POST["txtDOB"]).",intro=".singleQuote($_POST["txtIntro"])." WHERE id='".$_POST["id"]."'";

  if(!empty($_FILES["txtPicture"]["name"])){
    // Allow certain file formats
    $imageFileType = strtolower(pathinfo($_FILES["txtPicture"]["name"],PATHINFO_EXTENSION));
    if(!in_array($imageFileType,ALLOWED_FILE_FORMATS)){
      header("Location: error.php?msg=Only JPG, JPEG and PNG files are allowed.");
      exit;
    }

    if($_FILES['txtPicture']['size']>UPLOAD_FILE_SIZE){
      header("Location: error.php?msg=Maximum file size of ".UPLOAD_FILE_SIZE." bytes is only allowed.");
      exit;
    }

    //Check Uploaded file Dimensions
    list($width, $height) = getimagesize($_FILES["txtPicture"]["tmp_name"]);
    if($width != "214" || $height != "317") {
      header("Location: error.php?msg=Image dimensions must be 214 x 317 pixels.");
      exit;
    }

    $to_be_uploaded_path = "images/actors/".strtolower(str_replace(" ","_",$_POST["txtName"])).".".$imageFileType;

    // Check if file already exists
    if (file_exists($to_be_uploaded_path)) {
      unlink($to_be_uploaded_path);
    }

    //Upload File to Server
    move_uploaded_file($_FILES["txtPicture"]["tmp_name"], $to_be_uploaded_path);

    $sql = "update actor set name=".singleQuote($_POST["txtName"]).",dob=".singleQuote($_POST["txtDOB"]).",profile_image=".singleQuote($to_be_uploaded_path).",intro=".singleQuote($_POST["txtIntro"])." WHERE id='".$_POST["id"]."'";
  }
  updateActor($sql);

  header("Location: actor.php?id=".$_POST["id"]);
}

?>
