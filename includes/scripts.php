<!-- <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script> -->
<!-- <script src="js/jquery-3.4.1.min.js"></script> -->
<!-- <script src="js/jquery-3.3.1.min.js"></script> -->
<script src="js/bootstrap.min.js"></script>
<!-- <script src="js/bootstrap.bundle.min.js"></script> -->
<script src="js/bootstrap-typeahead.js"></script>
<script src="js/bootstrap-affix.js"></script>
<script src="js/holder/holder.js"></script>
<script src="js/google-code-prettify/prettify.js"></script>
<!-- <script src="plugins/alertifyjs/alertify.min.js"></script> -->
<!-- <script src="plugins/sweetalert/sweetalert2.min.js"></script> -->
<!-- <script src="plu"></script> -->
<script src="js/application.js"></script>

<script src="plugins/DataTables/js/jquery.dataTables.min.js"></script>
<script src="plugins/DataTables/js/dataTables.buttons.min.js"></script>
<script src="plugins/DataTables/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/DataTables/js/dataTables.responsive.min.js"></script>
<script src="plugins/DataTables/js/vfs_fonts.js"></script>
<script src="plugins/DataTables/js/buttons.colVis.min.js"></script>
<script src="plugins/DataTables/js/buttons.flash.min.js"></script>
<script src="plugins/DataTables/js/buttons.html5.min.js"></script>
<script src="plugins/DataTables/js/buttons.print.min.js"></script>
<script src="plugins/DataTables/js/jszip.min.js"></script>
<!-- <script src="plugins/DataTables/js/pdfmake.js"></script> -->

<script src="flexdatalist/jquery.flexdatalist.js"></script>

<script src="JsBarcode-master/dist/JsBarcode.all.min.js"></script>
<script src="select2/select2/dist/js/select2.min.js"></script>

<script src="date/js/jquery-ui.min.js"></script>
<script src="date/js/datepicker-es.js"></script>

<!-- <script src="report.js"></script> -->
<script>
	$('#codigo').focus()
	$('.dropdown-toggle').dropdown();

	$('#tabla1').DataTable({
		language: {
			url: 'includes/idioma.json'
		}
	});
	$('#tabla2').DataTable({
		language: {
			url: 'includes/idioma.json'
		}
	});
	$('#tabla3').DataTable({
		language: {
			url: 'includes/idioma.json'
		}
	});
	$('#tabla4').DataTable({
		"scrollY": "350px",
		"deferRender": true,
		"pageLength": 50,
		language: {
			url: 'includes/idioma.json'


		}

	});
	$('#tabla6').DataTable({
		"scrollY": "1000px",
		"deferRender": true,
		"pageLength": 25,
		language: {
			url: 'includes/idioma.json'


		}

	});
	$('#tabla5').DataTable({
		language: {
			url: 'includes/idioma.json'
		}
	});

	$('#tabla7').DataTable({
		"scrollY": "350px",
		"deferRender": true,
		"pageLength": 25,
		language: {
			url: 'includes/idioma.json'


		}

	});
	$('#tabla8').DataTable({

		"deferRender": true,
		"pageLength": 25,
		language: {
			url: 'includes/idioma.json'


		}

	});
	$('#tabla9').DataTable({

		"deferRender": true,
		"pageLength": 25,
		language: {
			url: 'includes/idioma.json'


		}

	});
	$('[data-toggle="tooltip"]').tooltip();
	$('#myContado').on('shown.bs.modal', function() {
		// get the locator for an input in your modal. Here I'm focusing on
		// the element with the id of myInput
		$('#ccpago').focus()
		$("#nombrecli").select2({

			placeholder: "BUSCAR CLIENTE",
			allowClear: true

		});


	});


	// $('.myinput').flexdatalist({ minLength: 3,

	// noResultsText: '<div class="alert alert-danger" align="center"><button type="button" class="close" data-dismiss="alert">×</button><strong>Producto no encontrado en la base de datos</strong>',
	//  toggleSelected: true, 
	//  searchContain: true,


	//  selectionRequired: false,


	// });
	$('[data-toggle="tooltip"]').tooltip();
	$('#mycrear').on('shown.bs.modal', function() {
		// get the locator for an input in your modal. Here I'm focusing on
		// the element with the id of myInput
		$('#tmp_nombre').focus()
	});





	var x = document.getElementById("codigo").value;
	JsBarcode("#barcode", x);









	$("#miselect").select2({
		placeholder: "",
		allowClear: true
	});
</script>