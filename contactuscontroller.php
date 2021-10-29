<?php
include 'libcommon.php';


//Front End Validation
if(!isset($_POST["input_name"]) || $_POST["input_name"]==null){
  header("Location: error.php?msg=Missing name.");
  exit;
}

if(!isset($_POST["input_email"]) || $_POST["input_email"]==null){
    header("Location: error.php?msg=Missing email.");
    exit;
}

if(!isset($_POST["input_msg"]) || $_POST["input_msg"]==null){
    header("Location: error.php?msg=Missing message.");
    exit;
}
$date = date('Y-m-d');

$query = "insert into contactus(con_name, con_email, con_message, con_date)VALUES(".singleQuote($_POST["input_name"]).",".singleQuote($_POST["input_email"]).",".singleQuote($_POST["input_msg"]).
",".singleQuote($date).")";

$new_id=addcontactus($query);

header("Location: contactusform.php");



//End Create and Edit


?>