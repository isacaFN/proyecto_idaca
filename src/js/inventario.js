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

function agregarInventario(){

    let opciones = '';
    arrayProductosCopia.forEach(producto => {
    opciones += `<option value="${producto.codproducto}">${producto.nomprod}</option>`;
});

    let mostrar = `
    <div class="contendor-modal">
        <div class="modal"> 
            <h3>Agregar inventario</h3>
            <p>Seleciona un producto y ingresa la cantidad para sumarlo al inventario</p>
            <form class="formulario-inventario" action="inventario" method="post">
                <div class="detalles_inventario">
                <label for="codproducto">Selecciona un producto:</label>
                <select name="codproducto" id="codproducto">
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
    

document.getElementById("modal-datos").innerHTML = mostrar;

const contenedorModal = document.querySelector('.contendor-modal');

    contenedorModal.addEventListener('click', function(event) {
        if (event.target === contenedorModal) {
            contenedorModal.remove(); 
        }
    });
}
window.agregarInventario = agregarInventario;