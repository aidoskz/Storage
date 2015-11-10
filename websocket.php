<?
/*      Simple Websocket Client
	copyleft Stefano Cudini 2011-01-19
	stefano.cudini@...

	inspired by:
		http://caucho.com/resin-4.0/examples/websocket-php/
*/
	$host = 'storage.ktga.kz';  //where is the websocket server
	$port = 8001;
	$local = "http://sd.ktga.kz/";  //url where this script run
	$data = '{"on":"all","data":"Hello"}';  //data to be send

	$head =	"GET / HTTP/1.1"."\r\n".
			"Upgrade: WebSocket"."\r\n".
			"Connection: Upgrade"."\r\n".
			"Origin: $local"."\r\n".
			"Host: $host"."\r\n".
			"Content-Length: ".strlen($data)."\r\n"."\r\n";
	////WebSocket handshake
	$sock = fsockopen($host, $port, $errno, $errstr, 2);
	fwrite($sock, $head ) or die('error:'.$errno.':'.$errstr);
	$headers = fread($sock, 2000);
	fwrite($sock, "\x00$data\xff" ) or die('error:'.$errno.':'.$errstr);
	$wsdata = fread($sock, 2000);  //receives the data included in the
// websocket package "\x00DATA\xff"
	$retdata = trim($wsdata,"\x00\xff"); //extracts data
	////WebSocket handshake
	fclose($sock);

	echo $retdata  //data result
?>
