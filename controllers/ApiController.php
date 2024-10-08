<?php

namespace controllers;

use Model\Usuario;
use MVC\router;

class ApiController{
    public static function apiUsuarios(router $router){
        $usuarios = Usuario::all();

        echo json_encode($usuarios);

    }
}