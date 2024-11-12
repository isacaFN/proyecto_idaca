<?php

namespace controllers;

use MVC\router;
use Model\Venta;
use Dompdf\Dompdf;
use Dompdf\Options;
use Model\Producto;

class VentaController{

     public static function ventas(router $router){

        $router->render('ventas/ventas',[
            
        ]);
    }

    public static function crearVenta(router $router){
        $router->render('ventas/crearVenta');
    }
    
    public static function verificarVenta(router $router) {
        $productosCantidad = [];

        $productos = Producto::all();

    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: application/json'); 
        
            // Leer los datos JSON enviados en la solicitud
            $rawData = file_get_contents('php://input');
        
            if ($rawData) {
                $productosCantidad = json_decode($rawData, true); // Decodificar JSON a un arreglo
        
                // Generar PDF usando Dompdf
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
            } else {
                // Si no se reciben datos JSON válidos
                echo json_encode([
                    'status' => 'error',
                    'message' => 'No se recibieron datos JSON válidos'
                ]);
            }
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Renderizar la página de verificación de la venta

            $pdf = $_GET['pdf'];
            $router->render('ventas/verificarVenta', [
                'pdf' => $pdf
            ]);
        }
    }

    public static function confirmarVenta(router $router) {
        header('Content-Type: application/json'); 
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Confirmación de venta
            $tempPdfPath = '/path/to/temp/pdf/previsualizacion.pdf';
            $finalPdfPath = '/path/to/final/pdf/venta_confirmada_' . time() . '.pdf';
    
            if (file_exists($tempPdfPath)) {
                rename($tempPdfPath, $finalPdfPath);
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Venta confirmada y PDF guardado',
                    'pdfUrl' => $finalPdfPath
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'No se encontró el PDF para confirmar la venta'
                ]);
            }
        }
    }
}