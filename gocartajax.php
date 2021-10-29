<?php
	include 'libcommon.php';

//Capture POSTED variables
$id = $_POST["pid"];
$user_action =$_POST["action"];


goCart($user_action,$id);
wish($user_action,$id);

 ?>