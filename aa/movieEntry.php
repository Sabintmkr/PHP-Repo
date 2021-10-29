<?php
include 'libcommon.php';

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
if(!isset($_POST["txtMovieName"]) || $_POST["txtMovieName"]==null){
  header("Location: error.php?msg=Movie Name is blank.");
  exit;
}
if(!isset($_POST["ddlDirector"]) || $_POST["ddlDirector"] == null){
  header("Location: error.php?msg=Director is blank.");
  exit;
}
if(!isset($_POST["ddlGenre"]) || $_POST["ddlGenre"] == null){
  header("Location: error.php?msg=Genre is blank.");
  exit;
}
if(!isset($_POST["txtLanguage"]) || $_POST["txtLanguage"]==null){
  header("Location: error.php?msg=Language is blank.");
  exit;
}
if(!isset($_POST["txtReleaseDate"]) || $_POST["txtReleaseDate"] == null){
  header("Location: error.php?msg=Release Date is blank.");
  exit;
}
if(!isset($_POST["txtAmount"]) || $_POST["txtAmount"] == null){
  header("Location: error.php?msg=Amount is blank.");
  exit;
}
if(!isset($_POST["txtIntro"]) || $_POST["txtIntro"] == null){
  header("Location: error.php?msg=Introduction is blank.");
  exit;
}

if($user_action=="add"){
  if(empty($_FILES["txtPicture"]["name"])){
    $to_be_uploaded_path = "images/unknown_movie.png";
  }
  else{
    //Validation for file formats
    $imageFileType = strtolower(pathinfo($_FILES["txtPicture"]["name"],PATHINFO_EXTENSION));
    if(!in_array($imageFileType,ALLOWED_FILE_FORMATS)){
      header("Location: error.php?msg=Only JPG, JPEG and PNG files are allowed.");
      exit;
    }

    //Validation for file size
    if($_FILES['txtPicture']['size']>UPLOAD_FILE_SIZE){
      header("Location: error.php?msg=Maximum file size of ".UPLOAD_FILE_SIZE." bytes is only allowed.");
      exit;
    }

    //Validation for Uploaded file Dimensions
    list($width, $height) = getimagesize($_FILES["txtPicture"]["tmp_name"]);
    if($width != "182" || $height != "268") {
      header("Location: error.php?msg=Image dimensions must be 182 x 268 pixels.");
      exit;
    }

    $to_be_uploaded_path = "images/coverImages/".strtolower(str_replace(" ","_",$_POST["txtMovieName"])).".".$imageFileType;

    // Check if file already exists
    if (file_exists($to_be_uploaded_path)) {
      unlink($to_be_uploaded_path);
    }

    //Upload File to Server
    move_uploaded_file($_FILES["txtPicture"]["tmp_name"], $to_be_uploaded_path);
  }

  $sql = "insert into movie(name,director,genre,profile_image,release_date,intro,language,amount)VALUES(".singleQuote($_POST["txtMovieName"]).",".singleQuote($_POST["ddlDirector"]).",".singleQuote($_POST["ddlGenre"]).",".singleQuote($to_be_uploaded_path).",".singleQuote($_POST["txtReleaseDate"]).",".singleQuote($_POST["txtIntro"]).",".singleQuote($_POST["txtLanguage"]).",".singleQuote($_POST["txtAmount"]).")";

  $new_id=addNewMovie($sql);

  header("Location: movie.php?id=".$new_id);
}

if($user_action=="update"){
  if(!isset($_POST["id"]) || $_POST["id"]==null){
    header("Location: error.php?msg=Movie ID is blank.");
  }

  $sql = "update movie set name=".singleQuote($_POST["txtMovieName"]).", director=".singleQuote($_POST["ddlDirector"]).", genre=".singleQuote($_POST["ddlGenre"]).", release_date=".singleQuote($_POST["txtReleaseDate"]).", intro=".singleQuote($_POST["txtIntro"]).", language=".singleQuote($_POST["txtLanguage"]).", amount=".singleQuote($_POST["txtAmount"])." where id=".singleQuote($_POST["id"]);

  if(!empty($_FILES["txtPicture"]["name"])){
    //Validation for file formats
    $imageFileType = strtolower(pathinfo($_FILES["txtPicture"]["name"],PATHINFO_EXTENSION));
    if(!in_array($imageFileType,ALLOWED_FILE_FORMATS)){
      header("Location: error.php?msg=Only JPG, JPEG and PNG files are allowed.");
      exit;
    }

    //Validation for file size
    if($_FILES['txtPicture']['size']>UPLOAD_FILE_SIZE){
      header("Location: error.php?msg=Maximum file size of ".UPLOAD_FILE_SIZE." bytes is only allowed.");
      exit;
    }

    //Validation for Uploaded file Dimensions
    list($width, $height) = getimagesize($_FILES["txtPicture"]["tmp_name"]);
    if($width != "182" || $height != "268") {
      header("Location: error.php?msg=Image dimensions must be 182 x 268 pixels.");
      exit;
    }

    $to_be_uploaded_path = "images/coverImages/".strtolower(str_replace(" ","_",$_POST["txtMovieName"])).".".$imageFileType;

    // Check if file already exists
    if (file_exists($to_be_uploaded_path)) {
      unlink($to_be_uploaded_path);
    }

    //Upload File to Server
    move_uploaded_file($_FILES["txtPicture"]["tmp_name"], $to_be_uploaded_path);

    $sql = "update movie set name=".singleQuote($_POST["txtMovieName"]).",  director=".singleQuote($_POST["ddlDirector"]).", genre=".singleQuote($_POST["ddlGenre"]).", profile_image=".singleQuote($to_be_uploaded_path).", release_date=".singleQuote($_POST["txtReleaseDate"]).", intro=".singleQuote($_POST["txtIntro"]).",language=".singleQuote($_POST["txtLanguage"]).",amount=".singleQuote($_POST["txtAmount"])." WHERE id=".singleQuote($_POST["id"]);

  }

  updateMovie($sql);

  header("Location: movie.php?id=".$_POST["id"]);
}

?>
