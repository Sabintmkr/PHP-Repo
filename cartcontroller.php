<?php
include 'libcommon.php';


if(!isset($_POST)){
  header("Location: error.php?msg=Invalid Request");
  exit;
}



//Front End Validation
if(!isset($_POST["input_name"]) || $_POST["input_name"]==null){
  header("Location: error.php?msg=Missing customer name.");
  exit;
}

if(!isset($_POST["input_email"]) || $_POST["input_email"]==null){
    header("Location: error.php?msg=Missing customer email.");
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

if(!isset($_POST["input_msg"]) || $_POST["input_msg"]==null){
    header("Location: error.php?msg=Missing customer message.");
    exit;
}

if(!isset($_POST["input_checkout"]) || $_POST["input_checkout"]==null){
    header("Location: error.php?msg=Missing payment.");
    exit;
}


$date = date('Y-m-d');
$status = "Active";

  $query = "insert into orders(o_name, o_email, o_mobile, o_address, o_suburb, o_city, o_state, o_msg, o_date, o_status, o_payment)
  VALUES(".singleQuote($_POST["input_name"]).",".singleQuote($_POST["input_email"]).",".singleQuote($_POST["input_mobile"]).",".singleQuote($_POST["input_address"]).","
        .singleQuote($_POST["input_suburb"]).",".singleQuote($_POST["input_city"]).",".singleQuote($_POST["input_state"]).",".singleQuote($_POST["input_msg"]).","
       .singleQuote($date).",".singleQuote($status).",".singleQuote($_POST["input_checkout"]).")";
    

  $new_id=addOrder($query);
  foreach ($_SESSION["cart_product"] as $list){
    $sql_query = "insert into orderdetails(od_name, od_price, od_qty, od_p_id, od_o_id, od_image)
    VALUES(".singleQuote($list['p_name']).",".singleQuote($list['p_price']).",".singleQuote($list['p_quantity']).",".singleQuote($list['p_id']).","
          .singleQuote($new_id).",".singleQuote($list['p_image']).")";
         
          $od_id=addOrderdetails($sql_query);
  }
 
  header("Location: index.php");




//End Create and Edit


?>