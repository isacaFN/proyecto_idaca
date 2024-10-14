let rutCliente;

function buscar(){
    consultarAPI(); // consultar al backend php

    rutCliente = document.getElementById('rut').value.trim();


    if (!/^[0-9]+$/.test(rutCliente)) {
        alert("El RUT solo debe contener números."); 
        return; 
    }
}

async function consultarAPI(){
    try {
        const url = 'http://localhost/proyecto_idaca/public/api/clientes';
        const respuesta = await fetch(url);
        const clientes = await respuesta.json();
        buscarCliente(clientes);
    } catch (error) {
        console.log(error);
        
    }
}

function buscarCliente(clientes){
    clientes.forEach(cliente => {

        const {dni,  nombre } = cliente;

        if(dni === rutCliente){
            mostrar(dni, nombre)
        }
        
    });

}

function mostrar(dni, nombre, apellido){

    while (nombreCliente.firstChild) {
        nombreCliente.removeChild(nombreCliente.firstChild);
    }

    const label = document.createElement('LABEL');
    label.textContent = 'Nombre cliente:';
    const Cliente = document.createElement('INPUT'); 
    Cliente.type = 'text';
    Cliente.classList.add('cliente');
    Cliente.value = nombre;

    nombreCliente.appendChild(label);
    nombreCliente.appendChild(Cliente);

    document.getElementById('rut').value = dni;

}

window.buscar = buscar;
