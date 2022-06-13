<?php 
session_start();
include ('php_conexion.php') ;



$id=$_GET['id'];

if($_SESSION['username']==""){
}else{
		$xSQL="DELETE FROM facturacompra WHERE factura=$id";
		mysql_query($xSQL);
		header('location:factuCompra.php?ddes='.$_SESSION['ddes']);
}




 ?>
