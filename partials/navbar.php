</head>

<body class="sidebar-dark sidebar-icon-only" id="body">
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav id="topMenu" class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar shadow">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo text-white" target="admin" href="empresa.php">
                    <!-- <img src="assets/images/logo.svg" alt="logo" /> -->
                    <?= APP_NAME ?>
                </a>
                <a class="navbar-brand brand-logo-mini text-white" target="admin" href="empresa.php">
                    <!-- <img src="assets/images/logo-mini.svg" alt="logo" /> -->
                    FC
                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="fas fa-bars"></span>
                </button>

                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item d-none d-lg-flex">
                        <a class="nav-link">
                            <p class="pt-3" style="line-height: 1px;font-size: 14px !important">Ultimo Ingreso: <span class="font-weight-bold"> <?= $_SESSION['entrada'] ?></span></p>
                            <p class="p-0" style="line-height: 1px;font-size: 14px !important">Ultima Salida: <span class="font-weight-bold"> <?= $_SESSION['salida'] ?></span></p>
                        </a>
                    </li>
                    <li class="nav-item d-none d-md-block">
                        <a class="nav-link" href="caja.php?ddes=0" target="admin">
                            <span class="btn btn-info btn-sm">
                                <i class="fas fa-plus"></i>
                                Venta Contado
                            </span>
                        </a>
                    </li>
                    <li class="nav-item d-none d-md-block">
                        <a class="nav-link" href="caja_credito.php?ddes=0" target="admin">
                            <span class="btn btn-dark btn-sm">
                                <i class="fas fa-plus"></i>
                                Venta Credito
                            </span>
                        </a>
                    </li>
                    <?php if ($_SESSION['rol'] === 'Administrador' || $_SESSION['rol'] === 'Empleado') : ?>
                        <li class="nav-item d-none d-md-block">
                            <a class="nav-link" href="caja_compra.php?ddes=0" target="admin">
                                <span class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i>
                                    Crear Compra
                                </span>
                            </a>
                        </li>
                    <?php endif ?>
                    <li class="nav-item  d-none d-lg-flex">
                        <div class="nav-link">
                            <p id="clock" class="font-weight-bold"></p>
                        </div>
                    </li>
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <img src="<?= $_SESSION['foto'] ?>" alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                            <!-- <a class="dropdown-item" href="profile.php">
                                <i class="fas fa-id-card-alt"></i>
                                Mi Perfil
                            </a> -->
                            <a class="dropdown-item" href="cambiar_clave.php" target="admin">
                                <i class="fas fa-key"></i>
                                Cambiar Clave
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item bg-danger text-white" href="app/ajax/user.php?req=logout">
                                <i class="fas fa-power-off text-white"></i>
                                Cerrar Sesion
                            </a>
                        </div>
                    </li>

                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center bars" type="button" data-toggle="offcanvas">
                    <span class="fas fa-bars"></span>
                </button>
            </div>
        </nav>