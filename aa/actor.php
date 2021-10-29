<?php
include('header.php');

$id = "";

if(!isset($_GET["id"]) || empty($_GET["id"])){
  header("Location: error.php?msg=Invalid Request.");
  exit();
}
$id = $_GET["id"];

$actor_detail = getActorDetail($id);

if(empty($actor_detail)){
  header("Location: error.php?msg=Invalid Actor.");
  exit();
}

?>

<!--Section for User Actions for Logged In Users-->
<?php if(isset($_SESSION['current_session'])){ ?>

  <div class="box">
    <div class="box-header"><h3 class="box-title">Available Actions</h3></div>
    <div class="box-body row">
      <div class="col-md-3">
      <form method="get" action="actorForm.php">
      <input type="hidden" id="id" name="id" value="<?=$id;?>"/>
      <input type="submit" class="btn btn-primary" value="Edit" />
      <input type="button" class="btn btn-primary" value="Delete" id="btnDelete" name="btnDelete" />
      </form>
      </div>
    </div>
  </div>
<?php }?>

<!--Actor Detail Block-->
<div class="box">
  <div class="box-header"><h3 class="box-title"><?=htmlspecialchars_decode($actor_detail['name']);?></h3></div>
  <div class="box-body row">
    <div class="col-md-3">
      <img src="<?=htmlspecialchars_decode($actor_detail['profile_image']);?>" alt="<?=htmlspecialchars_decode($actor_detail['name']);?>"/>
    </div>

    <div class="col-md-9">
      <div class="item">
        <p class="message"><?=htmlspecialchars_decode($actor_detail['intro']);?></p>
      </div>
      <div class="item">
        <p class="message"><b>Date of Birth: </b><?=htmlspecialchars_decode($actor_detail['dob']);?></p>
      </div>
    </div>
  </div>
</div>

<!--List of movies that the actor enrolled in-->
<div class="box">
  <div class="box-header"><h3 class="box-title">Casted In</h3></div>

  <div class="box-body row">
    <?php
    $movie_list = sqlSelectStatement("select m.* from movie m JOIN actor_enrolled a ON m.id=a.movie_id WHERE a.actor_id='".$id."'");
    if(!empty($movie_list))
    {
    foreach($movie_list as $row){ ?>
      <div class="col-md-3">
        <div class="description-block">
          <a href="movie.php?id=<?= htmlspecialchars_decode($row['id']);?>"><img src="<?=htmlspecialchars_decode($row['profile_image']);?>" alt="<?=htmlspecialchars_decode($row['name']);?>"/></a>
          <h5 class="description-header"><a href="movie.php?id=<?= htmlspecialchars_decode($row['id']);?>"><?= htmlspecialchars_decode($row['name']);?></a></h5>
        </div>
      </div>

    <?php
      }
    }
    ?>

  </div>
</div>

<script type="text/javascript">

$(document).ready(function () {
  //Delete an actor from the system
  $('#btnDelete').click(function(){
    if(confirm("Are you sure to delete the actor?")){
      var movie_id = "";
      var actor_id = "<?=$id;?>";

      $.ajax({
          method:"POST",
          url: 'actor_enroll_ajax.php',
          data: {mid:movie_id,aid:actor_id,action:"delete"},
          success: function (data, status, xhr) {
            var resp = data.split("||");
            alert(resp[1]);
            if(resp[0]=="0"){
              window.location.replace("actorList.php");
            }

          },
          error: function (jqXhr, textStatus, errorMessage) {
            alert("Server Connection Lost. Please try again");
          }
       });
    }
  });
});

</script>

<?php include('footer.php'); ?>
