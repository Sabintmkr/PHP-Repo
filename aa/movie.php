<?php

include('header.php');
$id="";

if(!isset($_GET["id"]) || empty($_GET["id"])){
  header("Location: error.php?msg=Invalid request.");
  exit;
}

$id = $_GET["id"];

$movie_detail = getMovieDetail($id);

if(empty($movie_detail)){
  header("Location: error.php?msg=Invalid Movie");
}

?>

<!--Section for User Actions for Logged In Users-->
<?php if(isset($_SESSION['current_session'])){ ?>
  <div class="box">
    <div class="box-header"><h3 class="box-title">Available Actions</h3></div>
    <div class="box-body row">
      <div class="col-md-3">
      <form method="get" action="movieForm.php">
      <input type="hidden" id="id" name="id" value="<?=$id;?>"/>
      <input type="submit" class="btn btn-primary" value="Edit" />
      <input type="button" class="btn btn-primary" value="Delete" id="btnDelete" name="btnDelete" />
      </form>
      </div>
    </div>
  </div>
<?php }?>


<!--Movie Detail Block-->
<div class="box">
  <div class="box-header"><h3 class="box-title"><?=htmlspecialchars_decode($movie_detail['name']);?></h3></div>
  <div class="box-body row">
    <div class="col-md-3">
      <img src="<?=htmlspecialchars_decode($movie_detail['profile_image']);?>" alt="<?=htmlspecialchars_decode($movie_detail['name']);?>"/>
    </div>

    <div class="col-md-9">
      <div class="item">
        <p class="message"><?=htmlspecialchars_decode($movie_detail['intro']);?></p>
      </div>
      <div class="item">
        <p class="message"><b>Director: </b><?=htmlspecialchars_decode($movie_detail['director_name']);?></p>
      </div>
      <div class="item">
        <p class="message"><b>Genre: </b><?=htmlspecialchars_decode($movie_detail['genre_name']);?></p>
      </div>
      <div class="item">
        <p class="message"><b>Language: </b><?=htmlspecialchars_decode($movie_detail['language']);?></p>
      </div>
      <div class="item">
        <p class="message"><b>Release Date: </b><?=htmlspecialchars_decode($movie_detail['release_date']);?></p>
      </div>
    </div>
  </div>
</div>


<!--Star Cast Block-->
<div class="box">
  <div class="box-header"><h3 class="box-title">Star Cast</h3></div>
  <div class="box-body row">
    <?php
    $actors_enrolled = getStarCastList($id);
    if(!empty($actors_enrolled)){
    foreach($actors_enrolled as $row){ ?>
    <div class="col-md-3">
      <div class="description-block">
        <a href="actor.php?id=<?= htmlspecialchars_decode($row['actor_id']);?>"><img src="<?=htmlspecialchars_decode($row['profile_image']);?>" alt="<?=htmlspecialchars_decode($row['actor_name']);?>"/></a>
        <h5 class="description-header"><a href="actor.php?id=<?= htmlspecialchars_decode($row['actor_id']);?>"><?= htmlspecialchars_decode($row['actor_name']);?></a></h5>
      </div>
    </div>

    <?php
    }
    }
    ?>

  </div>
</div>

<!--User Comments Block-->
<div class="box">
  <div class="box-header"><h3 class="box-title">User Comments</h3></div>
  <div class="box-body no-padding">
    <!--List User Comments-->
    <div id="divComments">
    <?php
    $review_list = getMovieReviews($id);
    if(!empty($review_list)){
    foreach($review_list as $row){ ?>
      <div class="post">
        <div class="user-block"><span class="username"><?=htmlspecialchars_decode($row['user_name']);?>&nbsp;[<?=htmlspecialchars_decode($row['date_ts']);?>]</span></div>
        <p><?=htmlspecialchars_decode($row['comment']);?></p>
      </div>
    <?php
      }
    }
    ?>
    </div>

    <!--New Comment block for non-admin users-->
    <?php if(!isset($_SESSION['current_session'])){ ?>
    <div class="post">

        <div class="form-group"><textarea class="form-control" rows="3" id="txtReview" name="txtReview" placeholder="Enter ..." required></textarea></div>
        <div class="col-md-6 form-group"><input type="text" class="form-control" id="txtFullName" name="txtFullName" placeholder="Full Name" required></div>
        <div class="col-md-6 form-group"><input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Enter email" required></div>
        <div class="form-group"><input type="submit" class="btn btn-primary" value="Post" id="btnAdd" name="btnAdd"/></div>

    </div>
    <?php }?>

  </div>
</div>

<script type="text/javascript">
$(document).ready(function () {
  //Event for deleting the selected movie
  $('#btnDelete').click(function(){
    if(confirm("Are you sure to delete the movie?")){
      var movie_id = "<?=$id;?>"

      $.ajax({
          method:"POST",
          url: 'movie_ajax.php',
          data: {mid:movie_id,action:"remove"},
          success: function (data, status, xhr) {
            var resp = data.split("||");
            alert(resp[1]);
            if(resp[0]=="0"){
              window.location.replace("list.php");
            }

          },
          error: function (jqXhr, textStatus, errorMessage) {
            alert("Server Connection Lost. Please try again");
          }
       });
    }
  });

  //Event for new user comment
  $('#btnAdd').click(function(){
    var movie_id = "<?=$id;?>"
    var review = $('#txtReview').val();
    var full_name = $('#txtFullName').val();
    var email = $('#txtEmail').val();

    if(review == ""){
      alert("Comment is blank.");
      $('#txtReview').focus();
      return false;
    }
    if(full_name == ""){
      alert("Full Name is blank.");
      $('#txtFullName').focus();
      return false;
    }
    if(email == ""){
      alert("Email is blank.");
      $('#txtEmail').focus();
      return false;
    }
    if(!validateEmail(email)){
      alert("Invalid Email Address.");
      $('#txtEmail').focus();
      return false;
    }

    $.ajax({
        method:"POST",
        url: 'movie_ajax.php',
        data: {mid:movie_id,user_name:full_name,user_email:email,comment:review,action:"addComment"},
        success: function (data, status, xhr) {
          var resp = data.split("||");
          alert(resp[1]);

          updateCommentDiv();
        },
        error: function (jqXhr, textStatus, errorMessage) {
          alert("Server Connection Lost. Please try again");
        }
     });
  });

});

//update user comments list div after update
function updateCommentDiv(){
  var movie_id = "<?=$id;?>"
  $.ajax({
      method:"POST",
      url: 'movie_ajax.php',
      data: {mid:movie_id,action:"viewComment"},
      success: function (data, status, xhr) {
        $("#divComments").html(data);
        $('#txtReview').val("");
        $('#txtFullName').val("");
        $('#txtEmail').val("");
      },
      error: function (jqXhr, textStatus, errorMessage) {
        alert("Server Connection Lost. Please try again");
      }
   });
}

</script>

<?php include('footer.php'); ?>
