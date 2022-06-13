<?php
require_once('app/php_conexion.php');
session_start();
if ($_POST) {
	$usuario=$_SESSION['username'];
	$usua = $_POST['username'];
	$nombrecli = $_POST['nombrecli'];
	$startDate = $_POST['startDate'];
	$endDate = $_POST['endDate'];
	$sql = querySimple("SELECT factu.cajera,detalle.factura,detalle.codigo, factu.fecha, factu.factura,factu.nombrecli,detalle.nombre,detalle.valor, detalle.importe
	FROM factura as factu
	inner join detalle
	WHERE fecha >='$startDate' AND fecha <= '$endDate'
	AND factu.factura=detalle.factura  AND  factu.nombrecli='$nombrecli' and detalle.factura=factu.factura and factu.cajera='$usua' AND factu.estado='s'");
	//$sql = querySimple("SELECT * FROM factura WHERE fecha >= '$start_date' AND fecha <= '$end_date' ");
	echo '<strong><h2>Usuario:' . $usuario. '</h2></strong>';
	echo '<strong><h2>Cliente:' . $nombrecli . '</h2></strong>';
	echo '<br>';
	echo '<br>';
	echo '<strong><h3>Desde:   ' . $startDate . ' <br>  Hasta:    ' . $endDate . '</h3> </strong>';
	$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		<tr>
<tr>
			<th>Fecha</th>
			<th>NÂ° de factura</th>
			<th>detalles</th>
			<th>precio Uni.</th>
			<th>Monto</th>
		</tr>
		<tr>';
	$importe = 0;
	while ($dato = mysqli_fetch_array($sql)) {
		$table .= '<tr>
				<td><center>' . date('d/m/Y', strtotime($dato['fecha'])) . '</center></td>
				<td><center>' . $dato['factura'] . '</center></td>
				<td><center>' . $dato['nombre'] . '</center></td>
				<td><center>' . $dato['valor'] . '</center></td>
				<td><center aling="left">' . number_format($dato['importe'], 0, ",", ".");
		'</center></td>
			</tr>';
		$importe += $dato['importe'];
	}
	$table .= '
		</tr>
		<tr>
			<td colspan="8" align="right"><strong>Total:' . number_format($importe, 0, ",", ".");
	' </strong></td>
		</tr>
	</table>
	';
	echo $table;
}
