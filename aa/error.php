<?php include('header.php');

$error_msg="Unknown Error";

if(isset($_GET["msg"])){
  $error_msg = "Oops!! <b>".$_GET["msg"];
}
?>

<div class="box box-danger">
  <div class="box-body">
    <h4><p class="text-center"><?=$error_msg;?></p></h4>

    <div class="form-group text-center"><button type="button" id="btnBack" name="btnBack" class="btn btn-primary" onclick="goBack();">Return Back</button></div>
  </div>
</div>

<?php include('footer.php'); ?>
