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
if(!isset($_POST["input_fname"]) || $_POST["input_fname"]==null){
  header("Location: error.php?msg=Missing employee firstname.");
  exit;
}

if(!isset($_POST["input_lname"]) || $_POST["input_lname"]==null){
    header("Location: error.php?msg=Missing employee last name.");
    exit;
}

if(!isset($_POST["input_address"]) || $_POST["input_address"]==null){
    header("Location: error.php?msg=Missing employee address.");
    exit;
}

if(!isset($_POST["input_phone"]) || $_POST["input_phone"]==null){
    header("Location: error.php?msg=Missing employee phone number.");
    exit;
}

if(!isset($_POST["input_usrname"]) || $_POST["input_email"]==null){
    header("Location: error.php?msg=Missing employee email.");
    exit;
}


if(!isset($_POST["input_usrname"]) || $_POST["input_usrname"]==null){
    header("Location: error.php?msg=Missing employee username.");
    exit;
}

if(!isset($_POST["input_password"]) || $_POST["input_password"]==null){
    header("Location: error.php?msg=Missing employee password.");
    exit;
}
  

if($user_action=="create"){
  $query = "insert into employee(emp_first_name,emp_last_name,emp_username,emp_password,emp_address,emp_phone,emp_email)VALUES(".singleQuote($_POST["input_fname"]).",".singleQuote($_POST["input_lname"]).","
        .singleQuote($_POST["input_usrname"]).",".singleQuote($_POST["input_password"]).",".singleQuote($_POST["input_address"]).",".singleQuote($_POST["input_phone"]).",".singleQuote($_POST["input_email"]).")";

  $new_id=addEmployee($query);

  header("Location: employee.php");
}

if($user_action=="edit"){
  if(!isset($_POST["id"]) || $_POST["id"]==null){
    header("Location: error.php?msg=Employee ID is missing.");
  }

  $query = "update employee set emp_first_name=".singleQuote($_POST["input_fname"]).",emp_last_name=".singleQuote($_POST["input_lname"]).",emp_username=".singleQuote($_POST["input_usrname"]).",
  emp_password=".singleQuote($_POST["input_password"]).",emp_address=".singleQuote($_POST["input_address"]).",emp_phone=".singleQuote($_POST["input_phone"]).", 
  emp_email=".singleQuote($_POST["input_email"])."where emp_id=".singleQuote($_POST["id"]);
  updateEmployee($query);

  header("Location: employee.php");
}

//End Create and Edit


?>
