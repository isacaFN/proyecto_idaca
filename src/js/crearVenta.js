let rutCliente;
let filas =0 ;
let url;

document.addEventListener('DOMContentLoaded', function() {

    iniciarapp();
})

function iniciarapp(){
    productos();
}

function productos(){
    url = 'http://localhost/proyecto_idaca/public/api/productos';
    consultarAPI(url);
}

function buscar(){
    rutCliente = document.getElementById('rut').value.trim();

    if (!/^[0-9]+$/.test(rutCliente)) {
        alert("El RUT solo debe contener números."); 
        return; 
    }

    url = 'http://localhost/proyecto_idaca/public/api/clientes';
    consultarAPI(url); // consultar al backend php
    

}

async function consultarAPI(url){
    try {
        const respuesta = await fetch(url);
        const convertir = await respuesta.json();

        if(url.includes('clientes')){
            buscarCliente(convertir);
        }

        if(url.includes('productos')){
            autocompletar(convertir);
        }
        
    } catch (error) {
        console.log(error);
        
    }
}

function autocompletar(convertir){

    const formulario = document.getElementById('producto');

    formulario.addEventListener('click', function(event) {
        if (event.target.tagName === 'INPUT') {
            const inputActual = event.target;

            // Obtener la clase del input
            const clasesInput = inputActual.classList;
            console.log('Clases del input:', clasesInput);

            // Obtener el abuelo (primer contenedor)
            const abuelo = inputActual.parentElement.parentElement; // Primer contenedor
            if (abuelo) {
                console.log('Clase del primer contenedor (abuelo):', abuelo.id);
            } else {
                console.log('No se encontró el abuelo.');
            }
        }
    }); 

    const input = document.getElementById('nombreProducto0');
    const sugerenciasDiv = document.getElementById('sugerencias');

    input.addEventListener('input', function() {
        const valorIngresado = input.value.toLowerCase(); // Valor en minúsculas
        sugerenciasDiv.innerHTML = ''; // Limpiar sugerencias anteriores

        // Filtrar las sugerencias basándose en el nombre del producto
        const coincidencias = convertir.filter(item => {
            return typeof item.nomprod === 'string' && item.nomprod.toLowerCase().includes(valorIngresado);
        });

        // Mostrar sugerencias
        if (coincidencias.length > 0) {
            sugerenciasDiv.style.display = 'block'; // Mostrar la lista de sugerencias
            coincidencias.forEach(coincidencia => {
                const divSugerencia = document.createElement('div');
                divSugerencia.classList.add('sugerencia');
                divSugerencia.textContent = coincidencia.nomprod; // Usar el nombre del producto

                // Añadir un evento click para autocompletar
                divSugerencia.addEventListener('click', function() {
                    input.value = coincidencia.nomprod; // Completar el input
                    sugerenciasDiv.innerHTML = ''; // Limpiar sugerencias
                    sugerenciasDiv.style.display = 'none'; // Ocultar sugerencias

                // completamos el restante de los input de la misma fila

                });

                sugerenciasDiv.appendChild(divSugerencia);
            });
        } else {
            sugerenciasDiv.style.display = 'none'; // Ocultar si no hay coincidencias
        }
    });

    // Ocultar sugerencias al hacer clic fuera del input
    document.addEventListener('click', function(event) {
        if (!input.contains(event.target) && !sugerenciasDiv.contains(event.target)) {
            sugerenciasDiv.innerHTML = ''; // Limpiar sugerencias
            sugerenciasDiv.style.display = 'none'; // Ocultar sugerencias
        }
    });

}

function buscarCliente(clientes){
    clientes.forEach(cliente => {

        const {dni,  nombre } = cliente;

        if(dni === rutCliente){
            mostrar(dni, nombre)
        }
        
    });

}

function mostrar(dni, nombre){

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

    filas++;

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
    input3.setAttribute('readonly', 'true');
    Precio.appendChild(input3);

    const Subtotal = document.createElement('TD');
    const input4 = document.createElement('input');
    input4.setAttribute('readonly', 'true');
    Subtotal.appendChild(input4);
    

    const trVenta = document.createElement('TR');
    trVenta.id = 'trVenta' + filas;

    trVenta.appendChild(codproducto);
    trVenta.appendChild(NombreProducto);
    trVenta.appendChild(Cantidad);
    trVenta.appendChild(Precio);
    trVenta.appendChild(Subtotal);

    document.getElementById('producto').appendChild(trVenta);

    document.querySelectorAll(".limpiar").forEach(function(elemento) {
        elemento.innerHTML = iconoLimpiar;
    });

    if (producto.children.length == 2){

        const botonEliminar = document.querySelector('.ocultar');
        botonEliminar.style.display = 'block';
    }

    if (producto.children.length == 1){

        const botonEliminar = document.querySelector('.ocultar');
        botonEliminar.style.display = 'none';
    }

}

function eliminarlinea(){

    filas--;

    if (producto.children.length > 1){
        const trVenta = document.getElementById('producto').lastChild;
        trVenta.remove();
    }

    if (producto.children.length == 1){

        const botonEliminar = document.querySelector('.ocultar');
        botonEliminar.style.display = 'none';
    }
}

window.buscar = buscar;
window.agregarlinea = agregarlinea;
window.eliminarlinea = eliminarlinea;
