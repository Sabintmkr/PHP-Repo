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

//Delete 
$plat_id = $_POST["pid"];
$user_action =$_POST["action"];

if($user_action == "delete"){
	$query = "delete from banner where b_id=".$plat_id;
	sqlExecuteStatement($query);

  	echo "0||Banner Successfully Delete!!!";
	exit();
}
//End Delete


 ?>