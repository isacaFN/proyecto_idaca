<?php

namespace controllers;

use Model\Usuario;
use MVC\router;
use Model\Cliente;

class ApiController{
    public static function apiUsuarios(router $router){
        $usuarios = Usuario::all();

        echo json_encode($usuarios);

    }

    public static function apiClientes(router $router){
        $clientes = cliente::all();

        echo json_encode($clientes);
    }
}