<?php
if (strlen(session_id()) < 1) {
	session_start();
}
require_once('php_conexion.php');
$id = $_GET['id'];
if ($_SESSION['username'] == "") {
} else {
	$xSQL = "DELETE FROM proveedor WHERE id=$id";
	querySimple($xSQL);
	$data = 'Proveedor Eliminado Correctamente';
	echo json_encode($data);
	// header('location:proveedor.php?ddes='.$_SESSION['ddes']);
}
