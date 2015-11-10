<?php 


$url = "https://hckj-test.fs.em2.oraclecloud.com/idcws/GenericSoapPort?WSDL";

 
$client = new SoapClient($url);  

echo var_dump($client);  




 ?>