<?php

namespace controllers;

use MVC\router;
use Model\Venta;

class VentaController{

     public static function ventas(router $router){

        $router->render('ventas/ventas',[
            
        ]);
    }

    public static function crearVenta(router $router){
        $router->render('ventas/crearVenta');
    }
}