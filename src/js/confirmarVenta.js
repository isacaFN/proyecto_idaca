document.addEventListener('DOMContentLoaded', function() {

    mostrarPrevisualizacionPDF();
})

function mostrarPrevisualizacionPDF() {
    document.getElementById('modalPrevisualizacion').style.display = 'block';

}

function confirmarVenta() {
    const productosGuardados = JSON.parse(localStorage.getItem('productos'));
    const clienteGuardado = JSON.parse(localStorage.getItem('cliente'));
    const pdfGuardado = localStorage.getItem('pdf');

    guardarVenta(productosGuardados, clienteGuardado, pdfGuardado);

}

async function guardarVenta(productos, cliente, pdf) {
    try {
        const response = await fetch('http://localhost/proyecto_idaca/public/guardarVenta', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ productos, cliente, pdf })
        });
        const text = await response.text();

        // Intentar convertir la respuesta a JSON
        try {
            const data = JSON.parse(text);
            if (data.status === 'success') {
                console.log("Respuesta del servidor:", data.data);
                window.location.href = 'ventas';

                // Opcional: redirigir o realizar otra acción
            } else {
                console.log("Hubo un error en la solicitud:", data.message);
            }
        } catch (jsonError) {
            console.error("Error al analizar el JSON:", jsonError);
            console.log("Mensaje de error:" + text);
        }
    } catch (error) {
        console.error("Error en la solicitud:", error);
    }
}

window.confirmarVenta = confirmarVenta;