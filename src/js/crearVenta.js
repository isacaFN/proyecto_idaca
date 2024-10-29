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

// function autocompletar(arrayproductos){

//     const inputs = document.querySelectorAll('.nombreProducto');

//     inputs.forEach(function(input) {
//     // Crear un contenedor único de sugerencias para cada input
//     const sugerenciasDiv = document.createElement('div');
//     sugerenciasDiv.classList.add('sugerencias');
//     input.parentElement.appendChild(sugerenciasDiv); // Añadir el div de sugerencias después del input

//     // Evento de input en cada campo de texto
//     input.addEventListener('input', function(event) {
//         const valorIngresado = input.value.toLowerCase(); // Valor en minúsculas
//         sugerenciasDiv.innerHTML = ''; // Limpiar sugerencias anteriores

//         // Filtrar las sugerencias basándose en el nombre del producto
//         const coincidencias = arrayproductos.filter(item => {
//             return typeof item.nomprod === 'string' && item.nomprod.toLowerCase().includes(valorIngresado);
//         });

//         // Mostrar sugerencias si hay coincidencias
//         if (coincidencias.length > 0) {
//             sugerenciasDiv.style.display = 'block'; // Mostrar la lista de sugerencias
//             coincidencias.forEach(coincidencia => {
//                 const divSugerencia = document.createElement('div');
//                 divSugerencia.classList.add('sugerencia');
//                 divSugerencia.textContent = coincidencia.nomprod; // Usar el nombre del producto

//                 // Añadir evento click para autocompletar
//                 divSugerencia.addEventListener('click', function() {
//                     input.value = coincidencia.nomprod; // Completar el input
//                     sugerenciasDiv.innerHTML = ''; // Limpiar sugerencias
//                     sugerenciasDiv.style.display = 'none'; // Ocultar sugerencias

//                     // Obtener el contenedor abuelo
//                     const contenedor = input.parentElement.parentElement; // Primer contenedor

//                     if (contenedor) {
//                         arrayproductos.forEach(valor => {
//                             if (coincidencia.nomprod === valor.nomprod) {
//                                 contenedor.dataset.idproducto = valor.codproducto; 

//                                 const trVenta = document.getElementById(contenedor.id);
//                                 const inputCodProducto = trVenta.querySelector('.codProducto');
//                                 inputCodProducto.value = valor.codproducto; 

//                                 const inputPrecioProducto = trVenta.querySelector('.precioProducto');
//                                 inputPrecioProducto.value = valor.precio;

//                                 const inputCantidadProducto = trVenta.querySelector('.cantidadProducto');
                                
//                                 document.addEventListener('click', function(event) {
//                                     if (inputCantidadProducto.contains(event.target)) {
//                                     }else{

//                                         if(inputCantidadProducto.value > 0){
//                                             const inputSubtotalProducto = trVenta.querySelector('.subtotalProducto');
//                                             inputSubtotalProducto.value = inputPrecioProducto.value * inputCantidadProducto.value;
//                                         }
//                                     }
//                                 });
//                             }
//                         });
//                     }
//                 });

//                 sugerenciasDiv.appendChild(divSugerencia); // Añadir la sugerencia al div
//             });
//         } else {
//             sugerenciasDiv.style.display = 'none'; // Ocultar si no hay coincidencias
//         }
//     });

//     // Evento global para detectar clics fuera del input y el contenedor de sugerencias
//     document.addEventListener('click', function(event) {
//         // Asegurarse de que el clic no ocurrió dentro del input actual ni en las sugerencias
//         if (!input.contains(event.target) && !sugerenciasDiv.contains(event.target)) {
//             sugerenciasDiv.innerHTML = ''; // Limpiar sugerencias
//             sugerenciasDiv.style.display = 'none'; // Ocultar sugerencias
//         }
//     });
// });
// }

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

                            const contenedor = input.closest('tr'); 
                            const productoSeleccionado = arrayproductos.find(item => item.nomprod === coincidencia.nomprod);

                            if (contenedor && productoSeleccionado) {
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
    trVenta.classList.add('trVenta'); 

    // Crear y agregar celdas e inputs
    const codproductoInput = document.createElement('input');
    const codproducto = document.createElement('td');
    codproductoInput.classList.add('codProducto');
    codproducto.appendChild(codproductoInput);

    const NombreProducto = document.createElement('td');
    const NombrProductoInput = document.createElement('input');
    NombrProductoInput.classList.add('nombreProducto');
    NombreProducto.appendChild(NombrProductoInput);

    const Cantidad = document.createElement('td');
    const input2 = document.createElement('input');
    input2.classList.add('cantidadProducto');
    input2.type = 'number';
    Cantidad.appendChild(input2);

    const Precio = document.createElement('td');
    const input3 = document.createElement('input');
    input3.classList.add('precioProducto');
    input3.setAttribute('readonly', 'true');
    Precio.appendChild(input3);

    const Subtotal = document.createElement('td');
    const input4 = document.createElement('input');
    input4.classList.add('subtotalProducto');
    input4.setAttribute('readonly', 'true');
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

window.buscar = buscar;
window.agregarlinea = agregarlinea;
window.eliminarlinea = eliminarlinea; 
