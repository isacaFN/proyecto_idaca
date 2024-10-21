let rutCliente;
let filas =0 ;
let url;
let arrayproductos = [];

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
            arrayproductos = convertir;
            autocompletar(arrayproductos);
        }
        
    } catch (error) {
        console.log(error);
        
    }
}

function autocompletar(arrayproductos){

    const inputs = document.querySelectorAll('.nombreProducto');

    inputs.forEach(function(input) {
    // Crear un contenedor único de sugerencias para cada input
    const sugerenciasDiv = document.createElement('div');
    sugerenciasDiv.classList.add('sugerencias');
    input.parentElement.appendChild(sugerenciasDiv); // Añadir el div de sugerencias después del input

    // Evento de input en cada campo de texto
    input.addEventListener('input', function(event) {
        const valorIngresado = input.value.toLowerCase(); // Valor en minúsculas
        sugerenciasDiv.innerHTML = ''; // Limpiar sugerencias anteriores

        // Filtrar las sugerencias basándose en el nombre del producto
        const coincidencias = arrayproductos.filter(item => {
            return typeof item.nomprod === 'string' && item.nomprod.toLowerCase().includes(valorIngresado);
        });

        // Mostrar sugerencias si hay coincidencias
        if (coincidencias.length > 0) {
            sugerenciasDiv.style.display = 'block'; // Mostrar la lista de sugerencias
            coincidencias.forEach(coincidencia => {
                const divSugerencia = document.createElement('div');
                divSugerencia.classList.add('sugerencia');
                divSugerencia.textContent = coincidencia.nomprod; // Usar el nombre del producto

                // Añadir evento click para autocompletar
                divSugerencia.addEventListener('click', function() {
                    input.value = coincidencia.nomprod; // Completar el input
                    sugerenciasDiv.innerHTML = ''; // Limpiar sugerencias
                    sugerenciasDiv.style.display = 'none'; // Ocultar sugerencias

                    // Obtener el contenedor abuelo
                    const contenedor = input.parentElement.parentElement; // Primer contenedor

                    if (contenedor) {
                        arrayproductos.forEach(valor => {
                            if (coincidencia.nomprod === valor.nomprod) {
                                contenedor.dataset.idproducto = valor.codproducto; 

                                const trVenta = document.getElementById(contenedor.id);
                                const inputCodProducto = trVenta.querySelector('.codProducto');
                                inputCodProducto.value = valor.codproducto; 

                                const inputPrecioProducto = trVenta.querySelector('.precioProducto');
                                inputPrecioProducto.value = valor.precio;

                                const inputCantidadProducto = trVenta.querySelector('.cantidadProducto');
                                
                                inputCantidadProducto.addEventListener('click', function(event) {
                                    if (!inputCantidadProducto.contains(event.target)) {
                                        console.log('fuera del input');
                                    }else{
                                        console.log('dentro del input');
                                    }
                                });
                            }
                        });
                    }
                });

                sugerenciasDiv.appendChild(divSugerencia); // Añadir la sugerencia al div
            });
        } else {
            sugerenciasDiv.style.display = 'none'; // Ocultar si no hay coincidencias
        }
    });

    // Evento global para detectar clics fuera del input y el contenedor de sugerencias
    document.addEventListener('click', function(event) {
        // Asegurarse de que el clic no ocurrió dentro del input actual ni en las sugerencias
        if (!input.contains(event.target) && !sugerenciasDiv.contains(event.target)) {
            sugerenciasDiv.innerHTML = ''; // Limpiar sugerencias
            sugerenciasDiv.style.display = 'none'; // Ocultar sugerencias
        }
    });
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
    codproductoInput.id = 'codproducto' + filas;
    codproductoInput.classList.add('codProducto');
    codproducto.appendChild(codproductoInput);

    const NombreProducto = document.createElement('TD');
    const NombrProductoInput = document.createElement('input');
    NombrProductoInput.id = 'nombreProducto' + filas;
    NombrProductoInput.classList.add('nombreProducto');
    NombreProducto.appendChild(NombrProductoInput);

    const Cantidad = document.createElement('TD');
    const input2 = document.createElement('input');
    input2.id = 'cantidadProducto' + filas;
    input2.classList.add('cantidadProducto');
    input2.type = 'number';
    Cantidad.appendChild(input2);


    const Precio = document.createElement('TD');  
    const input3 = document.createElement('input');
    input3.id = 'precioProducto' + filas;
    input3.classList.add('precioProducto');
    input3.setAttribute('readonly', 'true');
    Precio.appendChild(input3);

    const Subtotal = document.createElement('TD');
    const input4 = document.createElement('input');
    input4.id = 'subtotalProducto' + filas;
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

    autocompletar(arrayproductos);

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

    autocompletar(arrayproductos);

}

window.buscar = buscar;
window.agregarlinea = agregarlinea;
window.eliminarlinea = eliminarlinea; 
