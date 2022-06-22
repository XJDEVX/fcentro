<?php
if ($_SESSION['rol'] !== 'Administrador' && $_SESSION['rol'] !== 'Empleado') {
    header('location:error.php');
}