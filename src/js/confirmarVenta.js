document.addEventListener('DOMContentLoaded', function() {

    mostrarPrevisualizacionPDF();
})

function mostrarPrevisualizacionPDF() {
    document.getElementById('modalPrevisualizacion').style.display = 'block';

}

function confirmarVenta() {
    const productosGuardados = JSON.parse(localStorage.getItem('productos'));
    const clienteGuardado = JSON.parse(localStorage.getItem('cliente'));

    // enviarVenta(productosGuardados, clienteGuardado);

}

// async function enviarVenta(productos, cliente) {
//     try {
//         const response = await fetch('http://localhost/proyecto_idaca/public/confirmarVenta', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json'
//             },
//             body: JSON.stringify({ productos, cliente })
//         });
//         const text = await response.text();

//         // Intentar convertir a JSON si es posible
//         try {
//             const data = JSON.parse(text); // Intentar convertir a JSON
//             if (data.status === 'success') {
//                 console.log("Respuesta del servidor:", data.data);
//             } else {
//                 console.log("Hubo un error en la solicitud:", data.message);
//             }
//         } catch (jsonError) {
//             console.error("Error al analizar el JSON:", jsonError);
//         }

//     } catch (error) {
//         console.error("Error en la solicitud:", error);
//     }
// }

window.confirmarVenta = confirmarVenta;