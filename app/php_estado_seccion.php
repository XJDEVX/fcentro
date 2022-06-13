<?php
if (strlen(session_id()) < 1) {
	session_start();
}
require_once('php_conexion.php');
$id = $_GET['id'];
if ($_SESSION['username'] == "") {
} else {
	if ($_SESSION['rol'] == 'Administrador') {
		$cans = querySimple("SELECT * FROM seccion WHERE estado='s' and id='$id'");

		if ($dat = mysqli_fetch_array($cans)) {
			$xSQL = "UPDATE seccion SET estado='n' WHERE id=$id";
			querySimple($xSQL);
			header('location:../seccion.php');
		} else {
			$xSQL = "UPDATE seccion SET estado='s' WHERE id=$id";
			querySimple($xSQL);
			header('location:../seccion.php');
		}
	}
}
