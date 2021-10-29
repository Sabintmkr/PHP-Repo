<?php
session_start();
require("constants.php");

function getSqlConnection(){
  return new PDO('sqlite:'.dirname(__FILE__).'/'.DB_NAME);
}

function closeDBConnection($dbConn){
  $dbConn = null;
}

function getMovieDetail($id){
  $myPDO = getSqlConnection();

  $query = "SELECT m.*, (d.first_name || ' ' || d.last_name) AS director_name,g.genre_name from movie m JOIN director d ON m.director=d.id JOIN genre g ON m.genre = g.id WHERE m.id=".$id;
  if ($myPDO) {
    $result = $myPDO->query($query);

    return $result->fetch();

  } else {
      print "Connection to database failed!\n";
  }
  closeDBConnection();
}

function getMovieReviews($id){
  $myPDO = getSqlConnection();
  $query = "SELECT * FROM review WHERE movie_id=".$id." ORDER BY id DESC";
  if ($myPDO) {
    $result = $myPDO->query($query);

    return $result;

  } else {
      print "Connection to database failed!\n";
  }
  closeDBConnection();
}

function adminLogin($user_name,$user_password){
  $myPDO = getSqlConnection();
  $query = "SELECT * FROM admin_user WHERE user_login_id='" .$user_name. "' AND password='".$user_password."'";
  if ($myPDO) {
    $result = $myPDO->query($query);

    return $result->fetch();

  } else {
      print "Connection to database failed!\n";
  }
  closeDBConnection();
}

function generateRandomNumber($length){
  $digits = "";
  $numbers = range(0,9);
  shuffle($numbers);
  for($i = 0; $i < $length; $i++){
      global $digits;
      $digits .= $numbers[$i];
  }
  return $digits;
}

function insertNewReview($review){
  $myPDO = getSqlConnection();
  $query = "INSERT INTO review(movie_id,user_name,user_email,date_ts,comment) VALUES('".$review[0]."','".$review[1]."','".$review[2]."',datetime('now'),'".$review[3]."')";
  if ($myPDO) {
    $myPDO->exec($query);
    return;
  } else {
      print "Connection to database failed!\n";
  }
  closeDBConnection();
}

function updateCart($action,$id){
  switch ($action) {
    case 'add':
      if(!empty($id)) {
        $movie_detail = getMovieDetail($id);
		    $itemArray = array($movie_detail["id"]=>array('id'=>$movie_detail["id"],'name'=>$movie_detail["name"],'director'=>$movie_detail['director'],'quantity'=>'1','price'=>$movie_detail["amount"],'profile_image'=>$movie_detail['profile_image']));

        if(!empty($_SESSION["cart_item"])) {
			    if(in_array($movie_detail["id"],array_keys($_SESSION["cart_item"]))) {

				    foreach($_SESSION["cart_item"] as $k => $v) {
						  if($movie_detail["id"] == $k) {
							  if(empty($_SESSION["cart_item"][$k]["quantity"])) {
								  $_SESSION["cart_item"][$k]["quantity"] = 0;
							  }
						    $_SESSION["cart_item"][$k]["quantity"]++;
						  }
				    }
			    } else {
            $_SESSION["cart_item"] = $_SESSION["cart_item"]+$itemArray;
			    }
		    } else {
			    $_SESSION["cart_item"] = $itemArray;
		    }
    }
    break;
    case 'remove':
      if(!empty($id)) {
        foreach($_SESSION["cart_item"] as $k => $v) {

			    if($id == $k)
				    unset($_SESSION["cart_item"][$k]);
			    if(empty($_SESSION["cart_item"]))
				    unset($_SESSION["cart_item"]);
		    }

    }
    break;

    default:
      // code...
      break;
  }
}

function getStarCastList($id){
  $myPDO = getSqlConnection();
  $query = "SELECT e.id, a.id as actor_id, a.name as actor_name,a.profile_image FROM  actor_enrolled e JOIN actor a ON e.actor_id = a.id WHERE e.movie_id=".$id;
  if ($myPDO) {
    $result = $myPDO->query($query);

    return $result;

  } else {
      print "Connection to database failed!\n";
  }
  closeDBConnection();
}

function getActorDetail($id){
  $myPDO = getSqlConnection();
  $query = "SELECT * FROM actor WHERE id=".$id;
  if ($myPDO) {
    $result = $myPDO->query($query);

    return $result->fetch();

  } else {
      print "Connection to database failed!\n";
  }
  closeDBConnection();
}

function getActorList(){
  $myPDO = getSqlConnection();

  if ($myPDO) {
    $result = $myPDO->query("select * FROM actor order by name");
    return $result;

  } else {
      print "Connection to database failed!\n";
  }
  closeDBConnection();
}

function addNewActor($sql){
  $myPDO = getSqlConnection();
  $query = $sql;
  if ($myPDO) {
    $myPDO->exec($query);
    $id = $myPDO->lastInsertId();
    return $id;
  } else {
      print "Connection to database failed!\n";
  }
  closeDBConnection();
}

function updateActor($sql){
  $myPDO = getSqlConnection();
  $query = $sql;
  if ($myPDO) {
    $myPDO->exec($query);
    return;
  } else {
      print "Connection to database failed!\n";
  }
  closeDBConnection();
}

function getDirectorList(){
  $myPDO = getSqlConnection();

  if ($myPDO) {
    $result = $myPDO->query("select d.id, (d.first_name || ' ' || d.last_name) as name from director d ORDER BY d.first_name");
    return $result;

  } else {
      print "Connection to database failed!\n";
  }
  closeDBConnection();
}

function getGenreList(){
  $myPDO = getSqlConnection();

  if ($myPDO) {
    $result = $myPDO->query("select * from genre order by genre_name");
    return $result;

  } else {
      print "Connection to database failed!\n";
  }
  closeDBConnection();
}

function addNewMovie($sql){
  $myPDO = getSqlConnection();
  $query = $sql;
  if ($myPDO) {
    $myPDO->exec($query);
    $id = $myPDO->lastInsertId();
    return $id;
  } else {
      print "Connection to database failed!\n";
  }
  closeDBConnection();
}

function updateMovie($sql){
  $myPDO = getSqlConnection();
  $query = $sql;
  if ($myPDO) {
    $myPDO->exec($query);
    return;
  } else {
      print "Connection to database failed!\n";
  }
  closeDBConnection();
}

function sqlSelectStatement($sql){
  $myPDO = getSqlConnection();
  $query = $sql;
  if ($myPDO) {
    $result = $myPDO->query($query);

    return $result->fetchAll();
  } else {
      print "Connection to database failed!\n";
  }
  closeDBConnection();
}

function sqlExecuteStatement($sql){
  $myPDO = getSqlConnection();
  $query = $sql;
  if ($myPDO) {
    $myPDO->exec($query);
    return;
  } else {
      print "Connection to database failed!\n";
  }
  closeDBConnection();

}

function singleQuote($string){
  $return_string = $string;
  $return_string = str_replace(";", "", $string);
  $return_string = str_replace("'", "''", $string);
  //$return_string = str_replace('"', '""', $return_string);

  $return_string = htmlentities($return_string);
  return "'".$return_string."'";
}

?>
