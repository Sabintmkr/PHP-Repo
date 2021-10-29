<?php
	include 'libcommon.php';

//Capture POSTED variables
$movie_id = $_POST["mid"];
$user_action =$_POST["action"];


updateCart($user_action,$movie_id);

 ?>
