<?php
if (strlen(session_id()) < 1) {
    session_start();
}
require_once('php_conexion.php');
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
        $cann = querySimple("SELECT * FROM temp where cod='$codigo'");
        if ($datos = mysqli_fetch_array($cann)) {
            if ($cantidad <> 0) {
                $importe = $cantidad * $datos['costo'];
                $sql = "Update temp Set cant='$cantidad', importe='$importe' Where cod='$codigo'";
                querySimple($sql);
                // echo $sql;
            }
        }
    }

    if ($_SESSION["tventa"] == 'venta') {
        $cann = querySimple("SELECT * FROM temp where usu='$usuario'");
        while ($datos = mysqli_fetch_array($cann)) {
            $codp = $datos['cod'];
            $cant = $datos['cant'];
            $can = querySimple("SELECT * FROM producto where cod='$codp'");
            if ($dato = mysqli_fetch_array($can)) {
                $valore = $dato['costo'];
                $improtee = $valore * $cant;
                $sqld = "Update temp Set venta='$valore', importe='$improtee' Where cod='$codp'";
                querySimple($sqld);
            }
        }
    }
}
header('location:../caja_compra.php?ddes=' . $_SESSION['ddes']);
