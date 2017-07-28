<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1; maximum-scale=1.0; user-scalable=no;" />
<meta name="apple-mobile-web-app-status-bar-style" content="black"  />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="format-detection" content="telephone=no" />
<link href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<title>昆山汇美考勤</title>
</head>
<body>
<?php
	// header("Content-Type: text/html;charset=gbk");
	require_once "../pdo/pdoKswm.php";

	$empNo = trim($_GET['empNo']);
	$pdoStatement = $conn->query("exec wx_attendance '$empNo'");
	$rows = $pdoStatement->fetchAll(PDO::FETCH_NAMED);
?>

<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>
							日期
						</th>
						<th>
							星期
						</th>
						<th>
							正班
						</th>
						<th>
							平时加班
						</th>
						<th>
							周末加班
						</th>
						<th>
							原始记录
						</th>
					</tr>
				</thead>
				<tbody>
<?php
	foreach($rows as $row){
	// foreach($rows as $row){
	// 	foreach($row as $field => $value){
	// 		if ($value){
	// 			echo $field." => ".$value."<br />";
	// 		}
	// 	}
	// 	echo "<br />";
	// }
	// echo "<pre>";
	// print_r($rows);
	// echo "</pre>";
?>
					<tr>
						<td>
							<?php echo $row["日期"]; ?>
						</td>
						<td>
							<?php echo substr($row["星期"],0,3); ?>
						</td>
						<td>
							<?php echo $row["正班"]; ?>
						</td>
						<td>
							<?php echo $row["平时加班"]; ?>
						</td>
						<td>
							<?php echo $row["周末加班"]; ?>
						</td>
						<td>
							<?php echo $row["原始记录"]; ?>
						</td>
					</tr>
<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

</body>
</html>




