<?php

require_once '../app/php_conexion.php';
$nombrecli = isset($_POST['nombrecli']) ? $_POST['nombrecli'] : '';

$result = mysqli_query($con, "SELECT * FROM clientes WHERE nombrecli='$nombrecli'");

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
}
echo json_encode($row);
