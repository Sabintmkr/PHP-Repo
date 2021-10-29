<?php
  include 'libcommon.php';
  include('layout_header.php');
 
  //Checks if the form elements are posted or not
  if(isset($_POST["input_UserName"]) && isset($_POST["input_Password"])){
    
    //Verifes admin user login
    $user = customer_Login($_POST["input_UserName"],$_POST["input_Password"]);
    $_SESSION['cus_session'] = $_POST["input_UserName"];
   //echo($_SESSION['cus_session']);
  // $_SESSION['cus_session'] = $_POST["input_UserName"];
   ?>
   <script>
   window.location.href="/index.php";
   </script>
   <?php
 }
?>

<div class="container">
    <hr />
    <br />
    <form class="form-signin" action="customerlogin.php" method="post">
        <h1 class="h3 mb-3 font-weight-normal">Customer Login</h1>
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <label for="username" class="sr-only">Username</label>
                <input type="text" id="input_UserName" name="input_UserName" class="form-control" placeholder="User Name" required="" autofocus="">
            </div>
            <div class="col-lg-4"></div>
        </div>
        <br/>
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <label for="password" class="sr-only">Password</label>
                <input type="password" id="input_Password" name="input_Password" class="form-control" placeholder="Password" required="">
            </div>
            <div class="col-lg-4"></div>
        </div>
        <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="checkbox mb-3">
                <label>
                <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </div>
        <div class="col-lg-4"></div>
        </div>
    </form>
</div>
<br/>
<hr/>
<?php
  include('layout_foot.php');
?>