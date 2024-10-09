document.addEventListener('DOMContentLoaded', function() {

    iniciarapp();
})

function iniciarapp(){
    consultarAPI(); // consultar al backend php
}

async function consultarAPI(){
    try {
        const url = 'http://localhost/proyecto_idaca/public/api/usuarios';
        const respuesta = await fetch(url);
        const usuarios = respuesta.json();
        console.log(usuarios);
    } catch (error) {
        console.log(error);
        
    }
}

