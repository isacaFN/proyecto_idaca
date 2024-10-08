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

    public static function crearCliente(router $router){

        $cliente = new Cliente;

        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $cliente->sincronizar($_POST);
            $alertas = $cliente->validarCliente();
            
            if(empty($alertas)){

                $resultado = $cliente->extisteCliente();

                if($resultado->num_rows > 0){
                    $alertas = Cliente::getAlertas();
                }else{
                    $resultado = $cliente->crear();

                    if($resultado){
                        header('location: clientes?alert=success');
                    }
                }
            }

        }
        
        $router->render('clientes/crearCliente',[
            'cliente' => $cliente,
            'alertas' => $alertas
        ]);
    }
}