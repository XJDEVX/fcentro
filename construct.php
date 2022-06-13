<?php
error_reporting('E_NOTICE');
if (strlen(session_id()) < 1) {
    session_start();
}
require 'app/php_conexion.php';
if (!$_SESSION['rol']) {
    header('location:error.php');
}
$usuario = $_SESSION['username'];
$aleatorio = mt_rand(20000, 40000);
$cans = mysqli_query($con, "SELECT * FROM usuarios WHERE username='$usuario'");
if ($datos = mysqli_fetch_array($cans)) {
    $nombre_usu = $datos['nombre'];
}
if (!empty($_POST['tmp_cantidad']) and !empty($_POST['tmp_nombre']) and !empty($_POST['tmp_valor'])) {
    $tmp_cantidad = $_POST['tmp_cantidad'];
    $tmp_codigo = $_POST['tmp_codigo'];
    $tmp_nombre = $_POST['tmp_nombre'];
    $tmp_valor = $_POST['tmp_valor'];
    $tmp_iva = $_POST['tmp_iva'];
    $fechay = date("d-m-Y");
    $tmp_importe = $tmp_cantidad * $tmp_valor;
    $sql = "INSERT INTO caja_tmp (cod, nom, venta, cant, importe, exitencia,iva ,usu) VALUES  ('$tmp_codigo','$tmp_nombre','$tmp_valor','$tmp_cantidad','$tmp_importe','$tmp_cantidad','$tmp_iva','$usuario')";
    mysqli_query($con, $sql);
}
require_once "partials/header.php";
?>
</head>

<body data-spy="scroll" data-target=".bs-docs-sidebar" id="body1">
    <div class="container">
        <div class="row justify-content-center my-3">
            <div class="col-md-6">
                <img src="assets/images/building.svg" class="img-fluid" alt="">
                <h1 class="text-center">Modulo en Construccion</h1>
            </div>
        </div>
    </div>
    <?php
    require_once('partials/feet.php');
    require_once "partials/footer.php" ?>