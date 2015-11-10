<?php 

include "db.php";

function is_json($link = NULL){
        if($link===NULL){
            $link = $_SERVER['REQUEST_URI'];
        }
        if(preg_match('#.+\.json#', end(get_path($link) )) ){
            return true;
        }
        return false;
    }

function is_xml($link = NULL){
        if($link===NULL){
            $link = $_SERVER['REQUEST_URI'];
        }
        if(preg_match('#.+\.xml#', end(get_path($link) )) ){
            return true;
        }
        return false;
    }

function get_link($url){
	$parse = parse_url($url,PHP_URL_PATH);

	 if(preg_match_all('#(?P<name>.+)\.json#', $parse, $matches)){
            $parse = $matches['name'][0]; 
            // var_dump($matches);
            // exit();
        }

         if(preg_match_all('#(?P<name>.+)\.xml#', $parse, $matches)){
            $parse = $matches['name'][0]; 
            // var_dump($matches);
            // exit();
        }
	$arr = explode('/',$parse);
	foreach ($arr as $e) {
		if(trim($e)!=''){
			$newurl[] = trim($e);
		}
	}

	return $newurl;
}

function array_to_xml($array, $level=1) {
        $xml = '';
    if ($level==1) {
        $xml .= '<?xml version="1.0" encoding="ISO-8859-1"?>'.
                "\n<array>\n";
    }
    foreach ($array as $key=>$value) {
        $key = strtolower($key);
        if (is_array($value)) {
            $multi_tags = false;
            foreach($value as $key2=>$value2) {
                if (is_array($value2)) {
                    $xml .= str_repeat("\t",$level)."<$key>\n";
                    $xml .= array_to_xml($value2, $level+1);
                    $xml .= str_repeat("\t",$level)."</$key>\n";
                    $multi_tags = true;
                } else {
                    if (trim($value2)!='') {
                        if (htmlspecialchars($value2)!=$value2) {
                            $xml .= str_repeat("\t",$level).
                                    "<$key><![CDATA[$value2]]>".
                                    "</$key>\n";
                        } else {
                            $xml .= str_repeat("\t",$level).
                                    "<$key>$value2</$key>\n";
                        }
                    }
                    $multi_tags = true;
                }
            }
            if (!$multi_tags and count($value)>0) {
                $xml .= str_repeat("\t",$level)."<$key>\n";
                $xml .= array_to_xml($value, $level+1);
                $xml .= str_repeat("\t",$level)."</$key>\n";
            }
        } else {
            if (trim($value)!='') {
                if (htmlspecialchars($value)!=$value) {
                    $xml .= str_repeat("\t",$level)."<$key>".
                            "<![CDATA[$value]]></$key>\n";
                } else {
                    $xml .= str_repeat("\t",$level).
                            "<$key>$value</$key>\n";
                }
            }
        }
    }
    if ($level==1) {
        $xml .= "</array>\n";
    }
    return $xml;
}


function get_path($url){
	$parse = parse_url($url,PHP_URL_PATH);
 
	$arr = explode('/',$parse);
	foreach ($arr as $e) {
		if(trim($e)!=''){
			$newurl[] = trim($e);
		}
	}

	return $newurl;
}

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

/**
* FILES
*/
class Files
{
	public function add(){
		for($i=0; $i<count($_FILES['file']['name']); $i++) {
				$name = $_FILES['file']['name'][$i];
				$type = $_FILES['file']['type'][$i];
				$size = $_FILES['file']['size'][$i];
				$tmp_name = $_FILES['file']['tmp_name'][$i];
				//Make sure we have a filepath
				if ($tmp_name != ""){
			    //Setup our new file path


			    $folder = "uploads/".date('Y/m/d/').md5(date('H:i:s'))."/";
									if(!is_dir($folder)) {
	 
										mkdir($folder, 0755, true);
									}
			    $newFilePath = $folder . $name;
			    //Upload the file into the temp dir
			    $ip = GetRealIp();
			    $session_id = session_id();
			    $user_agent = $_SERVER['HTTP_USER_AGENT'];
				$hash = get_link($_SERVER['HTTP_REFERER'])[0];
				$DENY_EXT = array('php','php3', 'php4', 'php5', 'phtml', 'exe', 'pl', 'cgi', 'html', 'htm', 'js', 'asp', 'aspx', 'bat', 'sh', 'cmd');			    
			    $file_ext = strtolower( pathinfo($newFilePath, PATHINFO_EXTENSION) );
			    if(!in_array($file_ext, $DENY_EXT)){
				    if(move_uploaded_file($tmp_name, $newFilePath)) {
							mysql_query("INSERT INTO `storage_ktga`.`files` (`created`,`hash`,`path`,`name`,`type`,`size`,`ip`,`session_id`,`user_agent`) VALUES (NOW(),'$hash','/$newFilePath','$name','$type','$size','$ip','$session_id','$user_agent');");
					    }
				  	}
			    }

		}

	 

		return $folder;

	}

	public function delele($folder){
		if(preg_match ('#/upload/\d{4}/\d{2}/\d{2}/.+#', $folder ,$matches) ){
			if(is_dir($folder)){
			rmdir($folder);
			return true;
			}
		}
		return false;
	}

 }

     function GetRealIp()
	{
	 if (!empty($_SERVER['HTTP_CLIENT_IP']))
	 {
	   $ip=$_SERVER['HTTP_CLIENT_IP'];
	 }
	 elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
	 {
	  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	 }
	 else
	 {
	   $ip=$_SERVER['REMOTE_ADDR'];
	 }
	 return $ip;
	}

