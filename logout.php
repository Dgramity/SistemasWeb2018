<?php
session_start();
foreach($_SESSION as $j){
	unset($j);
}
session_destroy();
header("Location:layout.html");
?>