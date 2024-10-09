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
        const usuarios = await respuesta.json();
        mostrarUsuarios(usuarios);
    } catch (error) {
        console.log(error);
        
    }
}

function mostrarUsuarios(usuarios){
    console.log(usuarios);
}
