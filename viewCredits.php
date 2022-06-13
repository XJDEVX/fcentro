<?php
error_reporting(E_ERROR);
if (strlen(session_id()) < 1) {
  session_start();
}
require_once 'app/php_conexion.php';
$usu = $_SESSION['username'];
$tipo_usu = $_SESSION['rol'];
$nombrecli = $_GET['nombrecli'];
if ($tipo_usu !== 'Administrador') {
  header('location:error.php');
}
require_once 'partials/header.php'; ?>
</head>

<body data-spy="scroll" data-target=".bs-docs-sidebar">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card mt-4">
          <div class="card-header bg-dark">
            <div class="row">
              <div class="col-md-6">
                <h4 class="text-light">Creditos de: <?= $nombrecli ?></h4>
                <input type="hidden" name="nombre-cli" id='nombre-cli' value='<?= $nombrecli ?>'>
              </div>
              <div class="col-md-6 text-right">
                <a href="/clientesCredito.php" target="admin" class="btn btn-light">Volver al listado de clientes</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <table id="tablaClientes" width="100%" class="table table-striped mt-2 dt-responsive">
              <thead>
                <tr>
                  <th width="30%">Producto</th>
                  <th>Valor<small>(c/ interes)</small></th>
                  <th>Cuotas</th>
                  <th>Saldo</th>
                  <th>Estado</th>
                  <th>Fin Credito</th>
                  <th width="2%">Acciones</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  require_once 'partials/feet.php';
  require_once 'partials/footer.php';
  ?>
  <script>
    const cli = document.getElementById('nombre-cli').value
    let table = $('#tablaClientes')

    table.DataTable({
      'aProcessing': true,
      'aServerSide': true,
      dom: "<'row'<'col-md-6'l><'col-md-6'f>>" +
        "<'row'<'col-md-12'Br>>" +
        "<'row'<'col-md-12't>>" +
        "<'row'<'col-md-12'ip>>", //Definimos los elementos del control de tabla
      buttons: [
        'excelHtml5',
        'csvHtml5',
        // 'pdf'
      ],
      "language": {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla =(",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        "buttons": {
          "copy": "Copiar",
          "colvis": "Visibilidad"
        }
      },
      ajax: {
        url: `php_action/actions.php?request=allCreditsOwnerClient&nombrecli=${cli}`,
        type: 'GET',
        dataType: 'JSON',
        error: msj => {
          console.log(msj)
        }
      },
      'pageLength': 10
    })
  </script>