<?xml version="1.0" encoding="UTF-8"?>
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>Script Environment Variables</title>
</head>
<body>
  <h1>Script Environment Variables</h1>

    <strong>Request Line:</strong>
    <?php 
    print "$_SERVER[REQUEST_METHOD]  $_SERVER[REQUEST_URI]  $_SERVER[SERVER_PROTOCOL]" . PHP_EOL;
   ?>
  <h3>CGI Variables passed to script</h3>
  <ul>
<?php

  $CGI=array("AUTH_TYPE","CONTENT_LENGTH","CONTENT_TYPE","GATEWAY_INTERFACE",
             "PATH_INFO","PATH_TRANSLATED","QUERY_STRING","REMOTE_ADDR",
             "REMOTE_HOST","REMOTE_IDENT","REMOTE_USER","REQUEST_METHOD",
             "SCRIPT_NAME","SERVER_NAME","SERVER_PORT","SERVER_PROTOCOL",
             "SERVER_SOFTWARE");
  foreach ($CGI as $key) {
      if( array_key_exists($key, $_SERVER) ) {
          $value=htmlspecialchars( $_SERVER[$key] );
         print "<li><strong>$key:</strong> $value</li>" . PHP_EOL;
      }
  }
  foreach (  $_SERVER as $key => $value ) {
    if( strpos($key,'HTTP_') === 0 ) {
        $value=htmlspecialchars( $value );
        print "<li><strong>$key:</strong> $value</li>" . PHP_EOL;
    }
  }
?>
 </ul>
</body>
</html>