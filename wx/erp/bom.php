<html>
<head>
<!-- <meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> -->
<meta name="viewport" content="width=device-width, initial-scale=1; maximum-scale=1.0; user-scalable=no;" />
<meta name="apple-mobile-web-app-status-bar-style" content="black"  />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="format-detection" content="telephone=no" />
<title></title>
</head>
<body>

<?php
  require_once "../pdo/pdoKswm.php";

  $stmt = $pdo->prepare("SELECT top 2 part_no,part_no,material_no FROM bom");
  $stmt->execute();
  while ($row = $stmt->fetch()) {
    echo "<pre>";
    print_r($row);
    echo "</pre>";
    foreach($row as $field => $value){
      if ($value){
        echo $field." => ".$value."<br />";
      }
    }
    echo "<br />";
  }
  unset($pdo); unset($stmt);

?>

</body>
</html>
