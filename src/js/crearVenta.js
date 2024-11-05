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
    consultarAPI(url); // consultar al backend 'php
    

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

function autocompletar(arrayproductos) {
    document.addEventListener('focusin', function(event) {
        if (event.target.classList.contains('nombreProducto')) {
            const input = event.target;

            // Crear o reutilizar el contenedor de sugerencias para el input activo
            let sugerenciasDiv = input.nextElementSibling;
            if (!sugerenciasDiv || !sugerenciasDiv.classList.contains('sugerencias')) {
                sugerenciasDiv = document.createElement('div');
                sugerenciasDiv.classList.add('sugerencias');
                input.parentElement.appendChild(sugerenciasDiv);
            }

            input.addEventListener('input', function() {
                const valorIngresado = input.value.toLowerCase();
                sugerenciasDiv.innerHTML = '';

                const coincidencias = arrayproductos.filter(item => 
                    item.nomprod.toLowerCase().includes(valorIngresado)
                );

                if (coincidencias.length > 0) {
                    sugerenciasDiv.style.display = 'block';
                    coincidencias.forEach(coincidencia => {
                        const divSugerencia = document.createElement('div');
                        divSugerencia.classList.add('sugerencia');
                        divSugerencia.textContent = coincidencia.nomprod;

                        divSugerencia.addEventListener('click', function() {
                            input.value = coincidencia.nomprod;
                            sugerenciasDiv.innerHTML = '';
                            sugerenciasDiv.style.display = 'none';

                            // subimos de forma jearquica en el dom para encontrar el tr mas cercano
                            const contenedor = input.closest('tr'); 
                            const productoSeleccionado = arrayproductos.find(item => item.nomprod === coincidencia.nomprod);

                            if (contenedor && productoSeleccionado) {
                                contenedor.dataset.idproducto = productoSeleccionado.codproducto;
                                const inputCodProducto = contenedor.querySelector('.codProducto');
                                const inputPrecioProducto = contenedor.querySelector('.precioProducto');
                                const inputCantidadProducto = contenedor.querySelector('.cantidadProducto');
                                const inputSubtotalProducto = contenedor.querySelector('.subtotalProducto');

                                if (inputCodProducto && inputPrecioProducto && inputCantidadProducto && inputSubtotalProducto) {
                                    inputCodProducto.value = productoSeleccionado.codproducto;
                                    inputPrecioProducto.value = productoSeleccionado.precio;

                                    inputCantidadProducto.addEventListener('input', function() {
                                        const cantidad = parseFloat(inputCantidadProducto.value) || 0;
                                        inputSubtotalProducto.value = new Intl.NumberFormat('es-ES').format((productoSeleccionado.precio * cantidad));
                                        calcularSubtotalTotal();
                                        
                                    });
                                }
                            }
                        });
                        sugerenciasDiv.appendChild(divSugerencia);
                    });
                } else {
                    sugerenciasDiv.style.display = 'none';
                }
            });

            document.addEventListener('click', function(event) {
                if (!input.contains(event.target) && !sugerenciasDiv.contains(event.target)) {
                    sugerenciasDiv.innerHTML = '';
                    sugerenciasDiv.style.display = 'none';
                }
            });
        }
    });
}

function calcularSubtotalTotal() {
    const inputsSubtotalProducto = document.querySelectorAll('.subtotalProducto');
    let total = 0;
    
    inputsSubtotalProducto.forEach(input => {
        // Convertir el valor a número, eliminando cualquier formato de miles
        let valor = parseFloat(input.value.replace(/\./g, '').replace(',', '.')) || 0; // Remover puntos de miles y ajustar decimales
        total += valor;
    });
    
    const inputSubtotal = document.getElementById('subtotal');
    inputSubtotal.value = new Intl.NumberFormat('es-ES').format(total);

    let subtotal = inputSubtotal.value;

    calcularMontoNeto(subtotal);
}

function calcularMontoNeto(subtotal) {
        
    let valor = parseFloat(subtotal.replace(/\./g, '').replace(',', '.')) || 0; // Remover puntos de miles y ajustar decimales

    const descuentoInput = document.getElementById('descuento');

    descuentoInput.addEventListener('input', function() {
        if (parseFloat(descuentoInput.value) > 100) {
            alert("El descuento no puede ser mayor que 100%.");
            descuentoInput.value = 100; // Restablecer a 100 si se supera el máximo
        }else{
            const inputTotalDescuento = document.getElementById('totalDescuento');
            inputTotalDescuento.value = new Intl.NumberFormat('es-ES').format(((parseFloat(subtotal.replace(/\./g, '').replace(',', '.')) || 0) * parseFloat(descuentoInput.value)) / 100);

            const inputMontoNeto = document.getElementById('montoNeto');
            inputMontoNeto.value = new Intl.NumberFormat('es-ES').format(valor - parseFloat(inputTotalDescuento.value.replace(/\./g, '').replace(',', '.')));
            let montoNeto = inputMontoNeto.value;
            calcularTotal(montoNeto);
        }
    });

    calcularTotal(subtotal);

}

