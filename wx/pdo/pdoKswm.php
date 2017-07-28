<?php

$hostname = "222.92.97.115"; //"数据库IP";
$port = 1433;
$dbname = "kswmerp";  //"数据库名";
$username = "wmerpuser";
$pw = "Wellking&2005";
try {
  $conn = new PDO ("dblib:host=$hostname:$port;dbname=$dbname;charset=UTF-8","$username","$pw");
} catch (PDOException $e) {
  die("Failed to get DB handle: " . $e->getMessage() . "<br/>\n");
}

header("Content-Type: text/html;charset=utf-8");
?>
