<?php
include('dashboard_header.php');
include 'libcommon.php';
//echo "SID".$_SESSION['current_session'];
//echo "UserId".$_SESSION['user'];

//if(!isset($_SESSION['current_session'])){
  //  header("Location:error.php?msg=Login first");
    //die();

//}

//echo "UID:". $_SESSION['usr'];
//echo "Uname:". $_SESSION['usrname'];

$id=$_SESSION['usr'];

if(!isset($_SESSION['usr']) || empty($_SESSION['usr'])){
  header("Location: error.php?msg=Access Denied!!! Please Login");
  die();
}

$currentuser_detail = getUserDetail($id);

if(empty($currentuser_detail)){
  header("Location: error.php?msg=Unauthorized Access are denied..");
}


$usrid = $currentuser_detail['emp_id'];
$usernm = $currentuser_detail['emp_username'];
$fname = $currentuser_detail['emp_first_name'];
$lname = $currentuser_detail['emp_last_name'];
$address = $currentuser_detail['emp_address'];
$phone = $currentuser_detail['emp_phone'];
$email = $currentuser_detail['emp_email'];
$date = date("l");
$time = date("h:i:sa");
  
?>

<h1 class="mt-4">Welcome to GameLand Portal</h1>
<h3 class="mt-4"><?= $fname ?> </h3>
<br>
<div class="container emp-profile">
    <form method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img src="images/noimg.png" alt=""/>
                    <!--<div class="file btn btn-lg btn-primary">
                        Change Photo
                        <input type="file" name="file"/>
                    </div>-->
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                            <h5><?= "Username: ". $usernm ?></h5>
                            <h6>
                                Role: Admin
                            </h6>
                            <p class="proile-rating">Logged in at : <span><?= $date." ". $time?></span></p>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <b>ABOUT</b>
                        
                    </ul>
                </div>
            </div>
            <div class="col-md-2">
            <input type="button" class="btn btn-primary" value="Edit" onclick="location.href='employeeform.php?id=<?= $usrid;?>'"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="profile-work">
                    
                </div>
            </div>
            <div class="col-md-8">
                <div class="tab-content profile-tab">
                    <div class="tab-pane fade show active">
                        <div class="row">
                            <div class="col-md-6">
                                <label>User Id</label>
                            </div>
                            <div class="col-md-6">
                                <p><?= $usrid ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Name</label>
                            </div>
                            <div class="col-md-6">
                                <p><?= $fname." ".$lname ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Email</label>
                            </div>
                            <div class="col-md-6">
                                <p><?= $email ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Phone</label>
                            </div>
                            <div class="col-md-6">
                                <p><?= $phone ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Address</label>
                            </div>
                            <div class="col-md-6">
                                <p><?= $address ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>           
</div>
<?php
include('dashboard_footer.php');
?>