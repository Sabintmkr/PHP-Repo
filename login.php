<?php
  include('sub_layout_header.php');
  include 'libcommon.php';

  //Checks if the form elements are posted or not
  if(isset($_POST["input_UserName"]) && isset($_POST["input_Password"])){
    
    //Verifes admin user login
    $user = emp_Login($_POST["input_UserName"],$_POST["input_Password"]);
    

    if(empty($user)){
      header("Location: error.php?msg=Invalid Username or Password");
      exit();
    }
    $_SESSION['current_session']= $user['id']."_".generateRandomNumber(8);
    $_SESSION['usr']=$user['emp_id'];
    $_SESSION['usrname']=$user['emp_first_name'];
    header("Location: dash.php");
    exit();
    
 }
?>

<form class="form-signin" action="login.php" method="post">
    <img class="mb-4" src="images/logo1.png" alt="" >
    <h1 class="h3 mb-3 font-weight-normal">Employee Portal</h1>
    <label for="username" class="sr-only">Username</label>
    <input type="text" id="input_UserName" name="input_UserName" class="form-control" placeholder="User Name" required="" autofocus="">
    <label for="password" class="sr-only">Password</label>
    <input type="password" id="input_Password" name="input_Password" class="form-control" placeholder="Password" required="">
    <div class="checkbox mb-3">
        <label>
        <input type="checkbox" value="remember-me"> Remember me
        </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">All Rights Reserved. &copy; 2020 <a href="#">GAMELAND</a></p>
</form>

<?php
  include('sub_layout_footer.php');
?>