<?php 
ini_set('display_errors', true);

session_start();
mysql_connect('localhost','root','aidos123') or die("Not connect to MySQL"); 
mysql_select_db('test') or die("Not connect to DB");
mysql_set_charset('utf8'); 


/** 
*   Simle SQL execute
*@author=Aidos Kakimzhanov
*@version=1.0
*/
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

	 
}


if($_POST['test']!=''&&$_POST['name']&&$_POST['answer']){

	$name = $_POST['name'];
	$test = $_POST['test'];
	$answer = $_POST['answer'];

 
$test = preg_replace('/^ +(.+)/i', '$1', $test);
$test = preg_replace('/\t+/i', ' ', $test);
$test = preg_replace('/\|+/i', ' ', $test);
$test = preg_replace("/(.+)\r\n/", '$1|', $test);
$test = preg_replace("/(\r\n)+/", "\r\n", $test);
$test = preg_replace("/(\d+)\.(.+)/", "$1|$2", $test);
$test = preg_replace("/(.+)/", "$1###", $test);

 //preg_match_all("/((.+)\|.+###/", $test, $test);


}




?>

<form method=post>
	Name
<input name="name">

TEST
<textarea name="test"></textarea>

Answer 
<textarea name="answer"></textarea>


</form>
<pre>
<?=print_r($test) ?>
</pre>