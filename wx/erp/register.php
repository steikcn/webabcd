<?php
  require "startSession.php";

  if (!isset($_SESSION['uid'])) die("无效入口");

  $uid=$_SESSION['uid'];
	// $uid=$_GET['uid'];
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
<title>昆山汇美ERP</title>
</head>
<body>

<div class="container">
  <div class="row clearfix">
    <div class="col-md-12 column">
      <h4>
        需要将汇美账套ERP用户绑定到微信：
      </h4>
      <form class="form-horizontal" role="form" action="registerSave.php" method="post">
      <!-- <form class="form-horizontal" role="form" action="registerSave.php?uid=<?php echo $uid; ?>" method="post"> -->
        <div class="form-group">
           <label for="inputUserNo" class="col-sm-2 control-label">ERP用户名：</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputUserNo" name="userNo" placeholder="请输入汇美ERP用户名" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <?php echo $msg; ?>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
             <button type="submit" class="btn btn-default btn-lg btn-block btn-warning">绑 定</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>
