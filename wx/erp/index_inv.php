<?php
  require "startSession.php";
  $_SESSION['uid']=$_GET['uid'];

  require_once "../pdo/pdoKswm.php";

  $pdoStatement = $conn->prepare("select * from wx_erpUser where weixinId=?"); 
  $pdoStatement->execute(array($_SESSION['uid']));

  if ($row = $pdoStatement->fetch()){
    if ($row['disabled']){
      echo "<strong>再见！</strong>";
    }else{
      $_SESSION['userNo']=$row['userNo'];
      header("Location: inventory.php");
    }
  }else{
    header("Location: register.php");
  };

?>
