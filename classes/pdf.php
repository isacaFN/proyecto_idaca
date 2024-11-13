<?php
namespace Classes;

use Dompdf\Dompdf;
use Dompdf\Options;
use Model\Producto;

class Pdf{
    public $pdf;
    public $dni;
    public $nombre;
    public $montoNeto;
    public $totalIva;
    public $totalApagar;


    public function __construct($pdf){
        $this->pdf = $pdf;
    }

    public function generarPDF(){
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $html = '<h2>Nota de pedido</h2><table border="1"><tr><th>Código producto</th><th>Nombre</th><th>Cantidad</th><th>Precio</th><th>Subtotal</th></tr>';
        $html .= "<tr>
                            <td></td>
                        </tr>";
        
        // Renderizar el PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait'); // Establecer el tamaño de papel
        $dompdf->render(); // Generar el PDF
        
        $nombreArchivo = 'venta_' . date('Y-m-d_H-i-s') . '.pdf'; // Nombre del archivo PDF
        // Ruta para guardar el PDF en el servidor
        $tempPdfPath = $_SERVER['DOCUMENT_ROOT'] . '/proyecto_idaca/temp/pdf/' . $nombreArchivo;
        
        // Verificar si el directorio existe y crearlo si no es así
        $dir = dirname($tempPdfPath);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);  // Crear directorio si no existe
        }
    
        // Guardar el contenido del PDF en la ruta especificada
        file_put_contents($tempPdfPath, $dompdf->output());
    
        // Responder con éxito y la URL del PDF generado
        echo json_encode([
            'status' => 'success',
            'data' => 'Datos recibidos y PDF generado',
            'pdfUrl' => '/proyecto_idaca/temp/pdf/' . $nombreArchivo // URL accesible desde el navegador
        ]);
    }

}