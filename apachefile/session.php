<?php
ini_set("session.use_cookies","0");
ini_set("session.use_only_cookies","0");
ini_set("session.use_strict_mode","0");
ini_set("session.use_trans_sid","1");

session_start(); ?>
<?xml version="1.0" encoding="UTF-8"?>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head><title>PHP Session Test</title></head>
  <body>
    <h1>PHP Session Test</h1>
    <?php
    if ( !isset($_SESSION['visits']) )
        {
            $_SESSION['visits'] = 1;
            print "<h3>Start of Session</h3>";
            print "<h3>Session Id: ". session_id() ."</h3>";
        }
    else
        {
           $_SESSION['visits']++;
           $LastVisit = date('Y m d H:i:s', $_SESSION['time']);
           $VisitNo =  $_SESSION['visits']++;
           print "<h3>Session Id: ". session_id() ."</h3>";
           print "<h3>Time of Last Visit: $LastVisit</h3>";
           print "<h3>This is visit number: $VisitNo</h3>";
        }
    $_SESSION['time'] = time();

    if (isset($_SERVER['HTTP_COOKIE']) ) {
      print "<h3>HTTP Cookie Header</h3>\n";
      print "<p>${_SERVER['HTTP_COOKIE']}</p>";
    }

    ?>
    
    <p><a href="./session.php">A link back to the script</a></p>
   </body>
</html>