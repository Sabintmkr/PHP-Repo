<?php include('header.php');


$search_name = "";

//Capture seacrh parameter if provided
if(isset($_POST["q"])){
  $search_name = $_POST["q"];
}
$sql_query = "select * from movie WHERE '1'='1'";
if(isset($search_name)){
  $sql_query .= " and name LIKE '%".$search_name."%'";
}
$sql_query .= " order by name";

?>

<!--Section for Logged in user actions-->
<?php if(isset($_SESSION['current_session'])){ ?>

  <div class="box">
    <div class="box-header"><h3 class="box-title">Available Actions</h3></div>
    <div class="box-body row">
      <div class="col-md-3">
      <form method="get" action="movieForm.php">
      <input type="submit" class="btn btn-primary" value="Add New"/>
      </form>
      </div>
    </div>
  </div>

<?php }?>

<!--Movies List Block-->
<div class="box">
  <div class="box-header"><h3 class="box-title">Available Movies</h3></div>

  <div class="box-body row">
    <?php
    $movie_list = sqlSelectStatement($sql_query);
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
  </div>
</div>


<?php include('footer.php'); ?>
