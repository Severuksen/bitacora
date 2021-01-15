$(function(){
    $('#modificargruagrua').on('change', function(){
        let url    = '/menu/gruas';
        let data   = $('#modificargruaform').serialize()+'&seleccionargrua=1';
        let campos = ['#modificargruatipo', '#modificargruafabricante', '#modificargruamodelo'];

        post(url, data, campos);
    });

    $('#modificarmangrua').on('change', function(){
        let url    = '/menu/mantenimiento';
        let data   = $('#modificarmanform').serialize()+'&seleccionargrua=1';
        let campos = ['#modificarmanmantenimiento', '#modificarmanfecha', '#modificarmanhoras', '#modificarmanobservaciones', '#modificarmanestado'];

        post(url, data, campos);
    });

    $('#modificarmanumanual').on('change', function(){
        let url    = '/menu/manuales';
        let data   = $('#modificarmanuform').serialize()+'&seleccionarmanu=1';
        let campos = ['#modificarmanugrua', '#modificarmanunombre', '#modificarmanudescripcion'];

        post(url, data, campos);
    });
});

function post(url, data, campos)
{
    $.post({url, data, success: function(datos){
        for(var i=0;i<campos.length;i++){
            $(campos[i]).val(datos[i]);
        }
    }});
}

function abrir(evento, tabla)
{
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

function historial(evento)
{
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
    $("#"+id).trigger('click');
}
