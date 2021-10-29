<?php
 $id=$_SESSION['usr'];

 if(!isset($_SESSION['usr']) || empty($_SESSION['usr'])){
   header("Location: error.php?msg=Access Denied!!! Please Login");
   die();
 }
 
 $currentuser_detail = getUserDetail($id);
 
 if(empty($currentuser_detail)){
   header("Location: error.php?msg=Unauthorized Access are denied..");
 }

$tosend = $_POST["receiver"];
$sendfrom = $_Post["sender"];
$datet = $_POST["sdate"];
$msg = $_POST["smsg"];
$user_action =$_POST["action"];

if($user_action == "mail"){
    $to = $tosend;
    $subject = "This is a test HTML email";

    $message = "
    <html>
    <head>
    <title>This is a test HTML email</title>
    </head>
    <body>
    <p>" .$msg  "</p>
    </body>
    </html>
    ";

    // It is mandatory to set the content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers. From is required, rest other headers are optional
    $headers .= 'From:'.$sendfrom . "\r\n";
    //$headers .= 'Cc: sales@example.com' . "\r\n";

    mail($to,$subject,$message,$headers);
}
?>