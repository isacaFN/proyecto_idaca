<?php

namespace controllers;

use Model\Usuario;
use MVC\router;
use Model\Cliente;
use Model\Producto;
use controllers\VentaController;
use Model\TipoVenta;
use Model\Venta;

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

    public static function apitipoventa(router $router){
        $productos = TipoVenta::all();

        echo json_encode($productos);
    }

    public static function apiventas(router $router){
        $ventas = Venta::all();

        echo json_encode($ventas);
    }

}