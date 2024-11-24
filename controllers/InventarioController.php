<?php
namespace controllers;

use MVC\router;


class InventarioController{
    public static function inventario(router $router){
        $router->render('inventario/inventario');
    }
}