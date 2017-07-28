<?php
header("Content-type: text/html; charset=utf-8");

$hostname = "222.92.97.115"; //"数据库IP";
$port = 1433;
$dbname = "kswmerp";  //"数据库名";
$username = "mes";
$pw = "mesmes";
try {
  $dbh = new PDO ("dblib:host=$hostname:$port;dbname=$dbname;charset=UTF-8","$username","$pw");
} catch (PDOException $e) {
  die("Failed to get DB handle: " . $e->getMessage() . "<br/>\n");
}

$stmt = $dbh->prepare("SELECT top 5 * FROM bom");
$stmt->execute();
while ($row = $stmt->fetch()) {
  print_r($row);
}
unset($dbh); unset($stmt);

?>