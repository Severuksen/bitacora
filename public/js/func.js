$(function(){
    $('#modificargruagrua').on('change', function(){
        let data = $('#modificargruaform').serialize()+'&seleccionargrua=1';
        $.post({url: '/menu/gruas', data, success: function(grua){
            $('#modificargruatipo').val(grua[0]);
            $('#modificargruafabricante').val(grua[1]);
            $('#modificargruamodelo').val(grua[2]);
            $('#modificargruaestado').val(grua[3]);
        }});
    });

    $('#modificarmangrua').on('change', function(){
        let data = $('#modificarmanform').serialize()+'&seleccionargrua=1';
        $.post({url: '/menu/mantenimiento', data, success: function(grua){
            $('#modificarmanmantenimiento').val(grua[0]);
            $('#modificarmanfecha').val(grua[1]);
            $('#modificarmanhoras').val(grua[2]);
            $('#modificarmanobservaciones').val(grua[3]);
            $('#modificarmanestado').val(grua[4]);
        }});
    });

    $('#modificarmanumanual').on('change', function(){
        let data = $('#modificarmanuform').serialize()+'&seleccionarmanu=1';
        $.post({url: '/menu/manuales', data, success: function(grua){
            $('#modificarmanugrua').val(grua[0]);
            $('#modificarmanunombre').val(grua[1]);
            $('#modificarmanudescripcion').html(grua[2]);
        }});
    });
});

function abrir(evento, tabla) {
    "use strict";
    var i, contenido, enlaces;
    contenido = document.getElementsByClassName("contenido");
    for (i = 0; i < contenido.length; i++){
        contenido[i].style.display = "none";
    }
    enlaces = document.getElementsByClassName("enlaces");
    for (i = 0; i < enlaces.length; i++){
        enlaces[i].className = enlaces[i].className.replace(" activo", "");
    }
    document.getElementById(tabla).style.display = "flex";
    evento.currentTarget.className += " activo";
}

function historial(evento) {
    var contenido = document.getElementsByClassName("info");
    for (var i=0;i<contenido.length;i++){
        contenido[i].style.display = "none";
    }
    evento.currentTarget.nextElementSibling.style.display = 'flex';
}

function direccion(event, id)
{
    $("#"+id).val(event.currentTarget.value.substr(12));
}

function cargar(id)
{
    document.getElementById(id).click();
}
