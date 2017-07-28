<?php 
session_set_cookie_params (120);
session_start();
if (isset($_SESSION["admin"])) echo '<script type="text/javascript">alert(1);</script>';
var_dump($_SESSION);
?>