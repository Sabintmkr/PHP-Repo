<?php
	include 'libcommon.php';

//Capture POSTED variables
$movie_id = $_POST["mid"];
$user_action =$_POST["action"];

//Block for new movie comment
if($user_action == "addComment"){
	$user_name = $_POST["user_name"];
	$user_email = $_POST["user_email"];
	$comment = $_POST["comment"];
	$sql = "insert into review(movie_id,user_name,user_email,date_ts,comment) VALUES('".$movie_id."','".$user_name."','".$user_email."',datetime('now'),".singleQuote($comment).")";
	sqlExecuteStatement($sql);

	echo "0||Yeppy, the comment has been added to the movie.";
	exit();
}

//Remove a movie from the system
if($user_action == "remove"){
	$sql = "delete from movie where id=".$movie_id;
	sqlExecuteStatement($sql);

  $sql = "delete from actor_enrolled where movie_id=".$movie_id;
  sqlExecuteStatement($sql);

  $sql = "delete from review where movie_id=".$movie_id;
  sqlExecuteStatement($sql);

	echo "0||Yeppy, the selected movie has been successfully removed from the system.";
	exit();
}

//Retrieve Comments List of a movie
if($user_action == "viewComment"){
	$sql = "select * FROM review WHERE movie_id=".singleQuote($movie_id)." ORDER BY id DESC";

	$reviews = sqlSelectStatement($sql);

	$res= "";
	foreach ($reviews as $row) {
		$res = $res."<div class=\"post\">";
		$res = $res."<div class=\"user-block\"><span class=\"username\">".htmlspecialchars_decode($row["user_name"])."&nbsp;[".htmlspecialchars_decode($row["date_ts"])."]</span></div>";
		$res = $res."<p>".htmlspecialchars_decode($row["comment"])."</p>";
		$res = $res."</div>";
	}
	echo ($res);
	exit();
}

//Block for movie advance search
if($user_action == "advanceSearch"){
	$movie_name = $_POST["movie_name"];
	$director_id = $_POST["director_id"];
	$genre_id = $_POST["genre_id"];
	$actor_id = $_POST["actor_id"];

	$sql = "select m.* FROM movie m LEFT JOIN actor_enrolled a ON m.id=a.movie_id WHERE 1=1";

	if(!empty($movie_name))
		$sql = $sql." and m.name like '%".$movie_name."%'";

	if(!empty($director_id))
		$sql = $sql." and m.director = '".$director_id."'";

	if(!empty($genre_id))
		$sql = $sql." and m.genre = '".$genre_id."'";

	if(!empty($actor_id))
		$sql = $sql." and a.actor_id = '".$actor_id."'";
	else {
		$sql = $sql." group by m.name";
	}
	$sql = $sql." order by m.name";
//echo $sql;
//exit();
	$movies = sqlSelectStatement($sql);

	$res= "";
	foreach ($movies as $row) {
		$res = $res."<div class=\"col-md-3\">";
		$res = $res."<div class=\"description-block\">";
		$res = $res."<a href=\"movie.php?id=".htmlspecialchars_decode($row["id"])."\"><img src=\"".htmlspecialchars_decode($row["profile_image"])."\" alt=\"".htmlspecialchars_decode($row["name"])."\"></a>";
		$res = $res."<h5 class=\"description-header\"><a href=\"movie.php?id=".htmlspecialchars_decode($row["id"])."\">".htmlspecialchars_decode($row["name"])."</a></h5>";
		$res = $res."<input type=\"button\" class=\"btn btn-primary\" value=\"Edit\" onclick=\"location.href='movieForm.php?id=".htmlspecialchars_decode($row["id"])."'\">";
		$res = $res."</div>";
		$res = $res."</div>";
	}
	echo ($res);
	exit();
}

 ?>
