<?php
session_start(); 
$_SESSION = array();
session_destroy();
header("location: admin.php&action=login");
exit;
?>