<?php
if (strlen(session_id()) < 1) {
    session_start();
}
require_once 'php_conexion.php';
$id = $_GET['id'];
if ($_SESSION['username'] == "") {
} else {
    $borrar_sql = "DELETE FROM caja_tmp";
    querySimple($borrar_sql);
    header("Location:../caja_credito.php?ddes=" . $_SESSION['ddes'] . "");
}
