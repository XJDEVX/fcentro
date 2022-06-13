<?php
if (strlen(session_id()) < 1) {
    session_start();
}
require 'php_conexion.php';
$usuario = $_SESSION['username'];
if (!empty($_GET['xcodigo'])) {
    $codigo = $_GET['xcodigo'];
}
if (!empty($_GET['cantidad'])) {
    $cantidad = $_GET['cantidad'];
}
if (!empty($_GET['tventa'])) {
    $_SESSION['tventa'] = $_GET['tventa'];
}
if (!$_SESSION['username'] == "") {

    if (!empty($cantidad)) {
        $cann = mysqli_query($con, "SELECT * FROM caja_tmp where cod='$codigo'");
        if ($datos = mysqli_fetch_array($cann)) {
            if ($cantidad <> 0) {
                $importe = $cantidad * $datos['venta'];
                $sql = "UPDATE caja_tmp SET cant='$cantidad', importe='$importe' WHERE cod='$codigo'";
                mysqli_query($con, $sql);
                // echo $sql;
            }
        }
    }
}
header('location:../caja_credito.php?ddes=' . $_SESSION['ddes']);
