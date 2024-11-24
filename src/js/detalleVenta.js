document.addEventListener('DOMContentLoaded', function() {

    iniciarapp();
})

function iniciarapp(){


    asignarPDF();
}

function asignarPDF(){
    document.querySelectorAll('.boton_verde').forEach(button => {
        button.addEventListener('click', function() {
            // Obtener la ruta del PDF del atributo `data-pdf`
            const pdfPath = this.getAttribute('data-pdf').replace(/\s+/g, '');
            
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