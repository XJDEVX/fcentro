<?php
        session_start();
        include('php_conexion.php'); 
        $usu=$_SESSION['username'];
        $tipo_usu=$_SESSION['tipo_usu'];
        if(!$_SESSION['tipo_usu']=='a' or !$_SESSION['tipo_usu']=='ca'){
            header('location:error.php');
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('includes/header.php'); ?>
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
  <div class="container-fluid">
    <div class="row justify-content-center">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="btn-group" data-toggle="buttons-checkbox">
         
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="tabla9" width="100%" class="table table-striped">
            <thead>
              <tr>
                <th width="16%"><strong>N°Factura</strong></th>
                <th width="30%"><strong>PROVEEDOR</strong></th>
                <th width="20%"></th>
                <th width="20%">Monto</th>
                <th width="7%"><strong>Fecha</strong></th>
                <th width="20%">Acciones</th>
           
              </tr>
            </thead>
              <?php 
            
            
              $can=mysql_query("SELECT factu.fecha, factu.factura,factu.prov,detallecompra.importe  FROM facturacompra as factu inner join detallecompra ON factu.factura=detallecompra.factura" );
             
            while($dato=mysql_fetch_array($can)){
            

            ?>
            <tr>
              <td>
                <?php  echo $dato['factura']; ?></td>
                
        
                 
              <td><?php echo $dato['prov']; ?></td>
              <td>
                <?php if($tipo_usu=='ca' and $dato['tipo']<>'a'){ ?>
                  <a href="editcompra.php?factura=<?php echo $dato['factura']; ?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="top" title="Editar factura"><i class="fa fa-pencil"></i></a> 
                  <?php }elseif($tipo_usu=='a'){ ?>
                    <a href="editcompra.php?factura=<?php echo $dato['factura']; ?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="top" title="Editar factura"><i class="fa fa-pencil"></i></a> 
                  <?php }?>
              </td> 
               <!-- <td><a href="php_estado_cliente.php?id=<?php echo $dato['ced']; ?>"><?php echo $estado; ?></a></td> -->
               <td><?php echo $dato['importe']; ?></td>
              <td><?php echo $dato['fecha']; ?></td>
             
             
               <td><button type="button" onClick="window.location='eliminarfactcompra.php?id=<?php echo $dato['factura']; ?>'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Borrar</button>
               <button type="button" onClick="window.location='contadoreim.php?id=<?php echo $dato['factura']; ?>'" class="btn btn-sm btn-secondary"><i class="fa fa-print"></i> reimprimir facturA</button></td> 
              </tr>
              <?php } ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
  </div>
<?php include('includes/scripts.php'); ?>
<script>
$('#tabla9').DataTable();
</script>
</body>
</html>