<?php
require 'vendor/autoload.php';

use Carbon\Carbon;

// error_reporting(0);
if (strlen(session_id()) < 1) {
    session_start();
}
require_once('app/php_conexion.php');
$usuario = $_SESSION['username'];

if ($_SESSION['rol'] !== 'Administrador') {
    header('location:error.php');
}
$can = querySimple("SELECT MAX(factura) as maximo FROM factura"); //codigo de la factura
if ($dato = mysqli_fetch_array($can)) {
    $cfactura = $dato['maximo'] + 1;
}
if ($cfactura == 1) {
    $cfactura = 1000;
} //si es primera factura colocar que empieze en 1000
// $hoy=$fechay=date("Y-m-d");
// $fecha = date_format('Y-m-d', strtotime($_GET['fecha']));
$fecha = $_GET['fecha'] != 0 ? $_GET['fecha'] : strftime('%Y-%m-%d');
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';
if ($_GET['button'] == 'FACTURAR') {
    // LOGICA VENTA A CUOTAS

    $ccpago = $_GET['ccpago'];
    $tpagar = $_GET['tpagar'];
    $nombrecli = $_GET['nombrecli'];
    $cedula = $_GET['cedula'];
    $entrega = $_GET['entrega'];
    $interes = (int) $_GET['interes'];
    $cuotas = (int) $_GET['cuotas'];
    $montoInteres = (int) $_GET['monto_interes'];
    $montoPorCuota = $_GET['monto_por_cuota'];
    $primera_entrega = $_GET['primera_entrega'];

    $t_importe = 0;



    if ($tpagar >= $ccpago or $tpagar <= $ccpago) {
        //guarda tabla factura
        $factura_sql = "INSERT INTO factura (factura,cajera,nombrecli,cedula,total,fecha,estado)
                        VALUES ('$cfactura','$usuario','$nombrecli','$cedula','$tpagar','$fecha','s')";
        $factura = querySimple($factura_sql);
        //codigo de la factura / guarda en detalles
        $can = querySimple("SELECT * FROM caja_tmp where usu='$usuario'");
        while ($dato = mysqli_fetch_array($can)) {
            $cod = $dato['cod'];
            $nom = $dato['nom'];
            $cant = $dato['cant'];
            $venta = $dato['venta'];
            $importe = $dato['importe'];
            $t_importe = $t_importe + $importe;
            $iva = (int) $dato['iva'];

            //					$canVenta = querySimple("SELECT SUM(venta) FROM caja_tmp WHERE usu='$usuario'");
            //					while($data = mysqli_fetch_array($canVenta))
            //                    {
            //                        $venta = $data['venta'];
            //                    }
            $iva1 = 0;
            $iva2 = 0;
            if ($iva == '10') {
                $iva2 += $venta / 11;
            } else {
                $iva1 += $venta / 21;
            }
            $totalIva = $iva1 + $iva2;
            //                    $iva = $dato['iva'];
            $detalle_sql2 = "INSERT INTO detalle (factura, codigo, nombre, cantidad, valor,
                                        importe,iva,iva1, iva2, totalIva, total, tipo)
						                VALUES ('$cfactura','$cod','$nom','$cant','$venta',
                                        '$importe','$iva','$iva1', '$iva2','$totalIva','$tpagar','$tipo')";
            $querySimpleDetalle = querySimple($detalle_sql2);

            ////////////// CREAR CREDITO ////////////////////////
            $detalleID = queryID($querySimpleDetalle);

            $fechaInicio = Carbon::now();
            $fechaFin = Carbon::now()->addMonth($cuotas);

            $sqlCredito = "INSERT INTO credito ( cliente, usuario_caja, detalle_id, fecha_inicio,
                                fecha_fin, entrega, interes, total_cuotas, total_con_interes )
                                VALUES ( '$nombrecli', '$usuario', $detalleID, '$fechaInicio',
                                '$fechaFin', '$entrega', $interes, $cuotas, $montoInteres )";


            $querySimpleCredito = querySimple($sqlCredito);

            /////////////// CREAR CUOTAS /////////////////////////
            $creditoID = queryID($querySimpleCredito);
            // $fechaDelPago = Carbon::now();
            $actual = Carbon::now();
            $actual2 = Carbon::now()->addDays(5);
            for ($i = 1; $i <= $cuotas; $i++) {
                $fechaDelPago = $actual->addMonth();
                $fechaVencimiento = $actual2->addMonth();
                $sqlCrearCuota = "INSERT INTO cuotas ( credito_id, numero, monto, fecha_a_pagar, vencimiento )
                                VALUES ( '$creditoID', '$i', '$montoPorCuota', '$fechaDelPago', '$fechaVencimiento' )";
                $querySimpleCuota = querySimple($sqlCrearCuota);
            }

            if (isset($primera_entrega) && $primera_entrega !== "0") {
                $sqlActualizarPrimeraCuota = "UPDATE cuotas SET estado = 'PAGADO', fecha_pago='$actual' WHERE numero='1' AND credito_id='$creditoID'";
                $queryActualizarPrimeraCuota = querySimple($sqlActualizarPrimeraCuota);
            }

            ////ACTUALIZAR SALDO//////////////////
            $countCuotasPendientesSql = "SELECT SUM(monto) as monto FROM cuotas WHERE estado='PENDIENTE' AND credito_id='$creditoID'";
            $countCuotasPendientes = queryRow($countCuotasPendientesSql)['monto'];
            $updateCreditoSql = "UPDATE credito SET saldo='$countCuotasPendientes' WHERE detalle_id=$detalleID";
            $updateCredito = querySimple($updateCreditoSql);

            ////ACTUALIZAR LA EXISTENCIA//////////////////
            $ca = querySimple("SELECT * FROM producto where cod='$cod'");
            if ($date = mysqli_fetch_array($ca)) {
                $e_actual = $date['cantidad'];
            }
            $n_cantidad = $e_actual - $cant;
            if ($n_cantidad < 0) {
                $n_cantidad = 0;
            } // si la cantidad da negativo ponerlo en 0
            $sqlCantidad2 = "Update producto Set cantidad='$n_cantidad' Where cod='$cod'";
            $actualizarCant = querySimple($sqlCantidad2);
            /////////////////////////////////////////////
        }
        $borrar_sql = "DELETE FROM caja_tmp WHERE usu='$usuario'"; //borrar todo de la caja temporal
        $borrarCaja = querySimple($borrar_sql);
        header('location:realizadofactCredito.php');
    } else {
        header('location:ticket.php?mensaje=error');
    }
}
$_SESSION['ddes'] = 0;
// DELETE FROM factura;
// DELETE FROM detalle;
// DELETE FROM credito;
// DELETE FROM cuotas;
// ALTER TABLE detalle AUTO_INCREMENT=1;
// ALTER TABLE credito AUTO_INCREMENT=1;
// ALTER TABLE cuotas AUTO_INCREMENT=1;
