<?php
if (strlen(session_id()) < 1) {
	session_start();
}
require_once 'php_conexion.php';
$id = $_GET['id'];
$usuario = $_SESSION['username'];
$borrar_sql = "DELETE FROM caja_tmp WHERE usu='$usuario'";
querySimple($borrar_sql);
header("Location:../caja.php?ddes=" . $_SESSION['ddes'] . "");
