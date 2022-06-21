<?php
error_reporting('E_NOTICE');
if (strlen(session_id()) < 1) {
    session_start();
}
require 'app/php_conexion.php';

if ($_SESSION['rol'] !== 'Administrador' && $_SESSION['rol'] !== 'Empleado') {
    header('location:error.php');
}
require_once 'partials/header.php'; ?>
</head>

<body data-spy="scroll" data-target=".bs-docs-sidebar" id="body1">
    <div class="container-fluid pt-4 p-3">
        <div class="row mt-5 mt-lg-0 alig-items-center">
            <div class="col-md-12">
                <h4>Detalles del Credito</h4>
                <p>Total</p>
                <?= $_SESSION['neto']; ?>
                <p></p>
                 <form id="form1" name="contado" method="get" action="contado_cuota.php">
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
                                    <input name="cuotas" placeholder="Ingrese la cantidad" type="number" id="cuotas" class="form-control" required />
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

                                <div class="input-group mb-3">
                                    <div class="d-flex">
                                        <button type="submit" class="mt-4 ml-2 btn btn-dark btn-lg btn-block" name="button" id="button" value="FACTURAR"><i class="fa fa-money" aria-hidden="true"></i> PROCESAR VENTA A CREDITO</button>
                                    </div>
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
                                    <input name="primera_entrega" id="primera_entrega" placeholder="Ingrese el monto" value="0" type="number" class="form-control" required />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
                </div>

<?php require_once "partials/footer.php" ?>
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

         const percent = 100
        cuotas.addEventListener('input', () => {
            const cuotaValue = parseInt(cuotas.value)
            let actionPercent, action
            switch (cuotaValue) {
                case 1:
                    interes.value = 0
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 2:
                    interes.value = 0
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 3:
                    interes.value = 0
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 4:
                    interes.value = 0
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 5:
                    interes.value = 15
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 6:
                    interes.value = 18
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 7:
                    interes.value = 21
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 8:
                    interes.value = 24
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 9:
                    interes.value = 27
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 10:
                    interes.value = 30
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 11:
                    interes.value = 33
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 12:
                    interes.value = 36
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 13:
                    interes.value = 39
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 14:
                    interes.value = 42
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 15:
                    interes.value = 45
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 16:
                    interes.value = 48
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 17:
                    interes.value = 51
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 18:
                    interes.value = 54
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 19:
                    interes.value = 57
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 20:
                    interes.value = 60
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 21:
                    interes.value = 63
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 22:
                    interes.value = 66
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 23:
                    interes.value = 69
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
                case 24:
                    interes.value = 72
                    actionPercent = parseInt(percent) + parseInt(interes.value)
                    action = parseInt((tPagar.value * actionPercent) / 100)
                    montoInteres.value = action
                    break;
            }

            const calcMontoValue = Math.round(parseInt(montoInteres.value / cuotaValue))
            montoPorCuota.value = calcMontoValue
            // Controlar si se realiza la primera entrega
            siEntrega.addEventListener('click', function() {
                $('#no_entrega').attr('checked', false)
                $('#si_entrega').attr('checked', true)
                primeraEntrega.value = calcMontoValue
            })
            noEntrega.addEventListener('click', function() {
                $('#si_entrega').attr('checked', false)
                $('#no_entrega').attr('checked', true)
                primeraEntrega.value = 0
            })

        })

        const ventas = document.querySelectorAll('.ventaInput'),
            selects = document.querySelectorAll('.selectVentaInput')
</script>

