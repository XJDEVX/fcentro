<?php
require 'app/Globals.php';
$act = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= APP_NAME ?> | Login</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/iconfonts/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
                <div class="row flex-grow">
                    <div class="col-lg-6 d-flex align-items-center justify-content-center">
                        <div class="auth-form-transparent text-left p-3">
                            <div class="brand-logo">
                                <!-- <img src="assets/images/logo.svg" alt="logo"> -->
                                <h4><span class="text-primary font-weight-bold"><?= APP_NAME ?></span></h4>
                            </div>
                            <h4>Binvenido/a!</h4>
                            <h6 class="font-weight-light">Rellene el formulario de acceso!</h6>
                            <form class="pt-3" method="POST" id="loginForm">
                                <div class="form-group">
                                    <label for="exampleInputEmail">Usuario</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="fa fa-user text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control form-control-lg border-left-0" required
                                            id="username" name="username" placeholder="Ingrese su nombre de usuario"
                                            autofocus autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword">Contraseña</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="fa fa-lock text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="password" class="form-control form-control-lg border-left-0"
                                            required id="password" name="password" placeholder="Ingrese su Contraseña">
                                    </div>
                                </div>

                                <div class="form-group my-3">
                                    <button type="submit"
                                        class="btn btn-block btn-dark font-weight-medium auth-form-btn">
                                        INGRESAR
                                        </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 login-half-bg d-flex flex-row">
                        <!-- <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2018 All rights reserved.</p> -->
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/js/vendor.bundle.addons.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <script src="includes/sweetalert2/sweetalert2@9.js"></script>
    <script src="app/scripts/login.js"></script>
</body>

</html>