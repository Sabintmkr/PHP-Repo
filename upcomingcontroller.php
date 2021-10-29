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
  header("Location: error.php?msg=Missing item name.");
  exit;
}

if(!isset($_POST["input_date"]) || $_POST["input_date"]==null){
    header("Location: error.php?msg=Missing date for item.");
    exit;
}

if(!isset($_POST["input_msg"]) || $_POST["input_msg"]==null){
    header("Location: error.php?msg=Missing message for item.");
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



  $query = "insert into upcomingitem(u_name,u_date,u_image,u_msg)VALUES(".singleQuote($_POST["input_name"]).",".singleQuote($_POST["input_date"]).","
  .singleQuote($to_be_uploaded_path)."," .singleQuote($_POST["input_msg"]).")";


  $new_id=addUpcoming($query);

  header("Location: upcoming.php");
}

if($user_action=="edit"){
  if(!isset($_POST["id"]) || $_POST["id"]==null){
    header("Location: error.php?msg=Upcoming ID is missing.");
  }

  $query = "update upcomingitem set u_name=".singleQuote($_POST["input_name"]).",u_date=".singleQuote($_POST["input_date"]).",u_msg=".singleQuote($_POST["input_msg"])
  ."where u_id=".singleQuote($_POST["id"]);
  //updateUpcoming($query);
  if(!empty($_FILES["input_image"]["name"])){
  $imageFileType = strtolower(pathinfo($_FILES["input_image"]["name"],PATHINFO_EXTENSION));
  
  $to_be_uploaded_path = "images/".strtolower(str_replace(" ","_",$_POST["input_name"])).".".$imageFileType;

    // Check if file already exists
    if (file_exists($to_be_uploaded_path)) {
        unlink($to_be_uploaded_path);
      }
  

    //Upload File to Server
    move_uploaded_file($_FILES["input_image"]["tmp_name"], $to_be_uploaded_path);

  $query = "update upcomingitem set u_name=".singleQuote($_POST["input_name"]).",u_date=".singleQuote($_POST["input_date"]).",u_image=".singleQuote($to_be_uploaded_path).
  ",u_msg=".singleQuote($_POST["input_msg"])."where u_id=".singleQuote($_POST["id"]);
    }
  updateUpcoming($query);

  header("Location: upcoming.php");
}

//End Create and Edit


?>
