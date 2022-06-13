<?php
if (strlen(session_id()) < 1) {
	session_start();
}
require 'php_conexion.php';
$usu = $_SESSION['username'];
if ($_SESSION['rol'] !== 'Administrador') {
	header('location:../proveedor.php');
} else {
	$id = $_GET['id'];
	if ($_SESSION['username'] == "") {
	} else {
		if ($_SESSION['rol'] == 'Administrador') {
			$cans = mysqli_query($con, "SELECT * FROM proveedor WHERE estado='s' and id='$id'");
			if ($dat = mysqli_fetch_array($cans)) {
				$xSQL = "UPDATE proveedor SET estado='n' WHERE id=$id";
				mysqli_query($con, $xSQL);
				// header('location:../proveedor.php');
			} else {
				$xSQL = "UPDATE proveedor SET estado='s' WHERE id=$id";
				mysqli_query($con, $xSQL);
				// header('location:../proveedor.php');
			}
		}
	}
}
header('location:../proveedor.php');