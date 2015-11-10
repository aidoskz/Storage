<?php 
session_start();
mysql_connect('localhost','root','aidos123') or die("Not connect to MySQL"); 
mysql_select_db('storage_ktga') or die("Not connect to DB");
mysql_set_charset('utf8'); 