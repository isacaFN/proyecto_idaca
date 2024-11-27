document.addEventListener('DOMContentLoaded', function() {

    iniciarapp();
})

let arrayGastos = [];

function iniciarapp(){
    consultarAPI();
}

async function consultarAPI(){
    try {
        const url = 'http://localhost/proyecto_idaca/public/api/gastos';
        const respuesta = await fetch(url);
        const convertir = await respuesta.json();

        arrayGastos = convertir;

    } catch (error) {
        console.log(error);
        
    }
}


function agregarGasto(){
    let mostrar = `
    <div class="contendor-modal">
        <div class="modal"> 
            <h3>Agregar un Gasto</h3>
            <form class="formulario-inventario" action="gastos" method="post">
            <div class="detalles_inventario">
                    <label for="idnombre">Selecciona un gasto:</label>
                    <select name="idnombre" id="idnombre">
                        ${arrayGastos.map((gasto)=>{
                            return `<option value="${gasto.id}">${gasto.nombre}</option>`;
                        })}
                    </select>
                    <label for="fecha">Fecha:</label>
                    <input type="date" name="fecha" id="fecha" required>
                    <label for="monto">Monto:</label>
                    <input type="text" name="monto" id="monto" required>
                <div class="contenedor-boton">
                    <input class="boton_verde" type="submit" value="Agregar">
                </div>
            </div>
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

    const montoInput = document.getElementById('monto');

    montoInput.addEventListener('input', function () {
        let valor = this.value.replace(/\./g, ''); // Elimina puntos existentes
        if (!isNaN(valor) && valor !== '') {
            this.value = parseInt(valor, 10).toLocaleString('es-ES').replace(/,/g, '.'); // Formato con puntos
        } else {
            this.value = ''; // Limpia si el valor es inválido
        }
    });
    
    // Eliminar formato al enviar el formulario
    const formulario = document.querySelector('form'); // Selecciona el formulario
    formulario.addEventListener('submit', function (event) {
        const valorLimpio = montoInput.value.replace(/\./g, ''); // Elimina los puntos
        montoInput.value = valorLimpio; // Establece el valor limpio antes de enviar
    });

}

function formatNumber(input) {
    // Eliminar cualquier punto previo para procesar el número correctamente
    let number = input.toString().replace(/\./g, "");

    // Verificar si el valor es un número
    if (isNaN(number) || number === "") return "";

    // Convertir el valor a entero y formatearlo con separadores de miles
    return parseInt(number, 10).toLocaleString('es-ES').replace(/,/g, ".");
}
window.agregarGasto = agregarGasto;