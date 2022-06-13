<?php
if (strlen(session_id()) < 1) {
    session_start();
}
include('php_conexion.php');
$usuario = $_SESSION['username'];
if (!empty($_GET['xcodigo'])) {
    $codigo = $_GET['xcodigo'];
}
if (!empty($_GET['venta'])) {
    $venta = $_GET['venta'];
}
if (!empty($_GET['cant'])) {
    $cant = $_GET['cant'];
}
if (!empty($_GET['tventa'])) {
    $_SESSION['tventa'] = $_GET['tventa'];
}
if (!$_SESSION['username'] == "") {
    $cann = querySimple("SELECT * FROM temp where cod='$codigo'");
    if ($datos = mysqli_fetch_array($cann)) {
        if ($venta <> 0) {
            $importe = $datos['cant'] * $venta;
            $sql = "Update temp Set costo='$venta', importe='$importe' Where cod='$codigo'";
            querySimple($sql);
            // echo $sql;
        }
    }
}
header('location:../caja_compra.php?ddes=' . $_SESSION['ddes']);
