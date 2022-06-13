<?php
if (strlen(session_id()) < 1) {
	session_start();
}
require_once('php_conexion.php');
$usu = $_SESSION['username'];
if ($_SESSION['rol'] !== 'Administrador') {
	header('location:../clientes.php');
} else {
	$id = $_GET['id'];
	if ($_SESSION['username'] == "") {
	} else {
		if ($_SESSION['rol'] == 'Administrador') {
			$cans = querySimple("SELECT * FROM clientes WHERE estado='1' and id='$id'");

			if ($dat = mysqli_fetch_array($cans)) {
				$xSQL = "UPDATE clientes SET estado='0' WHERE id=$id";
				querySimple($xSQL);
				header('location:../clientes.php');
			} else {
				$xSQL = "UPDATE clientes SET estado='1' WHERE id=$id";
				querySimple($xSQL);
				header('location:../clientes.php');
			}
		}
	}
}
header('location:../clientes.php');
