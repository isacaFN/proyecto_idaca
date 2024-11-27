<?php
namespace controllers;

use MVC\router;
use Model\Stock;


class InventarioController{
    public static function inventario(router $router){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stock = Stock::findByCodProducto($_POST['codproducto']);

            if ($stock) {
                // Si el producto existe, sincroniza los datos y actualiza
                $stock->sincronizar($_POST);
                $resultado = $stock->guardar(); // Actualiza con el ID existente
            } else {
                // Si no existe, crea un nuevo registro
                $stock = new Stock($_POST);
                $resultado = $stock->guardar(); // Crea un nuevo registro
            }

            if ($resultado) {
                header('Location: inventario?alert=success');
            }
        }

    // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
    //     header('Content-Type: application/json');
    //     $stock = Stock::findByCodProducto($_POST['codproducto']);
    
    //     if ($stock) {
    //         $stock->sincronizar($_POST);
    //         $resultado = $stock->guardar();
    //     } else {
    //         $stock = new Stock($_POST);
    //         $resultado = $stock->guardar();
    //     }
    
    //     echo json_encode([
    //         'success' => $resultado,
    //         'message' => $resultado ? 'Inventario actualizado correctamente.' : 'Error al actualizar el inventario.',

    //     ]);
    //     exit;
    // }

    $stocks = Stock::productoyCantidad();
    $router->render('inventario/inventario', [
        'stocks' => $stocks
    ]);

    }
}