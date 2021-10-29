<?php include('header.php');

if(!isset($_SESSION['current_session'])){
  header("Location: error.php?msg=Session Out. Please re-login.");
  exit;
}

//Get Values from DB
$director_list = getDirectorList();
$genre_list = getGenreList();

//Initialize variables for new movie
$id="";
$header_text = "New Movie";
$movie_name = "";
$director_id = "";
$genre = "";
$language = "";
$release_date = "";
$intro = "";
$amount = "";
$user_action = "add";

//Initialize variables for update movie
if(isset($_GET["id"])){
  $id=$_GET["id"];
  $header_text="Update Movie";

  $movie_detail = getMovieDetail($id);

  $movie_name = $movie_detail['name'];
  $director_id = $movie_detail['director'];
  $genre = $movie_detail['genre'];
  $language = $movie_detail['language'];
  $release_date = $movie_detail['release_date'];
  $intro = $movie_detail['intro'];
  $amount = $movie_detail['amount'];
  $user_action = "update";
}
?>

<!--Movie Form Block-->
<div class="box">
  <div class="box-header"><h3 class="box-title"><?=$header_text;?></h3></div>
  <div class="box-body no-padding">

    <div class="post">
      <form action="movieEntry.php" method="post" enctype="multipart/form-data">

        <div class="col-md-6 form-group"><label>Movie Name</label><input type="text" class="form-control" id="txtMovieName" name="txtMovieName" value="<?=$movie_name;?>" required></div>
        <div class="col-md-6 form-group">
          <label>Director</label>
          <select class="form-control" id="ddlDirector" name="ddlDirector" required><option value="">--Select--</option>
          <?php
          foreach($director_list as $row){
            $selected = "";
            if($row["id"]==$director_id){
              $selected = "selected";
            }
          ?>
            <option value="<?=$row["id"];?>" <?=$selected;?>><?=$row["name"];?></option>

          <?php } ?>
          </select>
        </div>
        <div class="col-md-6 form-group">
          <label>Genre</label>
          <select class="form-control" id="ddlGenre" name="ddlGenre" required><option value="">--Select--</option>
          <?php
          foreach($genre_list as $row){
            $selected = "";
            if($row["id"]==$genre){
              $selected = "selected";
            }

            ?>
            <option value="<?=$row["id"];?>" <?=$selected;?>><?=$row["genre_name"];?></option>
          <?php } ?>
          </select>
        </div>
        <div class="col-md-6 form-group"><label>Language</label><input type="text" class="form-control" id="txtLanguage" name="txtLanguage" value="<?=$language;?>" required></div>
        <div class="col-md-6 form-group"><label>Profile Picture</label><input type="file" class="form-control" id="txtPicture" name="txtPicture" /></div>
        <div class="col-md-6 form-group"><label>Release Date (YYYY-MM-DD)</label><input type="text" class="form-control" id="txtReleaseDate" name="txtReleaseDate" value="<?=$release_date;?>" required></div>
        <div class="col-md-6 form-group"><label>Amount</label><input type="text" class="form-control" id="txtAmount" name="txtAmount" value="<?=$amount;?>" required></div>
        <div class="col-md-6 form-group"><label>Introduction</label><textarea class="form-control" rows="3" id="txtIntro" name="txtIntro" placeholder="Some Introduction......." required><?=$intro;?></textarea></div>
        <div class="form-group"><input type="submit" class="btn btn-primary" value="Save" id="btnSubmit" name="btnSubmit" /></div>
        <input type="hidden" id="id" name="id" value="<?=$id;?>"/>
        <input type="hidden" id="user_action" name="user_action" value="<?=$user_action;?>"/>
      </form>
    </div>


  </div>
</div>

