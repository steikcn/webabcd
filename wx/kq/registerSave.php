<?php
	header("Content-Type: text/html;charset=utf-8");
	require_once "../pdo/pdoKswm.php";

	$uid = $_GET['uid'];
	$empNo = trim($_POST['empNo']);
	$empName = trim($_POST['empName']);

	$pdoStatement = $conn->query("select top 1 empName from V_Employee where empNo='$empNo'");
	if (($row = $pdoStatement->fetch()) && (trim($row['empName'])==$empName)){

		$pdoStatement = $conn->prepare("delete from wx_employee where empNo=? insert wx_employee (weixinId,empNo,empName) values (?,?,?)");
		if ($pdoStatement->execute(array($empNo,$uid,$empNo,$empName))){
			header("Location: attendance.php?empNo=$empNo");
		}else{
			// print_r($pdoStatement->errorInfo());
			header("Location: register.php?uid=$uid&msg=内部错误 :(");
		}
	}else{
		header("Location: register.php?uid=$uid&msg=请认真填写您的工号和姓名！");
	}
	
?>
