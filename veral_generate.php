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


if($_GET['n']){
	$where= "WHERE tests.name LIKE '%" .mysql_real_escape_string($_GET['n']). "%' ";
}


$SQL = new SQL();

$test = $SQL->execute("SELECT UPPER(answers.answer) as answer, tests.* FROM tests
JOIN answers ON tests.number=answers.number and tests.name=answers.name $where ;");

header('Content-Type: text/plain; charset=utf-8');

ECHO<<<END
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE test SYSTEM "XTF_v1p1.dtd">
<test>
<questions>

END;


foreach ($test as $e) {

?>
<single random="y" format="custom">
<p align="left"><font face="Times New Roman" size="3"><?=$e['question']?></font></p>
<?php if ($e['a']): ?>
<answer rating="<?=($e['answer']=='А')?'1':'0'?>"><p align="left"><font face="Arial" size="3"/><font face="Times New Roman" size="3"><?=$e['a']?></font></p></answer>
<?php endif ?>
<?php if ($e['b']): ?>
<answer rating="<?=($e['answer']=='Б')?'1':'0'?>"><p align="left"><font face="Arial" size="3"/><font face="Times New Roman" size="3"><?=$e['b']?></font></p></answer>		
<?php endif ?>
<?php if ($e['v']): ?>
<answer rating="<?=($e['answer']=='В')?'1':'0'?>"><p align="left"><font face="Arial" size="3"/><font face="Times New Roman" size="3"><?=$e['v']?></font></p></answer>		
<?php endif ?>
<?php if ($e['g']): ?>
<answer rating="<?=($e['answer']=='Г')?'1':'0'?>"><p align="left"><font face="Arial" size="3"/><font face="Times New Roman" size="3"><?=$e['g']?></font></p></answer>		
<?php endif ?>
<?php if ($e['d']): ?>
<answer rating="<?=($e['answer']=='Д')?'1':'0'?>"><p align="left"><font face="Arial" size="3"/><font face="Times New Roman" size="3"><?=$e['d']?></font></p></answer>		
<?php endif ?>
<?php if ($e['e']): ?>
<answer rating="<?=($e['answer']=='Е')?'1':'0'?>"><p align="left"><font face="Arial" size="3"/><font face="Times New Roman" size="3"><?=$e['e']?></font></p></answer>		
<?php endif ?>
<?php if ($e['zh']): ?>
<answer rating="<?=($e['answer']=='Ж')?'1':'0'?>"><p align="left"><font face="Arial" size="3"/><font face="Times New Roman" size="3"><?=$e['zh']?></font></p></answer>		
<?php endif ?>
</single>
<?php
}
?>
 </questions>
</test>