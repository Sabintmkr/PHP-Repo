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
if(!isset($_POST["input_catname"]) || $_POST["input_catname"]==null){
  header("Location: error.php?msg=Missing category name.");
  exit;
}

if($user_action=="create"){
  $query = "insert into category(cat_platform)VALUES(".singleQuote($_POST["input_catname"]).")";

  $new_id=addCategory($query);

  header("Location: category.php");
}

if($user_action=="edit"){
  if(!isset($_POST["id"]) || $_POST["id"]==null){
    header("Location: error.php?msg=Category ID is missing.");
  }

  $query = "update category set cat_platform=".singleQuote($_POST["input_catname"])." where cat_id=".singleQuote($_POST["id"]);
  updateCategory($query);

  header("Location: category.php");
}

//End Create and Edit


?>