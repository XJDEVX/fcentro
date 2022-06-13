<?php
if (strlen(session_id()) < 1) {
    session_start();
}
require 'vendor/autoload.php';

use Carbon\Carbon;

require_once 'app/php_conexion.php';
$usu = $_SESSION['username'];
$tipo_usu = $_SESSION['rol'];
$creditoId = (int) $_GET['credito_id'];
$prod = $_GET['prod'];
$saldo = $_GET['saldo'];
if ($tipo_usu !== 'Administrador') {
    header('location:error.php');
}
require_once 'partials/header.php'; ?>
</head>

<style>
    .card-info-cuota {
        background-color: #d2d2d2;
        border-radius: .4rem;
        padding: 1rem .8rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .card-info-cuota h3 {
        font-size: 1.2rem;
    }

    .card-info-cuota span {
        font-size: 1.5rem;
    }

    .card-info-cuota.prod span {
        font-size: 1rem;
        margin-left: 1rem;
    }
</style>

<body data-spy="scroll" data-target=".bs-docs-sidebar">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <?php
                $sqlCuota = "SELECT
                        cuo.credito_id,
                        cred.cliente,
                        cuo.numero,
                        cuo.monto,
                        cuo.fecha_pago,
                        cuo.fecha_a_pagar,
                        cuo.vencimiento,
                        cuo.estado,
                        cred.id
                    FROM cuotas as cuo
                    INNER JOIN credito as cred
                    ON cuo.credito_id=cred.id
                    WHERE cuo.credito_id='$creditoId'";
                $querySqlCuota = querySimple($sqlCuota);
                $arrCuotas = [];
                foreach ($querySqlCuota as $cuota) {
                    $cuota['estado'] === 'PAGADO'
                    ? $btnPayCuota = "<p><small>Pagado el {$cuota['fecha_pago']}</small></p>"
                    : $btnPayCuota = '<a href="payCuota.php?credito_id=' . $creditoId . '&cuota_nro=' . $cuota['numero'] . '&prod=' . $prod . '" target="admin" class="btn btn-dark px-2 py-2"><i class="fa fa-check"></i> Pagar</a>';
                    $diasMora = Carbon::parse($cuota['vencimiento'])->diffInDays(Carbon::now(), false);
                    $arrCuotas[] = [
                        0 => $cuota['numero'],
                        1 => $cuota['monto'],
                        2 => Carbon::parse($cuota['fecha_a_pagar'])->format('d-m-Y'),
                        3 => Carbon::parse($cuota['vencimiento'])->toFormattedDateString(),
                        4 => $cuota['estado'] == 'PENDIENTE' ? $diasMora : 'Cuota Pagada',
                        5 => $diasMora > -1 ? (($cuota['monto'] * 8) / 100) * $diasMora + $cuota['monto'] : $cuota['monto'],
                        6 => $cuota['estado'] == 'PENDIENTE'
                            ? '<span class="badge badge-info">Pendiente</span>'
                            : '<span class="badge badge-danger">Pagado</span>',
                        7 => $btnPayCuota
                    ];
                }
                ?>
                <div class="card mt-4">
                    <div class="card-header bg-dark">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="text-light">Total de Cuotas: <?= $cuota['numero'] ?> <small>(id del credito: <?= $cuota['credito_id'] ?>)</small></h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="/viewCredits.php?nombrecli=<?= $cuota['cliente'] ?>" target="admin" class="btn btn-light">Volver al listado de creditos</a>
                                <a href="/clientesCredito.php" target="admin" class="btn btn-light">Volver al listado de clientes</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card-info-cuota prod">
                                    <h3>Producto</h3>
                                    <span><?= $prod ?></span>
                                </div>
                                <div class="card-info-cuota">
                                    <h3>Saldo</h3>
                                    <span><?= number_format($saldo, 0, ',', '.') ?> Gs</span>
                                </div>
                                <h3></h3>
                            </div>
                            <div class="col-md-9">
                                <table width="100%" class="table table-striped mt-2 table-responsive">
                                    <thead>
                                        <tr>
                                            <th>N° Cuota</th>
                                            <th>Monto</th>
                                            <th>Fecha a pagar</th>
                                            <th>Vencimiento</th>
                                            <th>Atraso</th>
                                            <th>c/Interes</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($arrCuotas as $c) {
                                            echo "<tr>
                                                    <td>{$c[0]}</td>
                                                    <td>{$c[1]}</td>
                                                    <td>{$c[2]}</td>
                                                    <td>{$c[3]}</td>
                                                    <td>{$c[4]}</td>
                                                    <td>{$c[5]}</td>
                                                    <td>{$c[6]}</td>
                                                    <td>{$c[7]}</td>
                                                </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once 'partials/feet.php';
    require_once 'partials/footer.php';
    ?>