<?php
namespace Classes;

use Dompdf\Dompdf;
use Dompdf\Options;
use Model\Producto;

class Pdf{
     public $arregloProductos = [];
     public $arregloCliente = [];
    // public $subtotalProducto;
    // public $cliente;
    // public $nombreCliente;

    public function __construct($arregloProductos, $arregloCliente){
        $this->arregloProductos = $arregloProductos;
        $this->arregloCliente = $arregloCliente;
        // $this->$subtotalProducto = $subtotalProducto;
        // $this->$cliente = $cliente;
        // $this->$nombreCliente = $nombreCliente;
    }

    public function PdfVenta(){
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);


        $html = '<img src="http://localhost/proyecto_idaca/public/build/img/logoidaca.jpg" style="width:120px; height:90px;">';
        $html .= '<h2>Nota de pedido</h2>';

        // Cuadro con nombre y RUT del cliente
        $html .= '<div style="border: 1px solid #000; padding: 10px; margin-bottom: 15px; width: 100%; max-width: 400px;">';
        $html .= '<p style="margin: 0;"><strong>Nombre del Cliente:</strong> ' . $this->arregloCliente[0]['nombreCliente'] . '</p>';
        $html .= '<p style="margin: 0;"><strong>RUT:</strong> ' . $this->arregloCliente[0]['dni'] . '</p>';
        $html .= '</div>';
        $html .= '<table style="border: 1px solid #000; border-collapse: collapse; width:100%; margin-bottom: 15px;">';
        $html .= '<tr><th style="border: 1px solid #000;">Código producto</th style="border: 1px solid #000;"><th style="border: 1px solid #000;">Nombre</th style="border: 1px solid #000;"><th style="border: 1px solid #000;">Cantidad</th style="border: 1px solid #000;"><th style="border: 1px solid #000;">Precio</th style="border: 1px solid #000;"><th style="border: 1px solid #000;">Subtotal</th style="border: 1px solid #000;"></tr>';
        foreach ($this->arregloProductos as $producto) {

        $subtotal = $producto['precio'] * $producto['cantidad'];
            
        $html .= "<tr>
                <td style='border: 1px solid #000; text-align: right;'>{$producto['codproducto']}</td>
                <td style='border: 1px solid #000; text-align: right;'>{$producto['nombreProducto']}</td>
                <td style='border: 1px solid #000; text-align: right;'>" . number_format($producto['cantidad'], 0, '', '.') . " kg</td>
                <td style='border: 1px solid #000; text-align: right;'>" . number_format($producto['precio'], 0, '', '.') . "</td>
                <td style='border: 1px solid #000; text-align: right;'>" . number_format($subtotal, 0, '', '.') . "</td>
            </tr>";
        }
        
        $html .= '</table>';
        $html .= '<section style="display: flex; justify-content: flex-end; margin-bottom: 15px; width: 100%;">';
        $html .= '<div style="border: 1px solid #000; padding: 10px; margin-bottom: 15px; width: 100%; max-width: 400px;">';
        $html .= '<p style="margin: 0;"><strong>Monto neto:</strong> ' . number_format($this->arregloCliente[0]['montoNeto'], 0, '', '.') . '</p>';
        $html .= '<p style="margin: 0;"><strong>Total Iva:</strong> ' . number_format($this->arregloCliente[0]['totalIva'], 0, '', '.') . '</p>';
        $html .= '<p style="margin: 0;"><strong>Total A pagar:</strong> ' . number_format($this->arregloCliente[0]['totalApagar'], 0, '', '.') . '</p>';
        $html .= '</div>';
    $html .= '</section>';
        
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
            'pdfUrl' => '/proyecto_idaca/temp/pdf/' . $nombreArchivo,
            'arreglocliente' => $this->arregloProductos,
            'arreglocliente' => $this->arregloCliente
        ]);
    }

}