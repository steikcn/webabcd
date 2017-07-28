<?php
  require "startSession.php";
  if (!isset($_SESSION['userNo'])) die("无效入口");
  $userNo=$_SESSION['userNo'];

  $msg="";
  if(isset($_GET['msg'])){
    $msg="<p style=\"color:red\">".$_GET['msg']."</p>";
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

<script type="text/javascript">
function validate_required(field,alerttxt) {
with (field) {
  if (value==null||value=="") {alert(alerttxt);return false}
  else {return true}
  }
}

function validate_form(thisform) {
with (thisform) {
  if (validate_required(queryStr,"请输入品号、客户品号或品名、型号！")==false)
    {queryStr.focus();return false}
  }
}
</script>

<title>昆山汇美库存查询</title>
</head>
<body>

<div class="container">
  <div class="row clearfix">
    <div class="col-md-12 column">
      <h4>
        请输入品号、客户品号或品名、型号：
      </h4>
      <form class="form-horizontal" role="form" action="inv_list.php" method="post" onsubmit="return validate_form(this)">
      <!-- <form class="form-horizontal" role="form" action="inv_list.php?user=<?php echo $userNo;?>" method="post" onsubmit="return validate_form(this)"> -->
        <div class="form-group">
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputQuery" name="queryStr" placeholder="品号、客户品号、品名、型号" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-10">
             <button type="submit" class="btn btn-default btn-block btn-success btn-lg" name="customerpartno" value="按客户部品号">按客户部品号查询</button>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-10">
             <button type="submit" class="btn btn-default btn-block btn-info btn-lg" name="partno" value="按品号">按ERP品号查询</button>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-10">
             <button type="submit" class="btn btn-default btn-block btn-primary btn-lg" name="partname" value="按品名">按品名查询</button>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-10">
             <button type="submit" class="btn btn-default btn-block btn-warning btn-lg" name="model" value="按型号">按规格型号查询</button>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-10">
            <?php echo $msg; ?>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>

<!-- 
btn-primary
btn-info
btn-warning
btn-success
btn-danger
 -->