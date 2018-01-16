<?php
require_once('nusoap.php');
require_once('class.wsdlcache.php');
$soapclient = new nusoap_client('http://localhost/comprobarPass.php?wsdl', true);
sleep(2);
$param = array('x' =>$_POST['pass']);
$result = $soapclient->call('comprobarPass',$param);
echo $result;
?>