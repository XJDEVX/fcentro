<?php
if (strlen(session_id()) < 1) {
    session_start();
}
require_once 'app/php_conexion.php';
$usu = $_SESSION['username'];
$tipo_usu = $_SESSION['rol'];
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
                                <h4 class="text-light">Consultar Creditos</h4>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="tablaClientes" width="100%" class="table table-striped mt-2 dt-responsive">
                            <thead>
                                <tr>
                                    <th width="20%"><strong>Nombre y Apellido</strong></th>
                                    <th width="10%"><strong>cedula</strong></th>
                                    <th width="20%"><strong>celular</strong></th>
                                    <th width="14%"><strong>Direccion</strong></th>
                                    <th width="20%">Acciones</th>
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
                url: 'php_action/actions.php?request=allClientsCredit',
                type: 'GET',
                dataType: 'JSON',
                error: msj => {
                    console.log(msj)
                }
            },
            'pageLength': 10
        })
    </script>