<?php
if (strlen(session_id()) < 1) {
	session_start();
}
require_once('app/php_conexion.php');
$usu = $_SESSION['username'];
$tipo_usu = $_SESSION['rol'];
if ($_SESSION['rol'] !== 'Administrador') {
	header('location:error.php');
}
require_once('partials/header.php');
?>
<div class="container-fluid">
    <?php
$sql = querySimple("SELECT factu.fecha, factu.factura, d.nombre, d.importe, factu.cajera
FROM factura as factu inner join detalle as d ON factu.factura=d.factura WHERE fecha = CURDATE() AND factu.estado = 's'");
//$sql = querySimple("SELECT * FROM factura WHERE fecha >= '$start_date' AND fecha <= '$end_date' ");
echo '<strong><h2>Cierre de Caja</h2>
<form action="today_report.php" id="getTodaySaleForm" method="POST">
                <button class="btn btn-primary mb-2"><i class="fa fa-print"></i> IMPRIMIR</button>
            </form>
</strong>';
$table = '
<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
    <tr>
<tr>
        <th>Fecha</th>
        <th>N° de Venta</th>
        <th>Cajero/a</th>
        <th>detalles</th>
        <th>Monto</th>
    </tr>

    <tr>';
$importe = 0;
while ($dato = mysqli_fetch_array($sql)) {
$table .= '<tr>
            <td><center>' . date('d/m/Y', strtotime($dato['fecha'])) . '</center></td>
            <td><center>' . $dato['factura'] . '</center></td>
            <td><center>' . $dato['cajera'] . '</center></td>
            <td><center>' . $dato['nombre'] . '</center></td>
            <td><center>' . number_format($dato['importe'], 0, ",", ".");
'</center></td>
        </tr>';
$importe += $dato['importe'];
}
$table .= '
    </tr>
    <tr>
        <td colspan="5" align="right" style="font-size: 30px"><strong>Total:' . number_format($importe, 0, ",", ".");
' </strong></td>
    </tr>
</table>
';
echo $table;
?>
</div>
<?php
	require_once('partials/feet.php');
	require_once('partials/footer.php');
	?>
<script src="report.js"></script>