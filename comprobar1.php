<?php
require_once('nusoap.php');
require_once('class.wsdlcache.php');
$soapclient = new nusoap_client('http://ehusw.es/jav/ServiciosWeb/comprobarmatricula.php?wsdl', true);
sleep(1);
$param = array('x' =>$_POST['correo']);
$result = $soapclient->call('comprobar',$param);
echo $result;
?>