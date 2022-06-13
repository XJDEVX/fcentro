<?php

session_start();
include('php_conexion.php');
$usu=$_SESSION['username'];
if(!$_SESSION['tipo_usu']=='a' or !$_SESSION['tipo_usu']=='ca'){
	header('location:clientes.php');
}else{
	$id=$_GET['id'];
	if($_SESSION['username']==""){
	}else{
		if($_SESSION['tipo_usu']=='a'){
			$cans=mysql_query("SELECT * FROM clientes WHERE estado='1' and cedula='$id'");
	
			if($dat=mysql_fetch_array($cans)){
				$xSQL="Update clientes Set estado='0' Where cedula=$id";
				mysql_query($xSQL);
				header('location:deudores.php');
			}else{
				$xSQL="Update clientes Set estado='1' Where cedula=$id";
				mysql_query($xSQL);
				header('location:deudores.php');
			}
			
		}
	}
}
header('location:deudores.php');