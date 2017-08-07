<?php
  require "startSession.php";
  if (!isset($_SESSION['userNo'])) die("网页已过期");
  $userNo=$_SESSION['userNo'];

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
  if (validate_required(newPlace,"请输入有效的新库位！")==false)
    {newPlace.focus();return false}
  }
}
</script>

<title>转移到新库位</title>
</head>
<body>

<div class="container">
  <div class="row clearfix">
    <div class="col-md-12 column">
      <h4>
        旧库位：<?php echo $_GET['place']; ?>
      </h4>      
      <h4>
        请输入新库位：
      </h4>
      <form class="form-horizontal" role="form" action="inv_changePlace.php" method="post" onsubmit="return validate_form(this)">
        <input type="hidden" name="part" value="<?php echo $_GET['part']; ?>" />
        <input type="hidden" name="store" value="<?php echo $_GET['store']; ?>" />
        <input type="hidden" name="lot" value="<?php echo $_GET['lot']; ?>" />
        <input type="hidden" name="oldPlace" value="<?php echo $_GET['place']; ?>" />
        <input type="hidden" name="qty" value="<?php echo $_GET['qty']; ?>" />
        <input type="hidden" name="company" value="<?php echo $_GET['company']; ?>" />
        <div class="form-group">
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputQuery" name="newPlace" placeholder="新库位" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-10">
             <button type="submit" class="btn btn-default btn-block btn-success btn-lg" name="changePlace" value="转移库位">转移</button>
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