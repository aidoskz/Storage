<?php 
include 'function.php';

 

print_r($_SERVER);

 
	print_r($_FILES);
 
$res = move_uploaded_file($_FILES['file']['tmp_name'], 'ra.png');

echo($res);

//echo Files::add();
// header("Location:/".get_link($_SERVER['HTTP_REFERER'])[0]);
exit();
?>