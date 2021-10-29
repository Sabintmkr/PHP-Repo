<?php include('header.php');

$director_list = getDirectorList();
$genre_list = getGenreList();
$actor_list = getActorList();
?>


<!--Search Criteria-->
<div class="box">
  <div class="box-header"><h3 class="box-title">Search Criteria</h3></div>
  <div class="box-body no-padding">
    <div class="post">
        <div class="col-md-6 form-group"><label>Movie Name</label><input type="text" class="form-control" id="txtMovieName" name="txtMovieName"></div>
        <div class="col-md-6 form-group"><label>Director</label><select class="form-control" id="ddlDirector" name="ddlDirector"><option value="">--Select--</option>
        <?php
        foreach($director_list as $row){
        ?>
          <option value="<?=$row["id"];?>"><?=$row["name"];?></option>

        <?php } ?>
        </select></div>
        <div class="col-md-6 form-group"><label>Genre</label><select class="form-control" id="ddlGenre" name="ddlGenre"><option value="">--Select--</option>
        <?php
        foreach($genre_list as $row){
          ?>
          <option value="<?=$row["id"];?>" ><?=$row["genre_name"];?></option>
        <?php } ?>
        </select></div>
        <div class="col-md-6 form-group"><label>Actor</label><select class="form-control" id="ddlActor" name="ddlActor"><option value="">--Select--</option>
        <?php
        foreach($actor_list as $row){
          ?>
          <option value="<?=$row["id"];?>" ><?=$row["name"];?></option>
        <?php } ?>
        </select></div>

        <div class="form-group"><input class="btn btn-primary" type="button" id="btnSearch" name="btnSearch" value="Search"/></div>
      </div>
  </div>
</div>

<!--Section for Logged in user actions-->
<?php if(isset($_SESSION['current_session'])){ ?>
  <!--Add Edit Block-->
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

  <div class="box-body row" id="divMovies">
    <?php
    $sql_query = "select * from movie WHERE '1'='1' ORDER BY id DESC";
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

<script type="text/javascript">

$(document).ready(function () {
  $('#btnSearch').click(function(){
    var movie = $('#txtMovieName').val();
    var director = $('#ddlDirector').val();
    var genre = $('#ddlGenre').val();
    var actor = $('#ddlActor').val();

    $.ajax({
        method:"POST",
        url: 'movie_ajax.php',
        data: {mid:'',movie_name:movie,director_id:director,genre_id:genre,actor_id:actor,action:"advanceSearch"},
        success: function (data, status, xhr) {
          var resp = data;
          if(resp === '')
            resp = "<h4><p class=\"text-center\">Sorry but no any match found for the provided search criteria.</p></h4>"

          $("#divMovies").html(resp);
        },
        error: function (jqXhr, textStatus, errorMessage) {
          alert("Server Connection Lost. Please try again");
        }
     });
  });
});

</script>

<?php include('footer.php'); ?>
