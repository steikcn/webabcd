<?php
  require "startSession.php";
	header("Content-Type: text/html;charset=utf-8");
	require_once "../pdo/pdoKswm.php";

	if (!isset($_SESSION['uid'])) die("网页已过期");

  $uid=$_SESSION['uid'];
	$userNo = trim($_POST['userNo']);


	$pdoStatement = $conn->query("select top 1 user_no,user_name from user_data where user_no='$userNo' and disable=0");
	if (($row = $pdoStatement->fetch()) && strtoupper(trim($row['user_no']))==strtoupper($userNo)){
		$userName = trim($row['user_name']);

		// $pdoStatement = $conn->prepare("delete from wx_erpUser where userNo=? insert wx_erpUser (weixinId,userNo,userName) values (?,?,?)");
		$pdoStatement = $conn->prepare("insert wx_erpUser (weixinId,userNo,userName) values (?,?,?)");
		if ($pdoStatement->execute(array($uid,$userNo,$userName))) {
			$_SESSION['userNo']=$userNo;
			header("Location: inventory.php");
		}else{
			//print_r($pdoStatement->errorInfo());
			header("Location: register.php?msg=内部错误 :(");
		}
	}else{
		header("Location: register.php?msg=不存在这个用户！");
	}
	
?>
