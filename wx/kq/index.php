<?php

  require_once "../pdo/pdoKswm.php";

  $uid = $_GET['uid'];
  $pdoStatement = $conn->prepare("select * from wx_employee where weixinId=?"); 
  $pdoStatement->execute(array($uid));
  if ($row = $pdoStatement->fetch()){
    $empNo = $row['empNo'];
    if ($row['disabled']){
      echo "<strong>再见！</strong>";
    }else{
      header("Location: attendance.php?empNo=$empNo");
    }
  }else{
    header("Location: register.php?uid=$uid");
  };

?>
