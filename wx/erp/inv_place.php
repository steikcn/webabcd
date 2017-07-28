<?php
  require "startSession.php";
  if (!isset($_SESSION['userNo'])) die("无效入口");
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1; maximum-scale=1.0; user-scalable=no;" />
<meta name="apple-mobile-web-app-status-bar-style" content="black"  />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="format-detection" content="telephone=no" />
<link href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<title>库位分布</title>
</head>
<body>
<?php
  require_once "../pdo/pdoKswm.php";

  $partNo = trim($_GET['partNo']);
  $stmt = $conn->prepare("exec wx_getPartPlace ?");
  
  if ($stmt->execute(array($partNo))) {
    while ($row = $stmt->fetch(PDO::FETCH_NAMED)) {
?>

<div class="container">
  <div class="row clearfix">
    <div class="col-md-12 column">
      <table class="table table-bordered table-hover">
        <tr>
          <td><?php echo $row["company"]; ?></td>
          <td><?php echo $row["store_no"]; ?></td>
          <td><?php echo $row["store_name"]; ?></td>
        </tr>
        <tr>
          <td><?php echo "批号 ".$row["lot_no"]; ?></td>
          <td><?php echo "库位 ".$row["place"]; ?></td>
          <td><?php echo $row["qty"]; ?></td>
        </tr>
        <tr>
          <td colspan="3"><?php echo "批号日期：".$row["lot_date"]; ?></td>
        </tr>
      </table>
    </div>
  </div>
</div>

<?php
    }
  }else{ echo $stmt->errorInfo()[2];}

?>


</body>
</html>

