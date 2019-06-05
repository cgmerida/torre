$(document).ready(function() {

    $("#guardar").click(function(e) {
        e.preventDefault();
        var form = $('form')[0];
        var formData = new FormData(form);
        if (!verificarForm('form input, form select')) {return false;}
        $.ajax({
            url: "datos/crear-actividades.php", 
            method: "POST", 
            data: formData, 
            contentType: false,
            cache: false,
            processData:false
        })
        .done(function(data) {
            if (data == "exito") {
                $(".mensaje").append( "<div class='alert alert-success fade show'>"+
                    "<a href=# class=close data-dismiss=alert aria-label=close>&times;</a>"+
                    "<strong>Exito!</strong> Se ingresaron los datos correctamente.</div>");
                $(".mensaje").show();
                $('form')[0].reset();
                $('#colonia').html('<option value="" selected>Seleccione Colonia</option>').selectpicker('refresh');
                $("#ubicacion").removeClass('btn-success').addClass('btn-info').html('<i class="fa fa-map-marker fa-fw"></i> Ingrese ubicación');
            } else if (data == "falta") {
                $(".mensaje").append("<div class='alert alert-danger fade in'><a href=# class=close data-dismiss=alert aria-label=close>&times;</a><strong>Error!</strong> No ingreso todos los datos necesarios.</div>");
                $(".mensaje").show();
            } else {
                $(".mensaje").append("<div class='alert alert-danger fade in'> <a href=# class=close data-dismiss=alert aria-label=close>&times;</a><strong>Error!</strong> No se pudo ingresar la información.</div>");
                $(".mensaje").show();
            }

            console.log(data);
        });
    });
});
$(function() {

    $('#fecha').datetimepicker({
        format: 'YYYY/MM/DD HH:mm',
        locale: 'es',
        ignoreReadonly: true
    });
    $('#fecha_fin').datetimepicker({
        useCurrent: false,
        format: 'YYYY/MM/DD HH:mm',
        locale: 'es',
        ignoreReadonly: true
    });

    $("#fecha").on("change.datetimepicker", function (e) {
        $('#fecha_fin').datetimepicker('minDate', e.date);
    });
    $("#fecha_fin").on("change.datetimepicker", function (e) {
        $('#fecha').datetimepicker('maxDate', e.date);
    });

    
});

$('#zona').change(function(){
    if (this.value=='otra') {
        $('#colonia').prop('disabled', true).html('<option value="" selected>Sin Colonia</option>').selectpicker('refresh');
        return false;
    }
    $.post( "datos/colonias.php", { zona: this.value } )
    .done(function( data ) {
        $('#colonia').prop('disabled', false).html(data).selectpicker('refresh');
    });
});

$('#oficina').change(function(){
    var opciones='<option value="" selected>Seleccione sub oficina</option><option>Jardines</option>';
    if (this.value=='Educa') {
        var opciones='<option value="" selected>Seleccione sub oficina</option><option>Ambiente Limpio</option><option>Rostro Humano</option>';
    }
    $('#sub-oficina').html(opciones)
});

$('#sub-oficina').change(function(){
    $.post( "datos/programas.php", { oficina: $('#oficina').val(), sub: this.value } )
    .done(function( data ) {
        $('#programa').html(data);
    }); 
});
function verificarForm(form) {
    var x=true;
    $(form).not( $(".bootstrap-select :input, .optional") ).each(function() {
        if( !$(this).val() ){
            console.log(this);
            var nombre=(!$(this).attr('name')==undefined)? 'colonia':$(this).attr('name');
            $(".mensaje").append("<div class='alert alert-danger fade show'>"+
                "<a href=# class=close data-dismiss=alert aria-label=close>&times;</a>"+
                "<strong>Error!</strong> Ingrese " + nombre + ".</div>");
            $(".mensaje").show();
            x=false;
        }
        return x;
    });
    return x;
}