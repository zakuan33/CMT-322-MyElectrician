<?php
$strurl ="index.php";
session_start();
session_destroy();
header("Location:$strurl");
?>
v