function calcularTotal(montoNeto){

    // agregar iva 
    const iva = 19; // 19% IVA
    const inputIva = document.getElementById('iva');
    inputIva.value = iva;
    let valor = parseFloat(montoNeto.replace(/\./g, '').replace(',', '.')) || 0; // Remover puntos de miles y ajustar decimales

    const inputtotalIva = document.getElementById('totalIva');
    let totaliva = (valor *  iva) / 100;
    inputtotalIva.value = new Intl.NumberFormat('es-ES').format(totaliva);

     valor = parseFloat(inputtotalIva.value.replace(/\./g, '').replace(',', '.')) || 0;

    let total = valor + parseFloat(montoNeto.replace(/\./g, '').replace(',', '.'));

    const inputTotal = document.getElementById('total');
    inputTotal.value = new Intl.NumberFormat('es-ES').format(total);
}


function agregarlinea() {
    filas++;

    const trVenta = document.createElement('tr');
    trVenta.classList.add('tr'); 

    // Crear y agregar celdas e inputs
    const codproductoInput = document.createElement('input');
    const codproducto = document.createElement('td');
    codproductoInput.classList.add('codProducto');
    codproductoInput.name = 'codproducto';
    codproducto.appendChild(codproductoInput);

    const NombreProducto = document.createElement('td');
    const NombrProductoInput = document.createElement('input');
    NombrProductoInput.classList.add('nombreProducto');
    NombrProductoInput.setAttribute('required', 'true');
    NombrProductoInput.name = `NombreProducto${filas}`;
    NombrProductoInput.type = 'text';
    NombreProducto.appendChild(NombrProductoInput);

    const Cantidad = document.createElement('td');
    const input2 = document.createElement('input');
    input2.classList.add('cantidadProducto');
    input2.type = 'number';
    input2.name = 'cantidad';
    input2.setAttribute('required', 'true');
    Cantidad.appendChild(input2);

    const Precio = document.createElement('td');
    const input3 = document.createElement('input');
    input3.classList.add('precioProducto');
    input3.setAttribute('readonly', 'true');
    input3.name = 'precio';
    Precio.appendChild(input3);

    const Subtotal = document.createElement('td');
    const input4 = document.createElement('input');
    input4.classList.add('subtotalProducto');
    input4.setAttribute('readonly', 'true');
    input4.name = 'subtotal';
    Subtotal.appendChild(input4);

    trVenta.appendChild(codproducto);
    trVenta.appendChild(NombreProducto);
    trVenta.appendChild(Cantidad);
    trVenta.appendChild(Precio);
    trVenta.appendChild(Subtotal);

    document.getElementById('producto').appendChild(trVenta);

    const botonEliminar = document.querySelector('.ocultar');
    botonEliminar.style.display = (producto.children.length > 1) ? 'block' : 'none';

}

function buscarCliente(clientes){
    // buscamos el cliente con find para que nos devuelva el objeto completo si existe, para poder acceder a todos sus datos
    const clienteEncontrado = clientes.find(cliente => cliente.dni === rutCliente);
    if (clienteEncontrado) {
        mostrar(clienteEncontrado.dni, clienteEncontrado.nombre);
    }else{
        clienteNoExiste();
    }
}

function clienteNoExiste(){
    let mostrar = `<div class="contendor-modal">
    <div class="modal"> 

    <h2>Cliente no existe</h2>
    <a class="boton_verde" href="crearCliente">
        Crear cliente 
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="32"
            height="32"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.75"
            stroke-linecap="round"
            stroke-linejoin="round"
            >
            <path d="M12.5 8l4 4l-4 4h4.5l4 -4l-4 -4z" />
            <path d="M3.5 8l4 4l-4 4h4.5l4 -4l-4 -4z" />
        </svg>
    </a>
</div>`;


document.getElementById("modal-datos").innerHTML = mostrar;

const contenedorModal = document.querySelector('.contendor-modal');

contenedorModal.addEventListener('click', function(event) {
    if (event.target === contenedorModal) {
        contenedorModal.remove(); 
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

    autocompletar(arrayproductos, filas);
    calcularSubtotalTotal()

}

function verificarVenta(){
    let suma = 0;
    const filas = document.querySelectorAll('.tr');
    console.log(filas[0].dataset.idproducto);
}


window.buscar = buscar;
window.agregarlinea = agregarlinea;
window.eliminarlinea = eliminarlinea; 
window.verificarVenta = verificarVenta;