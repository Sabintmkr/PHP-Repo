<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html>
<?php
	include 'libcommon.php';

?>

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Get Movie Online</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
		<link rel="manifest" href="site.webmanifest">
		<link rel="mask-icon" href="safari-pinned-tab.svg" color="#5bbad5">
		<meta name="msapplication-TileColor" content="#00aba9">
		<meta name="theme-color" content="#ffffff">

		<link rel="stylesheet" href="bootstrap.min.css">
		<link rel="stylesheet" href="font-awesome.min.css">
		<link rel="stylesheet" href="main.css">

		<style>

		</style>

		<script src="Scripts/jquery.min.js"></script>
		<script src="Scripts/master_script.js"></script>
	</head>

	<body>

		<div class="wrapper">

			<div id="topBlueBanner"></div>

			<!--Logo Block-->
			<div id="logo" class="logo">
				<a class="slogan" href="#"><img width="20%" src="images/GetMovieOnline_logo.png" /> </a>
			</div>

			<!--Simple Search Block-->
			<div class="search">
				<form id="search" method="post" action="list.php"><input type="text" name="q" id="query" value="" placeholder="Movie Name" class="searchbox">

					<input type="submit" value="Search" class="button">
				</form>
			</div>

			<!--Advance Search Block-->
			<div>
				<a href="search.php">Need an advance Search?</a>
			</div>

			<!--Menu Block-->
			<div id="menuBar" class="menuHeader">
				<nav>
						<ul class='clearfix'>
							<li><a href='index.php'>Home</a></li>
							<li><a href='list.php'>Movies</a></li>
							<li><a href='actorList.php'>Actors</a></li>
							<?php if(!isset($_SESSION['current_session'])){ ?>
								<li><a href='login.php'>Login</a></li>
							<?php }else{ ?>
								<li><a href='logout.php'>LogOut</a></li>
							<?php }?>
							<li><a href='cart.php'>My Cart</a></li>
						</ul>
				</nav>
			</div>
