<?php
if (strlen(session_id()) < 1) {
    session_start();
}
include('php_conexion.php');
$id = $_GET['id'];
if ($_SESSION['username'] == "") {
} else {
    $borrar_sql = "DELETE FROM temp";
    querySimple($borrar_sql);
    header('location:../caja_compra.php?ddes=' . $_SESSION["ddes"]);
}
