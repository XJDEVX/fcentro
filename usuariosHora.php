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
                                <h4 class="text-light">Usuarios por Horario de Ultimo Ingreso y Salida</h4>
                            </div>
                            <div class="col-md-6">
                                <!-- <div class="btn-group float-right" data-toggle="buttons-checkbox">
                                    <button type="button" class="btn btn-success" onClick="window.location='crear_usuarios.php'"><i class="fa fa-plus"></i> Ingresar Nuevo</button>
                                    <button type="button" class="btn btn-secondary" onClick="window.location='PDFusuarios.php'"><i class="fa fa-file-pdf-o"></i> Reporte PDF</button>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="tablaUsuarios" width="100%" class="table table-striped dt-responsive mt-2">
                            <thead>
                                <tr>
                                    <th width="30%"><strong>Nombre y Apellido</strong></th>
                                    <th>Rol del Usuario</th>
                                    <th>Ultima Entrada</th>
                                    <th>Ultima Salida</th>
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
                url: 'php_action/actions.php?request=allUsersTime',
                type: 'GET',
                dataType: 'JSON',
                error: msj => {
                    console.log(msj)
                }
            },
            'pageLength': 10
        })
        fetchUsers()
    </script>