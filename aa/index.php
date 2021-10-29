<?php include('header.php');

?>

<!--Movies List Block Recent-->
<div class="box">
  <div class="box-header"><h3 class="box-title">Recent</h3></div>

  <div class="box-body row">
    <?php
    $movie_list = sqlSelectStatement("select * from movie where release_date<Date('now') LIMIT 4 ");
    if(!empty($movie_list))
    {
    foreach($movie_list as $row){ ?>
      <div class="col-md-3">

        <div class="description-block">
          <a href="movie.php?id=<?= $row['id'];?>"><img src="<?=$row['profile_image'];?>" alt="<?=$row['name'];?>"/></a>
          <h5 class="description-header"><a href="movie.php?id=<?= $row['id'];?>"><?= $row['name'];?></a></h5>
          <?php if(isset($_SESSION['current_session'])){ ?>
            <input type="button" class="btn btn-primary" value="Edit" onclick="location.href='movieForm.php?id=<?= $row['id'];?>'"/>
          <?php }else{ ?>
            <input type="button" class="btn btn-primary" value="Add to Cart" onClick="updateCart('add','<?= $row['id'];?>')"/>
          <?php }?>
        </div>

      </div>

    <?php
      }
    }
    ?>

    <div class="text-center">
      <a href="list.php" class="uppercase">View All</a>
    </div>
  </div>
</div>

<!--Movies List Block Up Coming-->
<div class="box">
  <div class="box-header"><h3 class="box-title">Up Coming</h3></div>

  <div class="box-body row">
    <?php
    $movie_list = sqlSelectStatement("select * from movie where release_date>Date('now') LIMIT 4 ");
    if(!empty($movie_list))
    {
    foreach($movie_list as $row){ ?>
      <div class="col-md-3">

        <div class="description-block">
          <a href="movie.php?id=<?= $row['id'];?>"><img src="<?=$row['profile_image'];?>" alt="<?=$row['name'];?>"/></a>
          <h5 class="description-header"><a href="movie.php?id=<?= $row['id'];?>"><?= $row['name'];?></a></h5>
          <?php if(isset($_SESSION['current_session'])){ ?>
            <input type="button" class="btn btn-primary" value="Edit" onclick="location.href='movieForm.php?id=<?= $row['id'];?>'"/>
          <?php }else{ ?>
            <input type="button" class="btn btn-primary" value="Add to Cart" onClick="updateCart('add','<?= $row['id'];?>')"/>
          <?php }?>

        </div>

      </div>

    <?php
      }
    }
    ?>

    <div class="text-center">
      <a href="list.php" class="uppercase">View All</a>
    </div>
  </div>
</div>


<?php include('footer.php'); ?>
