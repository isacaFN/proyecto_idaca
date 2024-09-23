<?php

namespace controllers;

use Classes\Email;
use Model\Usuario;
use MVC\router;

class UsuarioController{

    public static function usuarios(router $router){
        $router->render('users/usuarios');
    }

    public static function crearUsuario(router $router){

        $usuario = new Usuario;

        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevoUsuario();
            
            // verificar si el usuario ya existe
            if(empty($alertas)){
                $resultado = $usuario->extisteUsuario();

                // si el usuario existe, mostrar mensaje de error
                if($resultado->num_rows > 0){
                    $alertas = usuario::getAlertas();
                }else{
                    // hash la contraseña
                    $usuario->hashPassword();

                    // crear token
                    $usuario->crearToken();

                    // enviar el correo electronico con el token
                    $email = new Email($usuario->correo, $usuario->token, $usuario->nombre);

                    debugear($email);
                }
            }

        }
        
        $router->render('users/CrearUsuario', 
        ['usuario' => $usuario,
        'alertas' => $alertas]
        );
    }
}