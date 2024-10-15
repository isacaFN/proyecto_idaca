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

function agregarlinea(){

    const codproductoInput = document.createElement('input');
    const codproducto = document.createElement('TD');
    codproducto.appendChild(codproductoInput);

    const NombreProducto = document.createElement('TD');
    const NombrProductoInput = document.createElement('input');
    NombreProducto.appendChild(NombrProductoInput);

    const Cantidad = document.createElement('TD');
    const input2 = document.createElement('input');
    input2.type = 'number';
    Cantidad.appendChild(input2);


    const Precio = document.createElement('TD');  
    const input3 = document.createElement('input');
    Precio.appendChild(input3);

    const Subtotal = document.createElement('TD');
    const input4 = document.createElement('input');
    input3.setAttribute('readonly', 'true');
    Subtotal.appendChild(input4);

    const Eliminar = document.createElement('TD');
    Eliminar.textContent = '';

    const trVenta = document.createElement('TR');
    trVenta.appendChild(codproducto);
    trVenta.appendChild(NombreProducto);
    trVenta.appendChild(Cantidad);
    trVenta.appendChild(Precio);
    trVenta.appendChild(Subtotal);
    trVenta.appendChild(Eliminar);

    document.getElementById('producto').appendChild(trVenta);
}

function eliminarlinea(){
    const trVenta = document.getElementById('producto').lastChild;
    trVenta.remove();
}
    


window.buscar = buscar;
window.agregarlinea = agregarlinea;
window.eliminarlinea = eliminarlinea;
