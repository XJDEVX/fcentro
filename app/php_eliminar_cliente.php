<?php
if (strlen(session_id()) < 1) {
	session_start();
}
require_once('php_conexion.php');
$id = $_GET['id'];
if ($_SESSION['username'] == "") {
} else {
	$xSQL = "DELETE FROM clientes WHERE id=$id";
	querySimple($xSQL);
	$data = "Cliente eliminado con exito";
	echo json_encode($data);
}
