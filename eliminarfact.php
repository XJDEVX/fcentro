<?php 
session_start();
include ('php_conexion.php') ;



$id=$_GET['id'];

if($_SESSION['username']==""){
}else{
		$xSQL="DELETE FROM factura WHERE factura=$id";
		mysql_query($xSQL);
		header('location:factu.php?ddes='.$_SESSION['ddes']);
}




 ?>
