<?php
error_reporting( 'E_ERROR' );
if (strlen(session_id()) < 1) {
	session_start();
}
require_once('php_conexion.php');
 $id = $_GET['id'];
if ($_SESSION['username'] == "") {
} else {

	$sqlFoto = "SELECT * FROM producto WHERE cod='$id'";
	$fotuli = queryRow($sqlFoto);
	$deleteFotoStorage =  '../'. $fotuli['foto'];
	unlink( $deleteFotoStorage );
	$xSQL = "DELETE FROM producto WHERE cod='$id'";
	querySimple($xSQL);
	// header('Location:../producto.php?ddes=' . $_SESSION['ddes']);
	$data = 'Producto Eliminado Correctamente';
	echo json_encode($data);
}