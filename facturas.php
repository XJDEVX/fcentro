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
require_once('partials/header.php'); ?>
</head>

<body data-spy="scroll" data-target=".bs-docs-sidebar">
  <div class="container-fluid my-4">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card">
          <div class="card-header bg-dark">
            <a href="caja.php?ddes=0" target="admin" class="btn btn-success"><i class="fa fa-shopping-cart"></i> Realizar
              Nueva Venta </a>
          </div>
          <div class="card-body">
            <div class="row my-2">
              <div class="col-md-4">
                <button class="btn btn-sm btn-default" onclick="loadAnulados()">Filtrar Anulados</button>
              </div>
              <div class="col-md-4"></div>
              <div class="col-md-4">
                <form>
                  <div class="form-group">
                    <input type="text" placeholder="Que deseas buscar?" class="form-control">
                  </div>
                </form>
              </div>
            </div>
            <table id="tablaInvoice" width="100%" class="table table-striped mt-2 dt-responsive">
              <thead>
                <tr>
                  <th width="2%"><strong>Venta Nro</strong></th>
                  <th width="2%"><strong>Cajero</strong></th>
                  <th width="5%"><strong>Cliente</strong></th>
                  <th width="2%"><strong>Fecha</strong></th>
                  <th width="3%"><strong>Total</strong></th>
                  <th width="1%"><strong>Estado</strong></th>
                  <th width="11%"><strong>Acciones</strong></th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="card-footer">
            <button class="btn btn-default btn-sm" onClick="loadMinusPage(5)">Anterior</button>
            <button class="btn btn-dark btn-sm" onclick="loadMorePage(5)">Siguiente</button>
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

    document.addEventListener('DOMContentLoaded', function() {
      localStorage.setItem('offset', Number(0))
    });

    const offset = localStorage.getItem('offset') || 0;

    const loadAnulados = async () => {
      document.querySelector('#tablaInvoice tbody').innerHTML = 'Cargando...'
      try {
        const {invoices} = await fetch('/php_action/actions.php?request=reject-invoices').then(res => res.json())
        let html = ''
        console.log(invoices)
        invoices.forEach( (inv, item) => {
          const { factura, nombrecli:cliente, cajera:cajero, fecha, total, estado } = inv
          html += `<tr>
            <td>${factura}</td>
            <td>${cajero}</td>
            <td>${cliente}</td>
            <td>${fecha}</td>
            <td>${total}</td>
            <td>${estado}</td>
           <td>`
            estado === 'Anulado' ? html+= `<a class="btn btn-sm btn-danger px-2 py-2 text-light disabled">Anulado</a>` : html += `<a class="btn btn-sm btn-danger px-2 py-2 text-light" onclick="anularVenta(${factura})"><i class="fa fa-trash"></i> Anular</a>
            </td>
          </tr>`
        })
        document.querySelector('#tablaInvoice tbody').innerHTML = html
      } catch (err) {
        console.log(err)
      }
    }

    const loadMorePage = (value = 0) => {
      const newOffset = Number(localStorage.getItem('offset')) + Number(value);
      localStorage.setItem('offset', newOffset)
      loadInvoices(newOffset)
    }

    const loadMinusPage = (value = 0) => {
      const newOffset = Number(localStorage.getItem('offset')) - Number(value);
      localStorage.setItem('offset', newOffset)
      loadInvoices(newOffset)
    }

    const loadInvoices = async (offset = 0) => {
      try {
        document.querySelector('#tablaInvoice tbody').innerHTML = 'Cargando...'
        const {invoices} = await fetch(`/php_action/actions.php?request=invoices&offset=${offset}`).then(resp => resp.json())
        let html = ''
        invoices.forEach( (inv, item) => {
          const { factura, cliente, cajero, fecha, total, estado } = inv
          html += `<tr>
            <td>${factura}</td>
            <td>${cajero}</td>
            <td>${cliente}</td>
            <td>${fecha}</td>
            <td>${total}</td>
            <td>${estado}</td>
            <td>`
            estado === 'Anulado' ? html+= `<a class="btn btn-sm btn-danger px-2 py-2 text-light disabled">Anulado</a>` : html += `<a class="btn btn-sm btn-danger px-2 py-2 text-light" onclick="anularVenta(${factura})"><i class="fa fa-trash"></i> Anular</a>
            </td>
          </tr>`
        })
        document.querySelector('#tablaInvoice tbody').innerHTML = html
      } catch (err) {
        console.log(err);
      }
    }

    loadInvoices()

    // function loadInvoices() {
    //   $('#tablaInvoice').DataTable({
    //     "aProcessing": true,
    //     "aServerSide": true,
    //     'aServerSide': true,
    //     dom: "<'row'<'col-md-6'l><'col-md-6'f>>" +
    //       "<'row'<'col-md-12'Br>>" +
    //       "<'row'<'col-md-12't>>" +
    //       "<'row'<'col-md-12'ip>>", //Definimos los elementos del control de tabla
    //     buttons: [
    //       'excelHtml5',
    //       'csvHtml5',
    //       // 'pdf'
    //     ],
    //     "language": {
    //       "sProcessing": "Procesando...",
    //       "sLengthMenu": "Mostrar _MENU_ registros",
    //       "sZeroRecords": "No se encontraron resultados",
    //       "sEmptyTable": "Ningún dato disponible en esta tabla =(",
    //       "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    //       "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    //       "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
    //       "sInfoPostFix": "",
    //       "sSearch": "Buscar:",
    //       "sUrl": "",
    //       "sInfoThousands": ",",
    //       "sLoadingRecords": "Cargando...",
    //       "oPaginate": {
    //         "sFirst": "Primero",
    //         "sLast": "Último",
    //         "sNext": "Siguiente",
    //         "sPrevious": "Anterior"
    //       },
    //       "oAria": {
    //         "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
    //         "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    //       },
    //       "buttons": {
    //         "copy": "Copiar",
    //         "colvis": "Visibilidad"
    //       }
    //     },
    //     ajax: {
    //       url: 'php_action/actions.php?request=allInvoices',
    //       type: 'GET',
    //       dataType: 'JSON',
    //       error: function(msj) {
    //         console.log(msj.responseText)
    //       }
    //     },
    //     "bDestroy": true,
    //     "order": [
    //       [0, "desc"]
    //     ],
    //     "pageLength": 15
    //   })
    // }
    // loadInvoices()

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