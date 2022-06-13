<?php
require_once '../app/php_conexion.php';
$cedula = isset($_POST['empresa']) ? $_POST['empresa'] : '';

$result = mysqli_query($con, "SELECT * FROM proveedor WHERE empresa='$cedula'");

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
}
echo json_encode($row);
