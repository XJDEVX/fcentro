<?php
$con = new mysqli(
	'localhost',
	'root',
	'',
	'fcentro'
);
$con->query("SET NAMES 'utf-8'");
if ($con->connect_errno) {
	printf("ERROR EN LA CONEXION CON LA BASE DE DATOS", $con->connect_error);
	die();
}
if (!function_exists('querySimple')) {
	function querySimple($sql)
	{
		global $con;
		$query = $con->query($sql);
		return $query;
	}
	function queryRow($sql)
	{
		global $con;
		$query = $con->query($sql);
		$row = $query->fetch_assoc();
		return $row;
	}
	function queryID($sql)
	{
		global $con;
		$query = $con->query($sql);
		return $con->insert_id;
	}
}

function dd($parameter)
{
	var_dump($parameter);
	die();
}

date_default_timezone_set('America/Asuncion');
setlocale(LC_TIME, 'Spanish');
// setlocale(LC_TIME, 'es_ES');
