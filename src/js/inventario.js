let arrayProductosCopia = [];
let url;
document.addEventListener('DOMContentLoaded', function() {

    iniciarapp();
})

function iniciarapp(){

    url = 'http://localhost/proyecto_idaca/public/api/productos';
    consultarAPI(url);
}

async function consultarAPI(url){
    try {
        const respuesta = await fetch(url);
        const convertir = await respuesta.json();

        arrayProductosCopia = convertir.map(producto => ({ ...producto }));
        
    } catch (error) {
        console.log(error);
        
    }
}

// function agregarInventario(){

//     let opciones = '';
//     arrayProductosCopia.forEach(producto => {
//     opciones += `<option value="${producto.codproducto}">${producto.nomprod}</option>`;
// });

//     let mostrar = `
//     <div class="contendor-modal">
//         <div class="modal"> 
//             <h3>Agregar inventario</h3>
//             <p>Seleciona un producto y ingresa la cantidad para sumarlo al inventario</p>
//             <form class="formulario-inventario" action="inventario" method="post">
//                 <div class="detalles_inventario">
//                 <label for="codproducto">Selecciona un producto:</label>
//                 <select name="codproducto" id="codproducto">
//                     ${opciones} 
//                 </select>
//                 <label for="cantactual">Cantidad:</label>
//                 <input type="number" name="cantactual" id="cantactual" required>
//                 </div>


//                 <input class="boton_verde" type="submit" value="Agregar">
//             </form>
//         </div>
//     </div>
// `;
    

// document.getElementById("modal-datos").innerHTML = mostrar;

// const contenedorModal = document.querySelector('.contendor-modal');

// contenedorModal.addEventListener('click', function(event) {
//     if (event.target === contenedorModal) {
//         contenedorModal.remove(); 
//     }
// });
// }

function agregarInventario() {
    let opciones = '';
    arrayProductosCopia.forEach(producto => {
        opciones += `<option value="${producto.codproducto}">${producto.nomprod}</option>`;
    });

    let mostrar = `
    <div class="contendor-modal">
        <div class="modal"> 
            <h3>Agregar inventario</h3>
            <p>Selecciona un producto e ingresa la cantidad para sumarlo al inventario</p>
            <form class="formulario-inventario">
                <div class="detalles_inventario">
                    <label for="codproducto">Selecciona un producto:</label>
                    <select name="codproducto" id="codproducto" required>
                        ${opciones} 
                    </select>
                    <label for="cantactual">Cantidad:</label>
                    <input type="number" name="cantactual" id="cantactual" required>
                </div>
                <input class="boton_verde" type="submit" value="Agregar">
            </form>
        </div>
    </div>
    `;

    // Agregar modal al DOM
    document.getElementById("modal-datos").innerHTML = mostrar;

    const contenedorModal = document.querySelector('.contendor-modal');

    // Cerrar modal al hacer clic fuera de él
    contenedorModal.addEventListener('click', function(event) {
        if (event.target === contenedorModal) {
            contenedorModal.remove(); 
        }
    });

    // Manejar envío del formulario con fetch
    const formulario = document.querySelector('.formulario-inventario');
    formulario.addEventListener('submit', function(event) {
        event.preventDefault(); // Evitar el envío tradicional del formulario

        const formData = new FormData(formulario);

        fetch('inventario', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message); // Mostrar mensaje de éxito
                location.reload();   // Recargar la página para mostrar cambios
            } else {
                alert(data.message); // Mostrar mensaje de error
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un error al procesar la solicitud');
        });
    });
}

window.agregarInventario = agregarInventario;