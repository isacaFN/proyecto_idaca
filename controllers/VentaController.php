<?php
namespace controllers;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use MVC\router;
use Model\Venta;
use Model\Producto;
use Classes\Pdf;

class VentaController{

    public $arregloProductos = [];

     public static function ventas(router $router){

        $router->render('ventas/ventas',[
            
        ]);
    }

    public static function crearVenta(router $router){
        $router->render('ventas/crearVenta');
    }
    
    public static function verificarVenta(router $router) {

        $productos = Producto::all();

    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: application/json'); 
        
            // Leer los datos JSON enviados en la solicitud
            $rawData = file_get_contents('php://input');
            if ($rawData) {
                $arregloProductosOriginal = json_decode($rawData, true); // Decodificar JSON a un arreglo

                $arregloProductos = []; 
                $arregloCliente = [];    
                $datosEcnontrados = false;

                foreach ($arregloProductosOriginal as $objeto) {
                    if (isset($objeto['codproducto'])) {
                        // Agregar al arreglo de productos solo los objetos con propiedades específicas
                        $arregloProductos[] = [
                            'codproducto' => $objeto['codproducto'],
                            'nombreProducto' => $objeto['nomprod'],
                            'cantidad' => $objeto['cantidad'],
                            'precio' => $objeto['precio']
                        ];
                    }
                    
                    if (isset($objeto['dni']) && !$datosEcnontrados) {
                        // Si encontramos los datos del cliente, los agregamos al arreglo de cliente
                        $datosEcnontrados = true;
                        $arregloCliente[] = [
                            'dni' => $objeto['dni'],
                            'nombreCliente' => $objeto['nombre'],
                            'montoNeto' => $objeto['montoNeto'],
                            'totalIva' => $objeto['totalIva'],
                            'totalApagar' => $objeto['totalApagar']
                        ];
                    }
                }
                
            $pdf = new Pdf($arregloProductos, $arregloCliente );

            $pdf->PdfVenta();

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