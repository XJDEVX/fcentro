<?php
if (strlen(session_id()) < 1) {
	session_start();
}
require_once('php_conexion.php');
$usu = $_SESSION['username'];
if ($_SESSION['rol'] !== 'Administrador') {
	header('location:../usuarios.php');
} else {
	$id = $_GET['id'];
	if ($_SESSION['username'] == "") {
	} else {
		if ($_SESSION['rol'] == 'Administrador') {
			$cans = querySimple("SELECT * FROM usuarios WHERE estado='1' and id='$id'");
			if ($dat = mysqli_fetch_array($cans)) {
				$xSQL = "UPDATE usuarios SET estado='0' WHERE id=$id";
				querySimple($xSQL);
				header('location:../usuarios.php');
			} else {
				$xSQL = "UPDATE usuarios SET estado='1' WHERE id=$id";
				querySimple($xSQL);
				header('location:../usuarios.php');
			}
		}
	}
}
header('location:../usuarios.php');
