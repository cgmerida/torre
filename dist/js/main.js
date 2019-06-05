$(document).ready(function(){

	$(".sidebar a.nav-link").each(function() {
		if (this.href == window.location.href) {
			$(this).parent().addClass("active");
			return false;
			// $(this).closest( "div" ).collapse('show');
		}
	});
	// $('li div').on('show.bs.collapse', function () {
		// $("li div.collapse.in").collapse('hide');
	// });
	
	
	$('select.form-control').css('color','#999');
	$('select.form-control').change(function() {
		$(this).css('color','#565656');
	});

	var selectpickerAdded = $('script[src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"]').length;

	if (selectpickerAdded > 0) {
		$('.selectpicker').selectpicker();
		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
			$('.selectpicker').selectpicker('mobile');
		}
	}


	var dataTableAdded = $('script[src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"]').length;

	if (dataTableAdded > 0) {

		$.extend( $.fn.dataTable.defaults, {
			responsive: true,
			"language": {
				"sProcessing":     "Procesando...",
				"sLengthMenu":     "Mostrar _MENU_ registros",
				"sZeroRecords":    "No se encontraron resultados",
				"sEmptyTable":     "Ningún dato disponible en esta tabla",
				"sInfo":           "Total registros _TOTAL_",
				"sInfoEmpty":      "No hay registros disponibles",
				"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix":    "",
				"sSearch":         "Buscar:",
				"sUrl":            "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "Último",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				},
				buttons: {
					colvis: 'Columnas',
					copyTitle: 'Copiado al cortapapeles',
					copySuccess: {
						_: '%d lineas copiadas',
						1: '1 linea copiada'
					}
				}
			}
		});
	}
});

$(function() {

	$(document).on('change', ':file', function() {
		var input = $(this),
		numFiles = input.get(0).files ? input.get(0).files.length : 1,
		label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [numFiles, label]);
	});
	$(document).ready( function() {
		$(':file').on('fileselect', function(event, numFiles, label) {

			var input = $(this).parents('.input-group').find(':text'),
			log = numFiles > 1 ? numFiles + ' files selected' : label;

			if( input.length ) {
				input.val(log);
			} else {
				if( log ) alert(log);
			}

		});
	});


});