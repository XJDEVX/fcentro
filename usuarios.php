<?php
if (strlen(session_id()) < 1) {
  session_start();
}
require_once 'app/php_conexion.php';
$usu = $_SESSION['username'];
$tipo_usu = $_SESSION['rol'];
if ($_SESSION['rol'] !== 'Administrador') {
  header('location:error.php');
}
require_once 'partials/header.php'; ?>
</head>

<body data-spy="scroll" data-target=".bs-docs-sidebar">
  <div class="container-fluid my-4">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card">
          <div class="card-header bg-dark">
            <div class="row align-items-center">
              <div class="col-md-6">
                <h4 class="text-light">Usuarios</h4>
              </div>
              <div class="col-md-6">
                <div class="btn-group float-right" data-toggle="buttons-checkbox">
                  <button type="button" class="btn btn-success" onClick="window.location='crear_usuarios.php'"><i class="fa fa-plus"></i> Ingresar Nuevo</button>
                  <!-- <button type="button" class="btn btn-secondary" onClick="window.location='PDFusuarios.php'"><i class="fa fa-file-pdf-o"></i> Reporte PDF</button> -->
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <table id="tablaUsuarios" width="100%" class="table table-striped dt-responsive mt-2">
              <thead>
                <tr>
                  <th width="30%"><strong>Nombre y Apellido</strong></th>
                  <th width="16%"><strong>Cedula</strong></th>
                  <th width="13%"><strong>Usuario</strong></th>
                  <th width="14%"><strong>Celular</strong></th>
                  <th width="2%"><strong>Rol</strong></th>
                  <th width="7%"><strong>Estado</strong></th>
                  <th width="20%"><strong>Acciones</strong></th>
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
    var table = $('#tablaUsuarios')
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
        url: 'php_action/actions.php?request=allUsers',
        type: 'GET',
        dataType: 'JSON',
        error: msj => {
          console.log(msj)
        }
      },
      'pageLength': 10
    })
    fetchUsers()

    function deleteUser(id) {
      Swal.fire({
        position: 'top',
        title: 'Desea Borrar al usuario del sistema?',
        text: "Los datos tambien se borraran de la base de datos!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI!',
        cancelButtonText: 'NO!',
      }).then((result) => {

        if (result.value) {
          $.ajax({
            url: 'app/php_eliminar_usuario.php?id=' + id,
            type: 'GET',
            success: data => {

              Swal.fire({
                position: 'top',
                icon: 'success',
                title: data,
                showConfirmButton: false,
                timer: 1500
              })
              setTimeout(function() {
                window.location.href = 'usuarios.php'
              }, 1600)
            }
          })
        }
      })
      // confirm("Desea Eliminar el usuario?");
    }
  </script>