<?php 
session_set_cookie_params (120);
session_start();
$_SESSION["admin"]=1;
if (isset($_SESSION["admin"])) echo "alert(1)"
?>
