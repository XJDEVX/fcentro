<?php
if (strlen(session_id()) < 1) {
  session_start();
}
require 'app/php_conexion.php';
require_once 'helper/sessionCheck.php';
$usu = $_SESSION['username'];
$tipo_usu = $_SESSION['rol'];
require_once 'partials/header.php';
?>
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
    <div class="container-fluid my-4 mx-2">
        <h1>Ajustes</h1>
        <hr>
        <div class="row">
            <!-- <div class="col-md-12"></div>
         -->
         <div class="col-md-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active mb-2" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Venta a credito</a>
                <a class="nav-link mb-2" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
            </div>
         </div>
         <div class="col-md-9">
             <div class="tab-content border-0" id="v-pills-tabContent">
               <div class="tab-pane  fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                   <form action="" class="w-100">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="cuota-percent">Porcentaje por cuota</label>
                                <input type="number" id="cuota-percent" name="cuota-percent" class="form-control" />
                            </div>
                            <div class="col-md-3">
                                <label for="mora-percent">Porcentaje por mora</label>
                                <input type="number" id="mora-percent" name="mora-percent" class="form-control" />
                            </div>
                            <div class="col-md-12 mt-4">
                                <button type="submit" class="btn btn-success">Aplicar Cambios</button>
                            </div>
                        </div>
                    </form>
               </div>
               <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">1</div>
             </div>
         </div>
        </div>
    </div>
  <?php
  require_once 'partials/feet.php';
  require_once 'partials/footer.php';
  ?>
  <script>
    $('#v-pills-tab a').on('click', function (e) {
        e.preventDefault()
        $(this).tab('show')
    })

    const cuotaPercent = document.getElementById('cuota-percent')
    const moraPercent = document.getElementById('mora-percent')
    cuotaPercent.value = 0
    moraPercent.value = 0

    document.addEventListener('DOMContentLoaded', () => {
        const getEmpresaData = async () => {
            try {
                const resp = await fetch( 'php_action/actions.php?request=getEmpresaData' )
                const { name, cuota_percent, mora_percent } = await resp.json()
                cuotaPercent.value = cuota_percent
                moraPercent.value = mora_percent
                console.log( name, cuota_percent )
            } catch (err) {
                console.log(err)
            }
        }
        getEmpresaData()
    })
  </script>