<!--Star Cast Update Block-->
<?php if(isset($_GET["id"])){

?>

<div class="box">
  <div class="box-header"><h3 class="box-title">Star Cast</h3></div>
  <div class="box-body row" id="divStarCast">
    <?php
    $actors_enrolled = getStarCastList($id);
    if(!empty($actors_enrolled)){
    foreach($actors_enrolled as $row){ ?>
    <div class="col-md-3">
      <div class="description-block">
        <a href="actor.php?id=<?= $row['actor_id'];?>"><img src="<?=$row['profile_image'];?>"/></a>
        <h5 class="description-header"><a href="actor.php?id=<?= $row['actor_id'];?>"><?= $row['actor_name'];?></a></h5>
        <div class="item">
          <input type="submit" class="btn btn-warning" value="Remove" onclick="removeActor(<?= $row['actor_id'];?>)"/>
        </div>
      </div>
    </div>

    <?php
    }
    }
    ?>
  </div>

  <hr>
  <form>
    <div class="box-body row">
      <div class="col-md-6">
        <label>Enroll New Actor</label>
        <select class="form-control" id="ddlActor" name="ddlActor" required><option value="">--Select--</option>
        <?php
        $actors = getActorList();
        foreach($actors as $row){
        ?>
          <option value="<?=$row["id"];?>"><?=$row["name"];?></option>

        <?php } ?>
        </select>
      </div>
    </div>
    <div class="box-body row ">
      <div class="col-md-6 btn-group">
        <input class="btn btn-primary" type="button" id="btnAdd" name="btnAdd" value="Add Actor"/>
      </div>
    </div>
  </form>
</div>

<?php } ?>

<script type="text/javascript">
$(document).ready(function () {
  //Front End Validation
  $('#btnSubmit').click(function(){
    if($('#txtMovieName').val()==""){
      alert("Movie Name is blank.");
      $('#txtMovieName').focus();
      return false;
    }
    if($('#ddlDirector').val()==""){
      alert("Director is not selected.");
      $('#ddlDirector').focus();
      return false;
    }
    if($('#ddlGenre').val()==""){
      alert("Genre is not selected.");
      $('#ddlGenre').focus();
      return false;
    }
    if($('#txtLanguage').val()==""){
      alert("Language is blank.");
      $('#txtLanguage').focus();
      return false;
    }
    if($('#txtReleaseDate').val()==""){
      alert("Release Date is blank.");
      $('#txtReleaseDate').focus();
      return false;
    }
    if($('#txtAmount').val()==""){
      alert("Amount is blank.");
      $('#txtAmount').focus();
      return false;
    }
    if($('#txtIntro').val()==""){
      alert("Movie Introduction is blank.");
      $('#txtIntro').focus();
      return false;
    }
  });

  //Assign new actor to a movie
  $('#btnAdd').click(function(){
    if($('#ddlActor').val()==""){
      alert("Please select an actor");
      return false;
    }
    var actor_id = $('#ddlActor').val();
    var movie_id = "<?=$id;?>"

    var is_success = "";
    $.ajax({
        method:"POST",
        url: 'actor_enroll_ajax.php',
        data: {aid:actor_id,mid:movie_id,action:"add"},
        success: function (data, status, xhr) {
          var resp = data.split("||");
          alert(resp[1]);
          if(resp[0]=="0"){
            updateActorDiv();
          }

        },
        error: function (jqXhr, textStatus, errorMessage) {
          alert("Server Connection Lost. Please try again");
        }
     });
  });

});

//Remove an actor from a movie
function removeActor(actor_id){
  if(confirm("Are you sure to delete the movie?")){
    var movie_id = "<?=$id;?>"

    var is_success = "";
    $.ajax({
        method:"POST",
        url: 'actor_enroll_ajax.php',
        data: {aid:actor_id,mid:movie_id,action:"remove"},
        success: function (data, status, xhr) {
          var resp = data.split("||");
          alert(resp[1]);
          if(resp[0]=="0"){
            updateActorDiv();
          }

        },
        error: function (jqXhr, textStatus, errorMessage) {
          alert("Server Connection Lost. Please try again");
        }
     });
  }
}

//Update actor div after user action
function updateActorDiv(){
  var movie_id = "<?=$id;?>"
  $.ajax({
      method:"POST",
      url: 'actor_enroll_ajax.php',
      data: {aid:"",mid:movie_id,action:"view"},
      success: function (data, status, xhr) {
        $("#divStarCast").html(data);
        $('#ddlActor').val("");
      },
      error: function (jqXhr, textStatus, errorMessage) {
        alert("Server Connection Lost. Please try again");
      }
   });
}

</script>

<?php include('footer.php'); ?>
