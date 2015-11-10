<?php 
include 'function.php';
Files::add();
header("Location:/".get_link($_SERVER['HTTP_REFERER'])[0]);
exit();
?>