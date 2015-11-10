<?php

if($_GET['wsdl']){
	file_get_contents('hello.wsdl');
	exit();
}

if(!extension_loaded("soap")){
  dl("php_soap.dll");
}

ini_set("soap.wsdl_cache_enabled","0");
$server = new SoapServer("hello.wsdl");

function doHello($yourName){


  return "Hello, ".$yourName;
}

$server->AddFunction("doHello");
$server->handle();
?>