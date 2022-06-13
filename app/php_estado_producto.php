<?php
if (strlen(session_id()) < 1) {
	session_start();
}
require 'php_conexion.php';
$usu = $_SESSION['username'];
if ($_SESSION['rol'] !== 'Administrador') {
	header('location:../producto.php');
} else {
	$id = $_GET['id'];
	if ($_SESSION['username'] == "") {
	} else {
		if ($_SESSION['rol'] == 'Administrador') {
			$cans = mysqli_query($con, "SELECT * FROM producto WHERE estado='s' and cod='$id'");
			if ($dat = mysqli_fetch_array($cans)){
				$xSQL = "UPDATE producto SET estado='a' WHERE cod='$id'";
				mysqli_query($con, $xSQL);
				header('location:../producto.php');
			} else {
				$xSQL = "UPDATE producto SET estado='s' WHERE cod='$id'";
				mysqli_query($con, $xSQL);
				header('location:../producto.php');
			}
		}
	}
}
header('location:../producto.php');