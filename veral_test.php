<?php 
ini_set('display_errors', true);

session_start();
mysql_connect('localhost','root','aidos123') or die("Not connect to MySQL"); 
mysql_select_db('test') or die("Not connect to DB");
mysql_set_charset('cp1251'); 


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



$SQL = new SQL();

$test = $SQL->execute('SELECT answers.answer, tests.* FROM tests
JOIN answers ON tests.number=answers.number and tests.name=answers.name ;');

header('Content-Type: text/plain; charset=windows-1251');

?>
<?php foreach ($test as $e): ?>
?<?=$e['question']?>

<?php if ($e['a']!=''): ?>
<?=($e['answer']=='�')?'+':'='?><?=$e['a']?>

<?php endif ?>
<?php if ($e['b']!=''): ?>
<?=($e['answer']=='�')?'+':'='?><?=$e['b']?>

<?php endif ?>
<?php if ($e['v']!=''): ?>
<?=($e['answer']=='�')?'+':'='?><?=$e['v']?>

<?php endif ?>
<?php if ($e['g']!=''): ?>
<?=($e['answer']=='�')?'+':'='?><?=$e['g']?>

<?php endif ?>
<?php if ($e['d']!=''): ?>
<?=($e['answer']=='�')?'+':'='?><?=$e['d']?>
<?php endif ?>
<?php if ($e['e']!=''): ?>
<?=($e['answer']=='�')?'+':'='?><?=$e['e']?>

<?php endif ?>
<?php if ($e['zh']!=''): ?>
<?=($e['answer']=='�')?'+':'='?><?=$e['zh']?>

<?php endif ?>
<?php endforeach ?>
