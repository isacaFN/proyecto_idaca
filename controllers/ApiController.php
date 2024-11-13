<?php

namespace controllers;

use Model\Usuario;
use MVC\router;
use Model\Cliente;
use Model\Producto;
use controllers\VentaController;

class ApiController{
    public static function apiUsuarios(router $router){
        $usuarios = Usuario::all();

        echo json_encode($usuarios);

    }

    public static function apiClientes(router $router){
        $clientes = cliente::all();

        echo json_encode($clientes);
    }

    public static function apiProductos(router $router){
        $productos = Producto::all();

        echo json_encode($productos);
    }

    public static function apiProductosFerificados(router $router){
        header('Content-Type: application/json'); // Asegúrate de establecer el tipo de contenido

        // Leer el JSON desde la solicitud
        $rawData = file_get_contents('php://input');

        // Verificar si la lectura del JSON fue exitosa
        if ($rawData) {
            $productosCantidad = json_decode($rawData, true); // Convertir JSON a arreglo

            // Procesar los datos (en este caso, solo devolver los datos recibidos)
            echo json_encode([
                'status' => 'success',
                'data' => 'Datos recibidos correctamente'  
            ]);

            // header('location: verificarVenta');
            $router->render('ventas/verificarVenta', [
                
            ]);

        } else {
            // Si no se pudo leer el JSON, enviar un error
            echo json_encode([
                'status' => 'error',
                'message' => 'No se recibieron datos JSON válidos'
            ]);
        }
    }
}