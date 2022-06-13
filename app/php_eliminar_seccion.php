<?php
if (strlen(session_id()) < 1) {
	session_start();
}
require_once('php_conexion.php');
$id = $_GET['id'];
if ($_SESSION['username'] == "") {
} else {
	$xSQL = "DELETE FROM seccion WHERE id=$id";
	querySimple($xSQL);
	header('location:../seccion.php?ddes=' . $_SESSION['ddes']);
}
