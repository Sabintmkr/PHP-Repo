<?xml version="1.0" encoding="UTF-8"?>
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>HTTP Request Headers</title>
</head>
<body>
  <h1>HTTP Request Headers</h1>

<?php
  $request = $_SERVER['REQUEST_METHOD'] .' '. $_SERVER['REQUEST_URI']  .' '. $_SERVER['SERVER_PROTOCOL'] . PHP_EOL;
  foreach (apache_request_headers() as $key => $value) {
    $request .= trim($key) .': '. trim($value) . PHP_EOL;
  }
  $request .= PHP_EOL . file_get_contents('php://input');

  print "<pre>" . PHP_EOL;
  print htmlentities($request);
  print "</pre>" . PHP_EOL;



?>
</body>
</html>
