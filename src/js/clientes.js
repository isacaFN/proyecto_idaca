document.addEventListener('DOMContentLoaded', function() {

    iniciarapp();
})

async function consultarAPI(){
    try {
        const url = 'http://localhost/proyecto_idaca/public/api/clientes';
        const respuesta = await fetch(url);
        const clientes = await respuesta.json();
        mostrarclientes(clientes);
    } catch (error) {
        console.log(error);
        
    }
}

function mostrarclientes(clientes){
    clientes.forEach(cliente => {

        const {dni,  nombre, telefono, correo, direccion } = cliente;

        const dnicliente = document.createElement('TD');
        dnicliente.textContent = dni;
     
        const nombrecliente = document.createElement('TD');
        nombrecliente.textContent = nombre;
    
        const telefonoCliente = document.createElement('TD');
        telefonoCliente.textContent = telefono;
        
        const correoCliente = document.createElement('TD');
        correoCliente.textContent = correo;

        const direccionCliente = document.createElement('TD');
        direccionCliente.textContent = direccion;
    
        const trcliente = document.createElement('TR');
        trcliente.dataset.idcliente = dni;
        
        trcliente.appendChild(dnicliente);
        trcliente.appendChild(nombrecliente);
        trcliente.appendChild(telefonoCliente);
        trcliente.appendChild(correoCliente);
        trcliente.appendChild(direccionCliente); 

        document.getElementById('clientes').appendChild(trcliente);
        
    });

}
