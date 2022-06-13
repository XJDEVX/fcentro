<?php
if (strlen(session_id()) < 1) {
    session_start();
}
require 'php_conexion.php';
$id = $_GET['id'];
if ($_SESSION['username'] == "") {
} else {
    $xSQL = "DELETE FROM caja_tmp WHERE cod='$id'";
    mysqli_query($con, $xSQL);
    // var_dump($id);
    header('location:../caja_credito.php?ddes=' . $_SESSION['ddes']);
}
