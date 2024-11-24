document.addEventListener('DOMContentLoaded', function() {

    iniciarapp();
})

function iniciarapp(){
    consultarAPI(); // consultar al backend php
}
async function consultarAPI(){
    try {
        const url = 'http://localhost/proyecto_idaca/public/api/ventas';
        const respuesta = await fetch(url);
        const ventas = await respuesta.json();
        mostrarventas(ventas);
    } catch (error) {
        console.log(error);
        
    }
}

function mostrarventas(ventas){
    ventas.forEach(venta => {
        const {numventa, fecha, totalpagar, totalkg, idcliente, tipoventa, pdf} = venta;
        const totalpagarVenta = new Intl.NumberFormat('es-ES').format(totalpagar.replace(/\./g, '').replace(',', '.'));
        

        const trVenta = document.createElement('tr');
        trVenta.classList.add('tr');
        trVenta.id = numventa;
        trVenta.classList.add('detalleventas');

        const tdventa = document.createElement('td');
        tdventa.textContent = numventa;

        const tdFecha = document.createElement('td');
        tdFecha.textContent = fecha;

        const tdCliente = document.createElement('td');
        tdCliente.textContent = idcliente;

        const tdKilosTotales = document.createElement('td');
        tdKilosTotales.textContent = totalkg;

        const tdTotalPagado = document.createElement('td');
        tdTotalPagado.textContent = totalpagarVenta;

        const tdTipoVenta = document.createElement('td');    
        tdTipoVenta.textContent = tipoventa;

        const tdAcciones = document.createElement('td');
        tdAcciones.classList.add('accionesventa');
        tdAcciones.innerHTML = `<div> <a href="detalleventa?numventa=${numventa}" title="Mostar detalles de venta" class="detalleventa">
        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-description">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" />
        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
        <path d="M9 17h6" /><path d="M9 13h6" /></svg> </a> </div>
        <div data-pdf="${pdf}" class="iconoDescargarPdf"><a title="descargar pdf"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-download">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 11l5 5l5 -5" /><path d="M12 4l0 12" /></svg> </a></div>`;

        trVenta.appendChild(tdventa);
        trVenta.appendChild(tdFecha);
        trVenta.appendChild(tdCliente);
        trVenta.appendChild(tdKilosTotales);
        trVenta.appendChild(tdTotalPagado);
        trVenta.appendChild(tdTipoVenta);
        trVenta.appendChild(tdAcciones);

        document.getElementById('Ventas').appendChild(trVenta);


    });

    document.querySelectorAll('.iconoDescargarPdf').forEach(button => {
        button.addEventListener('click', function() {
            // Obtener la ruta del PDF del atributo `data-pdf`
            const pdfPath = this.getAttribute('data-pdf').replace(/\s+/g, '');
    
            console.log("distes click");
            
            // Crear un enlace temporal para descargar el archivo
            const link = document.createElement('a');
            link.href = pdfPath;
            link.download = pdfPath.split('/').pop(); // Usar el nombre del archivo
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link); // Limpiar el DOM
        });
    });
}
