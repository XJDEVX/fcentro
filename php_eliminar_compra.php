<?php

session_start();
include('php_conexion.php');

$id=$_GET['id'];

if($_SESSION['username']==""){
}else{
		$xSQL="DELETE FROM caja_tmp WHERE cod=$id";
		mysql_query($xSQL);
		header('location:compra_product.php?ddes='.$_SESSION['ddes']);
}
?>