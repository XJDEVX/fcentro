$(document).ready(function () {
    // order date picker

    $("#startDate").datepicker({
        dateFormat: "yy-mm-dd"
    });
    // order date picker
    $("#endDate").datepicker({
        dateFormat: "yy-mm-dd"
    });
    $("#detalle").select2();
    $("#clientes").select2();
    $("#empresa").select2();



    $("#getOrderReportForm").unbind('submit').bind('submit', function () {

        var startDate = $("#startDate").val();
        var endDate = $("#endDate").val();

        if (startDate == "" || endDate == "") {
            if (startDate == "") {
                $("#startDate").addClass('is-invalit');
                $("#startDate").after('<p class="text-danger">Fecha de inicio Requerido</p>');
            } else {
                $(".form-group").removeClass('has-error');
                $(".text-danger").remove();
            }

            if (endDate == "") {
                $("#endDate").closest('.form-group').addClass('has-error');
                $("#endDate").after('<p class="text-danger">Fecha final Requerida</p>');
            } else {
                $(".form-group").removeClass('has-error');
                $(".text-danger").remove();
            }
        } else {
            $(".form-group").removeClass('has-error');
            $(".text-danger").remove();

            var form = $(this);

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'text',
                success: function (response) {
                    var mywindow = window.open('', 'SANTA CLARA', 'height=400,width=600');
                    mywindow.document.write('<html><head><title>Reporte de Compras</title>');
                    mywindow.document.write('</head><body>');
                    mywindow.document.write(response);
                    mywindow.document.write('</body></html>');

                    mywindow.document.close(); // necessary for IE >= 10
                    mywindow.focus(); // necessary for IE >= 10

                    mywindow.print();
                    // mywindow.close();
                } // /success
            }); // /ajax

        } // /else

        return false;
    });

});