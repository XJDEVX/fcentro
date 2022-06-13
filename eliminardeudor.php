<?php 
session_start();
include ('php_conexion.php') ;



$id=$_GET['id'];

if($_SESSION['username']==""){
}else{
		$xSQL="DELETE FROM clientes WHERE cedula=$id";
		mysql_query($xSQL);
		header('location:deudores.php?ddes='.$_SESSION['ddes']);
}




 ?>

