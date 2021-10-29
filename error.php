<?php
  include('sub_layout_header.php');
    $error_msg="Unknown Error";

    if(isset($_GET["msg"])){
        $error_msg = "Error !!!!  <br>".$_GET["msg"]; 
    }
?>

<div class="container">
    <h2><b>You Are Not Authorized</b></h2>
    <h1><p class="text-center"><?=$error_msg;?></p></h1>
    <div class="form-group text-center"><button type="button" id="btnBack" name="btnBack" class="btn btn-primary" onclick="goBack();">Return Back</button></div>
</div>

<?php
  include('sub_layout_footer.php');
?>

