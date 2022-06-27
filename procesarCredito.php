<?php
error_reporting('E_NOTICE');
if (strlen(session_id()) < 1) {
    session_start();
}
require 'app/php_conexion.php';

require_once 'helper/sessionCheck.php';
require_once 'partials/header.php'; ?>
</head>

<body data-spy="scroll" data-target=".bs-docs-sidebar" id="body1">
    <div class="container-fluid pt-4 p-3">
        <div class="row mt-5 mt-lg-0 alig-items-center">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>Detalles del Credito</h4>
                    <a href="caja_credito.php" target="admin" class="btn btn-light">
                        <i class="fas fa-arrow-left"></i>
                        Ir atras
                    </a>
                </div>
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="alert alert-info">
                            <h5>Total: <?= number_format( $_SESSION['neto'], 0, ',', '.' ); ?> GS</h5>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="alert alert-warning">
                            <h5>Entrega: <?= number_format( $_SESSION['neto'], 0, ',', '.' ); ?> GS</h5>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="alert alert-success">
                            <h5>Saldo Total: <?= number_format( $_SESSION['neto'], 0, ',', '.' ); ?> GS</h5>
                        </div>
                    </div>
                </div>
                 <form id="form1" name="contado" method="get" action="contado_cuota.php">
                    <input type="hidden" name="ccpago" value=<?= $_SESSION['neto'] ?> >
                        <div class="row">
                            <div class="col-md-4">

                                <div class="form-group">
                                    <label>NOMBRE DEL CLIENTE </label>
                                    <select id="nombrecli" class="form-control mySelect" required="" name="nombrecli">
                                        <?php
                                        $can = mysqli_query($con, "SELECT * FROM clientes where estado='1'");
                                        while ($dato = mysqli_fetch_array($can)) {
                                        ?>
                                            <option value="<?php echo $dato['nombrecli']; ?>" <?php if ($nombrecli == $dato['nombrecli']) {
                                                                                                    echo 'selected';
                                                                                                } ?>>
                                                <?php echo $dato['nombrecli']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group m-0 p-0">
                                    <label for="cedula">Cedula/RUC</label>
                                    <input type="text" readonly name="cedula" id="cedula" class="form-control form-control-sm">
                                </div>
                                <div class="form-group mt-2 p-0">
                                    <label for="cedula">Direccion</label>
                                    <input type="text" readonly name="direccion" id="direccion" class="form-control form-control-sm">
                                </div>
                                <div class="form-group mt-1 p-0">
                                    <label for="celular">Telefono/celular</label>
                                    <input type="text" readonly name="celular" id="celular" class="form-control form-control-sm">
                                </div>
                                <div class="form-group mt-4">
                                    <a href="crear_clientes.php" target="admin" class="btn btn-block btn-inverse-info">
                                        Crear Nuevo Cliente
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cuotas">Numero de Cuotas</label>
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-primary py-3 rounded-0" id="min-btn"><i class="fas fa-minus"></i></button>
                                        <input name="cuotas" placeholder="Ingrese la cantidad" type="number" id="cuotas" class="form-control rounded-0" required readonly />
                                        <button class="btn btn-dark py-3 rounded-0" id="max-btn"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="vencimiento">Vencimiento de la Primera cuota</label>
                                    <input name="vencimiento" id="vencimiento"
                                    type="text" disabled value="22/22/22" class="form-control" required />
                                </div>
                                <div class="form-group">
                                    <label for="vencimiento_total">Vencimiento del Credito</label>
                                    <input name="vencimiento_total" id="vencimiento_total"
                                    type="text" disabled value="22/22/22" class="form-control" required />
                                </div>
                                       -->
                                <div class="form-group">
                                    <input type="hidden" name="tpagar" id="tpagar" value="<?php echo $_SESSION['neto']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="interes">TASA DE INTERES %:</label>
                                    <input type="number" readonly class="form-control form-control-sm" name="interes" id="interes">
                                </div>
                                <div class="form-group">
                                    <label for="monto_interes">MONTO MAS INTERES:</label>
                                    <input type="number" readonly class="form-control form-control-sm" name="monto_interes" id="monto_interes">
                                </div>
                                <div class="form-group">
                                    <label for="monto_por_cuota">MONTO POR CUOTA:</label>
                                    <input type="number" readonly class="form-control form-control-sm" name="monto_por_cuota" id="monto_por_cuota">
                                </div>


                            </div>

                            <div class="col-md-4">

                                <div class="form-group" id='plan-pago'>
                                    <label for="plan_pago">Plan de Pago</label><br>
                                    <label for="">
                                        Con Entrega
                                        <input type="radio" name="entrega" value="Y" id="si_entrega">
                                    </label>
                                    <label for="">
                                        Sin Entrega
                                        <input type="radio" name="entrega" value="N" checked id="no_entrega">
                                    </label>
                                </div>
                                <div class="form-group" id='valor-entregar'>
                                    <label for="primera_entrega">Valor a Entregar</label>
                                    <input name="primera_entrega" id="primera_entrega" placeholder="Ingrese el monto" value="0" type="number" class="form-control" required readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-group mb-3">
                                <div class="d-flex w-50">
                                    <button type="submit" class="mt-4 ml-2 btn btn-dark btn-lg w-100" name="button" id="button" value="FACTURAR"><i class="fa fa-money" aria-hidden="true"></i> PROCESAR VENTA A CREDITO</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
                </div>

<?php require_once "partials/footer.php" ?>
<script src="assets/js/quotesActions.js"></script>
<script>
        var cliente = $('#nombrecli');
        const tPagar = document.getElementById('tpagar')
        const cuotas = document.getElementById('cuotas')
        const interes = document.getElementById('interes')
        const montoInteres = document.getElementById('monto_interes')
        const montoPorCuota = document.getElementById('monto_por_cuota')
        const primeraEntrega = document.getElementById('primera_entrega')
        const siEntrega = document.getElementById('si_entrega')
        const noEntrega = document.getElementById('no_entrega')
        const minBtn = document.getElementById('min-btn')
        const maxBtn = document.getElementById('max-btn')

        let count = localStorage.getItem('nro-cuotas') || 1;

        const handleMinCount = (e) => {
            e.preventDefault()
            count--
            if( count < 1 ) count = 1
            cuotas.value = count
            localStorage.setItem('nro-cuotas', count)
            quotesActions()
        }

        const handleMaxCount = (e) => {
            e.preventDefault()
            count++
            if( count > 24 ) count = 24
            cuotas.value = count
            localStorage.setItem('nro-cuotas', count)
            quotesActions()
        }

        minBtn.addEventListener('click', handleMinCount)
        maxBtn.addEventListener('click', handleMaxCount)
        let quoteTax = localStorage.getItem('quote-tax') || 0
        document.addEventListener( 'DOMContentLoaded', () => {

            cuotas.value = 1
            const getCuotasPercentFunc = async () => {
                try {
                    const resp = await fetch('/php_action/actions.php?request=getEmpresaData')
                    const {cuota_percent} = await resp.json()
                    quoteTax = cuota_percent
                    localStorage.setItem('quote-tax', quoteTax)
                } catch (err) {
                    console.log(err)
                }
            }
            quotesActions()
            getCuotasPercentFunc()
        })

        siEntrega.addEventListener('change', () => {
            primeraEntrega.removeAttribute('readonly')
            console.log('fsdfsfsfsfs')
        })

      cliente.select2()

        cliente.on('change', function() {
            var nombrecli = $('#nombrecli').val();
            $.ajax({
                url: 'helper/fetchClient.php',
                type: 'POST',
                data: {
                    nombrecli: nombrecli
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#cedula').val(data.cedula)
                    $('#direccion').val(data.direc)
                    $('#celular').val(data.celular)
                },
                error: function(msj) {
                    console.log(msj)
                }
            })
        })
        const ventas = document.querySelectorAll('.ventaInput'),
            selects = document.querySelectorAll('.selectVentaInput')
</script>

