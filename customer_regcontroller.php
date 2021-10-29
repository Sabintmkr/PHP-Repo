<?php
include 'libcommon.php';


if(!isset($_POST["user_action"]) || $_POST["user_action"]==null){
  header("Location: error.php?msg=User action is not defined.");
}

//Create and Edit
$user_action = $_POST["user_action"];

//Front End Validation
if(!isset($_POST["input_fname"]) || $_POST["input_fname"]==null){
  header("Location: error.php?msg=Missing customer firstname.");
  exit;
}

if(!isset($_POST["input_lname"]) || $_POST["input_lname"]==null){
    header("Location: error.php?msg=Missing customer last name.");
    exit;
}

if(!isset($_POST["input_address"]) || $_POST["input_address"]==null){
    header("Location: error.php?msg=Missing customer address.");
    exit;
}

if(!isset($_POST["input_suburb"]) || $_POST["input_suburb"]==null){
    header("Location: error.php?msg=Missing customer suburb.");
    exit;
}

if(!isset($_POST["input_city"]) || $_POST["input_city"]==null){
    header("Location: error.php?msg=Missing customer city.");
    exit;
}

if(!isset($_POST["input_state"]) || $_POST["input_state"]==null){
    header("Location: error.php?msg=Missing customer state.");
    exit;
}

if(!isset($_POST["input_mobile"]) || $_POST["input_mobile"]==null){
    header("Location: error.php?msg=Missing customer phone number.");
    exit;
}

if(!isset($_POST["input_usrname"]) || $_POST["input_email"]==null){
    header("Location: error.php?msg=Missing customer email.");
    exit;
}


if(!isset($_POST["input_usrname"]) || $_POST["input_usrname"]==null){
    header("Location: error.php?msg=Missing customer username.");
    exit;
}

if(!isset($_POST["input_password"]) || $_POST["input_password"]==null){
    header("Location: error.php?msg=Missing customer password.");
    exit;
}
  
$date - date('Y-m-d');
if($user_action=="create"){
  $query = "insert into client(cl_username, cl_password, cl_firstname, cl_lastname, cl_mobile, cl_email, cl_address, cl_suburb, cl_city, cl_state, cl_date)VALUES(".singleQuote($_POST["input_usrname"]).",".singleQuote($_POST["input_password"]).",".singleQuote($_POST["input_fname"]).",".singleQuote($_POST["input_lname"]).","
        .singleQuote($_POST["input_mobile"]).",".singleQuote($_POST["input_email"]).",".singleQuote($_POST["input_address"]).",".singleQuote($_POST["input_suburb"]).",".singleQuote($_POST["input_city"]).","
        .singleQuote($_POST["input_state"]).",".singleQuote($date).")";

  $new_id=addCustomer($query);

  header("Location: index.php");
}



//End Create and Edit


?>
