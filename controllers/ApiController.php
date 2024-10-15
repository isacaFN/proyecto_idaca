<?php

namespace controllers;

use Model\Usuario;
use MVC\router;
use Model\Cliente;
use Model\Producto;

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
}