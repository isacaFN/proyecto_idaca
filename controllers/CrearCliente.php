<?php

namespace controllers;

use MVC\router;

class CrearCliente{
     public static function crearCliente(router $router){
        $router->render('auth/crear-cliente');
    }
}