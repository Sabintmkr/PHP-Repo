<?php include('header.php');

if(!isset($_SESSION['current_session'])){
  header("Location: error.php?msg=Please login in the system to proceed further.");
  exit();
}

//Initialize variables for new user
$id="";
$header_text = "New Actor";
$actor_name = "";
$actor_dob ="";
$actor_picture = "";
$actor_intro = "";
$user_action = "add";

//Initialize variables for edit user
if(isset($_GET["id"])){
  $id=$_GET["id"];
  $header_text="Upate Actor";

  $actor_detail = getActorDetail($id);

  $actor_name = $actor_detail['name'];
  $actor_dob = $actor_detail['dob'];
  $actor_picture = "";
  $actor_intro = $actor_detail['intro'];
  $user_action = "update";
}
?>

<!--User Comments Block-->
<div class="box">
  <div class="box-header"><h3 class="box-title"><?=$header_text;?></h3></div>
  <div class="box-body no-padding">

    <div class="post">
      <form action="actorEntry.php" method="post" enctype="multipart/form-data">

        <div class="col-md-6 form-group"><label>Actor Full Name</label><input type="text" class="form-control" id="txtName" name="txtName" value="<?=$actor_name;?>" required></div>
        <div class="col-md-6 form-group"><label>Date of Birth (YYYY-MM-DD)</label><input type="text" class="form-control" id="txtDOB" name="txtDOB" value="<?=$actor_dob;?>" required></div>
        <div class="col-md-6 form-group"><label>Profile Picture</label><input type="file" class="form-control" id="txtPicture" name="txtPicture" /></div>
        <div class="col-md-6 form-group"><label>Introduction</label><textarea class="form-control" rows="3" id="txtIntro" name="txtIntro" placeholder="Some Introduction......." required><?=$actor_intro;?></textarea></div>
        <div class="form-group"><input type="submit" class="btn btn-primary" value="Save" name="btnSubmit" id="btnSubmit" /></div>
        <input type="hidden" id="id" name="id" value="<?=$id;?>"/>
        <input type="hidden" id="user_action" name="user_action" value="<?=$user_action;?>"/>

      </form>
    </div>

  </div>
</div>

<script type="text/javascript">

$(document).ready(function () {
  //Front End Validation
  $('#btnSubmit').click(function(){
    if($('#txtName').val()==""){
      alert("Actor Name is blank.");
      $('#txtName').focus();
      return false;
    }
    if($('#txtDOB').val()==""){
      alert("Date of Birth is blank.");
      $('#txtDOB').focus();
      return false;
    }
    if($('#txtIntro').val()==""){
      alert("Actor Introduction is blank.");
      $('#txtIntro').focus();
      return false;
    }
  });
});

</script>

<?php include('footer.php'); ?>
