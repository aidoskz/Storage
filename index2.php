<?php
$servername = "localhost";
$username = "root";
if ($_SERVER["SERVER_NAME"] == "test.loc") {
	$password = "";
	$dbname = "gis_ktga";
} else {
	$password = "aidos123";
	$dbname = "test";
}

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);
// // Check connection
// if ($conn->connect_error) {
    // die("Connection failed: " . $conn->connect_error);
// } 
mysql_connect('localhost','root','aidos123') or die("Not connect to MySQL"); 
mysql_select_db('test') or die("Not connect to DB");
mysql_set_charset('utf8'); 

header('Content-Type: application/json');

class SQL {


	public function getOne($sql){
 
	 
			$res = mysql_query($sql);
		 	$row = mysql_fetch_assoc($res);
	 
		return  $row;	 
	}
	public function execute($sql){

 
		$sql = mysql_query($sql);
			while ($row = mysql_fetch_assoc($sql)) {
				$data[] = $row;
			}
 
		return $data;	
	}

	public function getOneWithCache($sql){

		$Memcache = new Memcache();
		$Memcache->connect('localhost', 11211) or die ("Не могу подключиться");
		$res = $Memcache->get(md5($sql));
		if($res){
			$data=$res;
		}else{

			$sql = @mysql_query($sql);
			$data = @mysql_fetch_assoc($sql);
			$Memcache->set(md5($sql),$data,100);

		}
		return $data ;	
	}
	public function executeWithCache($sql){

		$Memcache = new Memcache();
		$Memcache->connect('localhost', 11211) or die ("Не могу подключиться");
		$res = $Memcache->get(md5($sql));
		if($res){
			$data=$res;
		}else{
		$sql = @mysql_query($sql);
			while ($row = @mysql_fetch_assoc($sql)) {
				$data[] = $row;
			}
			$Memcache->set(md5($sql),$data,100);
		}
		return $data;	
	}
}


if (isset($_GET['street']) && isset($_GET['housenum'])) {
	$street = $_GET['street'];
	$housenum = $_GET['housenum'];
	$sql = "SELECT account FROM `abonents` WHERE `street` LIKE '%".$street."%' AND `housenum` = '".$housenum."'";
	$data['response'] = json_encode(SQL::execute($sql));
	 
} else {
	$data['response'] = "No query params!!!";
}
//var_dump($sql);
 var_dump($data);
 
?>