<?php
require_once 'partials/header.php';
?>
</head>

<body data-spy="scroll" data-target=".bs-docs-sidebar">

    <?php include "partials/footer.php" ?>

    <script>
        Swal.fire({
            position: 'top',
            icon: 'success',
            title: 'VENTA REALIZADA CON EXITO',
            showConfirmButton: false,
            timer: 2500
        })

        setTimeout(() => {
            window.location.href = 'caja_credito.php'
        }, 2500);
        // alert("VENTA REALIZADA CON EXITO!!!!")
        // setTimeout(() => {
        //
        // });
    </script>