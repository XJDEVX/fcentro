<?php
error_reporting(E_ERROR);
session_start();
include('app/php_conexion.php');

// if ($_SESSION['rol'] !== 'A' || ) {
//     header('location:error.php');
// }
//contado.php?tpagar='.$tpagar.'&ccpago='.$ccpago)
if (!empty($_GET['tpagar']) and !empty($_GET['ccpago']) and !empty($_GET['factura'])) {
    $tpagar = $_GET['tpagar'];
    $ccpago = $_GET['ccpago'];
    $factura = $_GET['factura'];
    $cambio = $ccpago - $tpagar;
}

if (!empty($_GET['mensaje'])) {
    $error = 'si';
} else {
    $error = 'no';
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="css/factura3.css">
    <link href="js/google-code-prettify/prettify.css" rel="stylesheet">

    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.png">
    <title>FACTURA</title>
</head>
<body>
<?php
$can = querySimple("SELECT * FROM empresa where id=1");
if ($dato = mysqli_fetch_array($can)) {
    $empresa = $dato['empresa'];
    $direccion = $dato['direccion'];
    $telefono = $dato['tel1'];
    $nit = $dato['nit'];
    //    $fecha=date("Y-m-d H:i:s");
    date_default_timezone_set('America/Asuncion');
    setlocale(LC_TIME, 'spanish');
    // $fecha = strftime("%d de %B del %Y", strtotime(date('l')));

    $pagina = $dato['web'];
    $tama = $dato['tamano'];
}
$can = querySimple("SELECT * FROM factura where factura='$factura'");
if ($datos = mysqli_fetch_array($can)) {
    $cajera = $datos['cajera'];
    $nombrecli = $datos['nombrecli'];
    $ced = $datos['cedula'];
    $fecha = strftime("%d de %B del %Y", strtotime($datos['fecha']));;
}
$can = querySimple("SELECT * FROM usuarios where usu='$cajera'");
if ($datos = mysqli_fetch_array($can)) {
    $cajera = $datos['nom'];
}

?>
<div class="container">

            <div class="invoice">

                <div class="invHeader">
                    <div class="invoiceBuss">
                        <h1 style="color: transparent !important"><?php echo $empresa; ?></h1>
<!--                        --><?php //echo $direccion;
                                ?><!--<br />-->
<!--                        --><?php //echo $telefono;
                                ?><!--<br />-->
                    </div>
                    <div class="invoiceTimbrado">

                    </div>
                </div>
                <div class="detalles">

                        <div class="detallesFlex">
                            <div class="fecha">
                                <label for=""><span style="color: transparent !important;">Fecha de Emision:</span> <span><?php echo $fecha; ?></span></label>
                            </div>
                            <div class="condicion">
<!--                                <label for="">Condicion de Venta <span style="padding-left: 18px">CONTADO <span style="padding-left: 6px">×</span></span> <span>Credito</span></label>-->
                    <?php
                    $condicion = querySimple("SELECT * FROM detalle WHERE factura='$factura'");
                    $cond = mysqli_fetch_assoc($condicion);
                    if ($cond['tipo'] === 'CONTADO') {
                        echo '<p class="contadoP">X</p>';
                    } else {
                        echo '<p class="contadoP credito">X</p>';
                    }
                    ?>
                    <!-- <p class="contadoP">X</p> -->
                            </div>
                        </div>
                        <div class="detallesCliente my-0">
                            <div class="nombreCliente">
                                <label for="" ><span style="color: transparent !important;">Senores</span> <?= $nombrecli; ?></label>
                            </div>
                            <div class="ruc">
                                <label for=""><span style="color: transparent !important">Ruc</span> <?= $ced; ?></label>
                            </div>
                        </div>
                        <div class="detallesDireccion my-0">
                            <label for=""><span style="color: transparent !important">Direccion</span> <?= $direccion; ?></label>
                        </div>

                </div>

                <table >
                <thead>
                    <tr>
                        <th style="color: transparent !important" class="tablaCant">Cantidad</th>
                        <th style="color: transparent !important" class="tablaProd">Prod</th>
                        <th style="color: transparent !important" class="tablaPrec">Precio</th>
                        <th style="color: transparent !important" class="tablaExcenta">Excentas</th>
                        <th style="color: transparent !important" class="tablaCinco">5%</th>
                        <th style="color: transparent !important" class="tablaDiez">10%</th>
                    </tr>

                </thead>
                <tbody>
                <?php
                $numero = 0;
                $valor = 0;
                $importe = 0;

                $can = querySimple("SELECT * FROM detalle where factura='$factura'");
                while ($dato = mysqli_fetch_array($can)) {
                    $numero = $numero + 1;
                    $valor = $dato['cantidad'] * $dato['valor'];
                    $iva = $dato['iva'];
                    $tipo = $dato['tipo'];
                    $iva1 = $dato['iva1'];
                    $iva2 = $dato['iva2'];
                    $totalIva = $dato['totalIva'];


                ?>
                    <tr>
                        <td class="tablaCant">
                            <?= $dato['cantidad']; ?>
                        </td>
                        <td class="tablaProd">
                        <?= $dato['nombre']; ?>
                        </td>
                        <td class="tablaPrec">
                            <?= number_format($dato['valor'], 0, ",", "."); ?>
                        </td>
                        <td class="tablaExcenta">

                        </td>
                        <td class="tablaCinco">
                        <?php

                        if ($dato['iva'] == '5') {

                            echo number_format($dato['importe'], 0, ",", ".");
                        }  ?>
                        </td>
                        <td class="tablaDiez">
                        <?php

                        if ($dato['iva'] == '10') {

                            echo number_format($valor, 0, ",", ".");
                        } ?>
                        </td>

                    </tr>
                </tbody>
            <?php } ?>
                </table>

                <div class="parcial">
                    <div class="parcialExentas">

                    </div>
                    <div class="parcial5">
                    <p>
                    <?php
                    $total5 = querySimple("SELECT SUM(importe) as neto5 FROM detalle where iva='5' and factura='$factura'");
                    if ($dato = mysqli_fetch_array($total5)) {

                        $NETO = $dato['neto5'];
                        $_SESSION['neto5'] = $NETO;
                        echo number_format($_SESSION['neto5'], 0, ",", ".");
                    } ?>
                    </p>
                    </div>
                    <div class="parcial10">
                    <p>
                    <?php
                    $total10 = querySimple("SELECT SUM(importe) as neto10 FROM detalle where iva='10' and factura='$factura'");
                    if ($dato = mysqli_fetch_array($total10)) {

                        $NETO1 = $dato['neto10'];
                        $_SESSION['neto10'] = $NETO1;
                        echo number_format($_SESSION['neto10'], 0, ",", ".");
                    } ?>
                    </p>
                    </div>
                </div>

                <div class="enLetras">
                <?php
                require_once 'helper/fromNum.php';
                echo convertirNumeroLetra($tpagar);
                ?>
                </div>

                <div class="totalP">
                <?= number_format($tpagar, 0, ",", "."); ?>
                </div>

                <div class="totalesIva">

                    <div class="totales5">
                    <?php
                    $total5 = querySimple("SELECT SUM(importe) as neto5 FROM detalle where iva='5' and factura='$factura'");
                    if ($dato = mysqli_fetch_array($total5)) {

                        $NETO = $dato['neto5'] / 21;
                        $_SESSION['neto5'] = $NETO;
                        echo number_format($_SESSION['neto5'], 0, ",", ".");
                        $query = querySimple("UPDATE detalle SET iva1='$NETO' WHERE iva='5' AND factura='$factura'");
                    } ?>
                    <!-- <?= number_format($iva1, 0, ",", "."); ?> -->
                    </div>

                    <div class="totales10">

<?php
$total10 = querySimple("SELECT SUM(importe) as neto10 FROM detalle where iva='10' and factura='$factura'");
if ($dato = mysqli_fetch_array($total10)) {

    $NETO1 = $dato['neto10'] / 11;
    $_SESSION['neto10'] = $NETO1;

    echo number_format($_SESSION['neto10'], 0, ",", ".");
    // Y ACA HACER EL QUERY DE ACTUALIZACION
    $query = querySimple("UPDATE detalle SET iva2='$NETO1' WHERE iva='10' AND factura='$factura'");
} ?>


                    <!-- <?= number_format($iva2, 0, ",", "."); ?> -->
                    </div>

                    <div class="totales">
                    <?= number_format($totalIva, 0, ",", "."); ?>
                    </div>

                </div>

            </div>
</div>

<script language="javascript">

    function imprSelec(nombre) {
        ////////
        var ficha = document.getElementById(nombre);
        var ventimp = window.open(' ', 'popimpr');
        ventimp.document.write( ficha.innerHTML );
        ventimp.document.close();
        ventimp.print( );
        ventimp.close();
    }

</script>
<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/holder/holder.js"></script>
<script src="js/google-code-prettify/prettify.js"></script>
<script src="js/application.js"></script>
<script type="text/javascript">

    window.onload=function imprSelec(muestra)
    {window.print();}



</script>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>

    </body>

</html>