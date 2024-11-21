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

        // obtener el total de registros
        $totalRegistros = Venta::registrosTotales();

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
                            'totalApagar' => $objeto['totalApagar'],
                            'tipoPago' => $objeto['tipoPago']
                        ];
                    }
                }
                
            $pdf = new Pdf($arregloProductos, $arregloCliente, $totalRegistros);

            $pdf->PdfVenta();

        }
    }
        
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Obtener el parámetro 'pdf' de la URL
            $pdf = $_GET['pdf'] ?? null;  // Si no existe, será null
        
            // Renderizar la página de verificación de la venta, pasando la URL del PDF
            $router->render('ventas/verificarVenta', [
                'pdf' => $pdf  // Pasar la URL del PDF a la vista
            ]);
        }
    }

    public static function guardarVenta(router $router) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arregloProductos = [];
            $detalleCliente = [];
            header('Content-Type: application/json'); 
            // Leer los datos JSON enviados en la solicitud
            $rawData = file_get_contents('php://input');
            if ($rawData) {
                $arregloProductosOriginal = json_decode($rawData, true); // Decodificar JSON a un arreglo

                //console.log(data.arregloproductos.productos[0].cantidad);
                // desde el front vienen juntos los arreglo de los productos facturados y los detalles de la venta y cliente, los separamos aca!
                $arregloProductos = $arregloProductosOriginal['productos'];
                $detalleCliente = $arregloProductosOriginal['cliente'];

                foreach ($arregloProductos as $producto) {
                
                }



                echo json_encode([
                    'status' => 'success',
                    'data' => 'Datos recibidos y PDF generado',
                    'arregloproductos' => $arregloProductos,
                    'arreglocliente' => $detalleCliente
                ]);
            }

        }
    }
}