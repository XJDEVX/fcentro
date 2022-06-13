<?php
error_reporting(E_ERROR);
if (strlen(session_id()) < 1) {
  session_start();
}
require 'app/php_conexion.php';
if ($_SESSION['rol'] !== 'Administrador') {
  header('location:error.php');
}
require 'partials/header.php';
?>
</head>

<body data-spy="scroll" data-target=".bs-docs-sidebar">
  <div class="container-fluid pt-2">
    <div class="row pl-2">
      <h3>Panel de Control</h3>
    </div>
    <div class="row justify-content-center">

      <div class="col-md-6">
        <div class="row">
          <div class="col-md-6">
            <div class="card shadow bg-dark text-white text-center p-3 mb-3">
              <blockquote class="blockquote mb-0">
                <div class="row">
                  <div class="col-md-3">
                    <i class="fa fa-shopping-cart fa-2x"></i>
                  </div>
                  <div class="col-md-9">
                    <h4 class="font-weight-bold">Total de Ventas</h4>
                    <?php
                    $sql = "SELECT SUM(total) as total FROM detalle";
                    $query = mysqli_query($con, $sql);
                    if ($query->num_rows < 1) {
                      echo "No hay registros";
                    } else {
                      $data = mysqli_fetch_object($query);
                      echo $data->total . ' GS';
                    }
                    ?>
                  </div>
                </div>
              </blockquote>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card shadow bg-dark text-white text-center p-3 mb-3">
              <blockquote class="blockquote mb-0">
                <div class="row">
                  <div class="col-md-3">
                    <i class="fa fa-archive fa-2x"></i>
                  </div>
                  <div class="col-md-9">
                    <h4 class="font-weight-bold">Inventario</h4>
                    <?php
                    $sql = "SELECT COUNT(*) as total FROM producto";
                    $query = mysqli_query($con, $sql);
                    $data = mysqli_fetch_object($query);
                    echo $data->total . ' Productos';
                    ?>
                  </div>
                </div>
              </blockquote>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card shadow bg-dark text-white text-center p-3 mb-3">
              <blockquote class="blockquote mb-0">
                <div class="row">
                  <div class="col-md-3">
                    <i class="fa fa-calendar-check-o fa-2x"></i>
                  </div>
                  <div class="col-md-9">
                    <h4 class="font-weight-bold">Ventas de Hoy</h4>
                    <?php
                    $query = mysqli_query($con, "SELECT COUNT(*) FROM factura WHERE fecha=CURDATE()");
                    $count = mysqli_fetch_array($query);
                    $queryTotal = mysqli_query($con, "SELECT SUM(total) FROM factura WHERE fecha=CURDATE()");
                    $countTotal = mysqli_fetch_array($queryTotal);
                    ?>
                    <p>Nro de Ventas: <?= $count[0] ?></p>
                    <p>Recaudado: <?= $countTotal[0] ?> Gs</p>
                  </div>
                </div>
              </blockquote>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div> <!-- Container fluid =================== -->