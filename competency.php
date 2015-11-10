<?php
session_start();
mysql_connect('localhost','root','aidos123') or die("Not connect to MySQL"); 
mysql_select_db('kontrotenko_super_new') or die("Not connect to DB");
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
}?>
<!DOCTYPE html>
<html>
<head>
	<title>Таланты</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css">
</head>
<body>
<?php
if($_GET['email']!=''){
	$email = $_GET['email'];

foreach (SQL::execute("SELECT * FROM competency;") as $e) {
	$competency[$e['id']]=$e['name_ru'];
}

$ratings = array(1=>"Основной",
	2=>"Промежуточный",
	3=>"Опытный",
	4=>"Передовой",
	5=>"Эксперт"
	);
 
	$profile = SQL::execute("SELECT P.*,C.name_ru FROM `kontrotenko_super_new`.`profile_item` P LEFT JOIN `kontrotenko_super_new`.`competency` C ON P.competency=C.id  WHERE P.email='$email';");
	echo "<button class=add_profile>Добавить</button><form method=post><table> <thead> <tr> <th>#</th> <th>Навык</th> <th>Уровень</th> </tr> </thead> <tbody>";
	foreach ($profile as $e){
		echo '<tr><td>'.$e['id'].'</td><td>';
	echo "<select name='prof[".$e['id']."]' class='chzn'>";
	foreach ($competency as $k => $v) {
		$selected= 		($k==$e['competency'])?'selected':'';
		echo '<option '.$selected.' value='.$k.'>'.$v.'</option>';
	}
	echo '</select></td><td>';
	echo "<select name='rat[".$e['id']."]' class='chzn'>";
	foreach ($ratings as $k => $v) {
		$selected= 		($k==$e['rating'])?'selected':'';
		echo '<option '.$selected.' value='.$k.'>'.$v.'</option>';
	}
	echo '</select></td></tr>';
		}
		echo "</tbody></table><input type='hidden' name=email value='$email'> <input type=submit> </form>";
	}else{
		echo "Вы должны пройти по ссылке в вашем почте";
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.proto.min.js" type="text/javascript"></script>

<script type="text/javascript">
	$('.chzn').chosen();

$('.add_profile').click(function(e){
	$('tbody').append('<tr><td></td><td>123</td><td>234234</td></tr>');
});

</script>
</body>
</html>