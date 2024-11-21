document.addEventListener('DOMContentLoaded', function() {

    mostrarPrevisualizacionPDF();
})

function mostrarPrevisualizacionPDF() {
    document.getElementById('modalPrevisualizacion').style.display = 'block';

}

function confirmarVenta() {
    const productosGuardados = JSON.parse(localStorage.getItem('productos'));
    const clienteGuardado = JSON.parse(localStorage.getItem('cliente'));

    guardarVenta(productosGuardados, clienteGuardado);

}

async function guardarVenta(productos, cliente) {
    try {
        const response = await fetch('http://localhost/proyecto_idaca/public/guardarVenta', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ productos, cliente })
        });
        const text = await response.text();

        // Intentar convertir a JSON si es posible
        try {
            const data = JSON.parse(text); // Intentar convertir a JSON
            if (data.status === 'success') {
                console.log("Respuesta del servidor:", data.data);
                console.log(data.arregloproductos);
                console.log(data.arreglocliente);
                // console.log(data.arregloproductos.productos[0].cantidad);
            } else {
                console.log("Hubo un error en la solicitud:", data.message);
            }
        } catch (jsonError) {
            console.error("Error al analizar el JSON:", jsonError);
        }

    } catch (error) {
        console.error("Error en la solicitud:", error);
    }
}

window.confirmarVenta = confirmarVenta;