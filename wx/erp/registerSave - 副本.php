<?php
	header("Content-Type: text/html;charset=utf-8");
	require_once "../pdo/pdoKswm.php";

	$uid = $_GET['uid'];
	$userNo = trim($_POST['userNo']);
	$password = trim($_POST['password']);


	$pdoStatement = $conn->query("select top 1 password,user_name from user_data where user_no='$userNo' and disable=0");
	if (($row = $pdoStatement->fetch()) && (trim($row['password'])==$password)){
		$userName = trim($row['user_name']);

		$pdoStatement = $conn->prepare("delete from wx_erpUser where userNo=? insert wx_erpUser (weixinId,userNo,userName) values (?,?,?)");
		if ($pdoStatement->execute(array($userNo,$uid,$userNo,$userName))) {
			header("Location: inventory.php?userNo=$userNo");
		}else{
			print_r($pdoStatement->errorInfo());
			// header("Location: register.php?uid=$uid&msg=内部错误 :(");
		}
	}else{
		header("Location: register.php?uid=$uid&msg=错误的账号和密码！");
	}
	
?>
