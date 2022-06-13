<?php
if( strlen( session_id() ) < 1 ){
	session_start();
}
require_once('php_conexion.php');
$id=$_GET['id'];
if($_SESSION['username']==""){
}else{
		$xSQL="DELETE FROM usuarios WHERE id=$id";
		querySimple($xSQL);
		// header('location:usuarios.php?ddes='.$_SESSION['ddes']);
		$data = "Usuario eliminado con exito";
		echo json_encode($data);
}
// header('location:usuarios.php');
