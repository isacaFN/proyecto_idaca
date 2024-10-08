<?php

namespace controllers;

use MVC\router;
use Model\Cliente;

class ClienteController{

     public static function clientes(router $router){

        $clientes = Cliente::all();

        $router->render('clientes/clientes',[
            'clientes' => $clientes
        ]);
    }
}