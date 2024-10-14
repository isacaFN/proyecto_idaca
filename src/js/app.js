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
    usuarios.forEach(usuario => {

        const {id,  nombre, apellido, correo, nivel} = usuario;
    
        const nombreUsuario = document.createElement('TD');
        nombreUsuario.textContent = nombre;
    
        const apellidoUsuario = document.createElement('TD');
        apellidoUsuario.textContent = apellido;
    
        const correoUsuario = document.createElement('TD');
        correoUsuario.textContent = correo;
    
        const nivelUsuario = document.createElement('TD');
        nivelUsuario.textContent = nivel;
    
        const trUsuario = document.createElement('TR');
        trUsuario.dataset.idUsuario = id;
    
        trUsuario.appendChild(nombreUsuario);
        trUsuario.appendChild(apellidoUsuario);
        trUsuario.appendChild(correoUsuario);
        trUsuario.appendChild(nivelUsuario);

        document.getElementById('usuarios').appendChild(trUsuario);
        
    });

}
