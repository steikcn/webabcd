<?php
  // require "startSession.php";
  // if (!isset($_SESSION['userNo'])) die("无效入口");
  // $userNo=$_SESSION['userNo'];

  require_once "../pdo/pdoKswm.php";

  if (!isset($_POST['queryStr'])) die("网页已过期");

  $queryStr = trim($_POST['queryStr']);

  if ( ! empty( $_POST['partno'] ) ) {  //按品号查询
    $stmt = $conn->prepare("exec wx_getPartList 1,?");
  }
  if ( ! empty( $_POST['customerpartno'] ) ) {  //按客户部品号查询
    $stmt = $conn->prepare("exec wx_getPartList 2,?");
  }
  if ( ! empty( $_POST['partname'] ) ) {  //按品名查询
    $stmt = $conn->prepare("exec wx_getPartList 3,?");
  }
  if ( ! empty( $_POST['model'] ) ) {  //按规格型号查询
    $stmt = $conn->prepare("exec wx_getPartList 4,?");
  }
  
  if ($stmt->execute(array($queryStr))) {
    $rowCount = $stmt->rowCount();
    if ($rowCount==0){
      echo '<script type="text/javascript">alert("没有符合条件的记录！");history.go(-1);</script>';
    }
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1; maximum-scale=1.0; user-scalable=no;" />
<meta name="apple-mobile-web-app-status-bar-style" content="black"  />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="format-detection" content="telephone=no" />
<link href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<title>库存</title>
</head>
<body>

<?php
    while ($row = $stmt->fetch(PDO::FETCH_NAMED)) {
?>

<div class="container">
  <div class="row clearfix">
    <div class="col-md-12 column">
      <table class="table table-bordered table-hover">
        <tr><td><?php echo $row["part_no"]; ?></td><td><?php echo $row["ordering_no"]; ?></td></tr>
        <tr><td colspan="2"><?php echo $row["chinese_name"]; ?></td></tr>
        <tr><td colspan="2"><?php echo $row["model"]; ?></td></tr>
        <tr><td>
        <?php 
          if ($row["qty"]){
            echo "<a href=\"inv_place.php?partNo=".$row["part_no"]."\">";
            echo $row["qty"]; 
            echo "</a>";
          } else {
            echo $row["qty"]; 
          }
        ?>
        </td><td><?php echo $row["unit"]; ?></td></tr>
      </table>
    </div>
  </div>
</div>

<?php
      // foreach($row as $field => $value){
      //   if ($value){
      //     echo $field." => ".$value."<br />";
      //   }
      // }
      // echo "<br />";  
     
    }
  }else{ echo "error...";}

?>


</body>
</html>
