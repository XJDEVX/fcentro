<?php
if (strlen(session_id()) < 1) {
    session_start();
}
require_once('app/php_conexion.php');
$usu = $_SESSION['username'];
$tipo_usu = $_SESSION['rol'];
if ($_SESSION['rol'] !== 'Administrador') {
    header('location:error.php');
}
$factura = $_GET['factura'];
require_once('partials/header.php');
?>
</head>

<body data-spy="scroll" data-target=".bs-docs-sidebar">
    <div class="container my-4">
        <div class="row justify-content-between mb-5">
            <div class="col-md-6">
                <h3>Detalles de la Factura Nro: <?= $factura ?></h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="facturas.php" target="admin" class="btn btn-sm btn-secondary">
                    Volver al listado de Facturas
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?php
                $sql = "SELECT * FROM factura WHERE factura = '$factura' GROUP BY factura";
                $query = querySimple($sql);
                while ($detail = mysqli_fetch_object($query)) :
                    $requestDisabled = '';
                    if ($detail->estado === 'Anulado') {
                        $requestDisabled = 'disabled';
                    } else {
                        $requestDisabled = '';
                    }
                ?>
                    <div class="mb-3">
                        <h5>Factura Nro:</h5>
                        <p><?= $detail->factura ?></p>
                    </div>
                    <div class="mb-3">
                        <h5>Cajero:</h5>
                        <p><?= $detail->cajera ?></p>
                    </div>
                    <div class="mb-3">
                        <h5>Cliente:</h5>
                        <p><?= $detail->nombrecli ?></p>
                    </div>
                    <div class="mb-3">
                        <h5>Fecha de la Transaccion:</h5>
                        <p><?= date('d-m-Y', strtotime($detail->fecha)) ?></p>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="col-md-8">
                <!-- <?php
                        $sql2 = "SELECT * FROM detalle WHERE factura = '$factura' GROUP BY tipo";
                        $query2 = querySimple($sql2);
                        while ($detail2 = mysqli_fetch_object($query2)) :
                        ?>
                    <div class="mb-3">
                        <h5>Tipo de Factura:</h5>
                        <p><?= $detail2->tipo ?></p>
                        <div class="total mt-4">
                            <h2>TOTAL: <?= $detail2->total ?> Gs</h2>
                        </div>
                    </div>
                <?php endwhile; ?> -->
                <div class="mb-3">
                    <h5>Productos:</h5>
                    <table class="table table-sm table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>IVA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql3 = "SELECT * FROM detalle WHERE factura = '$factura'";
                            $query3 = querySimple($sql3);
                            while ($detail3 = mysqli_fetch_object($query3)) :
                            ?>
                                <tr>
                                    <td><?= $detail3->nombre ?></td>
                                    <td><?= $detail3->cantidad ?></td>
                                    <td><?= $detail3->valor ?></td>
                                    <td><?= $detail3->iva ?>%</td>
                                </tr>

                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <button onclick="anularVenta(<?= $factura ?>)" target="admin" class="btn btn-danger btn-block <?= $requestDisabled; ?>">
                    <i class="fa fa-trash"></i> Anular
                </button>
            </div>
            <!-- <div class="col-md-4">
                <a href="anularFactura.php?factura=<?= $factura ?>" target="admin" class="btn btn-success btn-block <?= $requestDisabled; ?>">
                    <i class="fa fa-floppy-o"></i> Reimprimir
                </a>
            </div> -->
        </div>
    </div>
    <?php
    require_once('partials/feet.php');
    require_once('partials/footer.php');
    ?>
    <script>
        function anularVenta(inv) {
            Swal.fire({
                position: 'top',
                title: 'Desea Anular esta Venta?',
                text: "Si la venta se anula permanecera como anulada pero el stock de los productos volveran a su cantidad anterior a la venta!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI!',
                cancelButtonText: 'NO!',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: 'app/anularFactura.php?factura=' + inv,
                        type: 'GET',
                        success: data => {

                            Swal.fire({
                                position: 'top',
                                icon: 'success',
                                title: 'Venta Anulada',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            setTimeout(function() {
                                window.location.href = 'facturas.php'
                            }, 1600)
                        }
                    })

                }
            })
            // confirm("Desea Eliminar el usuario?");
        }
    </script>