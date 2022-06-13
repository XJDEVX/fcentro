<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
  <style>
    .navbar {
      position: fixed;
      right: 1px;
      left: 0px;
      top: 0px;
      border-radius: 0px !important;
      background-color: #AB1414 !important;
      padding: .5rem 0 !important;
      z-index: 20;
    }

    .table {
      overflow-x: hidden !important;
    }

    .navbar .nav-link {
      color: #FFFFFF !important;
    }
  </style>
  <div class="container">
    <a class="navbar-brand" href="empresa.php" target="admin"> <?=$empresa?></a>
    <!--<a class="navbar-brand" href="caja.php?ddes=0" target="admin"><i class="fa fa-shopping-cart"></i> Ventas</a>-->
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarColor01"
      aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav ml-auto">
        <!-- <li class="nav-item">
        <a class="nav-link" href="config.php" target="admin"><i class="fa fa-cogs "></i> Configuracion</a>
      </li> -->
      <?php
      if($_SESSION['tipo_usu'] == 'a'):
      ?>
      <li class="nav-item">
        <a href="empresa.php" class="nav-link" target="admin"><i class="fa fa-tachometer"></i> Panel de Control</a>
      </li>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            target="admin" aria-haspopup="true" aria-expanded="false"><i class="fa fa-shopping-cart"></i> COMPRAS</a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="caja_compra.php" target="admin"><i class="fa fa-shopping-cart"></i> Nueva
              Compra</a>
            <a class="dropdown-item" href="facturasCompra.php" target="admin">
              <i class="fa fa-book"></i>
              Todas las Compras
            </a>
            <a class="dropdown-item" href="reportcompra.php" target="admin"><i class="fa  fa-bar-chart"></i> Reporte de
              Compras</a>
            <!-- <a class="dropdown-item" href="factuCompra.php" target="admin"><i class="fa  fa-pencil"></i> Facturas</a> -->
          </div>
        </li>
   
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            target="admin" aria-haspopup="true" aria-expanded="false"><i class="fa fa-shopping-cart"></i> VENTAS</a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="caja.php?ddes=0" target="admin"><i class="fa fa-shopping-cart"></i> Nueva
              Venta</a>
            <a class="dropdown-item" href="facturas.php" target="admin">
              <i class="fa fa-book"></i>
              Todas las Ventas
            </a>
            <a class="dropdown-item" href="report.php" target="admin"><i class="fa  fa-bar-chart"></i> Reporte de
              ventas</a>
            <!-- <a class="dropdown-item" href="factu.php" target="admin"><i class="fa  fa-pencil"></i> modificar ventas</a> -->
          </div>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="clientes.php" target="admin"><i class="fa fa-user"></i> Clientes</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false"><i class="fa fa-users"></i> Usuarios</a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="usuarios.php" target="admin"><i class="fa fa-search"></i> Buscar Usuarios</a>
            <a class="dropdown-item" href="crear_usuarios.php" target="admin"><i class="fa fa-user-plus"></i> Crear
              Usuarios</a>
          </div>

        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false"><i class="fa fa-folder-open"></i> Inventario</a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="producto.php" target="admin"><i class="fa fa-tasks"></i> Listar Productos</a>

            <a class="dropdown-item" href="crear_producto.php" target="admin"><i class="fa fa-archive"></i> Crear o
              Modificar Producto</a>
            <a class="dropdown-item" href="proveedor.php" target="admin"><i class="fa fa-search"></i> Buscar
              Proveedor</a>
            <a class="dropdown-item" href="crear_proveedor.php" target="admin"><i class="fa fa-truck"></i> Crear
              Proveedor</a>
            <a class="dropdown-item" href="seccion.php" target="admin"><i class="fa fa-list"></i> Secciones o
              Categorias</a>
            <!-- <a class="dropdown-item" href="compra_product.php" target="admin"><i class="fa fa-shopping-cart"></i> Comprar Producto</a>-->

          </div>
        </li>
        <?php endif;?>
        <!--  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-pie-chart"></i> Reportes</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="PDFproducto.php" target="admin"><i class="fa fa-print"></i> Reporte de Productos (PDF)</a>
          <a class="dropdown-item" href="PDFestado_inventario.php" target="admin"><i class="fa fa-print"></i> Reporte de Inventario (PDF)</a>
        </div>
        </li> -->

      </ul>
      <ul class="navbar-nav mr-right">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false"><i class="fa fa-address-card"></i>
            <?php echo $_SESSION['username']; ?></a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="cambiar_clave.php" target="admin"><i class="fa fa-key"></i> Cambiar
              Contraseña</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="php_cerrar.php">
              <button type="button" class="btn btn-danger btn-block">
                <i class="fa fa-power-off"></i> Salir
              </button>
            </a>
          </div>
        </li>
      </ul>
      <!-- <form class="form-inline">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
      </form>
 -->
    </div>
  </div>
</nav>