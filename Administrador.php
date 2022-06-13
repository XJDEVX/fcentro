<?php
session_start();
require 'app/php_conexion.php';
require 'app/Globals.php';
if (!$_SESSION['rol']) {
  header('location:error.php');
}
if ($_SESSION['rol'] == 'Administrador') {
  $titulo = 'Sistema de Facturacion';
} else {
  $titulo = 'Cajero/a';
}
$empresa = 'Fcentro';
require_once 'partials/header.php';
require_once 'partials/navbar.php';
require_once 'partials/themeSelector.php';
require_once 'partials/sidebar.php';
?>

<div class="main-panel">
  <!-- <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        Panel de Control
      </h3>
    </div>
    <div class="row grid-margin">
      <div class="col-12">
        <div class="card card-statistics">
          <div class="card-body">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
              <div class="statistics-item">
                <p>
                  <i class="icon-sm fa fa-user mr-2"></i>
                  Usuarios
                </p>
                <h2>Cantidad</h2>
                <a href="#" class="btn btn-outline-success btn-rounded">
                  Ir al modulo
                </a>
              </div>
              <div class="statistics-item">
                <p>
                  <i class="icon-sm fas fa-hourglass-half mr-2"></i>
                  Ventas de Hoy
                </p>
                <h2>Cantidad</h2>
                <a href="#" class="btn btn-outline-success btn-rounded">
                  Ir al modulo
                </a>
              </div>
              <div class="statistics-item">
                <p>
                  <i class="icon-sm fas fa-cloud-download-alt mr-2"></i>
                  Compras de Hoy
                </p>
                <h2>Cantidad</h2>
                <a href="#" class="btn btn-outline-success btn-rounded">
                  Ir al modulo
                </a>
              </div>
              <div class="statistics-item">
                <p>
                  <i class="icon-sm fas fa-check-circle mr-2"></i>
                  Total Ventas
                </p>
                <h2>Cantidad</h2>
                <a href="#" class="btn btn-outline-success btn-rounded">
                  Ir al modulo
                </a>
              </div>
              <div class="statistics-item">
                <p>
                  <i class="icon-sm fas fa-chart-line mr-2"></i>
                  Total Compras
                </p>
                <h2>Cantidad</h2>
                <a href="#" class="btn btn-outline-success btn-rounded">
                  Ir al modulo
                </a>
              </div>
              <div class="statistics-item">
                <p>
                  <i class="icon-sm fas fa-circle-notch mr-2"></i>
                  Inventario bajo
                </p>
                <h2>Cantidad</h2>
                <a href="#" class="btn btn-outline-success btn-rounded">
                  Ir al modulo
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->

  <iframe src="caja.php" class="p-0" frameborder="0" scrolling="auto" name="admin" width="100%" height="1000"></iframe>
  <?php
  require_once 'partials/footer.php';
  ?>