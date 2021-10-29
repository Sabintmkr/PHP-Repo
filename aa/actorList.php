<?php include('header.php'); ?>

<!--Section for Logged in user actions-->
<?php if(isset($_SESSION['current_session'])){ ?>
  <div class="box">
    <div class="box-header"><h3 class="box-title">Available Actions</h3></div>
    <div class="box-body row">
      <div class="col-md-3">
      <form method="get" action="actorForm.php">
      <input type="submit" class="btn btn-primary" value="Add New"/>
      </form>
      </div>
    </div>
  </div>
<?php }?>

<!--Actors List Block-->
<div class="box">
  <div class="box-header"><h3 class="box-title">Available Actors</h3></div>

  <div class="box-body row">
    <?php
    $movie_list = getActorList();
    if(!empty($movie_list))
    {
    foreach($movie_list as $row){ ?>
      <div class="col-md-3">
        <div class="description-block">
          <a href="actor.php?id=<?= $row['id'];?>"><img src="<?=$row['profile_image'];?>" alt="<?=$row['name'];?>"/></a>
          <h5 class="description-header"><a href="actor.php?id=<?= $row['id'];?>"><?= $row['name'];?></a></h5>
        </div>
      </div>

    <?php
      }
    }
    ?>
  </div>
</div>


<?php include('footer.php'); ?>
