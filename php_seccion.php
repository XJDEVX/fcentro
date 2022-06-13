<?php

session_start();
include('php_conexion.php');
$usu=$_SESSION['username'];
if(!$_SESSION['tipo_usu']=='a' or !$_SESSION['tipo_usu']=='ca'){
	header('location:producto.php');
}else{
	$id=$_GET['id'];
	if($_SESSION['username']==""){
	}else{
		if($_SESSION['tipo_usu']=='a'){
			$cans=mysql_query("SELECT * FROM producto WHERE seccion and cod='$id'");
	
			
			
		}
	}
}
header('location:producto.php');