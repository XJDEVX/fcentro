<?php

require_once 'app/php_conexion.php';
$factura = $_GET['factura'];
// var_dump($factura);
// die();
$sqlazo = "SELECT * FROM factura WHERE factura='$factura'";
$querazo = queryRow($sqlazo);	
		var_dump($querazo);
		die();


?>