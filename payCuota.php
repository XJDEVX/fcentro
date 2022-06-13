<?php
if (strlen(session_id()) < 1) {
    session_start();
}
require 'vendor/autoload.php';
use Carbon\Carbon;
require_once 'app/php_conexion.php';

$creditoId = (int) $_GET['credito_id'];
$cuotaNro = $_GET['cuota_nro'];
$prod = $_GET['prod'];
$today=Carbon::now();

$updateCuota = "UPDATE cuotas SET estado='PAGADO', fecha_pago='$today' WHERE numero='$cuotaNro' AND credito_id=$creditoId";
$execUpdateCuota = querySimple($updateCuota);
// dd($execUpdateCuota);

$calcTotalSaldo = "SELECT SUM(monto) as monto FROM cuotas WHERE estado='PENDIENTE' AND credito_id=$creditoId";
$execCalcTotalSaldo = queryRow($calcTotalSaldo);
// dd($execCalcTotalSaldo);

$saldoActual = $execCalcTotalSaldo['monto'];

$updateCredito = "UPDATE credito SET saldo='$saldoActual' WHERE id=$creditoId";
$execUpdateCredito = querySimple($updateCredito);

$getSaldo = "SELECT saldo FROM credito WHERE id=$creditoId";
$execGetSaldo = queryRow($getSaldo);
$saldo = $execGetSaldo['saldo'];




header("location:viewCuotas.php?credito_id=$creditoId&prod=$prod&saldo=$saldo");
