<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="profile-image">
                    <img src="<?= $_SESSION['foto'] ?>" alt="image" />
                </div>
                <div class="profile-name">
                    <p class="name">
                        Online: <span class="text-uppercase"><?= $_SESSION['username'] ?></span>
                    </p>
                    <p class="designation">
                        Rol: <?= $_SESSION['rol']; ?>
                    </p>
                </div>
            </div>
        </li>
        <?php if ($_SESSION['rol'] === 'Administrador') : ?>
            <li class="nav-item">
                <a class="nav-link" target="admin" href="empresa.php">
                    <i class="fa fa-home menu-icon"></i>
                    <span class="menu-title">Panel de Control</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" target="admin" href="clientesCredito.php">
                    <i class="fas fa-money-check-alt menu-icon"></i>
                    <span class="menu-title">Consultar Creditos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                    <i class="fas fa-clipboard-list menu-icon"></i>
                    <span class="menu-title">Inventario</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" target="admin" href="seccion.php">Categorias</a></li>
                        <li class="nav-item"> <a class="nav-link" target="admin" href="producto.php">Listado de
                                Productos</a></li>
                        <li class="nav-item"> <a class="nav-link" target="admin" href="crear_producto.php">Crear
                                Productos</a></li>
                    </ul>
                </div>
            </li>
        <?php endif; ?>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                <i class="fab fa-wpforms menu-icon"></i>
                <span class="menu-title">Compras</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="caja_compra.php?ddes=0" target="admin">Nueva
                            Compra</a></li>
                    <?php if ($_SESSION['rol'] === 'Administrador') : ?>
                        <li class="nav-item"><a class="nav-link" target="admin" href="facturasCompra.php">Historial de
                                Compras</a></li>
                        <!-- <li class="nav-item"><a class="nav-link" target="admin" href="reportcompra.php">Reportes</a></li> -->
                        <li class="nav-item"><a href="proveedor.php" target="admin" class="nav-link">Lista de
                                Proveedores</a></li>
                        <li class="nav-item"><a href="crear_proveedor.php" target="admin" class="nav-link">Crear
                                Proveedores</a></li>

                    <?php endif; ?>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#editors" aria-expanded="false" aria-controls="editors">
                <i class="fas fa-shopping-cart menu-icon"></i>
                <span class="menu-title">Ventas</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="editors">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" target="admin" href="caja.php?ddes=0">Nueva Venta al Contado</a></li>
                    <li class="nav-item"><a class="nav-link" target="admin" href="caja_credito.php?ddes=0">Nueva Venta a Credito</a></li>
                    <?php if ($_SESSION['rol'] === 'Administrador') : ?>
                        <li class="nav-item"><a class="nav-link" target="admin" href="facturas.php">Historial de Ventas</a>
                        </li>
                        <!-- <li class="nav-item"><a class="nav-link" target="admin" href="report.php">Reportes</a></li> -->
                        <li class="nav-item"><a class="nav-link" target="admin" href="clientes.php">Lista de Clientes</a>
                        </li>
                    <?php endif ?>
                    <li class="nav-item"><a class="nav-link" target="admin" href="crear_clientes.php">Crear Clientes</a>
                    </li>
                </ul>
            </div>
        </li>
        <?php if ($_SESSION['rol'] === 'Administrador') : ?>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                    <i class="fas fa-lock menu-icon"></i>
                    <span class="menu-title">Acceso</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="charts">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" target="admin" href="usuarios.php">Lista de Usuarios</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" target="admin" href="usuariosHora.php">Usuarios por
                                Horario</a></li>
                        <li class="nav-item"> <a class="nav-link" target="admin" href="crear_usuarios.php">Crear
                                Usuarios</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                    <i class="fas fa-chart-pie menu-icon"></i>
                    <span class="menu-title">Reportes</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="tables">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" target="admin" href="reportcompra.php">Reporte de
                                Compras</a></li>
                        <li class="nav-item"> <a class="nav-link" target="admin" href="report.php">Reporte de Ventas</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" target="admin" href="today_report_view.php">Cierre de
                                Caja</a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- <li class="nav-item">
            <a class="nav-link" href="construct.php">
                <i class="fas fa-cogs menu-icon"></i>
                <span class="menu-title">Ajustes</span>
            </a>
        </li> -->
        <?php endif; ?>
    </ul>
</nav>