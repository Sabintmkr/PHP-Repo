<?php
	include 'libcommon.php';

//Capture POSTED variables
$actor_id = $_POST["aid"];
$movie_id = $_POST["mid"];
$user_action =$_POST["action"];

//Block to add an actor to a movie
if($user_action == "add"){
	$sql_check_actor = "select * from actor_enrolled where movie_id='".$movie_id."'";

	$current_actors = sqlSelectStatement($sql_check_actor);

	//Validate for maximum count of actors
	if(count($current_actors)==8){
	  echo "1||Sorry but only 8 actors can be added in a movie.";
		exit();
	}

	//Validate if the selected actor already exists in the movie
	if(in_array($actor_id, array_column($current_actors, 'actor_id'))) {
	  echo "1||Sorry, the selected actor is already enrolled in this movie.";
		exit();
	}
	else {
		$sql = "insert into actor_enrolled(movie_id,actor_id) VALUES('".$movie_id."','".$actor_id."')";
		sqlExecuteStatement($sql);
		echo "0||Yeppy, the selected actor successfully enrolled in this movie.";
		exit();
	}
}

//Retrieve actors assigned to a movie
if($user_action =="view"){
	$sql_check_actor = "SELECT e.id, a.id as actor_id, a.name as actor_name,a.profile_image FROM  actor_enrolled e JOIN actor a ON e.actor_id = a.id WHERE e.movie_id='".$movie_id."'";
	$current_actors = sqlSelectStatement($sql_check_actor);

	$res= "";
	foreach ($current_actors as $row) {
		$res = $res."<div class=\"col-md-3\">";
		$res = $res."<div class=\"description-block\">";
		$res = $res."<a href=\"actor.php?id=".htmlspecialchars_decode($row["actor_id"])."\"><img src=\"".htmlspecialchars_decode($row["profile_image"])."\" alt=\"".htmlspecialchars_decode($row["actor_name"])."\"></a>";
		$res = $res."<h5 class=\"description-header\"><a href=\"actor.php?id=".htmlspecialchars_decode($row["actor_id"])."\">".htmlspecialchars_decode($row["actor_name"])."</a></h5>";
		$res = $res."<div class=\"item\">";
		$res = $res."<input type=\"submit\" class=\"btn btn-warning\" value=\"Remove\" onclick=\"removeActor(".htmlspecialchars_decode($row['actor_id']).")\"/>";
		$res = $res."</div>";
		$res = $res."</div>";
		$res = $res."</div>";
	}
	echo ($res);
	exit();
}

//Remove an actor from a movie
if($user_action == "remove"){
	$sql_check_actor = "delete from actor_enrolled where movie_id='".$movie_id."' and actor_id='".$actor_id."'";

	$current_actors = sqlExecuteStatement($sql_check_actor);

	echo "0||Yeppy, the selected actor successfully removed from this movie.";
	exit();
}

//Delete Actor from the System
if($user_action == "delete"){
	$sql= "select * from actor_enrolled where actor_id='".$actor_id."'";

	$current_enrolled = sqlSelectStatement($sql);

	//Validate if the selected actor already exists in the movie
	if(in_array($actor_id, array_column($current_enrolled, 'actor_id'))) {
	  echo "1||Sorry, could not delete. The selected actor is enrolled in a movie.";
		exit();
	}
	else {
		$sql = "delete from actor where id='".$actor_id."'";
		sqlExecuteStatement($sql);
		echo "0||Yeppy, the selected actor is successfully deleted from the system.";
		exit();
	}
}
 ?>
