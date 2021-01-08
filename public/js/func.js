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
