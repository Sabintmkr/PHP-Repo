<!DOCTYPE html>
<?php
if(isset($_SESSION['cus_session'])){

}


  
    
$query = "select * from category";
$c_list = sqlSelectStatement($query);


?>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>Game-Land</title>
    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="icon">

    <!-- Site CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/customstyles.css">


</head>

<body>
    <!-- Start Top-bar -->
    <div class="top-bar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="right-phone-box">
                        <p>Contact :- <a href="#"> +61 000 000 000</a></p>
                    </div>
                    <?php if(isset($_SESSION['cus_session'])){ ?>
                    <div class="top-bar-menu">
                        <ul>
                            
                            <li><a href="wishlist.php"><i class="fas fa-lightbulb"></i> Wishlist</a></li>
                        </ul>
                    </div>
                    <?php }?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="login-panel">
                        <div class="dropdown">
                            <?php if(!isset($_SESSION['cus_session'])){ ?>
                            <button onclick="loginFunction()" class="dropbtn">Sign-in</button>
                            <div id="myDropdown" class="dropdown-content">
                                <a href="customerlogin.php">Customer Login</a>
                                <a href="customer_register.php">Register</a>
                                <a href="login.php">Staff Portal</a>
                            </div>
                            <?php } else {?>
                            <a class="btn btn-danger" href="logout.php">Logout</a>
                            <?php }?>
                        </div>
                    </div>
                    <div class="text-slid-box">
                        <div id="offer-box">
                            <ul class="offer-box">
                                <li>
                                    <i class="fab fa-playstation"></i>WELCOME TO THE GAMING WORLD!!!!!
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Top-bar -->
    <!--Start Menunav-->
    <header class="main-header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default main_nav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu"
                        aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="images/logo1.png" class="logo"
                            alt="sitelogo"></a>
                </div>
                <!-- End Header Navigation -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item active"><a class="nav-connect" href="index.php">Home</a></li>
                        <li class="dropdown">
                            <a href="#" class="nav-connect dropbtn" onclick="main_nav_Function()">SHOP<i
                                    class="fas fa-angle-down"></i></a>
                            <ul id="mainDropdown" class="dropdown-content">
                                <?php
                                    if(!empty($c_list)){
                                        foreach($c_list as $list){ ?>
                                <li><a href="catproduct.php?id=<?= $list['cat_id'];?>"><?=$list['cat_platform']?></a>
                                </li>
                                <?php
                                        }
                                    }
                                ?>
                                <li><a href="game.php">Game</a></li>
                                <li><a href="accessories.php">Accessories</a></li>
                                <?php if(isset($_SESSION['cus_session'])){ ?>
                                <li><a href="wishlist.php">Wishlist</a></li>
                                <?php }?>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-connect" href="aboutus.php">About Us</a></li>
                        <li class="nav-item"><a class="nav-connect" href="sale.php">Sale</a></li>
                        <li class="nav-item"><a class="nav-connect" href="newrelease.php">New Release</a></li>
                        <li class="nav-item"><a class="nav-connect" href="contactusform.php">Contact Us</a></li>
                    </ul>
                </div>
                <div class="attr-nav">
                    <ul>
                        <!-- <li class="search"><a href="#" id="sbtn"><i class="fa fa-search"></i></a></li>-->
                        <li class="side-menu">
                            <a href="cart.php">
                                <i class="fa fa-shopping-cart" style="color: #000000 !important;"></i>
                                <p>My Cart</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="search">
                <form id="search" method="post" action="search.php">
                    <input type="text" name="srch" id="query" value="" placeholder="Find Products" class="form-control"
                        style="margin-bottom:5px;">
                    <input type="submit" value="Search" class="btn btn-success sbtn" style="margin-left: 30%;">
                </form>
                <a href="search.php?value=advsrch123" style="margin-left: 20%;">Advance Search</a>
            </div>
        </nav>

    </header>
    <!-- End Main Top -->
    <!--End Menunav-->