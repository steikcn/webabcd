<?php
  require "startSession.php";
  header("Content-Type: text/html;charset=utf-8");
  require_once "../pdo/pdoKswm.php";

  if (!isset($_SESSION['uid'])) die("网页已过期");

  $newPlace = trim(strtoupper($_POST['newPlace']));

  if ($_POST['company']==='金莓') {
    $stmt = $conn->prepare("exec ksgberp..changeStoreLocation ?,?,?,?,?,?,?");
  } else {
    $stmt = $conn->prepare("exec kswmerp..changeStoreLocation ?,?,?,?,?,?,?");
  }
// changeStoreLocation -- 参数：仓库、品号、原批号、新批号、新库位、转移数量、操作员

  if ($stmt->execute(array($_POST['store'],$_POST['part'],$_POST['lot'],$_POST['lot'],$newPlace,$_POST['qty'],$_SESSION['userNo']))) {
    if ($row = $stmt->fetch(PDO::FETCH_NAMED)) {
      $msg = $row['msg'];
      echo "<script type=\"text/javascript\">alert(\"$msg\");</script>";
      if ($row['rtn']===0) {
        $part = $_POST['part'];
        header("Location: inv_place.php?partNo=$part");
      } else {
        echo '<script type="text/javascript">history.go(-1);</script>';
      }
    }
  } else {
    echo "error...";
  }
?>
