<?php
include('header.php');

//Checks if the form elements are posted or not
if(isset($_POST["txtUserName"]) && isset($_POST["txtPassword"])){

  //Verifes admin user login
  $user_detail = adminLogin($_POST["txtUserName"],$_POST["txtPassword"]);

  if(empty($user_detail)){
    header("Location: error.php?msg=Invalid Login Credentials");
    exit();
  }

  //Sets session and redirects to home page
  $_SESSION['current_session']= $user_detail['id']."_".generateRandomNumber(8);
  header("Location: index.php");
}
?>

<div class="box">
  <div class="box-header"><h3 class="box-title">Admin Login</h3></div>
    <div class="box-body">
    <form action="login.php" method="post">
      <div class="form-group">
        <input type="text" id="txtUserName" name="txtUserName" class="form-control" required placeholder="Username">
      </div>
      <div class="form-group">
        <input type="password" id="txtPassword" name="txtPassword" class="form-control" required placeholder="Password">
      </div>
      <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
      </div>
    </form>

  </div>

</div>

<?php include('footer.php'); ?>
