<?php
require_once('app/php_conexion.php');
if ($_POST) {
	$prov = $_POST['empresa'];
	$startDate = $_POST['startDate'];
	$endDate = $_POST['endDate'];
	$sql = querySimple("SELECT factu.fecha, factu.factura,factu.prov,detallecompra.nombre, detallecompra.importe FROM facturacompra as factu inner join detallecompra WHERE fecha >='$startDate' AND fecha <= '$endDate' AND factu.factura=detallecompra.factura AND factu.prov='$prov'");
	//$sql = querySimple("SELECT * FROM factura WHERE fecha >= '$start_date' AND fecha <= '$end_date' ");
	echo '<strong><h2>Proveedor:' . $prov . '</h2></strong>';
	echo '<br>';
	echo '<br>';
	echo '<strong><h3>Desde:   ' . $startDate . ' <br>  Hasta:    ' . $endDate . '</h3> </strong>';
	$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		<tr>
<tr>
			<th>Fecha</th>
			<th>N° de Venta</th>
			<th>detalles</th>
			<th>Monto</th>
		</tr>

		<tr>';
	$importe = 0;
	while ($dato = mysqli_fetch_array($sql)) {
		$table .= '<tr>
				<td><center>' . date('d/m/Y', strtotime($dato['fecha'])) . '</center></td>
				<td><center>' . $dato['factura'] . '</center></td>
				<td><center>' . $dato['prov'] . '</center></td>
				<td><center>' . number_format($dato['importe'], 0, ",", ".");
		'</center></td>
			</tr>';
		$importe += $dato['importe'];
	}
	$table .= '
		</tr>
		<tr>
			<td colspan="4" align="right"><strong>Total:' . number_format($importe, 0, ",", ".");
	' </strong></td>
		</tr>
	</table>
	';
	echo $table;
}